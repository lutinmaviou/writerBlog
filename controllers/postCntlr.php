<?php
require('models/PostsMngr.php');
require('models/CommentsMngr.php');
require('models/Pagination.php');


use Lmv\WriterBlog\Models\Models_PostsMngr;
use Lmv\WriterBlog\Models\Models_Pagination;
use Lmv\WriterBlog\Models\Models_CommentsMngr;
//use Lmv\WriterBlog\Models\Autoloader;

//require_once 'Autoloader.php';
//Autoloader::register();

function readPosts()
{
    $listPosts = new Models_PostsMngr;
    $pagination = new Models_Pagination;
    $nbPosts = $pagination->getPostsPagination();
    $postsPerPage = 3;
    $nbPages = ceil($nbPosts / $postsPerPage);
    if (isset($_GET['page']) && !empty($_GET['page']) && ctype_digit($_GET['page'])) {
        if ($_GET['page'] > $nbPages) {
            $currentPage = $nbPages;
        } else {
            $currentPage = $_GET['page'];
            $previousPage = $currentPage - 1;
            $nextPage = $currentPage + 1;
        }
    } else {
        $currentPage = 1;
    }
    $firstOfPage = ($currentPage - 1) * $postsPerPage;

    $req = $listPosts->getPosts($firstOfPage, $postsPerPage);

    require('views/home.php');
}
function readPost()
{
    $readPost = new Models_PostsMngr;
    $readComments = new Models_CommentsMngr;
    $post = $readPost->getPost($_GET['id']);
    $comments = $readComments->getComments($_GET['id']);
    $lastId = $readPost->getLastPost();
    if ($_GET['id'] > $lastId['id']) {
        die('Ce post n\'existe pas');
    } else {
        $post;
        $comments;
    }
    require('views/postView.php');
}
function displayNewPost()
{
    require('views/createPostView.php');
}
function createPost($title, $chapterContent)
{
    $addPost = new Models_PostsMngr;
    $newPost = $addPost->addPost($title, $chapterContent);
    header('Location: index.php?page=1');
}
function displayUpdatePost()
{
    $updatePost = new Models_PostsMngr();
    $post = $updatePost->getPost($_GET['id']);
    require('views/updatePostView.php');
}
function updatePost($title, $chapterContent, $postId)
{
    $updatePost = new Models_PostsMngr;
    $postId = $_GET['id'];
    $modifyPost = $updatePost->changePost($title, $chapterContent, $postId);
    header('Location: index.php?page=1');
}
function deletePost($postId)
{
    $deletePost = new Models_PostsMngr;
    $selectedPost = $deletePost->removePost($postId);
    header('Location: index.php?page=1');
}
