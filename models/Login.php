<?php
class Login {
    
    private $db;
    public $SecurityLevel;
    public $ID;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function loginCheck($_username, $_password) {
        $stmt = $this->db->prepare("CALL spLogin(?,?)");
        $stmt->execute(array($_username, $_password));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
