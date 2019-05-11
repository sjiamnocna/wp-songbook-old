=== WP Songbook ===
Contributors: sjiamnocna
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=65SS8NS48FPFQ&lc=CZ&item_name=%c5%a0imon%20Jan%c4%8da&currency_code=CZK&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: songbook, song, music, choir, sing, songwriter, lyrics, info, songlist, media
Requires at least: 4.0
Tested up to: 4.6
Stable tag: 2.0.11
License: GPLv2 or later

Plugin, that allows people to manage song lyrics on Wordpress-based website. Adds many features to simplify and improve the process.

== Description ==

WP Songbook adds opportunity to manage song lyrics on your Wordpress based blog. It's simple tool to add song lyrics and share it on internet.
The best of the plugin:

= Songs managing =
- Custom post type "Songs"
- Using editor you can add and edit song lyrics
- Custom metabox for uploading and linking files to songs, adding video link, song tempo and duration
- Custom taxonomy boxes for Authors, Albums and Genres for sorting and grouping songs

= Managing linked files =
- Add, sort remove files - Add multiple files by pressing Ctrl key
- Add Google docs or any other links to the files
- Choose if the songs files are visible to public or only to logged-in website users (specify for each file separately or use global option)
- Linked files are shown at the bottom of song content page

= Song list =
- Select the page you want to use as songs list page or let the plugin create one for you
- The list contains all songs, you created
- You can select how do you want your songs to be ordered
- Show Youtube icon link or linked files icons in the list to easily access it
- Select the structure of the list - display first Authors names and then click to show their songs? No problem

= Single song appearance =
- Specify the wrapper element that will wrap the lyrics for better look within the theme
- Set to display song authors, albums, song files etc. in the page

= Settings page =
- Use the settings page to change options the way you want

If you're using v2.0.x, please post to [this topic](https://wordpress.org/support/topic/v-20-testing) in the forum (I'll get an email announcement. With new topic I won't get anything)
`If anything doesn't work, please visit "Support" tab, and leave a topic in forum. I'll also appreciate every idea to improve, so don't hesitate to [leave a topic in support forum]`

== Screenshots ==

1. Right after activation you will see this added in your menu
2. Editing the lyrics is as simple as editing any other content on your Wordpress site
3. It's simple to add an author name to song that will be displayed in song list (set in the settings)
4. You can link files, that will be shown on the single song display page or in the song list (set in the settings)
5. To link a file just open the media manager and choose files to link with song
6. The same to manage authors or post categories
7. If anything is not OK you can visit settings page to make it better

== Installation ==

- Unpack archive contents into plugin folder (/wp-content/plugins/) and activate it in plugin manager, the bookmark "Songs" will appear in admin menu after activation
- Click the Songs admin menu item, and choose settings. Now you can set everything, that you need

= * Since 2.0 (or testing) * Adding backtolist link to the theme
- Open theme file and find place, where you want to put it
- Add this: echo $wpsb->backtolist($link_class,$before,$after);
- The link can be used only once a page, becouse of appearance. To force display it for the nd time, add the fourth parameter true (bool):
’echo $wpsb->backtolist($link_class, $before, $after, true);’

== Frequently Asked Questions ==

**I'm getting 404 error "Not found" when accessing the song**
*This shouldn't happen till the v2.0 but if it occurs try resaving the Wordpress permalink structure settings in Settings -> Permalinks*

== Changelog ==

= 2.0.11 =
- Added song metabox security
- Added improved function for upgrading from old 1.6, tested
- Added debug logs
- Fixed non existing index in metabox
- Fixed song list
- Fixed for Wordpress v4.0, ceased support for older versions

= 2.0.10 =
- Fixed song list logic
- Fixed Windows WAMP absolute paths issue

= 2.0.9 =
- Added taxonomy terms separator option to settings
- Removed error displaying (for testing on my localhost)
- Fixed Undefined Ajax class call

= 2.0.8 =
- Fixed foreach loop error
- Fixed language support

= 2.0.7 =
- Added possibility to display languages in song list
- Fixed language directory

= 2.0.6 =
- Fixed error in class.mess.php

= 2.0.5 =
- Fixed language files names to fit textdomain

= 2.0.4 =
- Fixed inclusion of non existing file
- Fixed flush_rewrite_rules and register Posttype action

= 2.0.3 =
- Fixed unexpected output on activation
- Fixed unexisting function on add_action
- Added condition for adding code to admin head tag to not add unnecessary code

= 2.0.2 =
- Disabled version upgrade for errors

= 2.0.1 =
- Fixed language domain problem

