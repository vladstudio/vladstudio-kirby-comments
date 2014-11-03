<?php

if (c::get('comments.enabled')):

?>
<h3><?= l::get('comments.add') ?: 'Add comment' ?></h3>
<form id="smart-submit" class="add-comment-form" action="<?= url('smart-submit') ?>?handler=add-comment">

<label for="name"><?= l::get('comments.name') ?: 'Your name:' ?></label>
<input type="text" class="text required" name="name" id="name" value="<?= cookie::get('comments_author_name') ?: '' ?>">
<hr>
<label for="email"><?= l::get('comments.email') ?: 'Your email (will not be published):' ?></label>
<input type="email" class="text required email" name="email" id="email" value="<?= cookie::get('comments_author_email') ?: '' ?>">
<hr>
<label for=""><?= l::get('comments.text') ?: 'Your comment:' ?></label>
<textarea rows="12" name="text" class="required" id="text"></textarea>
<hr>
<input type="submit" class="submit" value="<?= l::get('comments.send') ?: 'Send' ?>">
<input type="hidden" name="diruri" value="<?= $page->diruri() ?>">

</form>
<?php endif; ?>
