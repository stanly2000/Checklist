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
        $stmt = $this->db->prepare("CALL spGetUsers");
        $stmt->execute();
        return   $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function update($params = [] )
    {
        try{
            $stmt = $this->db->prepare("CALL spUpdateUser (?,? ) ");
            $stmt->execute(array( $params['id'], $params['email']));
            
        } catch (Exception $ex) {
            echo "An error occured!";
            echo $ex->getMessage();           
        }        
    }
}
