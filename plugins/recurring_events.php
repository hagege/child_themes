<?php
/**
 * Plugin Name: Recurring Events Light (für The Events Calendar)
 * Description: Wiederkehrende Termine für The Events Calendar ohne Pro. Import aus Pro-Serien, Admin-Übersicht, Aufräum-Werkzeuge.
 * Version: 0.6
 * Author: REL
 */

defined( 'ABSPATH' ) || exit;

class REL_Recurring_Events {

    const RULES_KEY   = '_rel_recurrence_rules';
    const CLONE_KEY   = '_rel_parent_event';
    const EXCLUDE_KEY = '_rel_excluded_dates';
    const CAP         = 'edit_posts';
    const HORIZON     = 365; // Tage in die Zukunft

    public function __construct() {
        add_action( 'init', [ $this, 'schedule_cron' ] );
        add_action( 'rel_generate_occurrences', [ $this, 'generate_all' ] );

        add_action( 'add_meta_boxes', [ $this, 'register_metabox' ] );
        add_action( 'save_post_tribe_events', [ $this, 'save_rules' ], 20 );

        add_action( 'admin_menu', [ $this, 'register_menus' ] );
        add_action( 'admin_post_rel_generate_now', [ $this, 'handle_generate_now' ] );
        add_action( 'admin_post_rel_cleanup_all', [ $this, 'handle_cleanup_all' ] );
        add_action( 'admin_post_rel_import_run', [ $this, 'handle_import_run' ] );
    }

    /* ---------------------------------------------------------------
     * Cron
     * ------------------------------------------------------------- */

    public function schedule_cron() {
        if ( ! wp_next_scheduled( 'rel_generate_occurrences' ) ) {
            wp_schedule_event( time() + 300, 'daily', 'rel_generate_occurrences' );
        }
    }

    /* ---------------------------------------------------------------
     * Metabox
     * ------------------------------------------------------------- */

    public function register_metabox() {
        add_meta_box( 'rel_recurrence', 'Wiederholung (REL)', [ $this, 'render_metabox' ], 'tribe_events', 'normal', 'default' );
    }

    public function render_metabox( $post ) {
        wp_nonce_field( 'rel_save_rules', 'rel_nonce' );
        $rule = get_post_meta( $post->ID, self::RULES_KEY, true );
        $rule = is_array( $rule ) ? $rule : [];
        $rule = wp_parse_args( $rule, [
            'type' => 'none', 'interval' => 1, 'weekdays' => [], 'end_type' => 'never',
            'end_after' => 10, 'end_on' => '', 'dates' => [],
        ] );
        $days = [ 1 => 'Mo', 2 => 'Di', 3 => 'Mi', 4 => 'Do', 5 => 'Fr', 6 => 'Sa', 7 => 'So' ];

        if ( get_post_meta( $post->ID, self::CLONE_KEY, true ) ) {
            echo '<p><em>Dieser Termin wurde automatisch aus einem Master-Event erzeugt. Regeln bitte am Master-Event bearbeiten: ';
            $mid = (int) get_post_meta( $post->ID, self::CLONE_KEY, true );
            echo '<a href="' . esc_url( get_edit_post_link( $mid ) ) . '">' . esc_html( get_the_title( $mid ) ) . '</a></em></p>';
            return;
        }
        ?>
        <p>
            <label>Wiederholung:
                <select name="rel_type">
                    <option value="none" <?php selected( $rule['type'], 'none' ); ?>>Keine</option>
                    <option value="daily" <?php selected( $rule['type'], 'daily' ); ?>>Täglich</option>
                    <option value="weekly" <?php selected( $rule['type'], 'weekly' ); ?>>Wöchentlich</option>
                    <option value="monthly" <?php selected( $rule['type'], 'monthly' ); ?>>Monatlich (gleicher Tag)</option>
                    <option value="yearly" <?php selected( $rule['type'], 'yearly' ); ?>>Jährlich</option>
                    <option value="dates" <?php selected( $rule['type'], 'dates' ); ?>>Einzeldaten (Liste)</option>
                </select>
            </label>
            alle <input type="number" min="1" max="52" name="rel_interval" value="<?php echo (int) $rule['interval']; ?>" style="width:60px"> Intervall(e)
        </p>
        <p>Wochentage (nur wöchentlich):
            <?php foreach ( $days as $n => $label ) : ?>
                <label style="margin-right:8px"><input type="checkbox" name="rel_weekdays[]" value="<?php echo (int) $n; ?>" <?php checked( in_array( $n, array_map( 'intval', (array) $rule['weekdays'] ), true ) ); ?>> <?php echo esc_html( $label ); ?></label>
            <?php endforeach; ?>
        </p>
        <p>Ende:
            <select name="rel_end_type">
                <option value="never" <?php selected( $rule['end_type'], 'never' ); ?>>Nie (bis <?php echo (int) self::HORIZON; ?> Tage voraus)</option>
                <option value="after" <?php selected( $rule['end_type'], 'after' ); ?>>Nach Anzahl</option>
                <option value="on" <?php selected( $rule['end_type'], 'on' ); ?>>Am Datum</option>
            </select>
            Anzahl <input type="number" min="1" name="rel_end_after" value="<?php echo (int) $rule['end_after']; ?>" style="width:70px">
            Datum <input type="date" name="rel_end_on" value="<?php echo esc_attr( $rule['end_on'] ); ?>">
        </p>
        <p><label>Einzeldaten (nur Typ "Einzeldaten", ein Eintrag pro Zeile, JJJJ-MM-TT HH:MM):<br>
            <textarea name="rel_dates" rows="4" style="width:260px"><?php echo esc_textarea( implode( "\n", (array) $rule['dates'] ) ); ?></textarea></label></p>
        <p><label>Ausnahmen (ein Datum pro Zeile, JJJJ-MM-TT):<br>
            <textarea name="rel_excluded" rows="3" style="width:200px"><?php echo esc_textarea( implode( "\n", (array) get_post_meta( $post->ID, self::EXCLUDE_KEY, true ) ) ); ?></textarea></label></p>
        <?php
    }

