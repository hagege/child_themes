<!DOCTYPE html>
<html <?php language_attributes();?>>
 <head>
  <!-- Define the charset -->
  <meta charset="utf-8">
  <!-- Optimize mobile viewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,viewport-fit=cover">
  <!-- Set IE document compatibility mode -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Set the title -->
  <title><?php wp_title('-',true,'right');?> Protembis</title>
  <!-- Set the description -->
  <meta name="description" content="">
  <!-- Set our Favicons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon-16x16.png" sizes="16x16" />
  <!-- WP head -->
  <?php wp_head();?>
 </head>
 <body <?php body_class();?>>
  <a class="visually-hidden skip-to-content" href="#content" title="Skip to content">Skip to content</a>
  <header>
   <div class="container">
    <a class="logo animated-instant animate-from-top-always" href="<?php echo home_url();?>">
    </a>
    <button id="mobile-nav-open" class="mobile-nav-open span-button hide-on-desktop animated-instant animate-from-top-always animate-delay-1">
     <span class="visually-hidden">Open navigation menu</span>
    </button>
    <div class="header-links hide-nav-on-mobile">
     <div class="mobile-overlay-top hide-on-desktop">
      <a href="<?php echo home_url();?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/logo-icon.svg" alt="Protembis logo without text" width="50" height="39"></a>
      <button id="mobile-nav-close" class="mobile-nav-close span-button">
       <span class="visually-hidden">Close navigation menu</span>
      </button>
     </div>
     <nav class="animated-instant animate-from-top-always animate-delay-1">
      <?php wp_nav_menu(array('theme_location' => 'navigation','container' => ''));?>
     </nav>
     <div class="header-sub-links animated-instant animate-from-top-always animate-delay-1">
      <a id="contact-link" class="header-contact" href="#contact">Contact</a>
      <a id="connect-link" class="header-connect hide-on-desktop" href="#connect">Connect</a>
     </div>
    </div>
   </div>
  </header>