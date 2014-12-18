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
    
    public function RegisterUser($FirstName, $LastName, $Email, $Password)
    {
        try 
        {
      $query = 'CALL spInsertUser(:FirstName, :LastName, '
              . ':Email, :Password)'; 
      
      $stmt = $this->dbh->prepare($query);

      $stmt->execute(array(':FirstName' => $FirstName, 
          ':LastName' => $LastName, ':Email' => $Email, ':Password' => $Password));
        }
        
        catch (PDOException $e) 
        {
    print "Error!: " . $e->getMessage() . "<br/>";
   die();
        }

    
    }
    
    
    
    
}

