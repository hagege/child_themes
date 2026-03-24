<?php
/**
 * GSG Gymnasium Block Patterns
 * 
 * Füge diesen Code in die functions.php ein
 * oder erstelle eine separate Datei patterns.php und include sie
 */

// Register Block Pattern Category
function gsg_register_pattern_category() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'gsg',
            array('label' => __('GSG Gymnasium', 'gsg-child'))
        );
    }
}
add_action('init', 'gsg_register_pattern_category');

// === PATTERN 1: HERO SECTION ===
function gsg_register_hero_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'gsg/hero-section',
            array(
                'title'       => __('GSG Hero Section', 'gsg-child'),
                'description' => __('Hero-Bereich mit Statistiken und Call-to-Action', 'gsg-child'),
                'categories'  => array('gsg', 'featured'),
                'keywords'    => array('hero', 'header', 'start'),
                'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"gradient":"gsg-hero-gradient","textColor":"base","className":"gsg-hero","layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull gsg-hero has-base-color has-text-color has-background has-gsg-hero-gradient-gradient-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--90);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--90);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"3.5rem","fontWeight":"800","lineHeight":"1.1"}}} -->
<h1 class="wp-block-heading" style="font-size:3.5rem;font-weight:800;line-height:1.1">Willkommen am <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-gsg-yellow-color">GSG Gymnasium</mark></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem","lineHeight":"1.8"}}} -->
<p style="font-size:1.25rem;line-height:1.8">Wir fördern Talente, bilden Persönlichkeiten und bereiten auf die Zukunft vor. Moderne Bildung in traditionsbewusster Atmosphäre.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:button {"backgroundColor":"gsg-yellow","textColor":"gsg-navy","style":{"border":{"radius":"8px"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-gsg-navy-color has-gsg-yellow-background-color has-text-color has-background wp-element-button" href="#anmeldung" style="border-radius:8px">Jetzt anmelden</a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"base","textColor":"gsg-navy","style":{"border":{"radius":"8px","width":"2px"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"borderColor":"base","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-border-color has-base-border-color has-gsg-navy-color has-base-background-color has-text-color has-background has-link-color wp-element-button" href="#rundgang" style="border-width:2px;border-radius:8px">Virtueller Rundgang</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"1px"}},"backgroundColor":"gsg-navy","borderColor":"gsg-yellow","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-gsg-yellow-border-color has-gsg-navy-background-color has-background" style="border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-yellow"}}}},"textColor":"gsg-yellow"} -->
<p class="has-text-align-center has-gsg-yellow-color has-text-color has-link-color" style="font-size:2.5rem;font-weight:800;line-height:1">850</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"}}} -->
<p class="has-text-align-center" style="font-size:0.95rem">Schüler:innen</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"1px"}},"backgroundColor":"gsg-navy","borderColor":"gsg-yellow","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-gsg-yellow-border-color has-gsg-navy-background-color has-background" style="border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-yellow"}}}},"textColor":"gsg-yellow"} -->
<p class="has-text-align-center has-gsg-yellow-color has-text-color has-link-color" style="font-size:2.5rem;font-weight:800;line-height:1">98%</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"}}} -->
<p class="has-text-align-center" style="font-size:0.95rem">Abitur-Erfolg</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"1px"}},"backgroundColor":"gsg-navy","borderColor":"gsg-yellow","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-gsg-yellow-border-color has-gsg-navy-background-color has-background" style="border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-yellow"}}}},"textColor":"gsg-yellow"} -->
<p class="has-text-align-center has-gsg-yellow-color has-text-color has-link-color" style="font-size:2.5rem;font-weight:800;line-height:1">65</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"}}} -->
<p class="has-text-align-center" style="font-size:0.95rem">Lehrkräfte</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"1px"}},"backgroundColor":"gsg-navy","borderColor":"gsg-yellow","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-gsg-yellow-border-color has-gsg-navy-background-color has-background" style="border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-yellow"}}}},"textColor":"gsg-yellow"} -->
<p class="has-text-align-center has-gsg-yellow-color has-text-color has-link-color" style="font-size:2.5rem;font-weight:800;line-height:1">125+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"}}} -->
<p class="has-text-align-center" style="font-size:0.95rem">Jahre Tradition</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
            )
        );
    }
}
add_action('init', 'gsg_register_hero_pattern');

