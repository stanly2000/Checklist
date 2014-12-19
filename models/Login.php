<?php
session_start();
class Login {
    
    private $db;
    public $Email;
    public $Password;
    public $UserName;
    public $ID;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function loginCheck($_username, $_password) {
        $stmt = $this->db->prepare("CALL spLogin(?,?)");
        $stmt->execute(array($_username, $_password));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results == null) {
            return null;
        }
        else{
            foreach($results as $rows){
                $rows['UserID'] = $_SESSION['UserID'];
            }
            return $results;
        }
    }
}
