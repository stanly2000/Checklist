<?php

class HomeTest{
    
    
    
    public function getAllUsers($db)
    {

$stmt = $db->query('SELECT * FROM tbUser');
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}