// === PATTERN 2: NEWS GRID ===
function gsg_register_news_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'gsg/news-grid',
            array(
                'title'       => __('GSG News Grid', 'gsg-child'),
                'description' => __('3-spaltige Neuigkeiten-Übersicht', 'gsg-child'),
                'categories'  => array('gsg'),
                'keywords'    => array('news', 'neuigkeiten', 'blog'),
                'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"gsg-light-gray","layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull has-gsg-light-gray-background-color has-background" style="padding-top:var(--wp--preset--spacing--90);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--90);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h2 class="wp-block-heading has-text-align-center has-gsg-navy-color has-text-color has-link-color" style="font-size:2.5rem;font-weight:800">Aktuelle <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-gsg-yellow-color">Neuigkeiten</mark></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}},"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color" style="margin-bottom:var(--wp--preset--spacing--70)">Bleiben Sie informiert über Ereignisse, Erfolge und Projekte am GSG</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-news-card","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"border":{"radius":"12px"},"shadow":"var:preset|shadow|gsg-card"},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-news-card has-base-background-color has-background" style="border-radius:12px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;box-shadow:var(--wp--preset--shadow--gsg-card)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"6rem"},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"gsg-gray","textColor":"base"} -->
<p class="has-text-align-center has-base-color has-gsg-gray-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);font-size:6rem">🏆</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-gsg-blue-color has-text-color has-link-color" style="font-size:0.85rem">📅 15. März 2026 | 📂 Erfolge</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-gsg-navy-color has-text-color has-link-color">1. Platz bei "Jugend forscht"</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-gsg-blue-color has-text-color has-link-color">Unser Team hat beim Regionalwettbewerb "Jugend forscht" den ersten Platz in der Kategorie Biologie belegt.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<p class="has-gsg-navy-color has-text-color has-link-color"><a href="#">Mehr erfahren →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-news-card","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"border":{"radius":"12px"},"shadow":"var:preset|shadow|gsg-card"},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-news-card has-base-background-color has-background" style="border-radius:12px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;box-shadow:var(--wp--preset--shadow--gsg-card)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"6rem"},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"gsg-gray","textColor":"base"} -->
<p class="has-text-align-center has-base-color has-gsg-gray-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);font-size:6rem">🎭</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-gsg-blue-color has-text-color has-link-color" style="font-size:0.85rem">📅 12. März 2026 | 📂 Veranstaltungen</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-gsg-navy-color has-text-color has-link-color">Theateraufführung</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-gsg-blue-color has-text-color has-link-color">Der Theaterkurs der Q1 präsentiert Dürrenmatts Klassiker. Vorstellungen am 25. und 26. März.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<p class="has-gsg-navy-color has-text-color has-link-color"><a href="#">Mehr erfahren →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-news-card","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"border":{"radius":"12px"},"shadow":"var:preset|shadow|gsg-card"},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-news-card has-base-background-color has-background" style="border-radius:12px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;box-shadow:var(--wp--preset--shadow--gsg-card)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"6rem"},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"gsg-gray","textColor":"base"} -->
<p class="has-text-align-center has-base-color has-gsg-gray-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);font-size:6rem">🌍</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-gsg-blue-color has-text-color has-link-color" style="font-size:0.85rem">📅 8. März 2026 | 📂 Projekte</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-gsg-navy-color has-text-color has-link-color">Erasmus+ Austausch</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-gsg-blue-color has-text-color has-link-color">Schüler der 9. Klassen nehmen an einem zweiwöchigen Austauschprogramm in Barcelona teil.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<p class="has-gsg-navy-color has-text-color has-link-color"><a href="#">Mehr erfahren →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
            )
        );
    }
}
add_action('init', 'gsg_register_news_pattern');

