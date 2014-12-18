<?php

require_once ROOT.'models/HomeTest.php';
class HomeController extends Controller
{

    public function index()
    {
      //  echo "HOME controller index METHOD";
        $header = APP . 'views/_shared/header.php';
        $this->render(str_replace('Controller', '', __CLASS__),__FUNCTION__,'home/index');
    }


    public function test()
    {
//        require APP . 'views/_shared/header.php';
//        $model = new HomeTest();
//        $data = $model->getAllUsers($this->db);
//        require APP . 'views/home/test.php';
//        require APP . 'views/_shared/footer.php';
         $model = $this->model('User');
         $users = $model->getAll();
         $this->render(str_replace('Controller', '', __CLASS__),__FUNCTION__,'home/test',['users'=>$users ]);
        
    }
    
    public function user($id = null)
    {
        $model = $this->model('User');
        $existUser = null;
        if ($id)
        {
            $existUser = $model->get($id);
        }
        
        $this->render(str_replace('Controller', '', __CLASS__),__FUNCTION__,'home/user',['user'=>$existUser ]);
        
    }

}
