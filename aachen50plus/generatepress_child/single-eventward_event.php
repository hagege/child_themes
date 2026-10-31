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