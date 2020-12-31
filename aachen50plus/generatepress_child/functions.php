<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

/*----------------------------------------------------------------*/
/* Start: style.css Datei des Eltern-Themes einbinden
/* scheint nicht nötig zu sein, siehe hier: https://docs.generatepress.com/article/using-child-theme/
/* Datum: 30.12.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

/* function child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );
*/ 

/*----------------------------------------------------------------*/
/* Start: Damit 2 Spalten korrekt bei Schlagwörtern angezeigt werden
/* Datum: 30.12.2020
/* Autor: hgg
/*----------------------------------------------------------------*/
add_filter( 'generate_blog_columns', function( $columns ) {
    if ( ! is_singular() && 'tribe_events' === get_post_type() ) {
        $columns = true; 
    }

    return $columns;
} );


/*----------------------------------------------------------------*/
/* Start: Read-More Button, wenn der Beitrag einen Custom Excerpt hat
/* Datum: 31.12.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

add_filter( 'wp_trim_excerpt', 'tu_excerpt_metabox_more' );
function tu_excerpt_metabox_more( $excerpt ) {
    $output = $excerpt;

    if ( has_excerpt() ) {
        $output = sprintf( '%1$s <p class="read-more-container"><a class="read-more button" href="%2$s">%3$s ...</a></p>',
            $excerpt,
            get_permalink(),
            __( 'Read more', 'generatepress' )
        );
    }
	
    return $output;
}



function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );

/* https://theeventscalendar.com/support/forums/topic/counting-posts/ */
function tribe_count_by_cat ( $event_category_slug ) {

    if ( ! class_exists('Tribe__Events__Main') ) return false;


    $tax_query = array(    'taxonomy'    => Tribe__Events__Main::TAXONOMY,
                        'field'        => 'slug',
                        'terms'        => $event_category_slug );

      $args = array( 'post_type' => Tribe__Events__Main::POSTTYPE, 'post_status' => 'publish', 'tax_query' => array( $tax_query ), 'posts_per_page' => -1);

    $query = new WP_Query( $args );

    return $query->found_posts;
}


  /* -- ADD SHARING AFTER EVERY EVENT -- */
  /* Änderung von aachenerkinder auf aachen50plus bei den Grafiken, 25.10.2017, hgg */

  function add_tribe_event_sharing(){
    ?>

    <div class="share">
      Teilen auf:
      <?php /* FACEBOOK */ ?>
      <a target="_blank" class="sharebutton facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode(get_permalink()); ?>" title="<?php _e('Diesen Beitrag auf Facebook teilen'); ?>">
        <img src="https://www.aachen50plus.de/grafiken/facebook.png" alt="facebook" title="facebook" width=16px hight=16px border="0">
      </a>

      <!-- wird z. Zt. nicht in aachen50plus.de genutzt:
      <?php /* TWITTER */ ?>
      <a target="_blank" class="sharebutton twitter" href="https://twitter.com/home?status=<?php echo rawurlencode(get_the_title().' '.get_permalink()); ?>" title="<?php _e('Diesen Beitrag twittern'); ?>">
        <img src="https://www.aachen50plus.de/grafiken/twitter.png" alt="twitter" title="twitter" width=16px hight=16px border="0">
      </a>

      <?php /* GOOGLE PLUS */ ?>
      <a target="_blank" class="sharebutton googleplus" href="https://plus.google.com/share?url=<?php echo rawurlencode(get_permalink()); ?>" title="<?php _e('Diesen Beitrag auf Google+ teilen'); ?>">
        <img src="https://www.aachen50plus.de/grafiken/google_plus.png" alt="Google +" title="Google +" width=16px hight=16px border="0">
      </a>
      -->
      <?php /* Mail */ ?>
      <a class="sharebutton mail" href="mailto:?subject=interessanter Link auf aachen50plus.de&body=Hallo, hier ist ein interessanter Link auf aachen50plus.de:<?php echo rawurlencode(get_permalink()); ?> Viele Grüße" title="<?php _e('Diesen Beitrag per Mail teilen'); ?>">
        <img src="https://www.aachen50plus.de/grafiken/mail.png" alt="Mail" title="Mail" width=16px hight=16px border="0">
      </a>

    </div>

    <?php
  }
  add_action('tribe_events_after_the_content','add_tribe_event_sharing');


  add_theme_support( 'deactivate_tribe_events_calendar' );

  add_filter('widget_display_callback', 'increase_event_widget_limit', 10, 2);