// === PATTERN 3: FACHBEREICHE ===
function gsg_register_fachbereiche_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'gsg/fachbereiche-grid',
            array(
                'title'       => __('GSG Fachbereiche', 'gsg-child'),
                'description' => __('6 Fachbereiche mit Icons', 'gsg-child'),
                'categories'  => array('gsg'),
                'keywords'    => array('fächer', 'fachbereiche', 'subjects'),
                'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"base","layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--90);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--90);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h2 class="wp-block-heading has-text-align-center has-gsg-navy-color has-text-color has-link-color" style="font-size:2.5rem;font-weight:800">Unsere <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-gsg-yellow-color">Fachbereiche</mark></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}},"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color" style="margin-bottom:var(--wp--preset--spacing--70)">Exzellente Bildung in allen Bereichen</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"2px"}},"borderColor":"gsg-light-gray","gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-card has-border-color has-gsg-light-gray-border-color has-background has-gsg-section-gradient-gradient-background" style="border-width:2px;border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} -->
<p class="has-text-align-center" style="font-size:4rem">📖</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-text-align-center has-gsg-navy-color has-text-color has-link-color">Sprachen</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Deutsch, Englisch, Französisch, Spanisch, Latein</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"2px"}},"borderColor":"gsg-light-gray","gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-card has-border-color has-gsg-light-gray-border-color has-background has-gsg-section-gradient-gradient-background" style="border-width:2px;border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} -->
<p class="has-text-align-center" style="font-size:4rem">🔬</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-text-align-center has-gsg-navy-color has-text-color has-link-color">Naturwissenschaften</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Biologie, Chemie, Physik mit modernen Laboren</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"2px"}},"borderColor":"gsg-light-gray","gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-card has-border-color has-gsg-light-gray-border-color has-background has-gsg-section-gradient-gradient-background" style="border-width:2px;border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} -->
<p class="has-text-align-center" style="font-size:4rem">📐</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-text-align-center has-gsg-navy-color has-text-color has-link-color">Mathematik</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Von Grundlagen bis zur Leistungskursebene</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"2px"}},"borderColor":"gsg-light-gray","gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-card has-border-color has-gsg-light-gray-border-color has-background has-gsg-section-gradient-gradient-background" style="border-width:2px;border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} -->
<p class="has-text-align-center" style="font-size:4rem">🎨</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-text-align-center has-gsg-navy-color has-text-color has-link-color">Kunst & Musik</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Kreative Entfaltung in Atelier und Musikräumen</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"2px"}},"borderColor":"gsg-light-gray","gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-card has-border-color has-gsg-light-gray-border-color has-background has-gsg-section-gradient-gradient-background" style="border-width:2px;border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} -->
<p class="has-text-align-center" style="font-size:4rem">⚽</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-text-align-center has-gsg-navy-color has-text-color has-link-color">Sport</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Vielfältiges Sportangebot und AGs</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"gsg-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"2px"}},"borderColor":"gsg-light-gray","gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-card has-border-color has-gsg-light-gray-border-color has-background has-gsg-section-gradient-gradient-background" style="border-width:2px;border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} -->
<p class="has-text-align-center" style="font-size:4rem">🌍</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-text-align-center has-gsg-navy-color has-text-color has-link-color">Gesellschaftswissenschaften</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Geschichte, Politik, Erdkunde, Philosophie</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
            )
        );
    }
}
add_action('init', 'gsg_register_fachbereiche_pattern');

// Pattern wird in nächster Nachricht fortgesetzt...

/**
 * GSG Gymnasium Block Patterns - Teil 2
 * Fortsetzung der Patterns
 */

