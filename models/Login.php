<?php

class Login {
    
    public $Email;
    public $Password;
    
    public function __construct($_email, $_password) {
        $this->Email = $_email;
        $this->Password = $_password;
    }
    public function comfirm () {
        $stmt = $db->query('CAll spLogin(?,?)');
        $row_count = $stmt->rowCount();
        if ($row_count == 0) {
            header("Location: http://localhost/checklist/public/index.php");
        }
    }
}
