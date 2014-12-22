<?php
class LoginController extends Controller {
    
    public function index() {
        
        $this->render(__CLASS__,__FUNCTION__,
                'login/index',null,'loginPost' );
    }
    
        public function loginPost () {
            $model = $this->model('Login');
            $stmt = $model->loginCheck($_POST['Email'], $_POST['Password']);
            if ($stmt != null) {
                //TODO create session
                //CREATE INSTANCE LoggedUser Class
                // PUT this class to session 
                foreach($stmt as $rows)
                {
                    $_SESSION['UserID'] = $rows['UserID'];
                    $_SESSION['SecurityLevel'] = $rows['SecurityLevel'];
                    $_SESSION['Email'] = $rows['Email'];
                }
                $this->redirect('home');
            }
            else{
                $this->redirect('login/index');
            }
    }
    public function logout() {
        
        session_unset();
        $_SESSION['SecurityLevel'] = -1;
        $this->redirect('login/index');
        
    }
}
