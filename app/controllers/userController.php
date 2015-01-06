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
            $model->getUser();
            
            $this->render(__CLASS__, __FUNCTION__, 'user/view', [
                'user' => $model
            ], 'updatePost');
        } else
            $this->redirect(__CLASS__);
    }
    public function remove()
    {
        $id = htmlspecialchars(trim($_POST['id']));
        DebugLogger::log($id);
        if (isset($id)) {
            $model = $this->model('User');
            if ($model->remove($id))
                $_SESSION['afterActionMessage'] = "Action Successfully Completed";
            else
                $_SESSION['afterActionMessage'] = "Action failed, DB Problem..";
        }
        $this->redirect(__CLASS__);
    }
}