/**
 * Test if the current widget is an Advanced List Widget and fix the event limit if it is.
 */
function increase_event_widget_limit(array $instance, $widget) {
    if (is_a($widget, 'Tribe__Events__Pro__Advanced_List_Widget'))
        $instance['limit'] = 30;

    return $instance;
}
add_filter('avf_title_args', 'fix_blog_page_title', 10, 2);
function fix_blog_page_title($args, $id)
{
    if(is_page($id))
    {
        $parents = get_post_ancestors($id);
        if(!empty($parents))
        {
            $id = $parents[count($parents)-1];
            $args['title'] = get_the_title($id);
        }
    }
    return $args;
}


/*
 * Alters event's archive titles
 */

function tribe_alter_event_archive_titles ( $original_recipe_title, $depth ) {
  // Modify the titles here
  // Some of these include %1$s and %2$s, these will be replaced with relevant dates
  /* $title_upcoming =   'Upcoming Events'; // List View: Upcoming events */
  /* $title_past =       'Past Events'; // List view: Past events */
  $title_upcoming =   'Anstehende Veranstaltungen'; // List View: Upcoming events */
  $title_past =       'Vergangene Veranstaltungen'; // List view: Past events */
  $title_range =      'Veranstaltungen am %1$s - %2$s'; // List view: range of dates being viewed
  /* $title_month =      'Events for %1$s'; // Month View, %1$s = the name of the month */
  $title_month =      'Veranstaltungen im %1$s'; // Month View, %1$s = the name of the month */
  $title_day =        'Veranstaltungen am %1$s'; // Day View, %1$s = the day
  $title_all =        'Alle Veranstaltungen für %s'; // showing all recurrences of an event, %s = event title
  $title_week =       'Veranstaltungen in der Woche %s'; // Week view
  /*
  $title_all =        'All events for %s'; // showing all recurrences of an event, %s = event title
  $title_week =       'Events for week of %s'; // Week view
  */
  // Don't modify anything below this unless you know what it does
  global $wp_query;
  $tribe_ecp = Tribe__Events__Main::instance();
  $date_format = apply_filters( 'tribe_events_pro_page_title_date_format', tribe_get_date_format( true ) );
  // Default Title
  $title = $title_upcoming;
  // If there's a date selected in the tribe bar, show the date range of the currently showing events
  if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {
    if ( $wp_query->get( 'paged' ) > 1 ) {
      // if we're on page 1, show the selected tribe-bar-date as the first date in the range
      $first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
    } else {
      //otherwise show the start date of the first event in the results
      $first_event_date = tribe_format_date( $_REQUEST['tribe-bar-date'], false );
    }
    $last_event_date = tribe_get_end_date( $wp_query->posts[ count( $wp_query->posts ) - 1 ], false );
    $title = sprintf( $title_range, $first_event_date, $last_event_date );
  } elseif ( tribe_is_past() ) {
    $title = $title_past;
  }
  // Month view title
  if ( tribe_is_month() ) {
    $title = sprintf(
      $title_month,
      date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
    );
  }
  // Day view title
  if ( tribe_is_day() ) {
    $title = sprintf(
      $title_day,
      date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) )
    );
  }
  // All recurrences of an event
  if ( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ) {
    $title = sprintf( $title_all, get_the_title() );
  }
  // Week view title
  if ( function_exists('tribe_is_week') && tribe_is_week() ) {
    $title = sprintf(
      $title_week,
      date_i18n( $date_format, strtotime( tribe_get_first_week_day( $wp_query->get( 'start_date' ) ) ) )
    );
  }
  if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
    $cat = get_queried_object();
    $title = '<a href="' . esc_url( tribe_get_events_link() ) . '">' . $title . '</a>';
    $title .= ' &#8250; ' . $cat->name;
  }
  return $title;
}
add_filter( 'tribe_get_events_title', 'tribe_alter_event_archive_titles', 11, 2 );

/* eingefügt am 8.3.2017: */
function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');


/* --------------------------------------------------------- */
/* WPRocket Bot ausgeschaltet, weil es evtl. Probleme beim   */
/* Speichern von Veranstaltungen gibt, 5.9.2017              */
/* --------------------------------------------------------- */
add_filter( 'do_run_rocket_bot', '__return_false');

