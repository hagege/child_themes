<?php
/**
 * Plugin Name: Pattern Migration Tool
 * Plugin URI: https://your-site.com
 * Description: One-click migration: Replace old Block Patterns with new ones across all Posts, Pages, Templates. Runs once only.
 * Version: 1.0.0
 * Author: Gaia
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Text Domain: gaia-pattern-migration
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Reusable Block Migration Tool - Admin Form Version
 * No code editing needed - configure via admin interface
 */

add_action( 'admin_menu', 'gaia_migration_tool_menu' );
function gaia_migration_tool_menu() {
    add_management_page(
        'Block Migration',
        'Block Migration',
        'manage_options',
        'gaia-block-migration',
        'gaia_migration_tool_page'
    );
}

function gaia_migration_tool_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Access denied' );
    }

    // Get saved configuration or defaults
    $config = get_option( 'gaia_migration_config', array(
        'old_id'   => 36,
        'old_name' => 'spacer1',
        'new_id'   => 39,
        'new_name' => 'spacer2',
    ) );

    // Handle configuration save
    if ( isset( $_POST['save_config'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'gaia_save_config' ) ) {
        $config = array(
            'old_id'   => absint( $_POST['old_id'] ),
            'old_name' => sanitize_text_field( $_POST['old_name'] ),
            'new_id'   => absint( $_POST['new_id'] ),
            'new_name' => sanitize_text_field( $_POST['new_name'] ),
        );
        update_option( 'gaia_migration_config', $config );
        echo '<div class="notice notice-success"><p>✅ Configuration saved!</p></div>';
    }

    // Handle test search
    $test_result = '';
    if ( isset( $_POST['test_search'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'gaia_test' ) ) {
        $test_result = gaia_test_block_migration( $config );
    }

    // Handle migration
    if ( isset( $_POST['run_migration'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'gaia_migrate' ) ) {
        $result = gaia_run_block_migration( $config );
        echo '<div class="notice notice-success"><p>' . esc_html( $result ) . '</p></div>';
    }

    // Get block details
    $old_block = get_post( $config['old_id'] );
    $new_block = get_post( $config['new_id'] );

    ?>
    <div class="wrap">
        <h1>🔄 Reusable Block Migration Tool</h1>
        <p>Replace references to one reusable block with another across your entire site.</p>

        <!-- Configuration Form -->
        <div class="card" style="max-width:800px;">
            <h2>⚙️ Configuration</h2>
            <form method="post">
                <?php wp_nonce_field( 'gaia_save_config' ); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="old_id">Old Block ID</label>
                        </th>
                        <td>
                            <input type="number" name="old_id" id="old_id" 
                                   value="<?php echo esc_attr( $config['old_id'] ); ?>" 
                                   class="regular-text" required>
                            <p class="description">
                                <?php if ( $old_block && $old_block->post_type === 'wp_block' ) : ?>
                                    ✅ Found: <strong><?php echo esc_html( $old_block->post_title ); ?></strong>
                                <?php else : ?>
                                    ❌ Block not found
                                <?php endif; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="old_name">Old Block Name (slug)</label>
                        </th>
                        <td>
                            <input type="text" name="old_name" id="old_name" 
                                   value="<?php echo esc_attr( $config['old_name'] ); ?>" 
                                   class="regular-text" required>
                            <p class="description">
                                The name/slug as it appears in metadata (e.g., "spacer1")
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="new_id">New Block ID</label>
                        </th>
                        <td>
                            <input type="number" name="new_id" id="new_id" 
                                   value="<?php echo esc_attr( $config['new_id'] ); ?>" 
                                   class="regular-text" required>
                            <p class="description">
                                <?php if ( $new_block && $new_block->post_type === 'wp_block' ) : ?>
                                    ✅ Found: <strong><?php echo esc_html( $new_block->post_title ); ?></strong>
                                <?php else : ?>
                                    ❌ Block not found
                                <?php endif; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="new_name">New Block Name (slug)</label>
                        </th>
                        <td>
                            <input type="text" name="new_name" id="new_name" 
                                   value="<?php echo esc_attr( $config['new_name'] ); ?>" 
                                   class="regular-text" required>
                            <p class="description">
                                The name/slug as it appears in metadata (e.g., "spacer2")
                            </p>
                        </td>
                    </tr>
                </table>

                <p class="submit">
                    <button type="submit" name="save_config" class="button button-primary">
                        💾 Save Configuration
                    </button>
                </p>
            </form>
        </div>

        <!-- Preview -->
        <div class="card" style="max-width:800px;">
            <h2>📋 What Will Be Replaced</h2>
            <p><strong>From:</strong></p>
            <code style="background:#ffe6e6;padding:10px;display:block;white-space:pre-wrap;font-size:11px;margin-bottom:15px;">
"metadata":{"patternName":"core/block/<?php echo $config['old_id']; ?>","name":"<?php echo esc_html($config['old_name']); ?>"}
            </code>
            
            <p><strong>To:</strong></p>
            <code style="background:#e7f5e7;padding:10px;display:block;white-space:pre-wrap;font-size:11px;">
"metadata":{"patternName":"core/block/<?php echo $config['new_id']; ?>","name":"<?php echo esc_html($config['new_name']); ?>"}
            </code>
        </div>

        <!-- Test Search -->
        <div class="card" style="max-width:800px;">
            <h2>🔍 Step 1: Test Search</h2>
            <p>Check how many posts use the old block before migrating.</p>
            <form method="post">
                <?php wp_nonce_field( 'gaia_test' ); ?>
                <button type="submit" name="test_search" class="button button-secondary">
                    🔎 Search for Old Block
                </button>
            </form>
            
            <?php if ( $test_result ) : ?>
                <div style="margin-top:15px;padding:15px;background:#f0f0f1;border-left:4px solid #0073aa;">
                    <?php echo $test_result; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Migration -->
        <div class="card" style="max-width:800px;">
            <h2>🚀 Step 2: Run Migration</h2>
            <p><strong>⚠️ Warning:</strong> This will replace all occurrences. Make a backup first!</p>
            <form method="post" onsubmit="return confirm('⚠️ Are you sure?\n\nThis will replace:\n• Block ID <?php echo $config['old_id']; ?> (<?php echo esc_js($config['old_name']); ?>)\n\nWith:\n• Block ID <?php echo $config['new_id']; ?> (<?php echo esc_js($config['new_name']); ?>)\n\nProceed?');">
                <?php wp_nonce_field( 'gaia_migrate' ); ?>
                <button type="submit" name="run_migration" class="button button-primary button-large">
                    ▶️ Run Migration Now
                </button>
            </form>
        </div>

        <!-- Help -->
        <div class="card" style="max-width:800px;background:#f9f9f9;">
            <h2>❓ How to Find Block IDs</h2>
            <ol>
                <li>Go to <strong>Posts > Reusable Blocks</strong> (or <strong>Patterns > My Patterns</strong>)</li>
                <li>Hover over a block name and look at the URL in the bottom-left corner</li>
                <li>The ID is the number after <code>post=</code> (e.g., <code>post=36</code> means ID is 36)</li>
                <li>The name/slug is usually the same as the title, but lowercase (e.g., "Spacer1" → "spacer1")</li>
            </ol>
        </div>
    </div>

    <style>
        .gaia-migration-wrap .card { margin-bottom: 20px; }
        .gaia-migration-wrap code { font-family: monospace; }
    </style>
    <?php
}

function gaia_test_block_migration( $config ) {
    global $wpdb;
    
    $search_pattern = '"patternName":"core/block/' . $config['old_id'] . '"';
    
    $posts = $wpdb->get_results( $wpdb->prepare(
        "SELECT ID, post_type, post_title, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE %s
        AND post_status IN ('publish', 'draft', 'private')",
        '%' . $wpdb->esc_like( $search_pattern ) . '%'
    ) );
    
    if ( empty( $posts ) ) {
        return '<p style="color:#d63638;font-weight:bold;">❌ No posts found using block "' . 
               esc_html($config['old_name']) . '" (ID ' . $config['old_id'] . ')</p>
               <p>The block might not be used anywhere, or the ID/name is incorrect.</p>';
    }
    
    $found = array();
    foreach ( $posts as $post ) {
        $count = substr_count( $post->post_content, $search_pattern );
        $edit_link = get_edit_post_link( $post->ID );
        
        $found[] = sprintf(
            '<strong>ID %d</strong> (%s): <a href="%s" target="_blank">%s</a> - %d occurrence(s)',
            $post->ID,
            $post->post_type,
            esc_url( $edit_link ),
            $post->post_title ? esc_html($post->post_title) : '(no title)',
            $count
        );
    }
    
    return '<p style="color:#007017;font-weight:bold;">✅ Found ' . count($posts) . ' post(s) using this block:</p>
            <ul style="line-height:2;margin-top:10px;"><li>' . 
            implode( '</li><li>', $found ) . '</li></ul>';
}

function gaia_run_block_migration( $config ) {
    global $wpdb;
    
    $old_pattern = '"patternName":"core/block/' . $config['old_id'] . '","name":"' . $config['old_name'] . '"';
    $new_pattern = '"patternName":"core/block/' . $config['new_id'] . '","name":"' . $config['new_name'] . '"';
    
    $updated = 0;
    
    $posts = $wpdb->get_results( $wpdb->prepare(
        "SELECT ID, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE %s
        AND post_status IN ('publish', 'draft', 'private')",
        '%' . $wpdb->esc_like( $old_pattern ) . '%'
    ) );
    
    foreach ( $posts as $post ) {
        $new_content = str_replace( $old_pattern, $new_pattern, $post->post_content );
        
        if ( $new_content !== $post->post_content ) {
            $wpdb->update(
                $wpdb->posts,
                array( 'post_content' => $new_content ),
                array( 'ID' => $post->ID ),
                array( '%s' ),
                array( '%d' )
            );
            
            clean_post_cache( $post->ID );
            $updated++;
        }
    }
    
    return sprintf( 
        '✅ Migration complete! Successfully updated %d post(s). All "%s" blocks have been replaced with "%s".', 
        $updated, 
        $config['old_name'], 
        $config['new_name'] 
    );
}