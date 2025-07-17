<?php
/*
Plugin Name: Universal Fallback Image
Description: Zeigt bei Bildfehlern das Bild von einer konfigurierbaren Live-URL oder ein Standardbild an.
Version: 1.0
Author: HGG
*/

// Backend-Einstellung für die Live-URL und das Standardbild
add_action('admin_menu', function() {
    add_options_page('Fallback Image', 'Fallback Image', 'manage_options', 'fallback-image', function() {
        ?>
        <div class="wrap">
            <h1>Fallback Image Einstellungen</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('fallback-image-settings');
                do_settings_sections('fallback-image-settings');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Live-URL (ohne Slash am Ende)</th>
                        <td><input type="text" name="fallback_image_live_url" value="<?php echo esc_attr(get_option('fallback_image_live_url', 'https://example.com')); ?>" size="50"/></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Pfad zum Standardbild (relativ zur Domain)</th>
                        <td><input type="text" name="fallback_image_default" value="<?php echo esc_attr(get_option('fallback_image_default', '/wp-content/uploads/standardbild.jpg')); ?>" size="50"/></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    });
});

add_action('admin_init', function() {
    register_setting('fallback-image-settings', 'fallback_image_live_url');
    register_setting('fallback-image-settings', 'fallback_image_default');
});

// Fallback-JS im Frontend einbinden
add_action('wp_footer', function () {
    $liveUrl = esc_js(get_option('fallback_image_live_url', 'https://example.com'));
    $fallbackImage = esc_js(get_option('fallback_image_default', '/wp-content/uploads/standardbild.jpg'));
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fallbackImage = '<?php echo $fallbackImage; ?>';
        const liveUrl = '<?php echo $liveUrl; ?>';

        function getOriginalUrl(src) {
            // Nur lokale Bilder ersetzen, nicht externe
            if(src.includes(liveUrl)) return null;
            const match = src.match(/wp-content\/uploads\/.+/);
            if(match) {
                return liveUrl + '/' + match[0];
            }
            return null;
        }

        document.querySelectorAll('img').forEach(function(img) {
            img.addEventListener('error', function() {
                // 1. Versuch: Bild von Live-URL laden
                if (!img.dataset.fallbackTried) {
                    const liveImg = getOriginalUrl(img.src);
                    if (liveImg) {
                        img.dataset.fallbackTried = "live";
                        img.removeAttribute('srcset');
                        img.removeAttribute('sizes');
                        img.src = liveImg;
                        return;
                    }
                }
                // 2. Versuch: Standardbild laden
                if (img.dataset.fallbackTried !== "standard") {
                    img.dataset.fallbackTried = "standard";
                    img.removeAttribute('srcset');
                    img.removeAttribute('sizes');
                    img.src = fallbackImage;
                }
            });
        });
    });
    </script>
    <?php
});