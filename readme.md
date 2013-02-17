# Vladstudio Kirby CMS Comments

[Kirby](http://getkirby.com) is awesome CMS - but it's designed for simple static websites, and if you wanted to allow visitors to leave comments, the only option would be an external system, such as [Disqus](http://jacquesmattheij.com/disqus-bait-and-switch-now-with-ads).

Until now! With "Comments" plugin from Vladstudio, you can store comments right inside your Kirby-powered site.

The plugin is very simple, as is Kirby itself:

* sorting only first to last;
* showing all comments;
* no threads;
* no hot social features;
* no moderation;
* … only comments!

## Requirements

**Smart Submit** plugin is required. Grab it from
<https://github.com/vladstudio/vladstudio-kirby-smart-submit>. Smart Submit comes with Honeypot, a tiny anti-spam mechanism.

Like Smart Submit, Comments plugin is not a "real" plugin - it does not live in `plugins` folder.

----

## Installation

Download [Smart Submit](https://github.com/vladstudio/vladstudio-kirby-smart-submit). You will need the following files from Smart Submit in your Kirby site:

* `assets/js/smart-submit.js`
* `content/smart-submit/smart-submit.txt`
* `site/templates/smart-submit.php`

In your HTML head, include jQuery (latest please) and `smart-submit.js`. Example:

	// site/snippets/header.php
	echo js('//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	echo js('assets/js/smart-submit.js');

Add (and adjust as you need) the following settings into `site/config/config.php`:
	
	// enable/disable comments globally, true/false
	c::set('comments.enabled', true);

	// patterns for pages with comments (required)
	// relative to "content/" folder, f.e.: array('blog/*')
	c::set('comments.include.pages', array('*') );

	// patterns for pages without comments (optional)
	// relative to "content/", f.e.: array('blog/*')
	c::set('comments.exclude.pages', array() );

	// Show Gravatar images?
	// false or size in pixels (f.e. 32)
	c::set('comments.gravatar', 64); 

	// filename for saving comments
	c::set('comments.data.filename', 'comments.json');

	// format for post date: see http://php.net/date
	c::set('comments.date.format', 'Y-m-d');

	// install Amazon SES plugin and provide your email for notifications
	c::set('comments.notify.email', 'vladstudio@gmail.com');

	// when someone posts a comment, save name/email in cookie?
	c::set('comments.save_author_in_cookie', true);


Copy the following files from Comments plugin to your site:

	* `content/smart-submit/add-comment.php`
	* `site/snippets/comments.add.form.php`
	* `site/snippets/comments.read.php`
	* `site/snippets/comments.list.php`

If your site is multi-language, append translations from `site/languages/comments.*.php` to `site/languages/*.php`.
  
Create a template (or modify exising template) for pages with comments in `site/templates`. In our example: *site/templates/page-with-comments.php*. Add the following code where appropriate:

    <?php snippet('comments.list') ?>
    <?php snippet('comments.add.form') ?>

You can modify HTML code of these snippets as you wish, just keep form field names and content.
    
For every page where you want to enable comments, make sure the page uses the template for pages with comments (*content/99-testing-comments/page-with-comments.txt*).
	
The plugin comes with basic HTML only, no CSS styles. Add some styles to your CSS file(s), to match your web site design:
	
	* ul#comments
	* ul#comments li
	* ul#comments li div.comment-gravatar
	* ul#comments li div.comment-name
	* ul#comments li div.comment-date
	* ul#comments li div.comment-text

… and CSS rules for Smart Submit form:

	* form#smart-submit
	* form#smart-submit label
	* form#smart-submit input.text
	* form#smart-submit textarea

That's all!

----
## Email notification

If you want to receive email messages with new comments, simply install my [Amazon SES plugin](https://github.com/vladstudio/vladstudio-kirby-amazon-ses).

----
## Editing/deleting comments

Comments for a page are stored in JSON format in `comments.json`. Simply edit it and remove unwanted comment(s).

----
## Author

Author: Vlad Gerasimov <http://vladstudio.com> <vladstudio@gmail.com> 



