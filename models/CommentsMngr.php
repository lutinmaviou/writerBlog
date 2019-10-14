<?php
require_once('models/DbConnect.php');

class Models_CommentsMngr extends Models_DbConnect
{

    public function getComments($postId)
    {
        $req = $this->_dbConnect()->prepare('SELECT id, author, commentContent,
        DATE_FORMAT(commentDate, \'%d/%m/%Y\')
	    AS commentDateFr, reporting FROM comments WHERE post_id = ? ORDER BY commentDate DESC');
        $req->execute(array($postId));
        $comments = $req->fetchAll();
        return $comments;
    }
    public function getComment($commentId)
    {
        $comment = $this->_dbConnect()->prepare('SELECT id, post_id, author, commentContent
        DATE_FORMAT(commentDate, \'%d/%m/%Y\')
        AS commentDateFr, reporting FROM comments');
        $comment->execute(array($commentId));
        return $comment;
    }
    public function addComment($postId, $author, $comment, $status)
    {
        $req = $this->_dbConnect()->prepare('INSERT INTO comments(post_id, author, commentContent, commentDate, reporting)
        VALUES(?, ?, ?, NOW(), ?)');
        $affectedLines = $req->execute(array($postId, $author, $comment, $status));
        return $affectedLines;
    }
    public function removeComment($commentId)
    {
        $req = $this->_dbConnect()->prepare("DELETE FROM comments WHERE id = ? ");
        $selectedComment = $req->execute(array($commentId));
        return $selectedComment;
    }
    public function report($status, $commentId)
    {
        $req = $this->_dbConnect()->prepare("UPDATE comments SET reporting = ? WHERE id = ?");
        $reportedComment = $req->execute(array($status, $commentId));
        return $reportedComment;
    }
    public function getReportedComments()
    {
        $reportedComments = $this->_dbConnect()->query('SELECT id, post_id, author, commentContent,
        DATE_FORMAT(commentDate, \'%d/%m/%Y\')
        AS commentDateFr, reporting FROM comments WHERE reporting = 1 ORDER BY commentDate DESC');
        return $reportedComments;
    }
}
