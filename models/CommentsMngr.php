<?php
require_once('models/DbConnect.php');

class Models_CommentsMngr extends Models_DbConnect
{

    public function getComments($postId)
    {
        $comments = $this->_dbConnect()->prepare('SELECT id, author, commentContent,
        DATE_FORMAT(commentDate, \'%d/%m/%Y\')
	    AS commentDateFr FROM comments WHERE post_id = ? ORDER BY commentDate DESC');
        $comments->execute(array($postId));
        return $comments;
    }
    public function getComment($commentId)
    {
        $comment = $this->_dbConnect()->prepare('SELECT id, post_id, author, commentContent,
        DATE_FORMAT(commentDate, \'%d/%m/%Y\')
        AS commentDateFr FROM comments');
        $comment->execute(array($commentId));
        return $comment;
    }
    public function addComment($postId, $author, $comment)
    {
        $req = $this->_dbConnect()->prepare('INSERT INTO comments(post_id, author, commentContent, commentDate)
        VALUES(?, ?, ?, NOW())');
        $affectedLines = $req->execute(array($postId, $author, $comment));
        return $affectedLines;
    }
    public function removeComment($commentId)
    {
        $req = $this->_dbConnect()->prepare("DELETE FROM comments WHERE id = ? ");
        $selectedComment = $req->execute(array($commentId));
        return $selectedComment;
    }
}
