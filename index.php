<?php
session_start();
require_once('controllers/postCntlr.php');
require_once('controllers/commentCntrl.php');
require_once('controllers/memberCntrl.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                readPost();
            } else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'newPost') {
            displayNewPost();
        } elseif ($_GET['action'] === 'addNewPost') {
            if (!empty($_POST['title']) && !empty($_POST['chapterContent'])) {
                createPost($_POST['title'], $_POST['chapterContent']);
            } else {
                throw new Exception('Aucun contenu');
            }
        } elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
                echo 'Le post a bien été supprimé';
            }
        } elseif ($_GET['action'] === 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                displayUpdatePost();
            } else echo 'Aucun identifiant de post';
        } elseif ($_GET['action'] === 'submitUpdatePost') {
            if (!empty($_POST['title']) && !empty($_POST['chapterContent'])) {
                updatePost($_POST['title'], $_POST['chapterContent'], $_GET['id']);
            } else {
                throw new Exception('Erreur : aucun contenu');
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
        } elseif ($_GET['action'] === 'login') {
            displayLoginView();
        } elseif ($_GET['action'] === 'submitLogin') {
            submitLogin(strip_tags($_POST['pseudo']), strip_tags($_POST['pswd']));
        } elseif ($_GET['action'] === 'subscribe') {
            displaySubscribeView();
        } elseif ($_GET['action'] === 'addMember') {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                /*if (
                    strlen($_POST['password'] < 6)
                    || strlen($_POST['password'] > 20)
                    || preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['password'])
                ) {
                    echo 'Mot de passe non conforme';
                } else {*/
                addMember(strip_tags($_POST['pseudo']), strip_tags($_POST['password']), 'user');
                //}
            }
        } else {
            echo 'Tous les champs ne sont pas remplis!';
        }
    } else {
        readPosts();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
