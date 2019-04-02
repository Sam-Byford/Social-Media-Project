<?php
include_once('forum_code.php');

$forumObj = new ForumCode();
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$msgContents = $_POST['msgContents']; 

$result = $forumObj->send_message($sender, $receiver, $msgContents);