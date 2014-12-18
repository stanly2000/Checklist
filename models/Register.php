<?php

class Register { 
     private $db;
     public $FirstName;
     public $LastName;
     public $Email;
     public $Password;
     
      function __construct($db) {
        $this->db = $db;
    }
    
    public function RegisterUser($params =[])
    {
        print_r($params);
        try 
        {
      $query = 'CALL spInsertUser(:p_FirstName, :p_LastName, :p_Email, :p_Password)'; 
      
      $stmt = $this->db->prepare($query);

      $stmt->bindValue(':p_FirstName', $params['FirstName'], PDO::PARAM_STR);
      $stmt->bindValue(':p_LastName', $params['LastName'], PDO::PARAM_STR);
      $stmt->bindValue(':p_Email', $params['Email'], PDO::PARAM_STR);
      $stmt->bindValue(':p_Password', $params['Password'], PDO::PARAM_STR);
      
      $stmt->execute();      
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        catch (PDOException $e) 
        {
    print "Error!: " . $e->getMessage() . "<br/>";
   die();
        }

    
    }
    
    
    
    
}

