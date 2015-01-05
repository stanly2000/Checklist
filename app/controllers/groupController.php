<?php

class groupController extends Controller
{

    public function index()
    {
        if (! empty($_SESSION)) {
            
            $model = $this->model('Group');
            $groups = $model->GetGroups();
            $this->render(__CLASS__, __FUNCTION__, 'group/index', [
                'groups' => $groups
            ]);
        } else {
            $this->redirect('home');
        }
    }

    public function view($id)
    {
        $model = $this->model('Group');
        $view = $model->GetView($id);
        $this->render(__CLASS__, __FUNCTION__, 'group/view', [
            'view' => $view
        ]);
    }

    public function update($id)
    {
        $model = $this->model('Group');
        $update = $model->GetView($id);
        $this->render(__CLASS__, __FUNCTION__, 'group/update', [
            'update' => $update
        ], 'UpdateGroup');
    }

    public function UpdateGroup()
    {
        $model = $this->model('Group');
        $groupupdate = $model->UpdateGroup($_POST['GroupID'],$_POST['UGName']);
        $this->redirect('group/index');
    }
}
