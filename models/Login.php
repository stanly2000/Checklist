<?php

class Login {
    
    public $Email;
    public $Password;
    public $UserName;
    public $ID;
    
    public function __construct($_email, $_password) {
        $this->Email = $_email;
        $this->Password = $_password;
    }
    public function get($_username, $_password) {
                $stmt = $this->db->prepare("CALL spLogin(?,?)");
        $stmt->execute(array($_username, $_password));
        return   $stmt->fetch(PDO::FETCH_OBJ);
    }
}
