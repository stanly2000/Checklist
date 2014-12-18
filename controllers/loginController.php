<?php
class LoginController extends Controller {
    
    public function index() {
        
        $this->render(__CLASS__,__FUNCTION__,
                'login/index',null,'loginPost' );
    }
    
        public function loginPost () {
            $model = $this->model('Login');
            $db = $model->get($_POST['Email'], $_POST['Password']);
            if ($db == null) {
                        echo 'no User';
            }
            else{
                foreach($db as $rows)
                {
                    echo 'User Logged in';
                    echo '<br/>';
                    echo $rows['UserID'];
                }
            }
    }
}
