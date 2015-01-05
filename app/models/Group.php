<?php

class Group
{

    private $db;

    public $GroupID;

    public $GroupName;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function GetGroups()
    {
        $stmt = $this->db->prepare("SELECT * FROM Checklist.tbGroup;");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function GetView($id)
    {
        $stmt = $this->db->prepare('select * from tbGroup where GroupID = ?');
        $stmt->execute(array(
            $id
        ));
        $rows = $stmt->fetchall(PDO::FETCH_OBJ);
        return $rows;
    }

    public function UpdateGroup($ID, $groupname)
    {
        $stmt = $this->db->prepare('CALL spUpdateGroup (?,?)');
        $stmt->execute(array(
            $ID, $groupname
        ));
        $rows = $stmt->fetchall(PDO::FETCH_OBJ);
        return $rows;
    }
    public function CreateGroup($groupname) {
        
        $stmt = $this->db->prepare('CALL spInsertGroup(?)');
        $stmt->execute(array($groupname));
        $rows = $stmt->fetchall(PDO::FETCH_OBJ);
        return $rows;
        
    }
}
