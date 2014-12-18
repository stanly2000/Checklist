<?php

class Login {
    
    private $db;
    public $Email;
    public $Password;
    public $UserName;
    public $ID;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function get($_username, $_password) {
$stmt = $this->db->prepare("CALL spLogin(?,?)");
$stmt->execute(array($_username, $_password));
return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
