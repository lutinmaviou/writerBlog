<?php
require_once('controllers/postCntlr.php');
require_once('controllers/commentCntrl.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                readPost();
            } else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addNewPost') {
            if (!empty($_POST['title']) && !empty($_POST['chapterContent'])) {
                createPost($_POST['title'], $_POST['chapterContent']);
            } else {
                throw new Exception('Erreur : aucun contenu');
            }
        } elseif ($_GET['action'] === 'deletePost') {
            deletePost($_GET['id']);
            echo 'Le post a bien été supprimé';
        } elseif ($_GET['action'] === 'submitUpdatePost') {
            if (!empty($_POST['title']) && !empty($_POST['chapterContent'])) {
                updatePost($_POST['title'], $_POST['chapterContent']);
            } else {
                throw new Exception('Erreur : aucun contenu');
            }
        } elseif ($_GET['action'] === 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                displayUpdate();
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['commentContent'])) {
                    createComment($_GET['id'], $_POST['author'], $_POST['commentContent']);
                } else {
                    echo 'Erreur : tous les champs ne sont pas remplis !';
                }
            } else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
        }
    } else {
        readPosts();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}