    public function save_rules( $post_id ) {
        if ( ! isset( $_POST['rel_nonce'] ) || ! wp_verify_nonce( $_POST['rel_nonce'], 'rel_save_rules' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) || get_post_meta( $post_id, self::CLONE_KEY, true ) ) {
            return;
        }

        $type = sanitize_key( $_POST['rel_type'] ?? 'none' );
        if ( 'none' === $type ) {
            delete_post_meta( $post_id, self::RULES_KEY );
            return;
        }

        $dates = array_filter( array_map( 'trim', explode( "\n", (string) ( $_POST['rel_dates'] ?? '' ) ) ) );
        $dates = array_values( array_filter( array_map( 'sanitize_text_field', $dates ) ) );

        $rule = [
            'type'      => in_array( $type, [ 'daily', 'weekly', 'monthly', 'yearly', 'dates' ], true ) ? $type : 'weekly',
            'interval'  => max( 1, (int) ( $_POST['rel_interval'] ?? 1 ) ),
            'weekdays'  => array_map( 'intval', (array) ( $_POST['rel_weekdays'] ?? [] ) ),
            'end_type'  => sanitize_key( $_POST['rel_end_type'] ?? 'never' ),
            'end_after' => max( 1, (int) ( $_POST['rel_end_after'] ?? 10 ) ),
            'end_on'    => sanitize_text_field( $_POST['rel_end_on'] ?? '' ),
            'dates'     => $dates,
        ];
        update_post_meta( $post_id, self::RULES_KEY, $rule );

        $ex = array_filter( array_map( 'trim', explode( "\n", (string) ( $_POST['rel_excluded'] ?? '' ) ) ) );
        update_post_meta( $post_id, self::EXCLUDE_KEY, array_values( $ex ) );

        $this->generate_for_master( $post_id );
    }

    /* ---------------------------------------------------------------
     * Terminberechnung
     * ------------------------------------------------------------- */

