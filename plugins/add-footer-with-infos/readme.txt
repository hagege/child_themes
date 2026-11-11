=== Add footer with infos ===
Contributors: HGG
Tags: shortcode, footer, event, links, metadata
Stable tag: 0.5

Adds a configurable information footer to posts and supported event post types. Use the [fuss] shortcode or enter footer links in the editor metabox to append them automatically. The footer can display the featured image's photo credit, an external website, a tag archive link, and an event-category link.

== Description ==

Add footer with infos replaces the previous [fuss] shortcode implementation and provides a metabox for managing footer links on posts and detected event post types. The metabox may be shown in the sidebar or below the editor. Its position can also be selected in the user's profile.

Shortcode attributes:

* `link` — external website URL.
* `il` — internal tag path or slug.
* `vl` — event-category slug or name.

Values saved in the post metabox take precedence over the corresponding shortcode attributes. When footer fields have been saved in the metabox and the post content does not already render the shortcode footer, the footer is appended automatically.

== Installation ==

1. Upload the plugin directory to `/wp-content/plugins/` (or install the plugin using the WordPress Plugins screen).
2. Activate **Add footer with infos** from the Plugins screen.
3. Edit a post or supported event. Enter an external URL and select a tag and/or event category in the **Footer links** metabox.
4. Alternatively, add `[fuss]` to content. Optional attributes are, for example, `[fuss link="https://example.com" il="tag/news/" vl="community"]`.
5. Choose the metabox position in your profile or use the metabox's position switch.

The event post types detected by the plugin are `eventward_event`, `eventward`, `event`, `events`, and `tribe_events`. Event category links use the `eventward_category` taxonomy and default to the `/veranstaltungen/` overview path. English is the source language. A German (de_DE) translation is included in the `languages` directory.

== Frequently Asked Questions ==

= Does the plugin require the shortcode? =

No. When footer values are saved in the metabox, the plugin appends the footer to eligible single-post content automatically unless a rendered footer is already present. The `[fuss]` shortcode remains available for manually placed output.

= Which event plugin does it support? =

The source detects the event post types listed in Installation and uses the `eventward_category` taxonomy for category links. The event overview path can be changed by the `fuss_events_overview_path` filter.

= Why is a photo credit shown when no image alt text is set? =

The footer uses the featured image's alt text. If it is empty, it displays the default text “Photo: event organizer”; if no photo-credit-style label is present, that default credit is appended.

= How do I change the metabox location? =

Use the switch at the top of the metabox or select a location in your user profile. The configured default is the sidebar.

== Security Notes ==

A source review of `add-footer-with-infos.php` version 0.5 found no evident SQL-injection path, dynamic file inclusion, or use of dangerous execution/evaluation functions. Rendered text and attributes are context-escaped (including `esc_html`, `esc_attr`, and `esc_url`); metabox inputs are sanitized before storage. The external link is URL-escaped on output and uses `rel="noopener noreferrer"` with `target="_blank"`.

The post metabox save handler verifies its nonce, ignores autosaves/revisions, and checks `edit_post` capability. The metabox-position action uses a nonce, validates the requested position against an allowlist, checks `edit_post`, and safely redirects. Profile preference saving checks the WordPress profile nonce and `edit_user` capability. No clear CSRF or privilege-escalation flaw was identified in these reviewed flows.

This is a static review of the supplied plugin file only, not a complete security audit or runtime test. It does not cover the WordPress installation, third-party plugins/theme code, deployment configuration, or any files not supplied.

== Changelog ==

= 0.5 =
* Initial release / i18n-ready.
* Changed the text domain to `add-footer-with-infos`; includes a German (de_DE) translation.
* Supports `[fuss]` output and automatic footer appending for posts and detected event post types.
* Provides a footer-links metabox, photo-credit output, external/internal/category links, and configurable metabox placement.
