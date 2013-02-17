<?php 

if (c::get('comments.enabled')):

	// prepare current page's path (f.e. blog/post-one)
	$comments['match_path'] = str_replace('content/', '', $page->diruri);

	// check "include pages"
	if (c::get('comments.include.pages')):
		c::set('comments.enabled', false);
		foreach (c::get('comments.include.pages') as $value):
			if (fnmatch($value, $comments['match_path'])):
				c::set('comments.enabled', true);
				break;
			endif;
		endforeach;
	endif;

	// check "exclude pages"
	if (c::get('comments.exclude.pages')):
		foreach (c::get('comments.exclude.pages') as $value):
			if (fnmatch($value, $comments['match_path'])):
				c::set('comments.enabled', false);
				break;
			endif;
		endforeach;
	endif;

	// end of checks

endif;

// comments still enabled after checks?
if (c::get('comments.enabled')):

	// read comments
	$comments['data.file.path'] = c::get('root') . '/' . $page->diruri . '/' . c::get('comments.data.filename', 'comments.json');

	if (file_exists($comments['data.file.path'])):
		$comments['data'] = json_decode(utf8_encode(file_get_contents($comments['data.file.path'])), true);
	endif;

	// prepare HTML for gravatars
	if (c::get('comments.gravatar')):
		foreach ($comments['data'] as $i => $comment):
			$gravatar_hash = md5(strtolower(trim($comment['email'])));
			$comments['data'][$i]['gravatar'] = '<img src="http://www.gravatar.com/avatar/'.$gravatar_hash.'.jpg?s='.c::get('comments.gravatar').'" width="'.c::get('comments.gravatar').'" height="'.c::get('comments.gravatar').'">';
			endforeach;
	endif;

endif;


