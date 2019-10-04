<?php
require_once('models/DbConnect.php');

class Models_MembersMngr extends Models_DbConnect
{
    public function newMember($pseudo, $pswd, $status)
    {
        $req = $this->_dbConnect()->prepare('INSERT INTO members (pseudo, password, status)
         VALUES (?, ?, ?)');
        $newMember = $req->execute(array($pseudo, $pswd, $status));
        return $newMember;
    }
    public function getMemberInfos($pseudo, $pswd)
    {
        $req = $this->_dbConnect()->prepare('SELECT pseudo, password, status 
        FROM members');
        $req->execute(array($pseudo, $pswd));
        $member = $req->fetch();
        return $member;
    }
}
