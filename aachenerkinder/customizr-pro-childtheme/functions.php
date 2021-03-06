<?php

/*----------------------------------------------------------------*/
/* Start: style.css Datei des Eltern-Themes einbinden
/* Datum: 232.09.2019
/* Autor: hgg
/*----------------------------------------------------------------*/

function child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'additional-style_1', get_stylesheet_directory_uri() . '/parallax_scrolling.css' );
  wp_enqueue_style( 'additional-style_2', get_stylesheet_directory_uri() . '/posts_in_site.css' );
   

// die folgende Zeile ist wohl nicht notwendig:
//wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));

}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );        

/*----------------------------------------------------------------*/
/* Ende: style.css Datei des Eltern-Themes einbinden
/* Datum: 23.09.2019
/* Autor: hgg
/*----------------------------------------------------------------*/


/*----------------------------------------------------------------*/
/* Start: Keine Überschrift im Excerpt
/* Datum: 01.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/
/* Klappt zwar so weit, aber bei einem customer excerpt wird ... Weiterlesen... als Link nicht gezeigt */
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

  require_once 'library/inc.kundenfunktionen.php';
  /* wird nicht mehr genutzt, hgg, 8.3.2020 (Anpassung WP Google Maps Checkboxen) */
/*  require_once 'library/inc.overwrite_plugin.php'; */
  require_once 'library/inc.disable_tribe_js.php';
/*  require_once 'library/inc.testfunctions.php'; */

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



/**
 * Test if the current widget is an Advanced List Widget and fix the event limit if it is.
 */
function increase_event_widget_limit(array $instance, $widget) {
    if (is_a($widget, 'Tribe__Events__Pro__Advanced_List_Widget'))
        $instance['limit'] = 30;

    return $instance;
}
add_filter('avf_title_args', 'fix_blog_page_title', 10, 2);




/* eingefügt am 8.3.2017: */
function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');




/*----------------------------------------------------------------*/
/* Start: PHP in Text-Widget nutzen
/* Datum: 05.04.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
add_filter('widget_text', 'gibmirphp', 99);
function gibmirphp($text) {
  if (strpos($text, '<' . '?') !== false) {
    ob_start();
     eval('?' . '>' . $text);
     $text = ob_get_contents();
    ob_end_clean();
  }
  return $text;
}
/*----------------------------------------------------------------*/
/* Ende: PHP in Text-Widget nutzen
/* Datum: 05.04.2018
/* Autor: hgg
/*----------------------------------------------------------------*/


