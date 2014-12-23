<?php
class Group {
   
    private $db;
    public $GroupID;
    public $GroupName;
    
    function __construct($db) {
        $this->db = $db;
    }
    public function GetGroups() {
        
        $stmt = $this->db->prepare("CALL spGetUserGroup()");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
        
    }
    
}