// === PATTERN 4: TERMINE / EVENTS ===
function gsg_register_termine_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'gsg/termine-list',
            array(
                'title'       => __('GSG Termine Liste', 'gsg-child'),
                'description' => __('Termine-Übersicht mit Datum-Cards', 'gsg-child'),
                'categories'  => array('gsg'),
                'keywords'    => array('termine', 'events', 'kalender'),
                'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"gradient":"gsg-hero-gradient","textColor":"base","layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull has-base-color has-text-color has-background has-gsg-hero-gradient-gradient-background" style="padding-top:var(--wp--preset--spacing--90);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--90);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800"}}} -->
<h2 class="wp-block-heading has-text-align-center" style="font-size:2.5rem;font-weight:800">Wichtige <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-gsg-yellow-color">Termine</mark></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}}} -->
<p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--70)">Planen Sie mit uns - alle wichtigen Daten im Überblick</p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"className":"gsg-event-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"1px"}},"backgroundColor":"gsg-navy","borderColor":"gsg-yellow","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group gsg-event-card has-border-color has-gsg-yellow-border-color has-gsg-navy-background-color has-background" style="border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px"},"layout":{"selfStretch":"fit","flexSize":null},"dimensions":{"minHeight":""}},"backgroundColor":"gsg-yellow","textColor":"gsg-navy","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-gsg-navy-color has-gsg-yellow-background-color has-text-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1"}}} -->
<p class="has-text-align-center" style="font-size:2.5rem;font-weight:800;line-height:1">25</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9rem","textTransform":"uppercase","letterSpacing":"1px"}}} -->
<p class="has-text-align-center" style="font-size:0.9rem;letter-spacing:1px;text-transform:uppercase">MRZ</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem"}}} -->
<h3 class="wp-block-heading" style="font-size:1.5rem">Theateraufführung</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-yellow"}}}},"textColor":"gsg-yellow"} -->
<p class="has-gsg-yellow-color has-text-color has-link-color" style="font-weight:600">🕐 19:00 Uhr | 📍 Aula</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.95rem"}}} -->
<p style="font-size:0.95rem">Premiere: "Der Besuch der alten Dame" - Theaterkurs Q1</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"gsg-event-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"1px"}},"backgroundColor":"gsg-navy","borderColor":"gsg-yellow","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group gsg-event-card has-border-color has-gsg-yellow-border-color has-gsg-navy-background-color has-background" style="border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px"},"layout":{"selfStretch":"fit","flexSize":null}},"backgroundColor":"gsg-yellow","textColor":"gsg-navy","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-gsg-navy-color has-gsg-yellow-background-color has-text-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1"}}} -->
<p class="has-text-align-center" style="font-size:2.5rem;font-weight:800;line-height:1">1</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9rem","textTransform":"uppercase","letterSpacing":"1px"}}} -->
<p class="has-text-align-center" style="font-size:0.9rem;letter-spacing:1px;text-transform:uppercase">APR</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem"}}} -->
<h3 class="wp-block-heading" style="font-size:1.5rem">Tag der offenen Tür</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-yellow"}}}},"textColor":"gsg-yellow"} -->
<p class="has-gsg-yellow-color has-text-color has-link-color" style="font-weight:600">🕐 10:00-14:00 Uhr | 📍 Gesamtes Schulgelände</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.95rem"}}} -->
<p style="font-size:0.95rem">Informieren Sie sich über unser Bildungsangebot und lernen Sie unsere Schule kennen</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"gsg-event-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px","width":"1px"}},"backgroundColor":"gsg-navy","borderColor":"gsg-yellow","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group gsg-event-card has-border-color has-gsg-yellow-border-color has-gsg-navy-background-color has-background" style="border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px"},"layout":{"selfStretch":"fit","flexSize":null}},"backgroundColor":"gsg-yellow","textColor":"gsg-navy","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-gsg-navy-color has-gsg-yellow-background-color has-text-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800","lineHeight":"1"}}} -->
<p class="has-text-align-center" style="font-size:2.5rem;font-weight:800;line-height:1">15</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9rem","textTransform":"uppercase","letterSpacing":"1px"}}} -->
<p class="has-text-align-center" style="font-size:0.9rem;letter-spacing:1px;text-transform:uppercase">APR</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem"}}} -->
<h3 class="wp-block-heading" style="font-size:1.5rem">Elternsprechtag</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-yellow"}}}},"textColor":"gsg-yellow"} -->
<p class="has-gsg-yellow-color has-text-color has-link-color" style="font-weight:600">🕐 14:00-18:00 Uhr | 📍 Klassenräume</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.95rem"}}} -->
<p style="font-size:0.95rem">Individuelle Gespräche mit den Lehrkräften - Anmeldung erforderlich</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
            )
        );
    }
}
add_action('init', 'gsg_register_termine_pattern');

