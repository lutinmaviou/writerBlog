<?php
require_once('models/PostsMngr.php');
require_once('models/CommentsMngr.php');
require_once('models/Pagination.php');


function readPosts()
{
    $listPosts = new Models_PostsMngr;
    $pagination = new Models_Pagination;
    $nbPosts = $pagination->getPostsPagination();
    $postsPerPage = 3;
    $nbPages = ceil($nbPosts / $postsPerPage);
    /*if (!isset($_GET['page'])) {
        $currentPage = 0;
    } else {
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
            $currentPage = (intval($_GET['page']) - 1) * $postsPerPage;
        }
    }*/
    if (isset($_GET['page']) && !empty($_GET['page']) && ctype_digit($_GET['page'])) {
        if ($_GET['page'] > $nbPages) {
            $currentPage = $nbPages;
        } else {
            $currentPage = $_GET['page'];
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
