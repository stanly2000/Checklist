<?php

class Checklist {
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
//    public function update($params = [])
//    {
//        try{
//    $stmt = $this->db->prepare("CALL spUpdateChecklist (?,? ) ");
//    $stmt->execute(array( $params['id'],$params['title']));
//        }
//        catch(PDOException $ex) {
//    echo "An Error occured!"; 
//    echo $ex->getMessage();
//    die();
//    }
//
//    }
//    public function add($params = [])
//    {
//    $stmt = $this->db->prepare("CALL spInsertChecklist (:p_ChecklistName) ");
//    $stmt->bindValue(':p_ChecklistName', $params['title'], PDO::PARAM_STR);
//    $stmt->execute();
//    }
    public function remove($params = [])
    {
    $stmt = $this->db->prepare("CALL spDeleteChecklist (:p_ChecklistID)");
    $stmt->bindValue(':p_ChecklistID', $params['id'], PDO::PARAM_INT);
    $stmt->execute();
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
