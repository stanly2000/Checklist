<?php

class Task { 
     public $db;
     public $TaskID;
     public $Name;
     public $ChecklistID;
     public $Time;
     
      function __construct($db) {
        $this->db = $db;
    }
        public function get( $id)
    {       
        $stmt = $this->db->prepare("SELECT * FROM tbTask WHERE TaskID=?");
        $stmt->execute(array($id));
        return   $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getAll( )
    {       
        $stmt = $this->db->prepare("SELECT * FROM tbTask");
        $stmt->execute();
        return   $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
