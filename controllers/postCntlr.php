<?php
require_once('models/PostsMngr.php');
require_once('models/CommentsMngr.php');

function readPosts()
{
    $listPosts = new Models_PostsMngr;
    $req = $listPosts->getPosts();
    require('views/home.php');
}
function readPost()
{
    $readPost = new Models_PostsMngr;
    $readComments = new Models_CommentsMngr;
    $post = $readPost->getPost($_GET['id']);
    $comments = $readComments->getComments($_GET['id']);
    require('views/postView.php');
}
function createPost($title, $chapterContent)
{
    $addPost = new Models_PostsMngr;
    $newPost = $addPost->addPost($title, $chapterContent);
    header('Location: index.php');
}
function displayUpdate()
{
    $updatePost = new Models_PostsMngr();
    $post = $updatePost->getPost($_GET['id']);
    require('views/updatePostView.php');
}
function updatePost($title, $chapterContent)
{
    $updatePost = new Models_PostsMngr;
    $modifyPost = $updatePost->changePost($title, $chapterContent);
    header('Location: index.php');
}
function deletePost($postId)
{
    $deletePost = new Models_PostsMngr;
    $selectedPost = $deletePost->removePost($postId);
    header('Location: index.php');
}
