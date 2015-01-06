<?php

require_once APP . '/utilities/DebugLogger.php';

class Check 
{

    private $db;

    public $UserID;

    public $ActiveChecklist = [];


    function __construct($db)
    {
        $this->db = $db;
    }
    
    public function loadActiveLists()
    {
        try{
         //   $stmt = $this->db->prepare("SELECT c.* FROM tbChecklist as c, tbAssignChecklist as a, tbUserGroup as u
         //    WHERE c.ChecklistID = a.ChecklistID AND  a.GroupID = u.UserGroupID AND u.UserID =?");
         //   $stmt->execute(array(
         //       $this->UserID
         //   ));
         
            $stmt = $this->db->prepare("SELECT * FROM tbChecklist 
             WHERE ChecklistID < 4");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOExeption $e){
            DebugLogger::log($ex->getMessage());
            return false;
        }
    }
}
