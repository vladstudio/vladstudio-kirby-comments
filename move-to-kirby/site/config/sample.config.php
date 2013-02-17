<?php 

	// enable/disable comments globally, true/false
	c::set('comments.enabled', true);

	// patterns for pages with comments (required)
	// relative to "content/" folder, f.e.: array('blog/*')
	c::set('comments.include.pages', array('*') );

	// patterns for pages without comments (optional)
	// relative to "content/", f.e.: array('blog/*')
	c::set('comments.exclude.pages', array('') );

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
