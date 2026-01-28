<?php
/**
 * Polylang Shortcode - https://wordpress.org/plugins/polylang/
 * Add this code in your functions.php
 * Put shortcode [polylang_langswitcher] to post/page for display flags
 *
 * @return string
 */

// PDF und MP4 erlauben
function erlaube_pdf_mp4_uploads($mimes) {
    $mimes['pdf'] = 'application/pdf';
    $mimes['mp4'] = 'video/mp4';
    $mimes['m4v'] = 'video/mp4';
    return $mimes;
}
add_filter('upload_mimes', 'erlaube_pdf_mp4_uploads');

// Upload-Limit erhöhen (WordPress-Filter)
add_filter('upload_size_limit', function($size) {
    return 32 * 1024 * 1024; // 32MB
});

// Kategorie "Keine Anzeige" ausblenden
function verstecke_keine_anzeige($query) {
    if (!is_admin() && $query->is_main_query() && 
        (is_home() || is_archive() || is_search())) {
        $query->set('cat', '-82');
    }
}
add_action('pre_get_posts', 'verstecke_keine_anzeige');

// SEO: noindex für Kategorie
function noindex_keine_anzeige() {
    if (in_category(82)) {
        echo '<meta name="robots" content="noindex, nofollow">' . "\n";
    }
}
add_action('wp_head', 'noindex_keine_anzeige');