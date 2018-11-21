<?php

$commentsFound = isset( $allComments );
if ( $commentsFound === false ) {
    trigger_error('views/comments-html.php needs $allComments');
}

$commentMessage = "";
$numberOfComments = $allComments->rowCount();
if ( $numberOfComments === 0 ) {
    $commentMessage = "Be the first to comment this article";
}

$allCommentsHTML = "<ul id='comments'>";
while ($commentData = $allComments->fetchObject() ) {
    $allCommentsHTML .= "<li>
        $commentData->author wrote:
        <p>$commentData->txt</p>
        </li>";
}
$allCommentsHTML .= "</ul>";
$allCommentsHTML .= "<p>$commentMessage</p>";

return $allCommentsHTML;