// === PATTERN 5: ANMELDUNG / CTA SECTION ===
function gsg_register_anmeldung_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'gsg/anmeldung-cta',
            array(
                'title'       => __('GSG Anmeldung CTA', 'gsg-child'),
                'description' => __('Call-to-Action Bereich für Anmeldungen', 'gsg-child'),
                'categories'  => array('gsg', 'call-to-action'),
                'keywords'    => array('anmeldung', 'cta', 'kontakt'),
                'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"gradient":"gsg-yellow-gradient","textColor":"gsg-navy","layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull has-gsg-navy-color has-text-color has-background has-gsg-yellow-gradient-gradient-background" style="padding-top:var(--wp--preset--spacing--90);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--90);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"style":{"typography":{"fontSize":"3rem","fontWeight":"800"}}} -->
<h2 class="wp-block-heading" style="font-size:3rem;font-weight:800">Anmeldung am GSG</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.15rem","lineHeight":"1.8"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--50);font-size:1.15rem;line-height:1.8">Wir freuen uns über Ihr Interesse! Melden Sie Ihr Kind für das kommende Schuljahr an oder vereinbaren Sie einen Beratungstermin.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} -->
<p style="font-weight:700">Anmeldezeitraum: 1. - 15. Mai 2026</p>
<!-- /wp:paragraph -->

<!-- wp:list {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<ul style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:list-item -->
<li>✓ Persönliche Beratungsgespräche</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>✓ Schnupperstunden möglich</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>✓ Flexible Terminvereinbarung</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>✓ Online-Anmeldung verfügbar</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:button {"backgroundColor":"gsg-navy","textColor":"base","style":{"border":{"radius":"8px"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-gsg-navy-background-color has-text-color has-background wp-element-button" href="#anmeldung" style="border-radius:8px">Jetzt anmelden</a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"base","textColor":"gsg-navy","style":{"border":{"radius":"8px","width":"2px"}},"borderColor":"gsg-navy","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-border-color has-gsg-navy-border-color has-gsg-navy-color has-base-background-color has-text-color has-background wp-element-button" href="#kontakt" style="border-width:2px;border-radius:8px">Beratung vereinbaren</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}},"border":{"radius":"12px"},"shadow":"0 20px 60px rgba(0, 0, 0, 0.2)"},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-base-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--60);box-shadow:0 20px 60px rgba(0, 0, 0, 0.2)"><!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h3 class="wp-block-heading has-gsg-navy-color has-text-color has-link-color">Kontaktformular</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"},"spacing":{"margin":{"bottom":"var:preset|spacing|50"}},"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-gsg-blue-color has-text-color has-link-color" style="margin-bottom:var(--wp--preset--spacing--50);font-size:0.9rem">Nutzen Sie unser Kontaktformular oder rufen Sie uns direkt an: <strong>+49 (0) 123 456 789</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"4rem"}}} -->
<p class="has-text-align-center" style="font-size:4rem">📝</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color"><em>Hier würde Ihr Kontaktformular (Contact Form 7, WPForms o.ä.) eingefügt werden</em></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
            )
        );
    }
}
add_action('init', 'gsg_register_anmeldung_pattern');

