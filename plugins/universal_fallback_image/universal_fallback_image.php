<?php
/*
Plugin Name: Universal Fallback Image
Description: Zeigt bei Bildfehlern das Bild von einer konfigurierbaren Live-URL oder ein Standardbild an.
Version: 1.1
Author: HGG
*/

// Verhindere direkten Zugriff
if (!defined('ABSPATH')) {
    exit;
}

// Backend-Einstellung für die Live-URL und das Standardbild
add_action('admin_menu', 'fallback_image_admin_menu');
function fallback_image_admin_menu() {
    add_options_page(
        'Fallback Image', 
        'Fallback Image', 
        'manage_options', 
        'fallback-image', 
        'fallback_image_admin_page'
    );
}

function fallback_image_admin_page() {
    // Validierung und Speicherung
    if (isset($_POST['submit']) && check_admin_referer('fallback_image_settings', 'fallback_image_nonce')) {
        $live_url = sanitize_url($_POST['fallback_image_live_url']);
        $default_image = sanitize_text_field($_POST['fallback_image_default']);
        
        // Entferne trailing slash
        $live_url = rtrim($live_url, '/');
        
        update_option('fallback_image_live_url', $live_url);
        update_option('fallback_image_default', $default_image);
        
        echo '<div class="notice notice-success"><p>Einstellungen gespeichert!</p></div>';
    }
    
    $live_url = get_option('fallback_image_live_url', 'https://example.com');
    $default_image = get_option('fallback_image_default', '/wp-content/uploads/standardbild.jpg');
    ?>
    <div class="wrap">
        <h1>Fallback Image Einstellungen</h1>
        <form method="post" action="">
            <?php wp_nonce_field('fallback_image_settings', 'fallback_image_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Live-URL (ohne Slash am Ende)</th>
                    <td>
                        <input type="url" name="fallback_image_live_url" value="<?php echo esc_attr($live_url); ?>" size="50" required/>
                        <p class="description">Vollständige URL zur Live-Website (z.B. https://example.com)</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Pfad zum Standardbild (relativ zur Domain)</th>
                    <td>
                        <input type="text" name="fallback_image_default" value="<?php echo esc_attr($default_image); ?>" size="50" required/>
                        <p class="description">Pfad zum Fallback-Bild (z.B. /wp-content/uploads/standardbild.jpg)</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        
        <h2>Test</h2>
        <p>Live-URL: <code><?php echo esc_html($live_url); ?></code></p>
        <p>Standardbild: <code><?php echo esc_html($default_image); ?></code></p>
        <p>Aktueller Domain: <code><?php echo esc_html(home_url()); ?></code></p>
    </div>
    <?php
}

add_action('admin_init', 'fallback_image_admin_init');
function fallback_image_admin_init() {
    register_setting('fallback-image-settings', 'fallback_image_live_url', 'sanitize_url');
    register_setting('fallback-image-settings', 'fallback_image_default', 'sanitize_text_field');
}

// Fallback-JS im Frontend einbinden
add_action('wp_footer', 'fallback_image_frontend_script');
function fallback_image_frontend_script() {
    $live_url = esc_js(get_option('fallback_image_live_url', 'https://example.com'));
    $fallback_image = esc_js(get_option('fallback_image_default', '/wp-content/uploads/standardbild.jpg'));
    $current_domain = esc_js(parse_url(home_url(), PHP_URL_HOST));
    ?>
    <script>
    (function() {
        'use strict';
        
        const config = {
            fallbackImage: '<?php echo $fallback_image; ?>',
            liveUrl: '<?php echo $live_url; ?>',
            currentDomain: '<?php echo $current_domain; ?>',
            maxRetries: 2
        };

        function isLocalImage(src) {
            try {
                const url = new URL(src, window.location.origin);
                return url.hostname === config.currentDomain || 
                       url.hostname === window.location.hostname;
            } catch (e) {
                // Relative URLs sind lokal
                return !src.startsWith('http');
            }
        }

        function getOriginalUrl(src) {
            if (!isLocalImage(src)) return null;
            
            try {
                const url = new URL(src, window.location.origin);
                const pathname = url.pathname;
                const match = pathname.match(/\/wp-content\/uploads\/.+/);
                
                if (match) {
                    return config.liveUrl + match[0];
                }
            } catch (e) {
                // Fallback für relative URLs
                const match = src.match(/wp-content\/uploads\/.+/);
                if (match) {
                    return config.liveUrl + '/' + match[0];
                }
            }
            return null;
        }

        function handleImageError(img) {
            const retryCount = parseInt(img.dataset.retryCount || '0', 10);
            
            if (retryCount >= config.maxRetries) {
                console.warn('Fallback Image: Max retries reached for', img.src);
                return;
            }

            // 1. Versuch: Bild von Live-URL laden
            if (retryCount === 0) {
                const liveImgUrl = getOriginalUrl(img.src);
                if (liveImgUrl && liveImgUrl !== img.src) {
                    img.dataset.retryCount = '1';
                    img.dataset.originalSrc = img.src;
                    
                    // Entferne responsive Attribute
                    img.removeAttribute('srcset');
                    img.removeAttribute('sizes');
                    
                    img.src = liveImgUrl;
                    return;
                }
            }
            
            // 2. Versuch: Standardbild laden
            if (retryCount === 1 && config.fallbackImage !== img.src) {
                img.dataset.retryCount = '2';
                
                // Entferne responsive Attribute
                img.removeAttribute('srcset');
                img.removeAttribute('sizes');
                
                img.src = config.fallbackImage;
                return;
            }
        }

        function attachErrorHandler(img) {
            // Verhindere mehrfache Bindung
            if (img.dataset.fallbackHandlerAttached) return;
            img.dataset.fallbackHandlerAttached = 'true';
            
            img.addEventListener('error', function() {
                handleImageError(this);
            }, { passive: true });
            
            // Prüfe ob Bild bereits geladen ist und fehlerhaft
            if (img.complete && img.naturalWidth === 0 && img.naturalHeight === 0) {
                handleImageError(img);
            }
        }

        function initExistingImages() {
            document.querySelectorAll('img').forEach(attachErrorHandler);
        }

        function observeNewImages() {
            if (typeof MutationObserver === 'undefined') return;
            
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === Node.ELEMENT_NODE) {
                            if (node.tagName === 'IMG') {
                                attachErrorHandler(node);
                            } else {
                                // Suche nach img-Tags in hinzugefügten Elementen
                                const images = node.querySelectorAll ? node.querySelectorAll('img') : [];
                                images.forEach(attachErrorHandler);
                            }
                        }
                    });
                });
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }

        // Initialisierung
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                initExistingImages();
                observeNewImages();
            });
        } else {
            initExistingImages();
            observeNewImages();
        }
    })();
    </script>
    <?php
}

// Plugin-Deaktivierung Hook
register_deactivation_hook(__FILE__, 'fallback_image_deactivate');
function fallback_image_deactivate() {
    // Optionen bleiben bestehen für Reaktivierung
}

// Plugin-Deinstallation Hook
register_uninstall_hook(__FILE__, 'fallback_image_uninstall');
function fallback_image_uninstall() {
    delete_option('fallback_image_live_url');
    delete_option('fallback_image_default');
}