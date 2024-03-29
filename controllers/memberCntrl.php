<?php

use Lmv\WriterBlog\Models\MembersMngr;

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
    $pswd = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $newMember = new  MembersMngr;
    $member = $newMember->newMember($pseudo, $pswd, $status);
    $infosMbr = $newMember->getMemberInfos($pseudo);
    $_SESSION['id'] = $infosMbr['id'];
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['status'] = $infosMbr['status'];

    header('Location: index.php?member&page=1');
}
function submitLogin($pseudo)
{
    $connect = new MembersMngr;
    $infosMbr = $connect->getMemberInfos($pseudo);
    $correctPswd = password_verify($_POST['password'], $infosMbr['password']);
    if ($correctPswd && $_POST['pseudo'] === $pseudo) {
        $_SESSION['id'] = $infosMbr['id'];
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['status'] = $infosMbr['status'];
        if ($infosMbr['status'] === '0') {
            header('Location: index.php?member&page=1');
        } elseif ($infosMbr['status'] === '1') {
            header('Location: index.php?admin&page=1');
        }
    } else {
        echo 'echec de l\'identification';
    }
}
function logout()
{
    $_SESSION = [];
    session_destroy();
    header('Location: index.php?page=1');
}
