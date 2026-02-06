<?php
/**
 * Plugin Name: Pattern finder
 * Plugin URI: https://your-site.com
 * Description: Pattern Finder - Shows exact pattern code
 * Version: 1.0.0
 * Author: Gaia
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Text Domain: gaia-finder
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * TEMPORARY: Complete Block Finder
 */

add_action( 'admin_menu', 'gaia_block_finder_menu' );
function gaia_block_finder_menu() {
    add_management_page(
        'Block Finder',
        'Block Finder',
        'manage_options',
        'gaia-block-finder',
        'gaia_block_finder_page'
    );
}

function gaia_block_finder_page() {
    global $wpdb;
    
    echo '<div class="wrap">';
    echo '<h1>Complete Block Finder</h1>';
    
    // 1. Check for ANY blocks
    $posts_with_blocks = $wpdb->get_results(
        "SELECT ID, post_type, post_title, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE '%<!-- wp:%'
        AND post_status IN ('publish', 'draft', 'private')
        LIMIT 30"
    );
    
    if ( empty( $posts_with_blocks ) ) {
        echo '<p style="color:red;">❌ No posts found with Gutenberg blocks at all.</p>';
        echo '<p>Are you using the Classic Editor?</p>';
        echo '</div>';
        return;
    }
    
    echo '<p>✅ Found ' . count($posts_with_blocks) . ' posts with blocks.</p>';
    
    // 2. Find all block types used
    $all_block_types = array();
    
    foreach ( $posts_with_blocks as $post ) {
        preg_match_all( '/<!-- wp:([a-z0-9\-\/]+)/', $post->post_content, $matches );
        if ( ! empty( $matches[1] ) ) {
            foreach ( $matches[1] as $block_type ) {
                if ( ! isset( $all_block_types[ $block_type ] ) ) {
                    $all_block_types[ $block_type ] = 0;
                }
                $all_block_types[ $block_type ]++;
            }
        }
    }
    
    echo '<div class="card">';
    echo '<h2>Block Types Found (Total: ' . count($all_block_types) . ')</h2>';
    echo '<ul>';
    foreach ( $all_block_types as $type => $count ) {
        $highlight = ( strpos($type, 'pattern') !== false || strpos($type, 'block') !== false ) ? ' style="background:yellow;"' : '';
        echo '<li' . $highlight . '><strong>' . esc_html($type) . '</strong>: ' . $count . ' times</li>';
    }
    echo '</ul>';
    echo '</div>';
    
    // 3. Show detailed content for posts with "spacer" in name
    echo '<div class="card">';
    echo '<h2>Posts Containing "spacer" (searching in content)</h2>';
    
    $spacer_posts = $wpdb->get_results(
        "SELECT ID, post_type, post_title, post_content 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE '%spacer%'
        AND post_status IN ('publish', 'draft', 'private')
        LIMIT 10"
    );
    
    if ( empty( $spacer_posts ) ) {
        echo '<p>No posts found with "spacer" in content.</p>';
    } else {
        foreach ( $spacer_posts as $post ) {
            echo '<h3>Post ID ' . $post->ID . ': ' . esc_html($post->post_title) . '</h3>';
            
            // Show relevant excerpt
            $lines = explode( "\n", $post->post_content );
            $relevant_lines = array();
            foreach ( $lines as $line ) {
                if ( stripos( $line, 'spacer' ) !== false || stripos( $line, 'wp:' ) !== false ) {
                    $relevant_lines[] = $line;
                }
            }
            
            if ( ! empty( $relevant_lines ) ) {
                echo '<pre style="background:#f0f0f1;padding:10px;overflow-x:auto;font-size:11px;">';
                echo esc_html( implode( "\n", array_slice( $relevant_lines, 0, 20 ) ) );
                echo '</pre>';
            }
        }
    }
    echo '</div>';
    
    // 4. Check wp_block post type (Reusable Blocks / Synced Patterns)
    echo '<div class="card">';
    echo '<h2>Reusable Blocks / Synced Patterns (wp_block)</h2>';
    
    $reusable_blocks = $wpdb->get_results(
        "SELECT ID, post_title, post_content, post_name
        FROM {$wpdb->posts} 
        WHERE post_type = 'wp_block'
        AND post_status = 'publish'"
    );
    
    if ( empty( $reusable_blocks ) ) {
        echo '<p>No reusable blocks found.</p>';
    } else {
        echo '<p>Found ' . count($reusable_blocks) . ' reusable blocks:</p>';
        foreach ( $reusable_blocks as $block ) {
            $highlight = ( stripos( $block->post_title, 'spacer' ) !== false || stripos( $block->post_name, 'spacer' ) !== false ) ? ' style="background:yellow;"' : '';
            echo '<div' . $highlight . ' style="margin:10px 0;padding:10px;border:1px solid #ccc;">';
            echo '<strong>ID ' . $block->ID . ': ' . esc_html($block->post_title) . '</strong> (slug: ' . esc_html($block->post_name) . ')';
            echo '<pre style="background:#f0f0f1;padding:5px;margin-top:5px;font-size:11px;">';
            echo esc_html( substr( $block->post_content, 0, 300 ) ) . '...';
            echo '</pre>';
            echo '</div>';
        }
    }
    echo '</div>';
    
    echo '</div>';
}