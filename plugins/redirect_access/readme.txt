=== Restrict Access Redirect ===
Author URI: https://haurand.com
Plugin URI: https://haurand.com
Donate link: 
Contributors: 
Tags: 
Requires at least: 
Tested up to: 
Requires PHP: 
Stable tag: 0.1
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WordPress plugin that prevents non-logged-in users from accessing the website and redirects them to the login page with a message

== Description ==

Here's how the plugin works:

It hooks into the template_redirect action, which is fired before the page template is loaded. 
This allows us to check if the user is logged in before loading any content.
If the user is not logged in, it constructs the login URL using wp_login_url() function and appends a message parameter (message=no_access). 
This parameter will be checked later to display the "No access" message.
Then it redirects the user to the login page using wp_redirect() function.
It also hooks into the login_message filter to display the message "No access" on the login page if the message parameter is present in the URL.

A few notes about the sections above:

*   "Contributors" is a comma separated list of wordpress.org usernames
*   "Tags" is a comma separated list of tags that apply to the plugin
*   "Requires at least" is the lowest version that the plugin will work on
*   "Tested up to" is the highest version that you've *successfully used to test the plugin*. Note that it might work on
higher versions... this is just the highest one you've verified.
*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

    Note that the `readme.txt` of the stable tag is the one that is considered the defining one for the plugin, so
if the `/trunk/readme.txt` file says that the stable tag is `4.3`, then it is `/tags/4.3/readme.txt` that'll be used
for displaying information about the plugin.  In this situation, the only thing considered from the trunk `readme.txt`
is the stable tag pointer.  Thus, if you develop in trunk, you can update the trunk `readme.txt` to reflect changes in
your in-development version, without having that information incorrectly disclosed about the current stable version
that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

    If no stable tag is provided, it is assumed that trunk is stable, but you should specify "trunk" if that's where
you put the stable version, in order to eliminate any doubt.


== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.


== Installation ==

1. Go to `Plugins` in the Admin menu
2. Click on the button `Add new`
3. Search for `Restrict Access Redirect` and click 'Install Now' or click on the `upload` link to upload `restrict-access-redirect.zip`
4. Click on `Activate plugin`

== Changelog ==

= 0.1: February 27, 2024 =
* Birthday of Restrict Access Redirect