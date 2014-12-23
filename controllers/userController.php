<?php

class userController extends Controller
{
    public function index()
    {
        if($_SESSION['SecurityLevel'] <= 1){
            $this->redirect('login');
        }
        else{
        $model=$this->model('User');
        $user = $model->getAll();
        $this->render( __CLASS__,__FUNCTION__,'user/index',['user'=>$user ]);
        }
    }   

}

