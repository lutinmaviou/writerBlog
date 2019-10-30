<?php

//namespace Lmv\writerBlog\controllers;
require_once('models/CommentsMngr.php');

use Lmv\WriterBlog\Models\CommentsMngr;

function createComment($postId, $author, $comment, $status)
{
    $commentContent = new CommentsMngr;
    $req = $commentContent->addComment($postId, $author, $comment, $status);
    header('Location: index.php?action=post&id=' . $postId);
}
function deleteComment($postId, $commentId)
{
    $deleteComment = new CommentsMngr;
    $deletedComment = $deleteComment->removeComment($commentId);
    if ($_GET['status'] === '1') {
        header('Location: index.php?action=displayReports');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function commentReport($status, $postId, $commentId)
{
    $report = new CommentsMngr;
    $reportedComment = $report->report($status, $commentId);
    header('Location: index.php?action=post&id=' . $postId);
}
function readReportedComments()
{
    $report = new CommentsMngr;
    $reportedComments = $report->getReportedComments();
    $reportedComments;
    require('views/reportingView.php');
}
