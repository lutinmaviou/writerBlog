<?php

namespace Lmv\WriterBlog\Models;

use Lmv\WriterBlog\Models\DbConnect;

require_once('models/DbConnect.php');
class PostsMngr extends DbConnect
{
    public function addPost($title, $chapterContent)
    {
        $req = $this->_dbConnect()->prepare('INSERT INTO posts (title, chapterContent, postDate)
        VALUES (?, ?, NOW())');
        $newPost = $req->execute(array($title, $chapterContent));
        return $newPost;
    }
    public function getPosts($firstOfPage, $postsPerPage)
    {
        $req = $this->_dbConnect()->query('SELECT id, title, chapterContent,
        DATE_FORMAT(postDate, \'%d/%m/%Y\') AS postDateFr
        FROM posts 
        ORDER BY postDate 
        DESC LIMIT ' . $firstOfPage . ',' . $postsPerPage . '');
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
    public function getLastPost()
    {
        $req = $this->_dbConnect()->query("SELECT MAX(id) AS id FROM posts");
        $lastPost = $req->fetch();
        return $lastPost;
    }
    public function changePost($title, $chapterContent, $postId)
    {
        $req = $this->_dbConnect()->prepare('UPDATE posts 
        SET title = ?, chapterContent = ? 
        WHERE id= ?');
        $updatedPost = $req->execute(array($title, $chapterContent, $postId));
        return $updatedPost;
    }
    public function removePost($postId)
    {
        // Outer join to delete the post even if there are no comments
        $req = $this->_dbConnect()->prepare('DELETE p, c FROM posts p
        LEFT JOIN comments c ON c.post_id = p.id WHERE p.id= ?');
        $deletedPost = $req->execute(array($postId));
        return $deletedPost;
    }
    public function getPostsPagination()
    {
        $req = $this->_dbConnect()->query('SELECT id FROM posts');
        $totalPosts = $req->rowCount();
        return $totalPosts;
    }
}
