<?php
class RegisterController extends Controller
{
 
  public function __construct(){
        parent::__construct();
    }

    public function Register()
    {
        
        $model = $this->model('Register');
        $Register = $model->RegisterUser();
       //  $this->render('Home/index',['Register'=>$Register ]);
         
         if ($this->input->post()) {
            $FirstName = $this->input->post('FirstName');
            $LastName = $this->input->post('LastName');
            $Email = $this->input->post('Email');
            $Password = $this->input->post('Password');
         }
    }
   
}
