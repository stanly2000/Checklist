<?php

require_once APP.'models/HomeTest.php';
class HomeController extends Controller
{

    public function index()
    {
      //  echo "HOME controller index METHOD";
        $header = APP . 'views/_shared/header.php';
        $this->render(__CLASS__,__FUNCTION__,'home/index');
    }
    public function test()
    {

         $model = $this->model('User');
         $users = $model->getAll();
         $this->render( __CLASS__,__FUNCTION__,'home/test',['users'=>$users ]);
        
    }    
    public function user($id = null)
    {
        $model = $this->model('User');
        $existUser = null;
        if ($id)
        {
            $existUser = $model->get($id);
        }
        
        $this->render( __CLASS__,__FUNCTION__,'home/user',['user'=>$existUser ]);
        
    }

}
