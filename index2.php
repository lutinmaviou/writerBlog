<?php
session_start();

// Protection against session theft
$cookieName = 'ticket';
$ticket = session_id() . microtime() . rand(0, 9999999999);
$ticket = hash('sha512', $ticket);
setcookie($cookieName, $ticket, time() + (60 * 20));
$_SESSION['ticket'] = $ticket;
//********************************* */

require_once('controllers/postCntlr.php');
require_once('controllers/commentCntrl.php');
require_once('controllers/navCntrl.php');


try {
    if (isset($_SESSION['ticket']) && isset($_COOKIE['ticket'])) {
        if ($_SESSION['ticket'] === $_COOKIE['ticket']) {
            $ticket = session_id() . microtime() . rand(0, 9999999999);
            $ticket = hash('sha512', $ticket);
            $_session['ticket'] = $ticket;
            $_COOKIE['ticket'] = $ticket;

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
                    submitLogin();
                } elseif ($_GET['action'] === 'subscribe') {
                    displaySubscribeView();
                } elseif ($_GET['action'] === 'submitSubscribe') {
                    submitSubscribe();
                }
            } else {
                readPosts();
            }
        } else {
            $_SESSION = array();
            session_destroy();
            header('Location: index.php');
        }
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
