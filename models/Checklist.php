<?php
require_once 'IDbModels.php';
require_once '../utilities/DebugLogger.php';
class Checklist implements IDbModels{
    private $db;
    public $ChecklistID;
    public $ChecklistName;
    public $Tasks = [];
    public $validationRules = []; 
    
    function __construct($db) {
        $this->db = $db;
        $this->validationRules = ['title'=>['notEmpty','lettersAndNumbers'],
            'id'=>['notEmpty','isInteger']];
    }
    
    public function load($id){
        $stmt = $this->db->prepare("SELECT * FROM tbChecklist WHERE ChecklistID=?");
        $stmt->execute(array($id));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        $this->ChecklistID = $res->ChecklistID;
        $this->ChecklistName = $res->ChecklistName;
        if ($this->ChecklistID == null)
            return FALSE;
        else 
            return true;
    }
    
    public function getTasks(){
        try{
        $stmt = $this->db->prepare("SELECT * FROM tbTask WHERE ChecklistID=?");
        $stmt->execute(array($this->ChecklistID));
        $this->Tasks = $stmt->fetchAll(PDO::FETCH_OBJ);
        return true;
        }
        catch (PDOException $ex){ 
            return false;
        }
    }
    
    public function get( $id)
    {       
        $stmt = $this->db->prepare("SELECT * FROM tbChecklist WHERE ChecklistID=?");
        $stmt->execute(array($id));
        return   $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getAll( )
    {       
        $stmt = $this->db->prepare("CALL spGetChecklists");
        $stmt->execute();
        return   $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function remove($id)//$params = [])
    {
        try{
    $stmt = $this->db->prepare("CALL spDeleteChecklist (:p_ChecklistID)");
    $stmt->bindValue(':p_ChecklistID', $id, PDO::PARAM_INT);
    $stmt->execute();
    return true;
        }
        catch (PDOException $ex){ 
            return false;
        }
    }
    //TODO save model to db
    public function save(){
        
        try{
            if ($this->ChecklistID){
        $stmt = $this->db->prepare("CALL spUpdateChecklist (?,? ) ");
        $stmt->execute(array( $this->ChecklistID,$this->ChecklistName));
            }
            else {
                 $stmt = $this->db->prepare("CALL spInsertChecklist (:p_ChecklistName) ");
            $stmt->bindValue(':p_ChecklistName', $this->ChecklistName, PDO::PARAM_STR);
            $stmt->execute();
            }
        return true;
        }
        catch (PDOException $ex){ 
            return false;
        }
    }
}
