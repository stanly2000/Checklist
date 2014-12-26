<?php
require_once APP . '/utilities/Hash.php';

class Register
{

    private $db;

    public $FirstName;

    public $LastName;

    public $Email;

    public $Password;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function CheckIfEmailExists($Email)
    {
        // Checking if email already exists first before registering
        $stmt = $this->db->prepare("SELECT * FROM tbUser WHERE Email=:p_Email");
        $stmt->bindValue(':p_Email', $Email, PDO::PARAM_STR);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        // $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($res);
        // echo $row_count.' rows selected';die();
        if ($row_count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function RegisterUser($params = [])
    {
        print_r($params);
        try {
            $query = 'CALL spInsertUser(:p_FirstName, :p_LastName, :p_Email, :p_Password, :p_Salt)';
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindValue(':p_FirstName', $params['FirstName'], PDO::PARAM_STR);
            $stmt->bindValue(':p_LastName', $params['LastName'], PDO::PARAM_STR);
            $stmt->bindValue(':p_Email', $params['Email'], PDO::PARAM_STR);
            // $stmt->bindValue(':p_Password', $params['Password'], PDO::PARAM_STR);
            $salt = Hash::genSalt();
            $hash = Hash::genHash($params['Password'], $salt);
            $stmt->bindValue(':p_Password', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':p_Salt', $salt, PDO::PARAM_STR);
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 

        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}

