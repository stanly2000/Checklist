<?php

class userController extends Controller
{

    public function index()
    {
        if ($_SESSION['SecurityLevel'] <= 1) {
            $this->redirect('login');
        } else {
            $model = $this->model('User');
            $user = $model->getAll();
            $this->render(__CLASS__, __FUNCTION__, 'user/index', [
                'user' => $user
            ]);
        }
    }

    public function update($id = null)
    {
        $model = $this->model('User');
        if ($model->load($id)) {
            
            $this->render(__CLASS__, __FUNCTION__, 'user/update', [
                'user' => $model
            ], 'updatePost');
        } else
            $this->redirect(__CLASS__);
    }

    public function updatePost()
    {
        $model = $this->model('user');
    }

    public function view($id)
    {
        $model = $this->model('User');
        if ($model->load($id)) {
            if (! $model->getUser()) {
                echo "h";
                die();
            }
            $this->render(__CLASS__, __FUNCTION__, 'user/view', [
                'user' => $model
            ], 'updatePost');
        } else
            $this->redirect(__CLASS__);
    }
}
