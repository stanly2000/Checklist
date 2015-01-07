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
        ],'AddUserToGroup');
    }
    public function AddUserToGroup() {
        
        $model = $this->model("Group");
        $AddUser = $model->AddUserToGroup($_REQUEST['GroupID'], $_REQUEST['UserID']);
        if ($AddUser >=1) {
            $this->redirect(__CLASS__,'view',['GroupID'=>$_REQUEST['GroupID']]);
        }
        else{
            $message = "User Already exists";
            echo "<script type='text/javascript'>alert('$message');</script>";
            $this->redirect(__CLASS__,'view',['GroupID'=>$_REQUEST['GroupID']]);
        }
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
                if ($groupupdate >=1) {
          $this->redirect('group/index');
        }
        else{
            echo 'Something Went Wrong Please Contact IT';
        }
    }
    public function create() {
        
        $this->render(__CLASS__, __FUNCTION__, 'group/create', null, 'CreateGroup');
        
    }
    public function CreateGroup() {
        
        $model=  $this->model('Group');
        $groupcreate = $model->CreateGroup($_POST['groupname']);
                if ($groupcreate >=1) {
          $this->redirect('group/index');
        }
        else{
            echo 'Something Went Wrong Please Contact IT';
            die();
        }
        
    }
    public function delete($id) {
        $model = $this->model('Group');
        $delete = $model->GetView($id);
        $this->render(__CLASS__, __FUNCTION__, 'group/delete', [
            'delete' => $delete
        ], 'DeleteGroup');
    }
    public function DeleteGroup() {
        
        $model = $this->model('Group');
        $groupdelete = $model->DeleteGroup($_POST['GroupID']);
        if ($groupdelete >=1) {
          $this->redirect('group/index');
        }
        else{
            echo 'Something Went Wrong Please Contact IT';
            die();
        }
    }
}