/*----------------------------------------------------------------*/
/* Start: eigenes Schlagwörter-Widget mit weiteren Parametern nutzen
/* Datum: 17.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
class Schlagwort_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'Schlagwort-widget', // Base ID
                'Schlagwort-Wolke', // Name
                array('description' => __('eigene Schlagwort-Wolke (hgg) mit mehreren Parametern'),) // Args
        );
    }

    public function widget($args, $instance) {
        extract($args);

        /* Display Widget */
        $kleinste = ! empty( $instance['smallest'] ) ? $instance['smallest'] : 8;
        $groesste = ! empty( $instance['largest'] ) ? $instance['largest'] : 22;
        $titel = ! empty( $instance['title'] ) ? $instance['title'] : 'Schlagwörter';
        $anzahl = ! empty( $instance['number'] ) ? $instance['number'] : 35;
        $einheit = ! empty( $instance['unit'] ) ? $instance['unit'] : 'pt';
        $sortiert = ! empty( $instance['orderby'] ) ? $instance['orderby'] : 'name';
        ?>
        <div class="sidebar_widget">
           <?php
           echo '<h3 class="widget-title">' . $titel . '</h3>';
           wp_tag_cloud('smallest=' . $kleinste . '&largest=' . $groesste . '&unit=' . $einheit . '&number=' . $anzahl . '&orderby=' . $sortiert);
           ?>
           <!-- Your Content goes here -->

        </div>

        <?php

    }

    public function update($new_instance, $old_instance) {

        $instance = $old_instance;

        /* Strip tags to remove HTML (important for text inputs). */
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : 'Schlagwörter';
        $instance['smallest'] = ( ! empty( $new_instance['smallest'] ) ) ? sanitize_text_field( $new_instance['smallest'] ) : 10;
        $instance['largest'] = ( ! empty( $new_instance['largest'] ) ) ? sanitize_text_field( $new_instance['largest'] ) : 25;
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? sanitize_text_field( $new_instance['number'] ) : 50;
        $instance['unit'] = ( ! empty( $new_instance['unit'] ) ) ? sanitize_text_field( $new_instance['unit'] ) : 'pt';
        $instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? sanitize_text_field( $new_instance['orderby'] ) : 'name';

        /* No need to strip tags for.. */

        return $instance;
    }

    public function form($instance) {

        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Schlagwörter', 'text_domain' );
        $number = ! empty( $instance['number'] ) ? $instance['number'] : esc_html__( '40', 'text_domain' );
        $smallest = ! empty( $instance['smallest'] ) ? $instance['smallest'] : esc_html__( '10', 'text_domain' );
        $largest = ! empty( $instance['largest'] ) ? $instance['largest'] : esc_html__( '25', 'text_domain' );
        $unit = ! empty( $instance['unit'] ) ? $instance['unit'] : esc_html__( 'pt', 'text_domain' );
        $orderby = ! empty( $instance['orderby'] ) ? $instance['orderby'] : esc_html__( 'name', 'text_domain' );

        ?>

        <!-- Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Titel:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_attr_e( 'Anzahl Schlagwörter:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'smallest' ) ); ?>"><?php esc_attr_e( 'Kleinste Schriftgröße:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'smallest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'smallest' ) ); ?>" type="text" value="<?php echo esc_attr( $smallest ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'largest' ) ); ?>"><?php esc_attr_e( 'Größte Schriftgröße:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'largest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'largest' ) ); ?>" type="text" value="<?php echo esc_attr( $largest ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'unit' ) ); ?>"><?php esc_attr_e( 'Einheit (pt, px, em, %):', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'unit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'unit' ) ); ?>" type="text" value="<?php echo esc_attr( $unit ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_attr_e( 'Sortiert (name, count):', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" type="text" value="<?php echo esc_attr( $orderby ); ?>">
        </p>

        <!-- more Settings goes here! -->

        <?php

    }

}
/*----------------------------------------------------------------*/
/* Korrektur, weil create_function() deprecated ab PHP Version 7.2 */
/* hgg, 3.10.2019
/*----------------------------------------------------------------*/
function SW_widget() {
    register_widget('Schlagwort_widget');
}

add_action('widgets_init', 'SW_widget');

/*----------------------------------------------------------------*/
/* Ende: Schlagwörter-Widget nutzen
/* Datum: 17.12.2018
/* Autor: hgg
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
/*----------------------------------------------------------------*/
/* Ende: shortcodes für Anzahl Veranstaltungen und Beiträge
/* Datum: 18.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/


/* Korrektur des Datum-Zeit-Problems bei Veranstaltungen, wenn man den Block (Gutenberg) verwendet */
add_action('admin_head', function(){
    echo "<style>.tribe-editor__date-time .editor-block-list__block > .editor-block-list__insertion-point { top: 50px; }</style>";
});


