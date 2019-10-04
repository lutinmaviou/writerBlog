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
function submitLogin($pseudo, $pswd)
{
    // password hash and salt
    /*$pswd = $_POST['password'];
    $long = strlen($pswd);
    $pswd = '&*+=' . $long . $pswd . '**6\(';
    $pswd = hash('512', $pswd);*/
    // **********************

    $connect = new Models_MembersMngr;
    $infos = $connect->getMemberInfos($pseudo, $pswd);
    if ($_POST['password'] === $pswd) {
        header('Location: index.php');
    } else {
        echo 'echec de l\'identification';
    }
}
