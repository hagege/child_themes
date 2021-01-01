<?php
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
        echo "<p>Variablen:<br />\n</p>";
        // Hier ist die Überschrift nicht enthalten und der Button wird gezeigt: //
        var_dump($text);
     
        /***Change the excerpt word count.***/
        
        $excerpt_word_count = 20; //This is WP default.
        $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
        // diese Zeile verhindert die Ausgabe des Weiterlesen-Buttons: 
        // $excerpt = wp_trim_words( $text, $excerpt_length, $excerpt_more );
        echo "<p>Variablen:<br />\n</p>";
        var_dump($excerpt);
        var_dump($excerpt_more);
        
        }
    return apply_filters('wp_trim_excerpt', $excerpt, $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'bac_wp_strip_header_tags', 5);

?>