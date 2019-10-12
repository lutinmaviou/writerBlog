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
    public function getMemberInfos($pseudo)
    {
        $req = $this->_dbConnect()->prepare('SELECT id, password, status 
        FROM members WHERE pseudo= ?');
        $req->execute(array($pseudo));
        $member = $req->fetch();
        return $member;
    }
}
