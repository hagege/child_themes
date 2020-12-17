<?php 
/* style.css des Parent Themes einfügen */
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


/* Fügt nach dem Auszug (Excerpt) einen Read more-Link " … weiterlesen" ein  */
function new_excerpt_more($more) {
   global $post;
      return '<div class="read-more-button-wrap"><a class="moretag" href="'. get_permalink($post->ID) . '"> ... weiterlesen</a></div>'; 
 }
 add_filter('excerpt_more', 'new_excerpt_more');
 
/* Fügt nach dem manuellen Auszug (Excerpt) einen Read more-Link " … weiterlesen" ein  */
function manual_excerpt_more( $excerpt ) {
 $excerpt_more = '';
 if( has_excerpt() ) {
     $excerpt_more = '<div class="read-more-button-wrap"><a href="' . get_permalink() . '"> ... weiterlesen</a></div>';
 }
 return $excerpt . $excerpt_more;
}
add_filter( 'get_the_excerpt', 'manual_excerpt_more' ); 


/* Wartungsmodus 
function kb_wartungsmodus() {
  if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) { 
  wp_die('
   <html>
    <head>
        <title>Die Webseite ist zur Zeit wegen Wartungsarbeiten nicht erreichbar</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style type="text/css">
            html { background-color: #444444 }
            body { text-align: center; padding: 5%; font: 20px Helvetica, sans-serif; color: #ffffff; background-color: #444444; max-width: 1024px;}
            h1 { font-size: 50px; margin: 0; border-bottom: inherit; }
            article { display: block; text-align: left; margin: 0 auto; color:#ffffff}
            a { color: #87C1A4; text-decoration: none; }
            a:hover { color: #dc8100; text-decoration: none; }
            @media only screen and (max-width : 480px) {
                h1 { font-size: 40px; }
            }
            #error-page p, #error-page .wp-die-message { margin: 0; }
        </style>
    </head>
    <body>
        <article>
            <h1>Diese Webseite wird zur Zeit &uuml;berarbeitet</h1>
            <p>Es kann daher etwas dauern, bis die Seite wieder in gewohnter Form erreicht werden kann.</p>
            <hr>
            <div>
              <img src="https://handwerker-bischoff.de/wp-content/uploads/2020/07/icon_512.png" width="200" alt="Haus- &amp; Handwerkerservice Bischoff">
              <br>
            </div>
            <div>
              <h2>Haus- und Handwerkerservice Bischoff</h2>
              <p>Tel.: 01578-2656934</p>
              <p>Inh. R. Bischoff</p>
              <a href="mailto:info@handwerker-bischoff.de">info@handwerker-bischoff.de</a>
            </div>
            <div>
              <p>Wir k&uuml;mmern uns um Ihre Baustelle - wir sind f&uuml;r Sie da.</p>
              <ul>
              <li>Abbruch</li>
              <li>Malerarbeiten</li>
              <li>Gartenarbeiten</li>
              <li>Reparaturarbeiten</li>
              <li>Winterdienst</li>
              <li>Umbauarbeiten</li>
              <li>Renovierungen</li>
            <!-- <p id="signature">&mdash; <a href="mailto:[Email]">[Name]</a></p> -->
            </div>
            <hr>
        </article>
    </body>
   </html>
', 'Website im Wartungsmodus');
}} 

add_action('get_header', 'kb_wartungsmodus');
?>