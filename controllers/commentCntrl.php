<?php
require_once('models/CommentsMngr.php');
require_once('models/PostsMngr.php');

/*function readComment($commentId)
{
    $readComment = new Models_CommentsMngr;
    $comment = $readComment->getComment($commentId);
    require('views/commentView.php');
}*/
function createComment($postId, $author, $comment, $status)
{
    $commentContent = new Models_CommentsMngr;
    $req = $commentContent->addComment($postId, $author, $comment, $status);
    header('Location: index.php?action=post&id=' . $postId);
}
function deleteComment($postId, $commentId)
{
    $deleteComment = new Models_CommentsMngr;
    $deletedComment = $deleteComment->removeComment($commentId);
    if ($_GET['status'] === '1') {
        header('Location: index.php?action=displayReports');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function commentReport($status, $postId, $commentId)
{
    $report = new Models_CommentsMngr;
    $reportedComment = $report->report($status, $commentId);
    header('Location: index.php?action=post&id=' . $postId);
}
function readReportedComments()
{
    $report = new Models_CommentsMngr;
    $reportedComments = $report->getReportedComments();
    $reportedComments;
    require('views/reportingView.php');
}
