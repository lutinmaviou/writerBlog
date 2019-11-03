<?php

session_start();

use Lmv\writerBlog\Autoloader;

require('controllers/postCntlr.php');
require('controllers/commentCntrl.php');
require('controllers/memberCntrl.php');
require('vendor/Autoloader.php');

Autoloader::register();

try {
    // ----------------- POSTS -----------------
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
                createPost(htmlspecialchars($_POST['title']), $_POST['chapterContent']);
            } else {
                throw new Exception('Aucun contenu');
            }
        } elseif ($_GET['action'] === 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                displayUpdatePost();
            } else echo 'Aucun identifiant de post';
        } elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
                echo 'Le post a bien été supprimé';
            }
        } elseif ($_GET['action'] === 'submitUpdatePost') {
            if (!empty($_POST['title']) && !empty($_POST['chapterContent'])) {
                updatePost(htmlspecialchars($_POST['title']), $_POST['chapterContent'], $_GET['id']);
            } else {
                throw new Exception('Aucun contenu');
            }
            // ----------------- COMMENTS -----------------
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['commentContent'])) {
                    createComment($_GET['id'], $_SESSION['pseudo'], $_POST['commentContent'], 0);
                } else {
                    echo 'Erreur : les champs ne sont pas tous remplis !';
                }
            } else {
                throw new Exception('Aucun identifiant de billet reconnu');
            }
        } elseif ($_GET['action'] === 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id'], $_GET['commentId']);
            }
        } elseif ($_GET['action'] === 'report') {
            commentReport(1, $_GET['id'], $_GET['commentId']);
        } elseif ($_GET['action'] === 'displayReports') {
            readReportedComments();
        }
        // ----------------- LOGIN -----------------
        elseif ($_GET['action'] === 'login') {
            displayLoginView();
        } elseif ($_GET['action'] === 'submitLogin') {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                submitLogin(strip_tags($_POST['pseudo']), strip_tags($_POST['password']));
            } else {
                echo 'Les champs ne sont pas tous remplis!';
            }
            // ----------------- SUBSCRIBE -----------------
        } elseif ($_GET['action'] === 'subscribe') {
            displaySubscribeView();
        } elseif ($_GET['action'] === 'addMember') {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                // Member status : 1 = admin, 0 = member
                addMember(strip_tags($_POST['pseudo']), strip_tags($_POST['password']), 0);
            } else {
                echo 'Les champs ne sont pas tous remplis';
            }
            // ----------------- LOGOUT -----------------
        } elseif ($_GET['action'] === 'logout') {
            logout();
        }
    } else {
        readPosts();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
