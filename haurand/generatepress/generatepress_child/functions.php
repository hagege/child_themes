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

*/

/*----------------------------------------------------------------*/
/* Start: Block Patterns von haurand.com 
/* Datum: 14.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/

/* eigene Kategorie */
if ( function_exists( 'register_block_pattern_category' ) ) {
  register_block_pattern_category(
    'haurand',
    array( 'label' => __( 'Forms', 'text-domain' ) )
 );
}

function haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
  register_block_pattern_category(
   'Haurand',
   array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category', 'Haurand' ) )
   );
  }
 }
 add_action( 'init', 'haurand_register_block_categories' );

/* Beispiel - nicht benötigt */
/* register_block_pattern(
    'my-plugin/my-awesome-pattern',
    array(
        'title'       => __( 'Two buttons', 'my-plugin' ),
        'description' => _x( 'Two horizontal buttons, the left button is filled in, and the right button is outlined.', 'Block pattern description', 'my-plugin' ),
        'categories'  => array('Haurand'),
        'content'     => "<!-- wp:buttons {\"align\":\"center\"} -->\n<div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"backgroundColor\":\"very-dark-gray\",\"borderRadius\":0} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background has-very-dark-gray-background-color no-border-radius\">" . esc_html__( 'Button One', 'my-plugin' ) . "</a></div>\n<!-- /wp:button -->\n\n<!-- wp:button {\"textColor\":\"very-dark-gray\",\"borderRadius\":0,\"className\":\"is-style-outline\"} -->\n<div class=\"wp-block-button is-style-outline\"><a class=\"wp-block-button__link has-text-color has-very-dark-gray-color no-border-radius\">" . esc_html__( 'Button Two', 'my-plugin' ) . "</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons -->",
    )
);
*/
register_block_pattern(
   'absatz_zentriert',
     array(
     'title' => __( 'Absatz zentriert', 'absatz_zentriert' ),
     'description' => _x( 'Zentrierter Absatz', 'Ein Absatz mit zentriertem Text', 'absatz_zentriert' ),
     'categories'  => array('Haurand'),
     'content'     =>
        "<!-- wp:paragraph {\"align\":\"center\"} -->
        <p class=\"has-text-align-center\">Wir sind eine WordPress - Agentur in Aachen, die professionelle Webseiten zu fairen Konditionen erstellt. Beim Webdesign sorgen wir dafür, dass Ihre neue Homepage grafisch optimal gestaltet ist. Wir erstellen ansprechende und funktionelle Webseiten mit schnellen Ladezeiten (Performance).&nbsp;</p>
        <!-- /wp:paragraph -->",
   )
 );


 register_block_pattern(
  'listbox_rot',
    array(
    'title' => __( 'Listbox rot', 'listbox_rot' ),
    'description' => _x( 'Listbox rot', 'Eine Listbox mit roter Hintergrundfarbe', 'listbox_rot' ),
    'categories'  => array('Haurand'),
    'content'     =>
       "<!-- wp:list {\"style\":{\"color\":{\"background\":\"#b70000\"}},\"textColor\":\"white\"} -->
<ul class=\"has-white-color has-text-color has-background\" style=\"background-color:#b70000\"><li>Fotos</li><li>Texten</li><li>Formularen</li><li>Social Media Buttons</li><li>Downloadbereich</li><li>Newsverwaltung</li><li>Mehrsprachigkeit</li><li>DSGVO- Sicherheit</li><li>und allem, was Ihnen wichtig ist</li></ul>
<!-- /wp:list -->",
)
);

