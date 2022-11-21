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
/*---------------------------------------------------------------- */
add_filter( 'generate_blog_columns', function( $columns ) {
    if ( ! is_singular() && 'tribe_events' === get_post_type() && ! is_post_type_archive( 'tribe_events' ) ) {
        $columns = true;
    }

    return $columns;
} );


/*----------------------------------------------------------------*/
/* Start: Read-More Button, wenn der Beitrag einen Custom Excerpt hat
/* Datum: 31.12.2020
/* nicht mehr notwendig, wenn keine custom excerpts angelegt werden (3.1.2021)
/* Autor: hgg
/*----------------------------------------------------------------

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

/*----------------------------------------------------------------*/
/* Start: Keine Überschrift im Excerpt
/* Datum: 01.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/
/* Klappt zwar so weit, aber bei einem customer excerpt wird zwei Mal der Button gezeigt */
function wp_strip_header_tags( $excerpt='' ) {

        $raw_excerpt = $excerpt;
        if ( '' == $excerpt ) {
                $excerpt = get_the_content('');
                $excerpt = strip_shortcodes( $excerpt );
                $excerpt = apply_filters('the_content', $excerpt);
                $excerpt = str_replace(']]>', ']]>', $excerpt);
        }
        $regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
        $excerpt = preg_replace($regex,'', $excerpt);
        $excerpt_length = apply_filters('excerpt_length', 55);
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
        $excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );

    return apply_filters('wp_trim_excerpt', preg_replace($regex,'', $excerpt), $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'wp_strip_header_tags', 9);


/* adds the RTL stylesheet if you're using an RTL language. If not, you can remove the function.
function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );
*/

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
      <a class="sharebutton mail" href="mailto:?subject=interessanter Link auf aachen50plus.de&body=Hallo, hier ist ein interessanter Link auf aachen50plus.de:<?php echo rawurlencode(get_permalink()); ?> Viele Gr��e" title="<?php _e('Diesen Beitrag per Mail teilen'); ?>">
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


/*
 +===========================================================================================+
 | NinjaFirewall optional configuration file                                                 |
 |                                                                                           |
 | See: https://blog.nintechnet.com/ninjafirewall-wp-edition-the-htninja-configuration-file/ |
 +===========================================================================================+
*/
if ( isset( $_SERVER['REMOTE_ADDR'] ) && $_SERVER['REMOTE_ADDR'] == '185.30.32.248' ) {
  define('NFW_UWL', true);
  return 'ALLOW';
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
        // spezielle Anzeige wegen abgesagter Events, hgg, 19.3.2020
        // nicht auf der Hauptseite zeigen, hgg, 21.9.2020:
        if ( !is_front_page() ) {
          $ackids_button = '<div class="ackids_container"><div class="mitglied"><a class="button-mitglied" href="https://steadyhq.com/de/aachenerkinder" target="_blank" rel="noopener noreferrer">Werde Mitglied</a></div><div class="mitglied_beschreibung">Werde als Besucher oder Veranstalter Mitglied bei aachenerkinder.de und unterstütze unsere Arbeit.</div></div>';
          //$info_text = utf8_encode(' Bitte beachten: Zur Zeit finden aufgrund der aktuellen Bestimmungen fast nur Online-Veranstaltungen statt.');
          // $abgesagte_events ='<div class="ackids_container"><div class="abgesagt"><a class="corona-button-beitrag" href="https://aachenerkinder.de/corona-virus-staedteregion-aachen/">Infos zu Corona</a>' . $info_text . ' </div></div>';

          // $abgesagte_events ='<div class="ackids_container"><div class="mitglied"><a class="button-mitglied" href="http://aachener-senioren.de/_test_/corona-virus-staedteregion-aachen/">Infos zu Corona</a></div><p class="ackids-info-box">' . $info_text . ' </p></div>';
          // return $ackids_button . $content . $ackids_button;
          return $content . $ackids_button;
        }
    }

    return $content;
}


?>