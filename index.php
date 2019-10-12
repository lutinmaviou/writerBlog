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
                throw new Exception('Aucun identifiant de billet envoyé');
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
                throw new Exception('Aucun contenu');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['commentContent'])) {
                    createComment($_GET['id'], $_POST['author'], $_POST['commentContent']);
                } else {
                    echo 'Erreur : tous les champs ne sont pas remplis !';
                }
            } else {
                throw new Exception('Aucun identifiant de billet reconnu');
            }
        } elseif ($_GET['action'] === 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
        } elseif ($_GET['action'] === 'login') {
            displayLoginView();
        } elseif ($_GET['action'] === 'submitLogin') {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                submitLogin(strip_tags($_POST['pseudo']), strip_tags($_POST['password']));
            } else {
                echo 'Les champs ne sont pas tous remplis!';
            }
        } elseif ($_GET['action'] === 'subscribe') {
            displaySubscribeView();
        } elseif ($_GET['action'] === 'addMember') {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['password'])) {
                    echo 'Mot de passe non conforme';
                } else {
                    addMember(strip_tags($_POST['pseudo']), strip_tags($_POST['password']), 'user');
                }
            } else {
                echo 'Les champs ne sont pas tous remplis';
            }
        } elseif ($_GET['action'] === 'logout') {
            logout();
        }
    } else {
        readPosts();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

/*if (empty($_POST['pseudo']) && !empty($_POST['password'])) {
                die('Veuillez renseigner votre pseudo');
            } elseif (empty($_POST['password']) && !empty($_POST['pseudo'])) {
                die('Veuillez rentrer votre mot de passe');
            } elseif (empty($_POST['pseudo']) && empty($_POST['password'])) {
                die('Veuillez remplir tous les champs');
            } elseif (strlen($_POST['password'] < 6)) {
                echo 'mot de passe trop court';
                var_dump(strlen($_POST['password']));
            } elseif (strlen($_POST['password'] > 20)) {
                echo 'Mot de passe trop long';
            } elseif (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['password']) === false) {
                die('Mot de passe non conforme');
            } else {
                addMember(strip_tags($_POST['pseudo']), strip_tags($_POST['password']), 'user');
            }*/
