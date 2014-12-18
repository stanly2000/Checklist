<?php
class RegisterController extends Controller
{
 
  public function __construct(){
        parent::__construct();
    }
   

     public function Register()
    {
        $this->render(__CLASS__,__FUNCTION__,'register/register',null,'RegisterPost' );
    }
    
    public function RegisterPost()
    {         
        print_r($_POST);
           $model = $this->model('Register');
            $params['FirstName'] = $_POST['FirstName'];
             $params['LastName'] = $_POST['LastName'];
              $params['Email'] = $_POST['Email'];
               $params['Password'] = $_POST['Password'];
            $model->RegisterUser($params);
        $this->redirect(__CLASS__);
        echo('New User Registration Successful');
        
      //  $Register = $model->RegisterUser();
            
        // if ($this->input->post()) {
                    
          //  $model = $this->model('Register');
          //  $params['FirstName'] = $_POST['FirstName'];
          //  $params['LastName'] = $_POST['LastName'];
          //  $params['Email'] = $_POST['Email'];
          //  $params['Password'] = $_POST['Password'];
         //   $model->RegisterUser($params);
      //  $this->redirect(__CLASS__);
         }
    }
   



