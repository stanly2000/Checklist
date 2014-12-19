<?php
require_once ROOT.'/utilities/Validation.php';
require_once ROOT.'/utilities/DebugLogger.php';

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
DebugLogger::log('postRegister');
        $validator = new Validation();

        $fields = ['FirstName'=>$_POST['FirstName'], 'LastName'=>$_POST['LastName'],
            'Email'=>$_POST['Email'], 'Password'=>$_POST['Password']];

         $validationRules = ['FirstName'=>['notEmpty','lettersAndNumbers'],'LastName'=>['notEmpty','lettersAndNumbers'],
             'Email'=>['notEmpty','email'], 'Password'=>['notEmpty'] ];
         
        if($validator->validate($fields, $validationRules))
        {
            DebugLogger::log('valid = true');
           $model = $this->model('Register');
            $params['FirstName'] = $_POST['FirstName'];
             $params['LastName'] = $_POST['LastName'];
              $params['Email'] = $_POST['Email'];
               $params['Password'] = $_POST['Password'];
            $model->RegisterUser($params);
            
                $_SESSION['afterActionMessage'] = "New User Registered Successfully!";
        $this->redirect(__CLASS__,'Register');
        }
 else {
      $_SESSION['validationErrors'] = $validator->getErrors();
      $this->redirect(__CLASS__,'Register');
 }

         }
    }
   