/*----------------------------------------------------------------*/
/* Start: Ausschließen recaptcha bei lazyload WP Rocket, siehe Antwort von Lucy
/* Datum: 29.12.2017
/* Autor: hgg
/*----------------------------------------------------------------*/
function rocket_lazyload_exclude_src( $src ) {
$src[] = '?cp_contactformtoemail_captcha=captcha';

return $src;
}
add_filter( 'rocket_lazyload_excluded_src', 'rocket_lazyload_exclude_src' );
/*----------------------------------------------------------------*/
/* Ende: Ausschließen recaptcha bei lazyload WP Rocket
/* Datum: 29.12.2017
/* Autor: hgg
/*----------------------------------------------------------------*/

/*----------------------------------------------------------------*/
/* Start: Balken links in der Überschrift der Events fehlte
/* Datum: 12.10.2018
/* Autor: hgg
/* https://wordpress.org/support/topic/category-colors-not-showing-after-update-to-5-2-2/page/2/#post-10757393
/*----------------------------------------------------------------*/
add_filter( 'teccc_fix_category_background_color', function( $null, $category ) {
	return "#top .main_color {$category} .tribe-events-list-event-title,";
}, 10, 2 );
/*----------------------------------------------------------------*/
/* Ende: Balken links in der Überschrift der Events fehlte
/* Datum: 12.10.2018
/* Autor: hgg
/* https://wordpress.org/support/topic/category-colors-not-showing-after-update-to-5-2-2/page/2/#post-10757393
/*----------------------------------------------------------------*/

/*----------------------------------------------------------------*/
/* Start: shortcodes für Anzahl Veranstaltungen und Beiträge
/* Datum: 18.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/

// Display the total number of published posts using the shortcode [published-posts-count]
function customprefix_total_number_published_posts($atts) {
    return wp_count_posts('post')->publish;
}
add_shortcode('published-posts-count', 'customprefix_total_number_published_posts');


// Display the total number of published events using the shortcode [published-events-count]
function customprefix_total_number_published_events($atts) {
    return wp_count_posts('tribe_events')->publish;
}
add_shortcode('published-events-count', 'customprefix_total_number_published_events');

/* Die XMLRPC-Schnittstelle komplett abschalten  
/* hgg, 27.6.2019 */
add_filter( 'xmlrpc_enabled', '__return_false' );
/* Den HTTP-Header vom XMLRPC-Eintrag bereinigen */
add_filter( 'wp_headers', 'AH_remove_x_pingback' );
 function AH_remove_x_pingback( $headers )
 {
 unset( $headers['X-Pingback'] );
 return $headers;
 }


/*----------------------------------------------------------------*/
/* Start: Hinweistext vor dem Content
/* Datum: 22.03.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

add_filter( 'the_content', 'filter_the_content_in_the_main_loop' );

function filter_the_content_in_the_main_loop( $content ) {

    // Prüfen ob wir in dem Loop eines Beitrags oder einer Seite sind
    if (( is_single() OR is_page()) && in_the_loop() && is_main_query() ) {   
        // Den HTML Teil für die Schrift könnt ihr beliebig ändern oder erweitern
        // $ackids_button = '<div class="ackids_container"><div class="mitglied"><a class="button-mitglied" href="https://steadyhq.com/de/aachenerkinder" target="_blank" rel="noopener noreferrer">Werde Mitglied</a></div><div class="mitglied_beschreibung">Werde als Besucher oder Veranstalter Mitglied bei aachenerkinder.de und unterstütze unsere Arbeit.</div></div>';
        // spezielle Anzeige wegen abgesagter Events, hgg, 19.3.2020
        // nicht auf der Hauptseite zeigen, hgg, 21.9.2020:
        if ( !is_front_page() ) {
          $abgesagte_events ='<div class="ackids_container"><div class="abgesagt"><a class="corona-button-beitrag" href="https://aachenerkinder.de/corona-virus-staedteregion-aachen/">Infos zu Corona</a> - Bitte beachten: Im Dezember 2020 finden aufgrund der aktuellen Bestimmungen fast keine Veranstaltungen statt.</div></div>';
              // return $ackids_button . $content . $ackids_button;
          return $abgesagte_events . $content;
        }
    }

    return $content;
}


?>