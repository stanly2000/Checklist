<?php

class Checklist {
    private $db;
    public $ChecklistID;
    public $ChecklistName;
    
    function __construct($db) {
        $this->db = $db;
    }
    
    public function get( $id)
    {       
        $stmt = $this->db->prepare("SELECT * FROM tbChecklist WHERE ChecklistID=?");
        $stmt->execute(array($id));
        return   $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getAll( )
    {       
        $stmt = $this->db->prepare("SELECT * FROM tbChecklist");
        $stmt->execute();
        return   $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
