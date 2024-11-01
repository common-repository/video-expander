=== Video Expander ===
Contributors: bcupham
Donate link: http://example.com/
Tags: video, video gallery, expanding video, expanding youtube, video shortcode, simple video gallery,
youtube video gallery, no lightbox video gallery, video grid
Requires at least: 3.6
Tested up to: 4.3.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creates shortcode to display video iframes in columns, where each video expands to play on mouse click. 

== Description ==

Creates shortcode to display video iframes in columns, where each video expands to play on mouse click. 
Also generates a video thumbnail to use as a placeholder to reduce load time and memory usage. 

Shortcode format is the following: 
`[video-expander video-url="THE URL OF YOUR YOUTUBE OR VIMEO VIDEO"]The caption for your video.[/video-expander]`

**Read complete instructions in Installation section**

Admin can choose how many columns of videos to display. At 800px or less, will automatically display only
one column of videos. 

Accepts Youtube and Vimeo video urls only at this time. 

**Contact me with requests for features**

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Media screen to configure the number of columns of videos

**How to Create a Gallery**

1. Insert correctly formatted shortcode in your post or page content area (text edit mode only). 
1. Shortcode format is `[video-expander video-url="THE URL OF YOUR YOUTUBE OR VIMEO VIDEO"]The caption for your video.[/video-expander]`
1. Enter as many shortcodes as you want, but group them directly next to each other (no spaces or line breaks) or bad things will happen.
1. Save. The plugin will automatically wrap your shortcodes in a gallery `div`. 

**Example video urls**
`https://youtu.be/MBbpzbfNaC0` or `https://vimeo.com/123685236`

**BUT NOT:**
`https://www.youtube.com/watch?v=MBbpzbfNaC0`

In other words, the video id ('MBbpzbfNaC0') needs to go at the end of the URL. 

**Also...**

* To change colors, font-size, etc. you will need to know CSS. Either override in your styles.css or edit the video-expander.css file -- but remember to save it elsewhere before updating.
* To change the image for the play button, delete the original play-button.png file in the assets folder and give the new image the same name, including the file extension.

== Frequently Asked Questions ==

= What videos can I use? =

Video embed urls from Youtube and Vimeo only at this time. See Installation for correct format of urls.

= How do I stop the videos from auto-playing on click? =

Ask me to add that as an option in the settings page and I'll do it. 

= Can you change the plugin to do XYZ? =

If it is not too much work, sure. Just ask. 

= What about foo bar? =

Our top people are working on a solution.

== Screenshots ==

1. Example of a group of video-expander shortcodes ready to be displayed!
2. Two column video-expander gallery
3. Two column video-expander gallery with expanded video

== Changelog ==

= 1.0 =
* The first release. 