    /** Liefert DateTimeImmutable aller Folgetermine (ohne den Master selbst). */
    private function compute_dates( $master_id, array $rule ) {
        $start = get_post_meta( $master_id, '_EventStartDate', true );
        if ( ! $start ) {
            return [];
        }
        $tz       = wp_timezone();
        $first    = new DateTimeImmutable( $start, $tz );
        $limit    = new DateTimeImmutable( '+' . self::HORIZON . ' days', $tz );
        $excluded = (array) get_post_meta( $master_id, self::EXCLUDE_KEY, true );

        // Einzeldaten: feste Liste
        if ( 'dates' === $rule['type'] ) {
            $out = [];
            foreach ( (array) ( $rule['dates'] ?? [] ) as $d ) {
                try {
                    $dt = new DateTimeImmutable( $d, $tz );
                } catch ( Exception $e ) {
                    continue;
                }
                if ( $dt->format( 'Y-m-d H:i' ) === $first->format( 'Y-m-d H:i' ) ) {
                    continue;
                }
                if ( in_array( $dt->format( 'Y-m-d' ), $excluded, true ) ) {
                    continue;
                }
                $out[] = $dt;
            }
            usort( $out, function ( $a, $b ) {
                return $a <=> $b;
            } );
            return $out;
        }

        $interval = max( 1, (int) $rule['interval'] );
        $dates    = [];
        $count    = 0;
        $max      = 'after' === $rule['end_type'] ? max( 0, (int) $rule['end_after'] - 1 ) : 1000; // Master zählt mit
        $end_on   = ( 'on' === $rule['end_type'] && $rule['end_on'] ) ? new DateTimeImmutable( $rule['end_on'] . ' 23:59:59', $tz ) : null;

        $cursor = $first;
        for ( $i = 0; $i < 2000 && $count < $max; $i++ ) {
            switch ( $rule['type'] ) {
                case 'daily':
                    $cursor = $cursor->modify( "+{$interval} day" );
                    $batch  = [ $cursor ];
                    break;
                case 'monthly':
                    $cursor = $cursor->modify( "+{$interval} month" );
                    $batch  = [ $cursor ];
                    break;
                case 'yearly':
                    $cursor = $cursor->modify( "+{$interval} year" );
                    $batch  = [ $cursor ];
                    break;
                case 'weekly':
                default:
                    $cursor = $cursor->modify( "+{$interval} week" );
                    $batch  = [];
                    $wd     = ! empty( $rule['weekdays'] ) ? $rule['weekdays'] : [ (int) $first->format( 'N' ) ];
                    $monday = $cursor->modify( 'monday this week' );
                    foreach ( $wd as $d ) {
                        $day = $monday->modify( '+' . ( (int) $d - 1 ) . ' day' )->setTime( (int) $first->format( 'H' ), (int) $first->format( 'i' ) );
                        if ( $day > $first ) {
                            $batch[] = $day;
                        }
                    }
                    sort( $batch );
            }
            foreach ( $batch as $dt ) {
                if ( $dt > $limit || ( $end_on && $dt > $end_on ) ) {
                    return $dates;
                }
                if ( in_array( $dt->format( 'Y-m-d' ), $excluded, true ) ) {
                    continue;
                }
                $dates[] = $dt;
                $count++;
                if ( $count >= $max ) {
                    break;
                }
            }
        }
        return $dates;
    }

    /* ---------------------------------------------------------------
     * Generierung
     * ------------------------------------------------------------- */

    public function generate_all() {
        $masters = get_posts( [
            'post_type' => 'tribe_events', 'post_status' => 'publish', 'posts_per_page' => -1,
            'fields' => 'ids', 'meta_key' => self::RULES_KEY,
        ] );
        foreach ( $masters as $id ) {
            $this->generate_for_master( $id );
        }
        return count( $masters );
    }