/*----------------------------------------------------------------*/
/* Ende: Block Patterns von haurand.com 
/* Datum: 14.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/



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
/* Start: Shortcode zur Ausgabe eines aktuellen Beitrags
/* Datum: 04.01.2020
/* Autor: hgg
/*----------------------------------------------------------------*/
function shortcode_posts_function($atts){
  // Parameter für Posts
  // Voreinstellung für Parameter, falls keine angegeben werden:
  $werte = shortcode_atts( array(
      'headline' => 'Aktuelle Informationen',
      'category_posts' => 'allgemein',
      'anzahl_posts' => 2,
      'auszug' => 'ja',
      'content_laenge' => 55,
      'show_categories' => 'ja'
    ), $atts);


  // Werte aus dem Shortcode zuordnen: //
  $args['category'] = $werte['category_posts'];
  $args['numberposts'] = $werte['anzahl_posts'];
  // ID von der Kategorie "holen":
  $args['category'] = get_cat_ID($args['category']);
  // Beiträge holen
  $custom_posts = get_posts($args);
  // var_dump($args);
  // var_dump($args['numberposts']);
  // var_dump($posts);
  // Beiträge aufbereiten
  $content = '<h2>' . $werte['headline'] .'</h2>';
  $content .= '<div class="aktuelle_beitraege">';
  // found posts
  if( ! empty( $custom_posts ) ){
    foreach ($custom_posts as $post) {
        $content .= '<div class="beitrags_titel">'.$post->post_title.'</a></div>';
        // $content .= '<p class="beitrags_text">'.get_the_category($post->ID).'</p>';
        $thumbnail_id = get_post_thumbnail_id( $post->ID );
        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        // alte Einstellung: 
        // $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></a>';
        // $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').' alt="'.$alt_text.'"></a>';
        $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full'). ' width=auto height=auto alt="'.$alt_text.'"></a>';
        // hier entweder den Auszug anzeigen (vergisst man leicht, unter Dokument > Auszug)
        if (esc_attr($werte['auszug']) == 'ja'){
          $content .= '<p class="beitrags_text">' . $post->post_excerpt;
        } else {
          // Alternative: Wenn in der Regel Beiträge nur intern genutzt werden, ist diese Lösung einfacher: // 
          $content .= '<p class="beitrags_text">' . custom_post_excerpt($post->post_content, intval($werte['content_laenge']));
        }
        $content .= '<br><a href="'.get_permalink($post->ID).'">Weiterlesen</a>';
        if (esc_attr($werte['show_categories']) == 'ja'){
          $content .= '<br>';
          // $content .= '<div class="flex-container_fuss">';
          $content .= '<span class="beitrags_categories">Kategorien:&nbsp;</span>';
          foreach((get_the_category($post->ID)) as $cat) {
            $content .= '<span class="beitrags_categories"> ' . $cat->cat_name . ',&nbsp;' . '</span>';
          }
          $content .= '<br>';
          // $content .= '</div>';
        }
        $content .= '</p></div><hr>';
        // $content .= '<div class="flex-container_fuss"><a href="'.get_permalink($post->ID).'">Weiterlesen</a></div><hr>';
    }
  }
  $content .= '</div>';
  //Beiträge übergeben
  return $content;
}
add_shortcode('aktuelle_posts', 'shortcode_posts_function');



/*----------------------------------------------------------------*/
/* Diese Funktion reduziert den Content $content_text auf eine Länge von $c_laenge
/*----------------------------------------------------------------*/
function custom_post_excerpt($content_text, $c_laenge ){
// var_dump($content_text);
// $content_text = strip_shortcodes( $post->post_content );
$content_text = apply_filters( 'the_content', $content_text );
$content_text = str_replace(']]>', ']]&gt;', $content_text);
$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
$content_text = wp_trim_words( $content_text,  $c_laenge, $excerpt_more );
// var_dump($content_text);
// var_dump($c_laenge);
return $content_text;
}
/*----------------------------------------------------------------*/
/* Ende: Shortcode zur Ausgabe eines aktuellen Beitrags
/* Datum: 04.01.2020
/* Autor: hgg
/*----------------------------------------------------------------*/



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
        // $ackids_button = '<div class="ackids_container"><div class="mitglied"><a class="button-mitglied" href="https://steadyhq.com/de/aachenerkinder" target="_blank" rel="noopener noreferrer">Werde Mitglied</a></div><div class="mitglied_beschreibung">Werde als Besucher oder Veranstalter Mitglied bei aachenerkinder.de und unterst�tze unsere Arbeit.</div></div>';
        // spezielle Anzeige wegen abgesagter Events, hgg, 19.3.2020
        // nicht auf der Hauptseite zeigen, hgg, 21.9.2020:
        if ( !is_front_page() ) {
          $info_text = utf8_encode('- Bitte beachten: Im März 2021 finden aufgrund der aktuellen Bestimmungen fast keine Veranstaltungen statt.');
          $abgesagte_events ='<div class="ackids_container"><div class="abgesagt"><a class="corona-button-beitrag" href="https://aachenerkinder.de/corona-virus-staedteregion-aachen/">Infos zu Corona</a>' . $info_text . ' </div></div>';
              // return $ackids_button . $content . $ackids_button;
          return $abgesagte_events . $content;
        }
    }

    return $content;
}


?>