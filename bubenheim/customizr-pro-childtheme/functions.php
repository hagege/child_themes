<?php

// include_once("xlsxwriter.class.php");

function child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  /* wp_enqueue_style( 'additional-style', get_template_directory_uri() . '/parallax_scrolling.css' ); */
// die folgende Zeile ist wohl nicht notwendig:
//wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));

}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );


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

add_action('widgets_init', create_function('', 'register_widget( "Schlagwort_widget" );'));
/*----------------------------------------------------------------*/
/* Ende: Schlagwörter-Widget nutzen
/* Datum: 17.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/





/*----------------------------------------------------------------*/
/* Start: Text vor dem loop
/* Datum: 22.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
// Add some text after the header - für theme customizr
/* Nicht genutzt für Bubenheimer Spieleland: 
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
/* Start: WPCF7 > Übertragung Formular mit Excel-Tabelle
/* Datum: 6.2.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

function get_xlsx_before_mail($WPCF7_ContactForm)
{
	$wpcf7 = WPCF7_ContactForm :: get_current() ;
	$submission = WPCF7_Submission :: get_instance() ;
	if ($submission) {
		$posted_data = $submission->get_posted_data();
		if ( empty ($posted_data))
			return ;
		$mail = $WPCF7_ContactForm->prop('mail');
		if($posted_data['Institution'] == 'Verein'){
			$mail['body'] = str_replace('@@PLACEHOLDER@@','Anzahl Personen: '.$posted_data['AnzahlPersonen'],$mail['body']);
			
			$data = array(
				array('Institution', 'Institutionsname', 'Straße', 'PLZ', 'Ort','Anzahl zahlende Personen', 'Vorname', 'Name', 'E-Mail'),
				array($posted_data['Institution'], $posted_data['institutionsname'], $posted_data['str'], $posted_data['plz'], $posted_data['ort'], $posted_data['AnzahlPersonen'], $posted_data['first-name'], $posted_data['last-name'], $posted_data['your-email'])
			);
      /* hgg, 13.02.2020. Nicht mehr verwendet:
			$writer = new XLSXWriter();
			$writer->writeSheet($data);
			$writer->writeToFile('wp-content/form/'.$posted_data['last-name'].$posted_data['first-name'].'.xlsx');
       hgg, 13.02.2020. Nicht mehr verwendet: */
		}
				else{
			$mail['body'] = str_replace('@@PLACEHOLDER@@','Anzahl Betreuer / Erwachsene: '.$posted_data['AnzahlBetreuer'].' , Anzahl Kinder: '.$posted_data['AnzahlKinder']. ' , Alter der Kinder: '.$posted_data['alter_kinder'],$mail['body']);
			
			$kk = floor ($posted_data['AnzahlKinder'] / 10);
			$freeBetreuer = $posted_data['AnzahlBetreuer'] - $kk;
			if($freeBetreuer < 0)
				$freeBetreuer = 0;
			$data = array(
				array('Institution', 'Institutionsname', 'Straße', 'PLZ', 'Ort','Anzahl zahlende Personen', 'Vorname', 'Name', 'E-Mail'),
				array($posted_data['Institution'], $posted_data['institutionsname'], $posted_data['str'], $posted_data['plz'], $posted_data['ort'], $posted_data['AnzahlKinder'] + $freeBetreuer, $posted_data['first-name'], $posted_data['last-name'], $posted_data['your-email'])
			);
      /* hgg, 13.02.2020. Nicht mehr verwendet:
			$writer = new XLSXWriter();
			$writer->writeSheet($data);
			$writer->writeToFile('wp-content/form/'.$posted_data['last-name'].$posted_data['first-name'].'.xlsx');
       hgg, 13.02.2020. Nicht mehr verwendet: */
		}
			
		if($posted_data['newsletter']){
			$timestamp = time();
			$datum = date("d.m.Y - H:i:s", $timestamp);
			$mail['body'] = str_replace('@@PLACEHOLDER2@@', 'ja , Zeitpunkt der Zustimmung: '.$datum ,$mail['body']);
      // hgg, 13.02.2020. Nicht mehr verwendet:
			$path = 'form/'.$posted_data['last-name'].$posted_data['first-name'].'.xlsx';
			$mail['attachments'] = $path;
      // hgg, 13.02.2020: Zusätzliche Felder ausgeben
      $mail['body'] = str_replace('@@PLACEHOLDER3@@', $posted_data['Institution'] . "\n" . $posted_data['institutionsname'] . "\n" . $posted_data['str'] . "\n" . $posted_data['plz'] . "\n" . $posted_data['ort'] . "\n" . $posted_data['first-name'] . "\n" . $posted_data['last-name'] . "\n" . $posted_data['your-email'], $mail['body']);
      // Alternative: Auflistung mit Komma und dann in Excel > Daten > Text in Spalten
      // hat aber leider beim Test nicht ganz sauber funktioniert, wenn z. B. ein Komma im Text übergeben wird.
      // $mail['body'] = str_replace('@@PLACEHOLDER3@@', $posted_data['Institution'] . ", " . $posted_data['institutionsname'] . ", " . $posted_data['str'] . ", " . $posted_data['plz'] . ", " . $posted_data['ort'] . ", " . $posted_data['first-name'] . ", " . $posted_data['last-name'] . ", " . $posted_data['your-email'], $mail['body']);
		} else {
			$mail['body'] = str_replace('@@PLACEHOLDER2@@', 'nein',$mail['body']);
		}
		
		$WPCF7_ContactForm->set_properties( array("mail" => $mail)) ;
		return $WPCF7_ContactForm ;
	}
}
add_action('wpcf7_before_send_mail','get_xlsx_before_mail');
	
function clean_xlsx($WPCF7_ContactForm){
	$submission = WPCF7_Submission :: get_instance();
	$posted_data = $submission->get_posted_data();
	unlink('wp-content/form/'.$posted_data['last-name'].$posted_data['first-name'].'.xlsx');
}
add_action('wpcf7_mail_sent', 'clean_xlsx');
add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
add_action('wp_head', 'replacethiswithyourthemename_wcf7_datepickerfix');
function replacethiswithyourthemename_wcf7_datepickerfix(){
    ?><style>#ui-datepicker-div {z-index:99!important;}</style><?php
};
add_filter( 'wpcf7_validate_select*', 'custom_email_confirmation_validation_filter', 20, 2 );
function custom_email_confirmation_validation_filter( $result, $tag ) {
	if ('Institution' == $tag->name) {
		$selected_field = $_POST['Institution'];
		if ( $selected_field == "---" ) {
			$result->invalidate( $tag, "Bitte Institution auswählen!" );
		}
	}
	if ('anrede' == $tag->name) {
		$selected_field = $_POST['anrede'];
		if ( $selected_field == "---" ) {
			$result->invalidate( $tag, "Bitte Anrede auswählen!" );
		}
	}
	return $result;
};

/*----------------------------------------------------------------*/
/* Ende: WPCF7 > Übertragung Formular mit Excel-Tabelle
/* Datum: 6.2.2020
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
          $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></a>';
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


?>
