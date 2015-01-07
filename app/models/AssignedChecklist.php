<?php
require_once 'IDbModels.php';
require_once APP . '/utilities/DebugLogger.php';

class AssignedChecklist implements IDbModels
{
    private $db;
     
    public $AssignID;

    public $ChecklistID;

    public $ChecklistName;
    
    public $GroupID;
    
    public $GroupName;
    
    public $AssignTime;

    public $Tasks = [];

    public $validationRules = [];
    
     function __construct($db)
    {
        $this->db = $db;
        $this->validationRules = [
            'title' => [
                'notEmpty',
                'lettersAndNumbers'
            ],
            'id' => [
                'notEmpty',
                'isInteger'
            ]
        ];
    }
    
     public function load($id)
    {
        $stmt = $this->db->prepare("CALL spGetAssignedChecklists");
        $stmt->execute(array(
            $id
        ));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        $this->AssignID = $res->AssignID;
        $this->GroupName = $res->GroupName;
        $this->ChecklistID = $res->ChecklistID;
        $this->ChecklistName = $res->ChecklistName;
        $this->AssignTime = $res->AssignTime;
        if ($this->AssignID == null)
        {
            return FALSE;
            
        }
        else
        {
            return true;
            
        }
    }
    
     public function get($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbAssignChecklist WHERE AssignID=?");
        $stmt->execute(array(
            $id
        ));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("CALL spGetAssignedChecklists");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
     public function getAllGroups()
    {
        $stmt = $this->db->prepare("SELECT * FROM tbGroup");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function remove($id) {
        
    }

    public function save() {
        try
           {
          $stmt = $this->db->prepare("CALL spAssignChecklist (:p_ChecklistID, :p_GroupID) ");
                $stmt->bindValue(':p_ChecklistID', $this->ChecklistID, PDO::PARAM_STR);
                 $stmt->bindValue(':p_GroupID', $this->GroupID, PDO::PARAM_STR);
                $stmt->execute();
               
            return true;
           
        } catch
        (PDOException $ex) {
            echo $ex->getMessage();die();
            return false;
        }
        
    }

}

