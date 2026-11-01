<?php
/**
 * Single Template for Eventward (GeneratePress Child Theme)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
    <main id="main" <?php generate_do_element_classes( 'main' ); ?>>
        <?php
        /**
         * generate_before_main_content hook.
         */
        do_action( 'generate_before_main_content' );

        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="inside-article">

                    <!-- 1. HEADER: Titel + Featured Image nebeneinander -->
                    <div class="event-header-grid">
                        <div class="event-title-area">
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        </div>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="event-image-area">
                                <?php the_post_thumbnail( 'medium' ); // oder 'large' / 'thumbnail' ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- 2. DETAILS (Wann, Wo, Karte) + Embed Privacy Schutz -->
                    <div class="event-details-section">
                        <?php
                        $details_block = do_blocks( '<!-- wp:eventward/event-details {"part":"summary"} /-->' );
                        echo do_shortcode( $details_block );
                        ?>
                    </div>

                    <!-- 3. DER EVENT-CONTENT (Beschreibung) -->
                    <div class="entry-content event-description-section">
                        <?php the_content(); ?>
                    </div>

                    <!-- 4. WIEDERHOLUNGSTERMINE (Recurring Events) -->
                    <div class="event-recurring-section">
                        <?php
                        echo do_blocks( '<!-- wp:eventward/event-details {"part":"recurring"} /-->' );
                        ?>
                    </div>

                    <!-- 5. KATEGORIEN UND SCHLAGWÖRTER -->
                    <?php
                    // Taxonomie der Veranstaltungskategorien (aus dem Fuss-Plugin, sonst Fallback)
                    $event_cat_taxonomy = function_exists( 'fuss_event_taxonomy' ) ? fuss_event_taxonomy() : '';
                    if ( empty( $event_cat_taxonomy ) ) {
                        $event_cat_taxonomy = 'eventward_category';
                    }

                    // Kategorien als Links auf die Veranstaltungsübersicht (Fotoansicht)
                    $event_categories_html = array();
                    if ( taxonomy_exists( $event_cat_taxonomy ) ) {
                        $event_terms = get_the_terms( get_the_ID(), $event_cat_taxonomy );
                        if ( $event_terms && ! is_wp_error( $event_terms ) ) {
                            foreach ( $event_terms as $event_term ) {
                                if ( function_exists( 'fuss_get_category_data' ) ) {
                                    $cat_data = fuss_get_category_data( $event_term->slug );
                                    $cat_url  = $cat_data['url'];
                                } else {
                                    $cat_url = add_query_arg(
                                        array(
                                            'ew_view' => 'photo',
                                            'ew_cat'  => $event_term->slug,
                                        ),
                                        home_url( '/veranstaltungen/' )
                                    );
                                }
                                $event_categories_html[] = '<a href="' . esc_url( $cat_url ) . '">' . esc_html( $event_term->name ) . '</a>';
                            }
                        }
                    }

                    $event_tags = taxonomy_exists( 'post_tag' ) && is_object_in_taxonomy( get_post_type(), 'post_tag' )
                        ? get_the_term_list( get_the_ID(), 'post_tag', '', ', ', '' )
                        : false;

                    if ( ! empty( $event_categories_html ) || ( $event_tags && ! is_wp_error( $event_tags ) ) ) :
                        ?>
                        <footer class="event-taxonomies entry-meta">
                            <?php if ( ! empty( $event_categories_html ) ) : ?>
                                <span class="event-categories">
                                    <strong>Kategorien:</strong> <?php echo implode( ', ', $event_categories_html ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                                </span>
                            <?php endif; ?>

                            <?php if ( $event_tags && ! is_wp_error( $event_tags ) ) : ?>
                                <span class="event-tags">
                                    <strong> | Schlagwörter:</strong> <?php echo $event_tags; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                                </span>
                            <?php endif; ?>
                        </footer>
                    <?php endif; ?>

                </div>
            </article>
            <?php
        endwhile;

        /**
         * generate_after_main_content hook.
         */
        do_action( 'generate_after_main_content' );
        ?>
    </main>
</div>

<?php
/**
 * generate_after_primary_content_area hook.
 */
do_action( 'generate_after_primary_content_area' );

// Rendert die linke Seitenleiste exakt nach GeneratePress-Standard
generate_construct_sidebars();

get_footer();