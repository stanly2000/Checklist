<?php
require_once ROOT.'/utilities/Validation.php';

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
       // print_r($_POST);
        
        $validator = new Validation();
        
        $fields[] = ['FirstName'=>$_POST['FirstName'], 'LastName'=>$_POST['LastName'],
                   'Email'=>$_POST['Email'], 'Password'=>$_POST['Password']];
        $rules[] = ['FirstName'=>['notEmpty'], 'LastName'=>['notEmpty'],
                  'Email'=>['notEmpty'], 'Password'=>['notEmpty'] ];
        if($validator->validate($fields, $rules))
        {
           $model = $this->model('Register');
            $params['FirstName'] = $_POST['FirstName'];
             $params['LastName'] = $_POST['LastName'];
              $params['Email'] = $_POST['Email'];
               $params['Password'] = $_POST['Password'];
            $model->RegisterUser($params);
               $this->redirect(__CLASS__);
        }
               
          //  $this->redirect(login/index);
        
        
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
   



