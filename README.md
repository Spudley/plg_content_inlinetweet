InlineTweet
===========

This plugin allows you turn snippets of text in your page content into tweetable links.

At the simplest level, simply add `{inlinetweet}...{/inlinetweet}` markers around a block of text in your CMS content, and it will be rendered as a link that when clicked opens a twitter window to let you to send a tweet with that text.

There is more to it than that of course. Options and configuration are described below under 'Usage'.


Version History
----------------

* 1.0.0     


Installation
----------------

This is a standard Joomla plugin. Installation is via Joomla's extension manager. As with all plugins, remember that it must also be activated after being installed.


Usage
----------------

###Simple usage:

When editing content for your site, if you want a piece of text to be tweetable, simply add `{inlinetweet}` the start of it and `{/inlinetweet}` to the end. The text between these markers will be rendered on your site as a tweetable link.

Example:

    This is some content text on your site. {inlinetweet}This bit of it is a tweetable link.{/inlinetweet} And then we're back to normal text again.

###Options:

Inside the `{inlinetweet}` marker, you may add the following options:

* *via* - Here you can specify a Twitter username that you want the tweet to be sent 'via'. Do not include the `@` symbol on the username.
* *url* - This attribute allows you to override the URL that will be added to the tweet. By default it will be URL of the current page.
* *hashtags* - This allows you to add some hashtags to the tweet. Note: comma-separated; no spaces; no `#` characters.

Attributes are specified strictly in the form `attribute="value"`, with the values in double quotes.

Example:

    Here is some content on your site. {inlinetweet via="jack" hashtags="random,stuff"}This bit is a tweetable link.{/inlinetweet} And back to normal text again.

Obviously, you need to keep the overall length of your text plus tags, etc short enough to fit into a tweet. (if you make it too long, the plugin will work just fine and clicking the link will open the tweet page, but the user will have to edit the tweet down to an acceptable length before they can submit it)

Note that a `url` value of a single dot (`url="."`) is interpreted as a request to use the current page. This is the default anyway, so is the same as not specifying the URL at all, unless you've set a fixed default URL in the configuration, see below.

Another special value for `url` is a dash (`url="-"`). This indicates that the tweet should not have a URL at all.

###Configuration

In addition to being able to specify the above three options as arguments in the `{inlinetweet}` marker, the plugin also gives you the option to set default values for them all in the plugin configuration. Thus if you are going to have a lot of tweetable links on your site but you want them all to be sent via the same twitter username, then you could set the default value for 'via' in config and save yourself having to specify it on every twitter link.

You can still override the defaults for a specific tweet link by using the attributes in the `{inlinetweet}` marker as described above.

Please note, regarding the URL option: If you set a default value for the URL, it will override the default behaviour of using the current URL where the link is being displayed, and will instead give you a static URL that will be the same for all your tweet links. This feature may be useful for setting to a dash (`-`) if you know that you generally don't want URLs in your tweets, but setting to any other arbitrary fixed URL is unlikely to be useful so I recommend not setting this default value. It is there if you need it though. If you do set a default URL, you can always override it back to the 'current page' default by using `url="."` as described above.


Motivation
----------------

This is a PHP / Joomla-specific re-implementation of the [InlineTweet.js](https://github.com/ireade/inlinetweetjs) JavaScript library. The functionality of this plugin is broadly similar to the JS library, but the code was written from scratch and is not a copy of the JS code.

Reasons for using this plugin rather than the JS library:

- The JS library does not currently specify a license in its repository or documentation, meaning that people who care about these things (or whose legal departments care) cannot use it.
- The plugin has the ability to specify defaults in the config, which isn't a feature in the JS library.
- The JS library uses HTML `<span>` tags to activate the conversion. The plugin uses `{inlinetweet}` markers, which is more convenient in a WYSIWYG content editor.
- The plugin renders the link server-side, before the page is sent rather than the on client. This will avoid any issues with visible jumps as the page updates after it has loaded.


Todo List and Known Issues
--------------------------

* Todo: Add config to make the twitter icon optional.
* Todo: Allow the tweet text to be overridden.
* Todo: Allow single quotes as well as double quotes for attribute values.
* Issue: Things will break if your tweet text contains HTML or spans across the start or end of an HTML element.


License
----------------
As with all Joomla extensions and Joomla itself, this plugin is licensed under the GPLv2. The full license document should have been included with the source code.