= 2.0 =
- Finally relased the version on 14th of may 2016 after a lot of work
- Please, leave a topic in [support forum](https://wordpress.org/support/plugin/wp-songbook) if anything doesn't work
- Removed WPSB_LANGDOM constant to work better with WP.org translations
- Added flush_rewrite_rules after install or update

= 2.0.&eta;.1=
- Finished song content filter (files and taxonomies)
- Added hook to solve small differences between the old and new version
- Removed unnecessary admin scripts

= 2.0.&eta; =
- Added possibility to filter and remove the "Next / Prev post" when the song is being displayed
- Added languages taxonomy
- Added songbook metabox default options javascript object
- Added warnings and messages
- Added PHP docs for some classes and methods
- Fixed warning caused by passing function to empty() condition
- Finished song list (file and video links), added JQuery UI Tooltips for icons
- jQuery dragsort plugin replaced by Wordpres's built in jQuery UI Sortable

= 2.0.&zeta; =
- Added possibility to add a link "back to song list" into theme (see Installation tab)

= 2.0.&epsilon; =
- Added settings value check to prevent wrong values and breaking script
- Added possibility to link shared Google docs or any other link to a song files metabox
- Added small statistic overview to the settings
- Finished song list items and the song content hooks
- Prepared for PHP 7 constructors

= 2.0.&delta; =
- Fixed sort order in list

= 2.0.&gamma; =
- Rebuilt song info metabox
- List may contain list of taxonomy terms linked to list of their songs
- Added meta field for song duration
- Added bones for future playlists feature

= 2.0.&alpha; &amp; 2.0.&beta; =
- Everything's back compatible - you shouldn't loose anything, but for safety, backup your data before updating
- Completely rebuilt code for better functionality and extensibility, replacing the old not properly working version
- Refined plugin settings page and song metaboxes
- Removed help page - basic guide is located on settings page and every option has its description
- Started archiving versions in the "Developers" tab
- Not all functions are available yet, use only for testing

= 1.6 =
- Added option to allow adding comments to lyrics
- Fixed problem with lyrics wrapper

= 1.5.3 =
- Trying to fix some bug in code, that may couse PHP error on some servers

= 1.5.2 =
- Added edit song button into song list
- Readded video link to the song list
- Fixed bug that added link back to list to song list
- Tested and improved for Wordpress 4.0
- Fixed few PHP warnings

= 1.5.1 =
- Fixed error with displaying list

= 1.5 =
- Now allows choose content displayed in the list by default
- Improved filtering archive link for custom taxonomies
- Improved creating list table to be easier to add new columns for future
- Updated language files

= 1.4.3 =
- Fixed warnings and notices shown by WP_DEBUG that may couse errors
- Updated language files

= 1.4.2 =
- Added new warnings
- Improved few functions to work better
- Removed few parts, that could be wrong and arent necessary

= 1.4.1 =
- Fixed missing files, that resulted in error

= 1.4 =
- Added taxonomy Album + enable option to settings
- Added taxonomy Genre + enable option to settings
- Now there's an option to use publish year in the songlist (you can set time in editor on right side in publication controls)
- Added options to allow of displaying song list grid new columns Album, Genre and Year
- Updated language files with few new phrases

= 1.3 =
- Now its possible to display list of author's songs
- Button for displaying Authors name was added to song list
- Added options to show or hide list header and link to list of author
- Updated language files

= 1.2.3 =
- Added warnings and messages to inform if something is wrong
- Fixed saving the options

= 1.2.2 =
- Language files revision
- Added new screenshots and improved readme file to contain important informations
- Updated Screenshots

= 1.2.1 =
- Fixed readme.txt to give relevant informations about this plugin
- If theres any file to display (and not blocked by any private rule), is displayed
- Removed Fancybox for license troubles

= 1.2 =
- At first, the files are now working, Im sorry for all troubles
- You can choose song lyrics wrap element to improve look of the page
- Fixed icons to fit new WP admin lookup
- If installing, default settings are automatically added
- Auto creating new page for song list is now option of song list page select
- If any file is removed from Wordpress, appears as broken in editor and is no more linked to song after saving
- Option to show Go Back to song list button in all songs
- Added second column to plugin settings page
- Removed list of added files from song list - it only caused errors
- All styles are now external

= 1.1.2 =
- When removing plugin, all settings are removed from database
- Fixed: If no author is set to song, nothing will appear in song list

= 1.1.1 =
- Fixed bugs with attaching files - didn't save value when no file is chosen
- Fixed bug with listing files and songs
- Files no more appears in song when they were deleted from Wordpress
- Improved admin script and style including
- Since this version automatically adds default settings after install

= 1.1 =
- Many key core changes
- Changed song listing system
- Now existing page with songs is detected by exist, not by option
- Updated language files
- Added option to show files to logged/unlogged users

= 1.0.3 =
- Fixed some language bugs
- Added settings and guide links to the plugins page

= 1.0.2 =
- Im very sorry for that troubles I made you. Now it shouldn't happen anymore. Hope :)

= 1.0.1 =
- Bug: last version, after wordpress installation on some hostings causes error

= 1.0 =
- Its great to tell, all basic things are working well :)
- After saving settings you know what was changed.
- If you have any problem or idea, let me know.

= 0.9.3 =

- Finally added songbook settings page and fixed troubles with metaboxes

= 0.9.2 =
- Added filebox for adding files to songs and other to add aditional info about song. Now you can define song tempo or add link to video on internet.

= 0.9.1 =
- Solved trouble with displaying, shortcodes and added new feature - Widget for displaying newest songs

= 0.9 =
- Added to repository, still not finished but stable. Adds CPT Song, Taxonomy Author and some plugin "guide of use" to Wordpress installation