    public function generate_for_master( $master_id ) {
        $rule = get_post_meta( $master_id, self::RULES_KEY, true );
        if ( ! is_array( $rule ) ) {
            return 0;
        }
        $master = get_post( $master_id );
        $start  = get_post_meta( $master_id, '_EventStartDate', true );
        $end    = get_post_meta( $master_id, '_EventEndDate', true );
        if ( ! $master || ! $start || ! $end ) {
            return 0;
        }
        $duration = max( 0, strtotime( $end ) - strtotime( $start ) );
        $created  = 0;

        $existing = get_posts( [
            'post_type' => 'tribe_events', 'post_status' => 'any', 'posts_per_page' => -1,
            'fields' => 'ids', 'meta_key' => self::CLONE_KEY, 'meta_value' => $master_id,
        ] );
        $have = [];
        foreach ( $existing as $cid ) {
            $have[ get_post_meta( $cid, '_EventStartDate', true ) ] = $cid;
        }

        $wanted = [];
        foreach ( $this->compute_dates( $master_id, $rule ) as $dt ) {
            $s            = $dt->format( 'Y-m-d H:i:s' );
            $wanted[ $s ] = true;
            if ( isset( $have[ $s ] ) ) {
                continue;
            }
            $e      = date( 'Y-m-d H:i:s', strtotime( $s ) + $duration );
            $new_id = wp_insert_post( [
                'post_type' => 'tribe_events', 'post_status' => $master->post_status,
                'post_title' => $master->post_title, 'post_content' => $master->post_content,
                'post_excerpt' => $master->post_excerpt, 'post_author' => $master->post_author,
            ] );
            if ( is_wp_error( $new_id ) || ! $new_id ) {
                continue;
            }
            $this->copy_meta( $master_id, $new_id );
            update_post_meta( $new_id, '_EventStartDate', $s );
            update_post_meta( $new_id, '_EventEndDate', $e );
            update_post_meta( $new_id, '_EventStartDateUTC', get_gmt_from_date( $s ) );
            update_post_meta( $new_id, '_EventEndDateUTC', get_gmt_from_date( $e ) );
            update_post_meta( $new_id, '_EventDuration', $duration );
            update_post_meta( $new_id, self::CLONE_KEY, $master_id );
            foreach ( [ 'tribe_events_cat', 'post_tag' ] as $tax ) {
                wp_set_object_terms( $new_id, wp_get_object_terms( $master_id, $tax, [ 'fields' => 'ids' ] ), $tax );
            }
            $thumb = get_post_thumbnail_id( $master_id );
            if ( $thumb ) {
                set_post_thumbnail( $new_id, $thumb );
            }
            $created++;
        }

        // Zukünftige Klone entfernen, die nicht mehr zur Regel passen
        foreach ( $have as $s => $cid ) {
            if ( ! isset( $wanted[ $s ] ) && strtotime( $s ) > time() ) {
                wp_delete_post( $cid, true );
            }
        }
        return $created;
    }

    private function copy_meta( $from, $to ) {
        $skip = [ self::RULES_KEY, self::CLONE_KEY, self::EXCLUDE_KEY, '_EventStartDate', '_EventEndDate',
            '_EventStartDateUTC', '_EventEndDateUTC', '_edit_lock', '_edit_last', '_EventDuration',
            '_EventRecurrence', '_tribe_modified_fields', '_EventOccurrencesCount', '_thumbnail_id' ];
        foreach ( get_post_meta( $from ) as $key => $values ) {
            if ( in_array( $key, $skip, true ) || 0 === strpos( $key, '_oembed_' ) ) {
                continue;
            }
            foreach ( $values as $v ) {
                add_post_meta( $to, $key, maybe_unserialize( $v ) );
            }
        }
    }

    /* ---------------------------------------------------------------
     * Aufräumen
     * ------------------------------------------------------------- */

