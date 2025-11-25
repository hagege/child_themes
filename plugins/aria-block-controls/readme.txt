
=== ARIA Block Controls ===

Contributors:      WordPress Telex
Tags:              block, accessibility, aria, a11y
Tested up to:      6.8
Stable tag:        0.1.0
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Enhance WordPress blocks with ARIA attributes for improved accessibility.

== Description ==

ARIA Block Controls is a powerful accessibility plugin that adds optional ARIA (Accessible Rich Internet Applications) attribute controls to all WordPress blocks. These controls appear in the Advanced panel of the block inspector, making it easy to enhance your site's accessibility without writing code.

**Features:**

* Add ARIA labels to any block for screen readers
* Configure ARIA-labelledby to reference other elements
* Customize ARIA-describedby for additional context
* Set custom ARIA attributes for specific needs
* Special handling for button blocks - ARIA attributes are applied to the anchor tag for proper semantics
* Works with all WordPress core blocks and third-party blocks
* Clean, intuitive interface integrated into the block editor
* Fully compatible with WordPress 6.8 and above

**Why ARIA Attributes Matter:**

ARIA attributes help make your website more accessible to users with disabilities by providing additional semantic information to assistive technologies like screen readers. This plugin makes it simple to add these important attributes to your content without needing technical expertise.

**Usage:**

1. Select any block in the editor
2. Open the block settings sidebar
3. Navigate to the Advanced panel
4. Fill in the desired ARIA attributes:
   - **ARIA Label**: Provides an accessible name for the element
   - **ARIA Labelledby**: References another element's ID for labeling
   - **ARIA Describedby**: References another element's ID for description
   - **Custom ARIA Attributes**: Add any other ARIA attribute in the format `attribute=value`

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/aria-block-controls` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Start editing any post or page - ARIA controls will automatically appear in the Advanced panel of all blocks

== Frequently Asked Questions ==

= Does this work with all blocks? =

Yes! The plugin adds ARIA controls to all blocks, including WordPress core blocks and third-party blocks.

= How do button blocks work differently? =

For button blocks, the ARIA attributes are applied to the actual anchor (`<a>`) tag inside the button, ensuring proper semantic structure and accessibility.

= Can I add multiple ARIA attributes? =

Yes, you can add multiple ARIA attributes using the "Custom ARIA Attributes" field. Separate multiple attributes with commas (e.g., `aria-expanded=true, aria-controls=menu-1`).

= Will this affect my site's performance? =

No, the plugin only adds markup to blocks where you've explicitly configured ARIA attributes. It has minimal impact on performance.

= Is this WCAG compliant? =

The plugin provides the tools to add ARIA attributes correctly, but it's up to you to use them appropriately according to WCAG guidelines.

== Screenshots ==

1. ARIA controls in the Advanced panel of the block inspector
2. Custom ARIA attributes being configured for a block
3. Button block with ARIA attributes applied to the anchor tag

== Changelog ==

= 0.1.0 =
* Initial release
* ARIA label control for all blocks
* ARIA labelledby control for all blocks
* ARIA describedby control for all blocks
* Custom ARIA attributes field
* Special handling for button blocks
* Integration with Advanced panel

== Privacy Policy ==

This plugin does not collect, store, or transmit any user data. It only adds HTML attributes to your content as configured by you in the block editor.
