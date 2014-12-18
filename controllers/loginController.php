<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author dev
 */
class LoginController {
    public function index() {
        
        $this->render(str_replace('Controller', '', __CLASS__),__FUNCTION__,
                'login/index', null, 'loginPost');
    }
    
        public function loginPost () {
            $model = $this->models('Login');
$stmt->execute(array($_POST[''], $name));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
