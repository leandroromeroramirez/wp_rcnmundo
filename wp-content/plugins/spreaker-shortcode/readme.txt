=== Spreaker Shortcode ===
Contributors: Spreaker
Tags: spreaker, shortcode, audio, embed, widget, player, podcast, music, sound
Requires at least: 2.5.0
Tested up to: 4.8.0
Stable tag: 1.4.1


A simple and easy way to embed Spreaker player into your WordPress blog.


== Description ==

The Spreaker shortcode plugin is an easy way to embed Spreaker audio player into your WordPress blog. It works for any Spreaker episode, show, or user. Once you install this plugin, it will work on all of your blog posts.

A simple example:

`[spreaker type=player resource="episode_id=3331356"]`


**More Options**

Spreaker shortcode requires the resource play. It can be only of the following:

* `resource="episode_id=X"`: id of the episode to embed.
* `resource="show_id=X"`: id of the show, whose latest episode should be displayed.
* `resource="user_id=X"`: id of the user, whose latest episode should be displayed.

The plugin also supports the following optional parameters:

* `width`: player's width - can be in % or px (ie. `100%` or `400px`).
* `height`: player's height - can be in % or px (ie. `100%` or `400px`).
* `theme`: player's UI theme. Supported themes are: `light` (default) and `dark`.
* `cover`: HTTPS url of an image to display as player's background.
* `playlist`:  configures how the playlist should be built. It can be `playlist="false"` to disable the playlist, `playlist="user"` to display all user's episodes in the playlist or `playlist="show"` to display all show's episodes in the playlist. The default behavious depends on resource.
* `playlist-continuous`: enables or disables the playlist continuous playback. When `true` it continuously plays all episodes in the playlist until the end.
* `playlist-loop`: enables or disables loop playlist playback when continuous playback is enabled. When `true` and playlist continuous playback is enabled as well, it will loop the playlist continuously (defaults to `false`).
* `playlist-autoupdate`: enables or disables the playlist autoupdate, when a new episode is published. This feature is enabled by default.
* `autoplay`: enables or disables the autoplay. When `true` it automatically starts playing when the player loads. Autoplay doesn't work on most mobile browsers. Defaults to `false`.
* `live-autoplay`: when `true` and a new LIVE is onair, the player will start playing automatically, no matter if `autoplay` is disabled or the player is already playing another episode (defaults to `false`).
* `chapters-image`: enables or disables the display of chapters images in the player (defaults to `true`).

**How to get the shortcode**

Play any track on <a href="http://www.spreaker.com">www.spreaker.com</a> and then click on the **share button** in the player (bottom-right corner): you can customize the appearance of the player and get the shortcode to copy and paste to your WordPress blog.


**Help**

If you need further help, please contact us at <a href="http://help.spreaker.com">help.spreaker.com</a>.



== Changelog ==

= 1.4.1 =
* Tested with WordPress 4.8.0

= 1.4.0 =
* Removed the support for the old embedded player (no more supported by Spreaker). If a widget has been included with the old shortcode syntax, it's now automatically converted to the new embedded player.
* Added `chapters-image` attribute support for the new Spreaker's player

= 1.3.6 =
* Added `live-autoplay` attribute support for the new Spreaker's player

= 1.3.5 =
* FIX: the plugin should display the old (mini) embedded player when type attribute is missing, in order to avoid breaking backward compatibility

= 1.3.4 =
* Translated the plugin in Spanish and Italian

= 1.3.3 =
* Added `playlist-loop` attribute support for the new Spreaker's player

= 1.3.2 =
* Added `playlist-autoupdate` attribute support for the new Spreaker's player

= 1.3.0 =
* Added support for the new Spreaker's player

= 1.2.5 =
* Tested with WordPress 4.5.3

= 1.2.4 =
* FIX: the plugin now supports sharing of user's latest episode via `user_id` param

= 1.2.3 =
* FIX: the plugin now supports both HTTP and HTTPS WordPress websites
* Tested with WordPress 4.4

= 1.2.2 =
* Tested with WordPress 4.3.1

= 1.2.1 =
* Tested with WordPress 4.1
* Added banner and icon
* Updated description

= 1.2 =
* Updated the link to spreaker support forum

= 1.1 =
* Added coupon support

= 1.0 =
* First Release
