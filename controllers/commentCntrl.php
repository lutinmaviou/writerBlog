<?php
require_once('models/CommentsMngr.php');
require_once('models/PostsMngr.php');

function readComment($commentId)
{
    $readComment = new Models_CommentsMngr;
    $comment = $readComment->getComment($commentId);
    require('views/commentView.php');
}
function createComment($postId, $author, $comment)
{
    $commentContent = new Models_CommentsMngr;
    $req = $commentContent->addComment($postId, $author, $comment);
    header('Location: index.php?action=post&id=' . $postId);
}
function deleteComment($commentId)
{
    $deleteComment = new Models_CommentsMngr;

    $deletedComment = $deleteComment->removeComment($commentId);
    header('Location: index.php');
}
