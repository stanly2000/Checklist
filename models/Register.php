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
      $query = 'CALL spInsertUser(:p_FirstName, :p_LastName, :p_Email, :p_Password, :p_Salt)'; 
      
      $stmt = $this->db->prepare($query);

      $stmt->bindValue(':p_FirstName', $params['FirstName'], PDO::PARAM_STR);
      $stmt->bindValue(':p_LastName', $params['LastName'], PDO::PARAM_STR);
      $stmt->bindValue(':p_Email', $params['Email'], PDO::PARAM_STR);
     // $stmt->bindValue(':p_Password', $params['Password'], PDO::PARAM_STR);
      $salt = $this->genSalt();
      $hash = $this->genHash($params['Password'], $salt);
      $stmt->bindValue(':p_Password', $hash, PDO::PARAM_STR);
      $stmt->bindValue(':p_Salt', $salt, PDO::PARAM_STR);
      
      $stmt->execute();    
     echo "salt=".$salt."<br>";
     echo "hash=".$hash."<br>";
     die();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        catch (PDOException $e) 
        {
    print "Error!: " . $e->getMessage() . "<br/>";
   die();
        }

    
    }
    
    private function genSalt(){
        $length = 16;
     
        return substr(str_replace('+','.',  base64_encode(md5(mt_rand(), true))),0,16);
    }
    
    private function genHash($password,$salt){
        if (CRYPT_SHA512 !=1){
            die("Can't find hash function!");
        }
        else{
            $rounds = 6666;
            return crypt($password, '$6$rounds='.$rounds.'$'.$salt);
        }
    }
    
    
    
    
}

