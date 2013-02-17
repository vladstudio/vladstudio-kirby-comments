<?php 

require 'comments.read.php';

if (count($comments['data'])):

	?>
	<h3><?= l::get('comments.title') ?: 'Comments' ?></h3>
	<ul id="comments">
		<?php foreach ($comments['data'] as $comment):
			echo '<li>'.
			(c::get('comments.gravatar') ? '<div class="comment-gravatar">'.$comment['gravatar'].'</div>' : '').
			'
			<div class="comment-name">'.$comment['name'].'</div>
			<div class="comment-date">'.date(c::get('comments.date.format' ?: 'Y-m-d'), strtotime($comment['date'])).'</div>
			<div class="comment-text">'.kirbytext($comment['text']).'</div>
			</li>';
		endforeach; ?>
	</ul>
	<?php 
endif;