/*----------------------------------------------------------------*/
/* Start: Text vor dem loop
/* Datum: 22.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
// Add some text after the header - für theme customizr
add_action( '__before_loop' , 'add_promotional_text' );
function add_promotional_text() {
  // If we're not on the home page, do nothing
  if ( !is_front_page() )
    return;
  // Echo the html
  echo "<div class='ackids'><strong>aachenerkinder.de</strong> - Internetportal für Familien und Kinder in der Städteregion Aachen und Umgebung mit Freizeitangeboten und Veranstaltungen, Terminen, vielen Infos und Tipps – Online-Familienzeitung.</div><br>";
}
/*----------------------------------------------------------------*/
/* Ende: Text vor dem loop
/* Datum: 22.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/


/*----------------------------------------------------------------*/
/* Start: Anzeige image in der Beitragsliste
/* Datum: 25.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/

add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
  $columns = array_slice($columns, 0, 1, true) + array("img" => "Beitragsbild") + array_slice($columns, 1, count($columns) - 1, true);
  return $columns;
}

function manage_img_column($column_name, $post_id) {
 if( $column_name == 'img' ) {
  echo get_the_post_thumbnail($post_id, 'thumbnail');
 }
 return $column_name;
}

/*----------------------------------------------------------------*/
/* Ende: Anzeige image in der Beitragsliste
/* Datum: 25.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/



/*----------------------------------------------------------------*/
/* Start: Unterstützerbutton am Ende von jedem Beitrag oder jeder Veranstaltung
/* Datum: 22.09.2019
/* Autor: hgg
/*----------------------------------------------------------------*/

add_filter( 'the_content', 'filter_the_content_in_the_main_loop' );

function filter_the_content_in_the_main_loop( $content ) {

    // Prüfen ob wir in dem Loop eines Beitrags oder einer Seite sind
    if (( is_single() OR is_page()) && in_the_loop() && is_main_query() ) {
        // Den HTML Teil für die Schrift könnt ihr beliebig ändern oder erweitern
        $ackids_button = '<div class="ackids_container"><div class="mitglied"><a class="button-mitglied" href="https://steadyhq.com/de/aachenerkinder" target="_blank" rel="noopener noreferrer">Werde Mitglied</a></div><div class="mitglied_beschreibung">Werde als Besucher oder Veranstalter Mitglied bei aachenerkinder.de und unterstütze unsere Arbeit.</div></div>';
        // spezielle Anzeige wegen abgesagter Events, hgg, 19.3.2020
        $abgesagte_events = '<div class="ackids_container"><div class="mitglied"><a class="button-mitglied" href="https://aachenerkinder.de/corona-virus-staedteregion-aachen/">Infos zu Corona</a></div><div class="mitglied_beschreibung">Alle Infos zu Corona in der Städteregion Aachen - täglich aktualisiert. Im März 2021 finden aufgrund der aktuellen Bestimmungen fast keine Veranstaltungen statt.</div></div>';
        // $abgesagte_events ='<div class="ackids_container"><div class="abgesagt"><strong>Bitte beachten:</strong> Im November 2020 finden so gut wie keine Veranstaltung statt.  Bleibt gesund!</div></div>';
        // return $ackids_button . $content . $ackids_button;
        return $abgesagte_events . $content . $ackids_button;
    }

    return $content;
}
/*----------------------------------------------------------------*/
/* Ende: Unterstützerbutton am Ende von jedem Beitrag oder jeder Veranstaltung
/* Datum: 22.09.2019
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
          $content .= '<div class="flex-container"><a href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></a>';
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
/* Start:  Block pattern - Button für ackids
/* Datum: 11.11.2020
/* Autor: hgg
/*----------------------------------------------------------------*/
register_block_pattern(
   'button-card-pattern',
     array(
     'title' => __( 'ackids-Button', 'button-block-pattern' ),
     'description' => _x( 'Button für ackids', 'Button für ackids', 'button-block-pattern' ),
     'categories'  => array('buttons'),
     'content'     => 
        "<!-- wp:paragraph -->
        <p><a class=\"tribe-events-button-beitrag\" href=\"https://aachenerkinder.de/wp-content/uploads/2020/11/Bekanntmachung_2020_weiterfuehrende_schulen.pdf\">Weitere Infos</a> </p>
        <!-- /wp:paragraph -->",
   )
 )
/*----------------------------------------------------------------*/
/* Ende:  Block pattern - Button für ackids
/* Datum: 11.11.2020
/* Autor: hgg
/*----------------------------------------------------------------*/


?>
