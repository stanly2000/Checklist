<?php

class userController extends Controller
{
    
    public function index()
    {
        $model=$this->model('User');
        $user = $model->getAll();
        $this->render( __CLASS__,__FUNCTION__,'user/index',['user'=>$user ]);
    }
    

}

