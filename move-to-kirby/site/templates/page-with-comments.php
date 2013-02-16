
	<h1><?php echo html($page->title()) ?></h1>
	<p><?php echo kirbytext($page->text()) ?></p>

	<?php snippet('comments.list') ?>
	<?php snippet('comments.add.form') ?>

