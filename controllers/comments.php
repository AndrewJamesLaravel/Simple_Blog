<?php

include_once "models/Comment_Table.class.php";
$commentTable = new Comment_Table( $db );
$commentMessage = ""; // !!!

$newCommentSubmitted = isset( $_POST['new-comment'] );
if ( $newCommentSubmitted ) {
    $whichEntry = $_POST['entry-id'];
    $user = $_POST['user-name'];
    $comment = $_POST['new-comment'];
    $commentTable->saveComment( $whichEntry, $user, $comment );
    $commentMessage = "comment saved successfully"; // Works
}

$comments = include_once "views/comments-form-html.php";
$allComments = $commentTable->getAllById( $entryId );
$comments .= include_once "views/comments-html.php";

return $comments;