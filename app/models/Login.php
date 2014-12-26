<?php
require_once APP . '/utilities/Hash.php';

class Login
{

    private $db;

    public $SecurityLevel;

    public $ID;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function loginCheck($_username, $_password)
    {
        $stmt = $this->db->prepare("select * from tbUser where Email = ?");
        $stmt->execute(array(
            $_username
        ));
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if (Hash::genHash($_password, $results['Salt']) === $results['Password']) {
            return $results;
        } else {
            return null;
        }
    }
}
