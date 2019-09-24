<?php
require('models/DbConnect.php');

class Models_PostsMngr extends Models_DbConnect
{
    public function addPost($title, $chapterContent)
    {
        $req = $this->_dbConnect()->prepare('INSERT INTO posts (title, chapterContent, postDate)
        VALUES (?, ?, NOW())');
        $newPost = $req->execute(array($title, $chapterContent));
        return $newPost;
    }
    public function getPosts()
    {
        $req = $this->_dbConnect()->query('SELECT id, title, chapterContent, 
        DATE_FORMAT(postDate, \'%d/%m/%Y à %H:%i\') AS postDateFr
        FROM posts 
        ORDER BY postDate 
        DESC LIMIT 0, 5');
        return $req;
    }
    public function getPost($postId)
    {
        $req = $this->_dbConnect()->prepare('SELECT id, title, chapterContent,
        DATE_FORMAT(postDate, \'%d/%m/%Y à %H:%i\') AS postDateFr
	    FROM posts
        WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }
    public function changePost($title, $chapterContent)
    {
        $req = $this->_dbConnect()->prepare('UPDATE posts SET title = ?, chapterContent = ?, NOW() WHERE id=' . $_GET['id']);
        $updatedPost = $req->execute(array($title, $chapterContent));
        return $updatedPost;
    }
    public function removePost($postId)
    {
        $req = $this->_dbConnect()->prepare('DELETE posts, comments FROM posts
        INNER JOIN comments ON comments.post_id = posts.id WHERE posts.id= ?');
        $selectedPost = $req->execute(array($postId));
        return $selectedPost;
    }
}
