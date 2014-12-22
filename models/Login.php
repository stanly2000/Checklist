<?php
class Login {
    
    private $db;
    public $SecurityLevel;
    public $ID;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
//    public function loginCheckPrev($_username, $_password) {
//        $stmt = $this->db->prepare("CALL spLogin(?,?)");
//        $stmt->execute(array($_username, $_password));
//        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        return $results;
//    }
    
    public function loginCheck($_username, $_password) {
        $stmt = $this->db->prepare("select * from tbUser where Email = ?");
        $stmt->execute(array($_username));
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($this->genHash($_password,$results['Salt']) === $results['Password']){
        return $results;
        }
        else {          
        return null;}
        

    }
    
    private function genHash($password,$salt){
        if (CRYPT_SHA512 !=1){
            die("Can't find hash function!");
        }
        else{
            $rounds = 6666;
            return crypt($password, '$6$rounds='.$rounds.'$'.$salt);
        }
    }
}
