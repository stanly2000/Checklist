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
        $stmt = $this->db->prepare('CALL spGetUserGroupByID (?)');
        $stmt->execute(array($id));
        $rows = $stmt->fetchall(PDO::FETCH_OBJ);
        return $rows;
    }

    public function UpdateGroup($ID, $groupname)
    {
        $stmt = $this->db->prepare('CALL spUpdateGroup (?,?)');
        $stmt->execute(array(
            $ID, $groupname
        ));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    public function CreateGroup($groupname) {
        
        $stmt = $this->db->prepare('CALL spInsertGroup(?)');
        $stmt->execute(array($groupname));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
        
    }
    public function DeleteGroup($id) {
        
        $stmt = $this->db->prepare('CALL spDeleteGroup (?)');
        $stmt->execute(array($id));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    public function AddUserToGroup($groupid, $userid) {
        
        $stmt = $this->db->prepare('update Checklist.tbUserGroup set GroupID = ? where UserID = ?;');
        $stmt->execute(array($groupid, $userid));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
}
