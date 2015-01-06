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
        $this->UserID = $_SESSION['UserID'];
    }
    
    public function loadActiveLists()
    {
        try{
            $stmt = $this->db->prepare("SELECT AssignID, c.* 
            FROM tbAssignChecklist as a, tbChecklist as c
            WHERE c.ChecklistID = a.ChecklistID AND a.GroupID in ( SELECT GroupID FROM tbUserGroup WHERE UserID=?)");
            $stmt->execute(array(
                $this->UserID
            ));
         
//             $stmt = $this->db->prepare("SELECT * FROM tbChecklist 
//              WHERE ChecklistID < 4");
//             $stmt->execute();
             return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOExeption $e){
            DebugLogger::log($ex->getMessage());
            return false;
        }
    }
    
    public function getTasks($assignID){
        try{
            
            $stmt = $this->db->prepare("SELECT ChecklistID FROM tbAssignChecklist WHERE AssignID=:p_AssignID");
            $stmt->bindValue(':p_AssignID', $assignID, PDO::PARAM_INT);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $ChecklistID = $row['ChecklistID'];
            
            $stmt2 = $this->db->prepare("SELECT tbTask.*, StatusID FROM tbTask left join 
                tbTasksCompleted on tbTask.TaskID=tbTasksCompleted.TaskID where ChecklistID=:p_ChecklistID");
            $stmt2->bindValue(':p_ChecklistID', $ChecklistID, PDO::PARAM_INT);
            $stmt2->execute();
            
            return $stmt2->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOExeption $e){
            DebugLogger::log($ex->getMessage());
            return false;
        }
    }
    
    public function updateTask($taskID,$assignID)
    {
        DebugLogger::log("taskID=$taskID assignID=$assignID");
        //TODO put all in procedure
        try{
            $stmt = $this->db->prepare("SELECT * FROM tbTasksCompleted  
            WHERE TaskID=:p_TaskID AND AssignID=:p_AssignID ");
            $stmt->bindValue(':p_TaskID', $taskID, PDO::PARAM_INT);
            $stmt->bindValue(':p_AssignID', $assignID, PDO::PARAM_INT);
            $stmt->execute();
        
            if ($stmt->rowCount() == 1)
            {
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               $TasksCompletedID = $row['TasksCompletedID'];
               $stmt2 = $this->db->prepare("DELETE FROM tbTasksCompleted
                   WHERE TasksCompletedID=?");
               $stmt2->execute(array(
                   $TasksCompletedID
               ));
            }
            else {
                $stmt3 = $this->db->prepare("INSERT INTO tbTasksCompleted
                    (AssignID, TaskID, StatusID, UserID) 
                     VALUES( :p_AssignID, :p_TaskID, 3, :p_UserID)");
         
            $stmt3->bindValue(':p_TaskID', $taskID, PDO::PARAM_INT);
            $stmt3->bindValue(':p_AssignID', $assignID, PDO::PARAM_INT);
            $stmt3->bindValue(':p_UserID', $this->UserID, PDO::PARAM_INT);
            $stmt3->execute();
            }
            
        }
        catch (PDOExeption $e){
            DebugLogger::log($ex->getMessage());
            return false;
        }
    }
}
