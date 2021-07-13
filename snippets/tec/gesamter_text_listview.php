<?php

/* gesamten Text ohne Formatierung zeigen - Liste - hgg, 13.7.2021 */
/* Vorlage: https://gist.github.com/ggwicz/ba85b0f9aa4dadbda538 */

if ( function_exists( 'tribe_get_events' ) ) {
	/**
	 * Ensure that allowed HTML is preserved in Events Calendar tooltips.
	 *
	 * @link http://theeventscalendar.com/?p=1038901
	 */
	add_filter( 'wp_trim_words', 'tribe_support_1038901', 10, 4 );
		
	function tribe_support_1038901( $text, $num_words, $more, $original_text ) {
		
		if ( ! tribe_is_event( get_the_ID() ) ) {
			return $text;
		}
	
		if ( null === $more ) {
			$more = '&hellip;';
		}
	
		$text = $original_text;
        // keine Formatierungen
        $text = strip_tags($text);
        // echo var_dump($text); 

/*	 hier Anfang Auskommentierung
		if ( strpos( _x( 'words', 'Word count type. Do not translate!' ), 'characters' ) === 0 && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
			$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
			preg_match_all( '/./u', $text, $words_array );
			$words_array = array_slice( $words_array[0], 0, $num_words + 1 );
			$sep = '';
		} else {
			$words_array = preg_split( "/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY );
			$sep = ' ';
		}
	
		if ( count( $words_array ) > $num_words ) {
			array_pop( $words_array );
			$text = implode( $sep, $words_array );
			$text = $text . $more;
		} else {
			$text = implode( $sep, $words_array );
		}
/*	 hier Ende Auskommentierung */	
		return $text;
	}
}
?>