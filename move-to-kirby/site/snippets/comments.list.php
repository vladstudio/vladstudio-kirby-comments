<?php 

if (c::get('comments.enabled')):

	// read comments
	$comments['data.file.path'] = c::get('root') . '/' . $page->diruri . '/' . c::get('comments.data.filename');

	if (file_exists($comments['data.file.path'])):
		$comments['data'] = json_decode(utf8_encode(file_get_contents($comments['data.file.path'])), true);
	endif;

	// show comments list
	if (count($comments['data'])):

	?>
	<h3><?= l::get('comments.title') ?: 'Comments' ?></h3>
	<ul id="comments">
		<?php foreach ($comments['data'] as $comment):
			echo '<li>';
			
			if (c::get('comments.gravatar') && $comment['email']):
				$gravatar_hash = md5(strtolower(trim($comment['email'])));
				echo '<div class="comment-gravatar"><img src="http://www.gravatar.com/avatar/'.$gravatar_hash.'.jpg?s='.c::get('comments.gravatar').'" width="'.c::get('comments.gravatar').'" height="'.c::get('comments.gravatar').'"></div>';
			endif;

			echo '
			<div class="comment-name">'.$comment['name'].'</div>
			<div class="comment-date">'.date(c::get('comments.date.format' ?: 'Y-m-d'), strtotime($comment['date'])).'</div>
			<div class="comment-text">'.kirbytext($comment['text']).'</div>
			</li>';
		endforeach; ?>
	</ul>
	<?php 
	endif;
endif;
 ?>
