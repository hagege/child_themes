/** Diese Funktion filtert das Datum aus dem Excerpt, wenn das Datum vor dem Text steht. 
Bei Beiträgen (z. B. bei Pressemitteilungen) die mit Datum veröffentlicht werden, 
sollte möglichst das Datum ausgeblendet werden, damit im Teaser das Datum nicht zu sehen ist.
Nachteil dieser Lösung: Bei jedem Beitrag auf der Archive-Seite wird diese Funktion ausgeführt:
Mehr Abfragen und schlechtere Performance. 
hgg, 23.7.2021 */

<?php
function excerpt_text_without_date( $excerpt ) {
$finde_doppelpunkt = ":";
//Position ermitteln:
$pos = strpos($excerpt, $finde_doppelpunkt);
if ($pos !== false) {
    // nur dann ersetzen, wenn die Position des Doppelpunktes maximal 11 ist
    // z. B. bei 23.07.2021: oder 6.1.2021:
    if ($pos <= 11) { 
        $excerpt = substr($excerpt, $pos+1);
    }   
} 
// var_dump($excerpt);                                      
return $excerpt;

add_filter( 'get_the_excerpt', 'excerpt_text_without_date', 999 );
?>