// === PATTERN 6: INFO BOX ===
function gsg_register_info_box_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'gsg/info-box',
            array(
                'title'       => __('GSG Info Box', 'gsg-child'),
                'description' => __('Hervorgehobene Info-Box mit Icon', 'gsg-child'),
                'categories'  => array('gsg', 'text'),
                'keywords'    => array('info', 'hinweis', 'box'),
                'content'     => '<!-- wp:group {"className":"gsg-info-box","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"8px","left":{"color":"var:preset|color|gsg-navy","width":"4px"}}},"backgroundColor":"gsg-light-gray","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-info-box has-gsg-light-gray-background-color has-background" style="border-radius:8px;border-left-color:var(--wp--preset--color--gsg-navy);border-left-width:4px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"}}} -->
<p style="font-size:2rem">ℹ️</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<h4 class="wp-block-heading has-gsg-navy-color has-text-color has-link-color">Wichtiger Hinweis</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-gsg-blue-color has-text-color has-link-color">Hier steht Ihre wichtige Information. Diese Box eignet sich perfekt für Ankündigungen, Termine oder besondere Hinweise.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
            )
        );
    }
}
add_action('init', 'gsg_register_info_box_pattern');

// === PATTERN 7: ACCENT BOX (GELB) ===
function gsg_register_accent_box_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'gsg/accent-box',
            array(
                'title'       => __('GSG Accent Box (Gelb)', 'gsg-child'),
                'description' => __('Hervorgehobene Box mit gelbem Hintergrund', 'gsg-child'),
                'categories'  => array('gsg', 'text'),
                'keywords'    => array('accent', 'highlight', 'box'),
                'content'     => '<!-- wp:group {"className":"gsg-accent-box","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"8px","left":{"color":"var:preset|color|gsg-gold","width":"4px"}}},"backgroundColor":"gsg-yellow","textColor":"gsg-navy","layout":{"type":"constrained"}} -->
<div class="wp-block-group gsg-accent-box has-gsg-navy-color has-gsg-yellow-background-color has-text-color has-background" style="border-radius:8px;border-left-color:var(--wp--preset--color--gsg-gold);border-left-width:4px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"2rem"}}} -->
<p style="font-size:2rem">⭐</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading">Besondere Ankündigung</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Diese gelbe Box zieht besondere Aufmerksamkeit auf sich. Ideal für wichtige Termine, Erfolge oder besondere Veranstaltungen.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
            )
        );
    }
}
add_action('init', 'gsg_register_accent_box_pattern');

// === PATTERN 8: STATISTIKEN ===
function gsg_register_stats_pattern() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'gsg/statistics',
            array(
                'title'       => __('GSG Statistiken', 'gsg-child'),
                'description' => __('4 Statistik-Boxen nebeneinander', 'gsg-child'),
                'categories'  => array('gsg'),
                'keywords'    => array('stats', 'zahlen', 'fakten'),
                'content'     => '<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px"}},"gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background has-gsg-section-gradient-gradient-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3.5rem","fontWeight":"800","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<p class="has-text-align-center has-gsg-navy-color has-text-color has-link-color" style="font-size:3.5rem;font-weight:800;line-height:1">850</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Schüler:innen</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px"}},"gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background has-gsg-section-gradient-gradient-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3.5rem","fontWeight":"800","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<p class="has-text-align-center has-gsg-navy-color has-text-color has-link-color" style="font-size:3.5rem;font-weight:800;line-height:1">65</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Lehrkräfte</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px"}},"gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background has-gsg-section-gradient-gradient-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3.5rem","fontWeight":"800","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<p class="has-text-align-center has-gsg-navy-color has-text-color has-link-color" style="font-size:3.5rem;font-weight:800;line-height:1">98%</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Abitur-Erfolg</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"12px"}},"gradient":"gsg-section-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background has-gsg-section-gradient-gradient-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"3.5rem","fontWeight":"800","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|gsg-navy"}}}},"textColor":"gsg-navy"} -->
<p class="has-text-align-center has-gsg-navy-color has-text-color has-link-color" style="font-size:3.5rem;font-weight:800;line-height:1">125+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|gsg-blue"}}}},"textColor":"gsg-blue"} -->
<p class="has-text-align-center has-gsg-blue-color has-text-color has-link-color">Jahre Tradition</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
            )
        );
    }
}
add_action('init', 'gsg_register_stats_pattern');
