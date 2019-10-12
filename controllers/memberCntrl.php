<?php
require_once('models/MembersMngr.php');

function displayLoginView()
{
    require('views/loginView.php');
}
function displaySubscribeView()
{
    require('views/subscribeView.php');
}
function addMember($pseudo, $pswd, $status)
{
    // password hash and salt
    /*$pswd = $_POST['password'];
    $long = strlen($pswd);
    $pswd = '&*+=' . $long . $pswd . '**6\(';
    $pswd = hash('512', $pswd);*/
    // **********************

    // password_hash($_POST['password, PASSWORD_DEFAULT) ???
    // password_verify()
    // est-ce mieux?

    $newMember = new  Models_MembersMngr;
    $member = $newMember->newMember($pseudo, $pswd, $status);

    header('Location: index.php');
}
function submitLogin($pseudo)
{
    // password hash and salt
    /*$pswd = $_POST['password'];
    $long = strlen($pswd);
    $pswd = '&*+=' . $long . $pswd . '**6\(';
    $pswd = hash('512', $pswd);*/
    // **********************

    $connect = new Models_MembersMngr;
    $infosMbr = $connect->getMemberInfos($pseudo);
    if ($_POST['password'] === $infosMbr['password'] && $_POST['pseudo'] === $pseudo) {
        $_SESSION['id'] = $infosMbr['id'];
        $_SESSION['pseudo'] = $pseudo;
        header('Location: index.php?login=success');
    } else {
        echo 'echec de l\'identification';
    }
}
function logout()
{
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
}
