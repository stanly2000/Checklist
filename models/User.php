<?php

class User {
    public $db;
    public $UserID;
    public $FirstName;
    public $LastName;
    public $Email;
    public $Password;
    public $SecurityLevel;
    
    function __construct($db) {
        $this->db = $db;
    }
    
    public function get( $id)
    {       
        $stmt = $this->db->prepare("SELECT * FROM tbUser WHERE UserID=?");
        $stmt->execute(array($id));
        return   $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getAll( )
    {       
        $stmt = $this->db->prepare("SELECT * FROM tbUser");
        $stmt->execute();
        return   $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
