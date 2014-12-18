<?php
class RegisterController extends Controller
{
 
  public function __construct(){
        parent::__construct();
    }
   

    public function Register()
    {         
        $Register = $model->RegisterUser();
            
         if ($this->input->post()) {
                    
            $model = $this->model('Register');
            $params['FirstName'] = $_POST['FirstName'];
            $params['LastName'] = $_POST['LastName'];
            $params['Email'] = $_POST['Email'];
            $params['Password'] = $_POST['Password'];
            $model->RegisterUser($params);
        $this->redirect(__CLASS__);
         }
    }
   
}


