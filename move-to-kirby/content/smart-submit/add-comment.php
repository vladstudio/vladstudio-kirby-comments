<?php

header('Content-type: application/json');


//validate using Kirby toolkit
$errors = array();
if (!get('name'))             { die('{"error":"'.(l::get('error.name-required') ?: 'Please enter your name.').'"}'); }
if (!v::email(get('email')))  { die('{"error":"'.(l::get('error.email-invalid') ?: 'Please enter valid e-mail address.').'"}'); }
if (!get('text'))             { die('{"error":"'.(l::get('error.message-required') ?: 'Message is required.').'"}'); }

$comments_file = kirby()->roots()->content() . '/' . get('diruri') . '/' . c::get('comments.data.filename', 'comments.json');
$comments = json_decode(utf8_encode(file_get_contents($comments_file)), true);

$new_comment_id = count($comments);
$comments[$new_comment_id] = array();
$comments[$new_comment_id]['name'] = get('name');
$comments[$new_comment_id]['email'] = get('email');
$comments[$new_comment_id]['date'] = date('r', time());
$comments[$new_comment_id]['text'] = get('text');
$comment_json = json_encode($comments, JSON_HEX_QUOT | JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK);

// write to file
file_put_contents($comments_file, $comment_json) || die('{"error":"'.(l::get('comments.file_error') ?: 'Failed to save comment, please contact web master!').'"}');

// save name & email into cookie
if (c::get('comments.save_author_in_cookie')):
  cookie::set('comments_author_name', get('name'));
  cookie::set('comments_author_email', get('email'));
endif;

// email notification
if (function_exists('amazon_ses') && v::email(c::get('comments.notify.email'))):
amazon_ses(array(
  'to'  => c::get('comments.notify.email'),
  'body'  =>
    "From: ".addslashes(get('name'))." <".addslashes(get('email')).">\n\n".
    server::get('http_referer')."\n\n".
    addslashes(get('text'))
  ));
endif;

die('{"success":"'.(l::get('comments.saved') ?: 'Thank you for your comment!').'"}');
