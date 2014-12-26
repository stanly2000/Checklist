<?php

class LoginController extends Controller
{

    public function index()
    {
        $_SESSION['SecurityLevel'] = - 1;
        $this->render(__CLASS__, __FUNCTION__, 'login/index', null, 'loginPost');
    }

    public function loginPost()
    {
        $model = $this->model('Login');
        $stmt = $model->loginCheck($_POST['Email'], $_POST['Password']);
        if ($stmt != null) {
            // TODO create session
            // CREATE INSTANCE LoggedUser Class
            // PUT this class to session
            $_SESSION['UserID'] = $stmt['UserID'];
            $_SESSION['FirstName'] = $stmt['FirstName'];
            $_SESSION['SecurityLevel'] = $stmt['SecurityLevel'];
            $this->redirect('home');
        } else {
            $this->redirect('login/index');
        }
    }

    public function logout()
    {
        $_SESSION['SecurityLevel'] = - 1;
        $this->redirect('login/index');
    }
}
