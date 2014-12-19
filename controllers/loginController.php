<?php
session_start();
class LoginController extends Controller {
    
    public function index() {
        
        $this->render(__CLASS__,__FUNCTION__,
                'login/index',null,'loginPost' );
    }
    
        public function loginPost () {
            $model = $this->model('Login');
            $stmt = $model->loginCheck($_POST['Email'], $_POST['Password']);
            if ($stmt == null) {
                
                //TODO create session
                //CRESTE INSTANCE LoggedUser Class
                // PUT this class to session 
                
                
                $this->redirect('login/index');
            }
            else{
                foreach($stmt as $rows)
                {
                    $this->redirect('home');
                }
            }
    }
}
