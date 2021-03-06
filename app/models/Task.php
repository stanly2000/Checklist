<?php
require_once APP . '/utilities/DebugLogger.php';

class Task
{

    public $db;

    public $TaskID;

    public $TaskName;

    public $ChecklistID;

    public $TaskTime;

    public $PropertyName;

    public $PropertyAttribute;

    public $PropertyValue;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbTask WHERE TaskID=?");
        $stmt->execute(array(
            $id
        ));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("CALL spGetTasks");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($params = [])
    {
        try {
            $stmt = $this->db->prepare("CALL spUpdateTask (?,? ) ");
            $stmt->execute(array(
                $params['id'],
                $params['title']
            ));
        } catch (PDOException $ex) {
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

    public function remove($id)
    {
        try {
            $stmt = $this->db->prepare("CALL spDeleteTask (:p_TaskID)");
            $stmt->bindValue(':p_TaskID', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            DebugLogger::log($ex->getMessage());
            return false;
        }
    }

    public function load($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbTask WHERE TaskID=?");
        $stmt->execute(array(
            $id
        ));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        $this->TaskID = $res->TaskID;
        $this->ChecklistID = $res->ChecklistID;
        $this->TaskName = $res->TaskName;
        if ($this->TaskID == null)
            return FALSE;
        else
            return TRUE;
    }

    public function save()
    {
        try {
            
            if ($this->TaskID && $this->TaskID > 0) {
                $stmt = $this->db->prepare("CALL spUpdateTask (:p_TaskID,:p_TaskName,:p_ChecklistID,:p_TaskTime ) ");
                $stmt->bindValue(':p_TaskID', $this->TaskID, PDO::PARAM_INT);
                $stmt->bindValue(':p_TaskName', $this->TaskName, PDO::PARAM_STR);
                $stmt->bindValue(':p_ChecklistID', $this->ChecklistID, PDO::PARAM_INT);
                $stmt->bindValue(':p_TaskTime', $this->TaskTime, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                $stmt = $this->db->prepare("CALL spInsertTask (:p_TaskName, :p_ChecklistID, :p_TaskTime ) ");
                $stmt->bindValue(':p_TaskName', $this->TaskName, PDO::PARAM_STR);
                $stmt->bindValue(':p_ChecklistID', $this->ChecklistID, PDO::PARAM_INT);
                $stmt->bindValue(':p_TaskTime', $this->TaskName, PDO::PARAM_STR);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->TaskID = $res['lastInsertID'];
            }
            return true;
        } catch (PDOException $ex) {
            DebugLogger::log($ex->getMessage());
            return false;
        }
    }

    private function getLastInserted()
    {
        $stmt = $this->db->prepare("SELECT MAX(TaskID) FROM tbTask ");
    }

    public function addParams($param, $value)
    {
        // so far task can have only one param
        // if (is_numeric($value));
        // DebugLogger::log($param.' - '. $value . ' - '.$this->TaskID);
        // check if params exist
        $check = $this->db->prepare("SELECT * FROM tbTaskProperties WHERE TaskID = ?");
        $check->execute(array(
            $this->TaskID
        ));
        $row_count = $check->rowCount();
        if ($row_count > 0) {
            $delParam = $this->db->prepare("DELETE FROM tbTaskProperties WHERE TaskID = ?");
            $delParam->execute(array(
                $this->TaskID
            ));
        }
        
        $propAttribute = '';
        $propValue = 0;
        if (is_numeric($value)) {
            $propValue = $value;
        } else {
            $propAttribute = $value;
        }
        
        try {
            $stmt = $this->db->prepare("CALL spInsertTaskProperties (:p_TaskID, :p_PropertyName, :p_PropertyAttribute, :p_PropertyValue ) ");
            $stmt->bindValue(':p_PropertyValue', $propValue, PDO::PARAM_INT);
            $stmt->bindValue(':p_PropertyAttribute', $propAttribute, PDO::PARAM_STR);
            $stmt->bindValue(':p_TaskID', $this->TaskID, PDO::PARAM_INT);
            $stmt->bindValue(':p_PropertyName', $param, PDO::PARAM_STR);
            
            $stmt->execute();
            
            return true;
        } catch (PDOException $ex) {
            DebugLogger::log($ex->getMessage());
            // /echo $ex;
            // die();
            return false;
        }
    }
}
