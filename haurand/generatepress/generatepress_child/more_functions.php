<?php

// Einträge in post_excerpt (Beiträge) löschen:
// $wpdb->query( "UPDATE wp_posts SET post_excerpt='' WHERE post_type= 'post' " );
// Einträge in post_excerpt (Veranstaltungen) löschen:
// $wpdb->query( "UPDATE wp_posts SET post_excerpt='' WHERE post_type= 'tribe_events' " );


/*----------------------------------------------------------------*/
/* Start: Damit die Überschrift nicht gezeigt wird.
/*        Funktioniert zwar, aber es wird kein Button "Mehr" angezeigt
/*        außer bei Beiträgen, die einen manuellen excerpt haben
/* Datum: 30.12.2020
/* Autor: hgg
/*---------------------------------------------------------------- */
function bac_wp_strip_header_tags( $excerpt ) {
    $raw_excerpt = $excerpt;
    if ( '' == $excerpt ) {
        //Retrieve the post content.
        $excerpt = get_the_content(''); 
        //remove shortcode tags from the given content.
        $excerpt = strip_shortcodes( $excerpt );
        $excerpt = apply_filters('the_content', $excerpt);
        $excerpt = str_replace(']]>', ']]>', $excerpt);
     
        //Regular expression that strips the header tags and their content.
        $regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
        $excerpt = preg_replace($regex,'', $excerpt);
     
        /***Change the excerpt word count.***/
        $excerpt_word_count = 20; //This is WP default.
        $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
         
        $excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
        }
        return apply_filters('wp_trim_excerpt', $excerpt, $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'bac_wp_strip_header_tags', 5);


/*----------------------------------------------------------------*/
/* Ende: Block Patterns von haurand.com 
/* Datum: 14.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/

/***********************CODE-1************************************************
* @Author: Boutros AbiChedid 
* @Date:   April 18, 2012
* @Websites: bacsoftwareconsulting.com/ ; blueoliveonline.com/
* @Description: Remove header tags and their content From the automatically 
* generated Excerpt.
* Code modifies default excerpt_length and excerpt_more filters.
* Code Does NOT preserve any other HTML formatting in the excerpt.
* @Tested on: WordPress version 3.3.1 
****************************************************************************/
 
function wp_strip_header_tags( $excerpt='' ) {
  $raw_excerpt = $excerpt;
  if ( '' == $excerpt ) {
      //Retrieve the post content.
      $excerpt = get_the_content(''); 
      /* remove shortcode tags from the given content. */
      $excerpt = strip_shortcodes( $excerpt );
      $excerpt = apply_filters('the_content', $excerpt);
      $excerpt = str_replace(']]>', ']]&gt;', $excerpt);
      
   
      //Regular expression that strips the header tags and their content.
      $regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
      $excerpt = preg_replace($regex,'', $excerpt);
   
      /***Change the excerpt word count.***/
      $excerpt_word_count = 55; //This is WP default.
      $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
       
      /*** Change the excerpt ending.***/
      $excerpt_end = '[...]'; //This is the WP default.
      $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
       
      $excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
      }
      return apply_filters('wp_trim_excerpt', preg_replace($regex, '', $excerpt, $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'wp_strip_header_tags', 99);


function wp_strip_header_tags( $excerpt='' ) {
  $raw_excerpt = $excerpt;
  // var_dump($excerpt);
  // echo(the_excerpt());
  if ( '' == $excerpt ) {
      //Retrieve the post content.
      $excerpt = get_the_content(''); 
      /* remove shortcode tags from the given content. */
      $excerpt = strip_shortcodes( $excerpt );
      $excerpt = apply_filters('the_content', $excerpt);
      $excerpt = str_replace(']]>', ']]&gt;', $excerpt);
  }
   
  //Regular expression that strips the header tags and their content.
  $regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
  $excerpt = preg_replace($regex,'', $excerpt);

  /***Change the excerpt word count.***/
  $excerpt_word_count = 55; //This is WP default.
  $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
    
  /*** Change the excerpt ending.***/
  $excerpt_end = '[...]'; //This is the WP default.
  $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
    
  $excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
  
  return apply_filters('wp_trim_excerpt', preg_replace($regex,'', $excerpt), $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'wp_strip_header_tags', 99);

?>

Alternative, aber hat nicht funktioniert:

/**
 *  Create a custom excerpt string from the first paragraph of the content.
 *
 *  @param   integer  $id       The id of the post
 *  @return  string   $excerpt  The excerpt string
 */
function wp_first_paragraph_excerpt( $id=null ) {
  // Set $id to the current post by default
  if( !$id ) {
      global $post;
      $id = get_the_id();
  }

  // Get the post content
  $content = get_post_field( 'post_content', $id );
  var_dump($content);
  $content = apply_filters( 'the_content', strip_shortcodes( $content ) );

  // Remove all tags, except paragraphs
  $excerpt = strip_tags( $content, '<p></p>' );

  // Remove empty paragraph tags
  $excerpt = force_balance_tags( $excerpt );
  $excerpt = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $excerpt );
  $excerpt = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $excerpt );

  // Get the first paragraph
  $excerpt = substr( $excerpt, 0, strpos( $excerpt, '</p>' ) + 4 );

  // Remove remaining paragraph tags
  $excerpt = strip_tags( $excerpt );

  return $excerpt;
}
add_filter( 'get_the_excerpt', 'wp_first_paragraph_excerpt', 99);
?>

/*
add_filter( 'the_excerpt', 'wpse49280_strip_header_tags', 1 );
function wpse49280_strip_header_tags( $excerpt ) {
    // this is just an example, there is probably a better regex
    $regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
    return preg_replace(
        $regex,
        '',
        $excerpt
    );
}
*/


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
    // found posts
    if( ! empty( $custom_posts ) ){
      foreach ($custom_posts as $post) {
          // $content .= '<p class="beitrags_text">'.get_the_category($post->ID).'</p>';
          $thumbnail_id = get_post_thumbnail_id( $post->ID );
          $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
          // alte Einstellung: 
          // $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></a>';
          // $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').' alt="'.$alt_text.'"></a>';
          $content .= '<article>';
          $content .= '<div class="aktuelle_beitraege">';
          $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full'). '" width=auto height=auto alt="'.$alt_text.'"></a>';
          $content .= '<h2 class="beitrags_titel">'.$post->post_title.'</a></h2>';
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
          $content .= '</p></div></div></article>';
          // $content .= '<div class="flex-container_fuss"><a href="'.get_permalink($post->ID).'">Weiterlesen</a></div><hr>';
      }
    }
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