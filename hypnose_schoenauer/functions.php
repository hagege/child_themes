<?php
/**
 * Child Theme Functions
 * Praxis für Hypnose – Sarah Schönauer (hypnose-fuer-dich.de)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Direkten Zugriff verhindern
}

/**
 * JSON-LD Strukturierte Daten im Head-Bereich einbinden
 */
add_action( 'wp_head', function() {
    // Nur auf der Startseite und der Kontaktseite ausgeben
    if ( is_front_page() || is_page( 'kontakt-und-anfahrt' ) || is_page( 'kontakt' ) ) {
        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "HealthAndBeautyBusiness",
          "name": "Hypnose für dich – Sarah Schönauer",
          "description": "Praxis für Hypnose in Witten. Unterstützung bei Ängsten, mentaler Erschöpfung, Kinderwunsch und Geburtsbegleitung.",
          "url": "https://hypnose-fuer-dich.de/",
          "telephone": "+491636661749",
          "email": "hello@hypnose-fuer-dich.de",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Bahnhofstraße 32",
            "addressLocality": "Witten",
            "postalCode": "58452",
            "addressCountry": "DE"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": 51.4398,
            "longitude": 7.3364
          },
          "founder": {
            "@type": "Person",
            "name": "Sarah Schönauer",
            "jobTitle": "Hypnotiseurin & Hebamme"
          },
          "areaServed": [
            {
              "@type": "City",
              "name": "Witten"
            },
            {
              "@type": "City",
              "name": "Bochum"
            },
            {
              "@type": "City",
              "name": "Dortmund"
            },
            {
              "@type": "City",
              "name": "Recklinghausen"
            }
          ]
        }
        </script>
        <?php
    }
}, 20 );