    public function handle_cleanup_all() {
        check_admin_referer( 'rel_cleanup_all' );
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Keine Berechtigung.' );
        }
        $clones = get_posts( [
            'post_type' => 'tribe_events', 'post_status' => 'any', 'posts_per_page' => -1,
            'fields' => 'ids', 'meta_key' => self::CLONE_KEY,
        ] );
        $removed = 0;
        foreach ( $clones as $cid ) {
            $master = (int) get_post_meta( $cid, self::CLONE_KEY, true );
            $start  = get_post_meta( $cid, '_EventStartDate', true );
            $orphan = ! $master || ! get_post( $master ) || ! is_array( get_post_meta( $master, self::RULES_KEY, true ) );
            $old    = $start && strtotime( $start ) < strtotime( '-1 day' );
            if ( $orphan || $old ) {
                wp_delete_post( $cid, true );
                $removed++;
            }
        }
        wp_safe_redirect( add_query_arg( [ 'page' => 'rel-overview', 'rel_msg' => 'cleaned', 'n' => $removed ], admin_url( 'edit.php?post_type=tribe_events' ) ) );
        exit;
    }

    public function handle_generate_now() {
        check_admin_referer( 'rel_generate_now' );
        if ( ! current_user_can( self::CAP ) ) {
            wp_die( 'Keine Berechtigung.' );
        }
        $this->generate_all();
        wp_safe_redirect( add_query_arg( [ 'page' => 'rel-overview', 'rel_msg' => 'generated' ], admin_url( 'edit.php?post_type=tribe_events' ) ) );
        exit;
    }

    /* ---------------------------------------------------------------
     * Menüs
     * ------------------------------------------------------------- */

    public function register_menus() {
        add_submenu_page(
            'edit.php?post_type=tribe_events',
            'Wiederkehrende Termine (REL)',
            'REL: Übersicht',
            self::CAP,
            'rel-overview',
            [ $this, 'render_overview' ]
        );
        add_submenu_page(
            'edit.php?post_type=tribe_events',
            'REL: Import aus Serien',
            'REL: Serien-Import',
            'manage_options',
            'rel-import',
            [ $this, 'render_import_page' ]
        );
    }

    /* ---------------------------------------------------------------
     * Übersicht
     * ------------------------------------------------------------- */

    public function render_overview() {
        if ( ! current_user_can( self::CAP ) ) {
            return;
        }
        echo '<div class="wrap"><h1>Wiederkehrende Termine (REL)</h1>';

        if ( isset( $_GET['rel_msg'] ) ) {
            if ( 'cleaned' === $_GET['rel_msg'] ) {
                echo '<div class="notice notice-success"><p>' . (int) ( $_GET['n'] ?? 0 ) . ' veraltete bzw. verwaiste Termine entfernt.</p></div>';
            } elseif ( 'generated' === $_GET['rel_msg'] ) {
                echo '<div class="notice notice-success"><p>Termine wurden neu berechnet.</p></div>';
            } elseif ( 'imported' === $_GET['rel_msg'] ) {
                echo '<div class="notice notice-success"><p>' . (int) ( $_GET['n'] ?? 0 ) . ' Serien wurden importiert, ' . (int) ( $_GET['c'] ?? 0 ) . ' Termine angelegt.</p></div>';
            }
        }

        $masters = get_posts( [
            'post_type' => 'tribe_events', 'post_status' => 'any', 'posts_per_page' => -1,
            'meta_key' => self::RULES_KEY, 'orderby' => 'title', 'order' => 'ASC',
        ] );

        echo '<p>';
        echo '<a class="button button-primary" href="' . esc_url( wp_nonce_url( admin_url( 'admin-post.php?action=rel_generate_now' ), 'rel_generate_now' ) ) . '">Termine jetzt neu berechnen</a> ';
        if ( current_user_can( 'manage_options' ) ) {
            echo '<a class="button" onclick="return confirm(\'Veraltete und verwaiste Folgetermine endgültig löschen?\');" href="' . esc_url( wp_nonce_url( admin_url( 'admin-post.php?action=rel_cleanup_all' ), 'rel_cleanup_all' ) ) . '">Alles aufräumen</a> ';
            echo '<a class="button" href="' . esc_url( admin_url( 'edit.php?post_type=tribe_events&page=rel-import' ) ) . '">Serien-Import</a>';
        }
        echo '</p>';

        if ( ! $masters ) {
            echo '<p>Noch keine Master-Events mit Wiederholungsregel vorhanden.</p></div>';
            return;
        }

        $labels = [ 'daily' => 'täglich', 'weekly' => 'wöchentlich', 'monthly' => 'monatlich', 'yearly' => 'jährlich', 'dates' => 'Einzeldaten' ];
        echo '<table class="widefat striped"><thead><tr><th>Master-Event</th><th>Regel</th><th>Start</th><th>Folgetermine</th><th>Nächster Termin</th></tr></thead><tbody>';
        foreach ( $masters as $m ) {
            $rule = get_post_meta( $m->ID, self::RULES_KEY, true );
            $kids = get_posts( [
                'post_type' => 'tribe_events', 'post_status' => 'any', 'posts_per_page' => -1,
                'fields' => 'ids', 'meta_key' => self::CLONE_KEY, 'meta_value' => $m->ID,
            ] );
            $next = '';
            $now  = current_time( 'timestamp' );
            $best = PHP_INT_MAX;
            foreach ( $kids as $kid ) {
                $ts = strtotime( get_post_meta( $kid, '_EventStartDate', true ) );
                if ( $ts >= $now && $ts < $best ) {
                    $best = $ts;
                }
            }
            if ( PHP_INT_MAX !== $best ) {
                $next = date_i18n( 'd.m.Y H:i', $best );
            }
            $type = $labels[ $rule['type'] ] ?? '?';
            printf(
                '<tr><td><a href="%s">%s</a></td><td>%s, Intervall %d</td><td>%s</td><td>%d</td><td>%s</td></tr>',
                esc_url( get_edit_post_link( $m->ID ) ),
                esc_html( $m->post_title ),
                esc_html( $type ),
                (int) ( $rule['interval'] ?? 1 ),
                esc_html( get_post_meta( $m->ID, '_EventStartDate', true ) ),
                count( $kids ),
                esc_html( $next ?: '–' )
            );
        }
        echo '</tbody></table></div>';
    }

    /* ---------------------------------------------------------------
     * Import aus Pro-Serien (tec_events.rset / tec_occurrences)
     * ------------------------------------------------------------- */

    /** Parst einen iCal-rset-String in eine REL-Regel. */
    private function parse_rset( $rset ) {
        $rule = [
            'type' => 'dates', 'interval' => 1, 'weekdays' => [], 'end_type' => 'never',
            'end_after' => 10, 'end_on' => '', 'dates' => [],
        ];
        $excl   = [];
        $rrule  = null;
        $lines  = preg_split( '/\r\n|\r|\n/', trim( (string) $rset ) );

        foreach ( $lines as $line ) {
            $line = trim( $line );
            if ( 0 === strpos( $line, 'RRULE:' ) ) {
                $rrule = substr( $line, 6 );
            } elseif ( 0 === strpos( $line, 'RDATE' ) ) {
                $pos = strrpos( $line, ':' );
                if ( false === $pos ) {
                    continue;
                }
                $val = explode( '/', substr( $line, $pos + 1 ) )[0];
                $dt  = $this->ical_to_mysql( $val );
                if ( $dt ) {
                    $rule['dates'][] = $dt;
                }
            } elseif ( 0 === strpos( $line, 'EXDATE' ) ) {
                $pos = strrpos( $line, ':' );
                if ( false === $pos ) {
                    continue;
                }
                foreach ( explode( ',', substr( $line, $pos + 1 ) ) as $val ) {
                    $dt = $this->ical_to_mysql( $val );
                    if ( $dt ) {
                        $excl[] = substr( $dt, 0, 10 );
                    }
                }
            }
        }

        if ( $rrule ) {
            $p = [];
            foreach ( explode( ';', $rrule ) as $part ) {
                $kv = explode( '=', $part, 2 );
                if ( 2 === count( $kv ) ) {
                    $p[ strtoupper( $kv[0] ) ] = $kv[1];
                }
            }
            $map = [ 'DAILY' => 'daily', 'WEEKLY' => 'weekly', 'MONTHLY' => 'monthly', 'YEARLY' => 'yearly' ];
            $freq = $p['FREQ'] ?? '';
            if ( ! isset( $map[ $freq ] ) ) {
                return null;
            }
            $rule['type']     = $map[ $freq ];
            $rule['interval'] = max( 1, (int) ( $p['INTERVAL'] ?? 1 ) );
            if ( ! empty( $p['BYDAY'] ) ) {
                $wd = [ 'MO' => 1, 'TU' => 2, 'WE' => 3, 'TH' => 4, 'FR' => 5, 'SA' => 6, 'SU' => 7 ];
                foreach ( explode( ',', $p['BYDAY'] ) as $d ) {
                    $d = substr( trim( $d ), -2 );
                    if ( isset( $wd[ $d ] ) ) {
                        $rule['weekdays'][] = $wd[ $d ];
                    }
                }
            }
            if ( ! empty( $p['COUNT'] ) ) {
                $rule['end_type']  = 'after';
                $rule['end_after'] = max( 1, (int) $p['COUNT'] );
            } elseif ( ! empty( $p['UNTIL'] ) ) {
                $u = $this->ical_to_mysql( $p['UNTIL'] );
                if ( $u ) {
                    $rule['end_type'] = 'on';
                    $rule['end_on']   = substr( $u, 0, 10 );
                }
            }
            // zusätzliche RDATEs zu einer RRULE gehen nicht in die Regel ein, nur im Fall "dates"
            $rule['dates'] = [];
        } elseif ( ! $rule['dates'] ) {
            return null;
        } else {
            sort( $rule['dates'] );
            $rule['dates'] = array_values( array_unique( $rule['dates'] ) );
        }

        return [ 'rule' => $rule, 'excluded' => array_values( array_unique( $excl ) ) ];
    }

    private function ical_to_mysql( $val ) {
        $val = trim( $val );
        if ( preg_match( '/^(\d{4})(\d{2})(\d{2})T?(\d{2})?(\d{2})?(\d{2})?Z?$/', $val, $m ) ) {
            return sprintf( '%s-%s-%s %s:%s:%s', $m[1], $m[2], $m[3], $m[4] ?? '00', $m[5] ?? '00', $m[6] ?? '00' );
        }
        return null;
    }

    /** Liefert Serien aus tec_events/tec_occurrences. */
    private function find_pro_series( $only_future = true ) {
        global $wpdb;
        $ev = $wpdb->prefix . 'tec_events';
        $oc = $wpdb->prefix . 'tec_occurrences';
        if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $ev ) ) !== $ev ) {
            return [];
        }
        $now = current_time( 'mysql' );
        $rows = $wpdb->get_results( $wpdb->prepare(
            "SELECT e.event_id, e.post_id, e.rset,
                    COUNT(o.occurrence_id) AS occ_count,
                    SUM(CASE WHEN o.start_date >= %s THEN 1 ELSE 0 END) AS future_count,
                    MIN(o.start_date) AS first_occ,
                    MAX(o.start_date) AS last_occ
             FROM `{$ev}` e
             LEFT JOIN `{$oc}` o ON o.event_id = e.event_id
             WHERE e.rset IS NOT NULL AND e.rset <> ''
             GROUP BY e.event_id, e.post_id, e.rset
             ORDER BY last_occ DESC",
            $now
        ) );

        $out = [];
        foreach ( (array) $rows as $r ) {
            if ( $only_future && (int) $r->future_count < 1 ) {
                continue;
            }
            if ( ! get_post( $r->post_id ) ) {
                continue;
            }
            $parsed = $this->parse_rset( $r->rset );
            $r->parsed = $parsed;
            $out[]     = $r;
        }
        return $out;
    }

    private function occurrences_of( $event_id ) {
        global $wpdb;
        $oc = $wpdb->prefix . 'tec_occurrences';
        return $wpdb->get_results( $wpdb->prepare(
            "SELECT start_date, end_date FROM `{$oc}` WHERE event_id = %d ORDER BY start_date ASC",
            $event_id
        ) );
    }

    public function render_import_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        global $wpdb;
        $all = ! empty( $_GET['all'] );

        echo '<div class="wrap"><h1>REL: Import aus Pro-Serien</h1>';
        echo '<p>Liest die Serien aus <code>tec_events.rset</code> und <code>tec_occurrences</code>, legt die Regel am Master-Termin ab und erzeugt die künftigen Folgetermine als echte Termine. <strong>Es wird nichts gelöscht.</strong> Bitte vorher ein Datenbank-Backup erstellen.</p>';

        $series = $this->find_pro_series( ! $all );
        $labels = [ 'daily' => 'täglich', 'weekly' => 'wöchentlich', 'monthly' => 'monatlich', 'yearly' => 'jährlich', 'dates' => 'Einzeldaten' ];

        echo '<p>' . count( $series ) . ' Serien' . ( $all ? ' (inkl. abgelaufene)' : ' mit künftigen Terminen' ) . ' gefunden. ';
        echo '<a href="' . esc_url( add_query_arg( 'all', $all ? '0' : '1' ) ) . '">' . ( $all ? 'Nur künftige zeigen' : 'Auch abgelaufene zeigen' ) . '</a></p>';

        if ( ! $series ) {
            echo '<div class="notice notice-warning"><p>Keine Serien gefunden.</p></div></div>';
            return;
        }

        echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '">';
        echo '<input type="hidden" name="action" value="rel_import_run">';
        echo '<input type="hidden" name="all" value="' . ( $all ? 1 : 0 ) . '">';
        wp_nonce_field( 'rel_import_run' );
        echo '<table class="widefat striped"><thead><tr><td class="check-column"><input type="checkbox" checked onclick="document.querySelectorAll(\'.relchk\').forEach(function(c){c.checked=this.checked}.bind(this))"></td><th>Event</th><th>Regel</th><th>Vorkommen</th><th>Künftig</th><th>Letzter Termin</th></tr></thead><tbody>';
        $importable = 0;
        foreach ( $series as $r ) {
            $p = $r->parsed;
            if ( $p ) {
                $rl  = $p['rule'];
                $txt = $labels[ $rl['type'] ];
                if ( 'dates' !== $rl['type'] ) {
                    $txt .= ', alle ' . (int) $rl['interval'];
                    if ( $rl['weekdays'] ) {
                        $txt .= ' (' . implode( ',', $rl['weekdays'] ) . ')';
                    }
                    if ( 'after' === $rl['end_type'] ) {
                        $txt .= ', ' . (int) $rl['end_after'] . 'x';
                    } elseif ( 'on' === $rl['end_type'] ) {
                        $txt .= ', bis ' . $rl['end_on'];
                    }
                }
                $importable++;
                echo '<tr><th class="check-column"><input type="checkbox" class="relchk" name="ids[]" value="' . (int) $r->event_id . '" checked></th>';
            } else {
                $txt = 'nicht lesbar, wird übersprungen';
                echo '<tr><th class="check-column"></th>';
            }
            echo '<td><a href="' . esc_url( get_edit_post_link( $r->post_id ) ) . '">' . esc_html( get_the_title( $r->post_id ) ) . '</a></td>';
            echo '<td>' . esc_html( $txt ) . '</td><td>' . (int) $r->occ_count . '</td><td>' . (int) $r->future_count . '</td><td>' . esc_html( $r->last_occ ) . '</td></tr>';
        }
        echo '</tbody></table>';
        if ( $importable ) {
            submit_button( 'Ausgewählte Serien importieren', 'primary', 'submit', true );
        }
        echo '</form></div>';
    }

    public function handle_import_run() {
        check_admin_referer( 'rel_import_run' );
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Keine Berechtigung.' );
        }
        @set_time_limit( 0 );
        $ids    = array_map( 'intval', (array) ( $_POST['ids'] ?? [] ) );
        $all    = ! empty( $_POST['all'] );
        $done   = 0;
        $made   = 0;

        foreach ( $this->find_pro_series( ! $all ) as $r ) {
            if ( ! in_array( (int) $r->event_id, $ids, true ) || ! $r->parsed ) {
                continue;
            }
            $master = (int) $r->post_id;
            $rule   = $r->parsed['rule'];
            $occ    = $this->occurrences_of( $r->event_id );
            if ( ! $occ ) {
                continue;
            }

            // Master auf das erste noch relevante Vorkommen setzen (ältestes bleibt Basis der Regel)
            $first = $occ[0];
            $dur   = max( 0, strtotime( $first->end_date ) - strtotime( $first->start_date ) );
            update_post_meta( $master, '_EventStartDate', $first->start_date );
            update_post_meta( $master, '_EventEndDate', $first->end_date );
            update_post_meta( $master, '_EventStartDateUTC', get_gmt_from_date( $first->start_date ) );
            update_post_meta( $master, '_EventEndDateUTC', get_gmt_from_date( $first->end_date ) );
            update_post_meta( $master, '_EventDuration', $dur );

            if ( 'dates' === $rule['type'] ) {
                $rule['dates'] = [];
                foreach ( $occ as $o ) {
                    $rule['dates'][] = substr( $o->start_date, 0, 16 );
                }
            }

            update_post_meta( $master, self::RULES_KEY, $rule );
            update_post_meta( $master, self::EXCLUDE_KEY, $r->parsed['excluded'] );

            $made += (int) $this->generate_for_master( $master );
            $done++;
        }

        wp_safe_redirect( add_query_arg( [ 'page' => 'rel-overview', 'rel_msg' => 'imported', 'n' => $done, 'c' => $made ], admin_url( 'edit.php?post_type=tribe_events' ) ) );
        exit;
    }

} // Ende Klasse

new REL_Recurring_Events();