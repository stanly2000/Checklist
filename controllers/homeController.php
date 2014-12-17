<?php

require_once ROOT.'models/HomeTest.php';
class Home extends Controller
{

    public function index()
    {
      //  echo "HOME controller index METHOD";
        $header = APP . 'views/_shared/header.php';
        $this->render('home/index');
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
         $this->render('home/test',['users'=>$users ]);
        
    }
    
    public function user($id = null)
    {
        $model = $this->model('User');
        $existUser = null;
        if ($id)
        {
            $existUser = $model->get($id);
        }
        
        $this->render('home/user',['user'=>$existUser ]);
        
    }

}
