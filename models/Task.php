<?php

class Task { 
     public $db;
     public $TaskID;
     public $TaskName;
     public $ChecklistID;
     public $TaskTime;
     
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
        $stmt = $this->db->prepare("CALL spGetTask");
        $stmt->execute();
        return   $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function update($params = [])
    {
        try{
               $stmt = $this->db->prepare("CALL spUpdateTask (?,? ) ");
               $stmt->execute(array( $params['id'],$params['title']));
        }
        catch(PDOException $ex) {
                echo "An Error occured!"; 
                echo $ex->getMessage();
    }

    }
    public function add($params = [])
    {
         $stmt = $this->db->prepare("CALL spInsertTask (:p_TaskName) ");
         $stmt->bindValue(':p_TaskName', $params['title'], PDO::PARAM_STR);
         $stmt->execute();
    }
    public function remove($params = [])
    {
         $stmt = $this->db->prepare("CALL spDeleteTask (:p_TaskID)");
         $stmt->bindValue(':p_TaskID', $params['id'], PDO::PARAM_INT);
         $stmt->execute();
    }
}
