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
function bac_wp_strip_header_tags( $text ) {
    $raw_excerpt = $text;
    if ( '' == $text ) {
        //Retrieve the post content.
        $text = get_the_content(''); 
        //remove shortcode tags from the given content.
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
     
        //Regular expression that strips the header tags and their content.
        $regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
        $text = preg_replace($regex,'', $text);
     
        /***Change the excerpt word count.***/
        $excerpt_word_count = 20; //This is WP default.
        $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
         
        $excerpt = wp_trim_words( $text, $excerpt_length, $excerpt_more );
        }
        return apply_filters('wp_trim_excerpt', $excerpt, $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'bac_wp_strip_header_tags', 5);


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


?>