<?php
require_once APP . '/utilities/Validation.php';
require_once APP . '/utilities/DebugLogger.php';

class ChecklistController extends Controller
{

    public function index()
    {
        $model = $this->model('Checklist');
        $checklists = $model->getAll();
        $this->render(__CLASS__, __FUNCTION__, 'checklist/index', [
            'checklists' => $checklists
        ]);
    }

    public function view($id)
    {
        $model = $this->model('Checklist');
        if ($model->load($id)) {
            $model->getTasks();
            
            $this->render(__CLASS__, __FUNCTION__, 'checklist/view', [
                'checklist' => $model
            ], 'updatePost');
        } else
            $this->redirect(__CLASS__);
        
        // $model = $this->model('Checklist');
        // $existChecklist = null;
        // if ($id)
        // {
        // $existChecklist = $model->get($id);
        // }
        //
        // $this->render( __CLASS__,__FUNCTION__,'checklist/view',['checklist'=>$existChecklist ]);
    }

    public function add()
    {
        $this->render(__CLASS__, __FUNCTION__, 'checklist/add', null, 'addPost');
    }

    public function addPost()
    {
        $model = $this->model('Checklist');
        // adding this for using general model validation rules
        $dummyInt = 1;
        $validator = new Validation();
        $title = htmlspecialchars(trim($_POST['title']));
        $fields = [
            'title' => $title,
            'id' => $dummyInt
        ];
        
        if ($validator->validate($fields, $model->validationRules)) {
            
            $model->ChecklistName = $title;
            if ($model->save())
                $_SESSION['afterActionMessage'] = "Action Successfully Completed";
            else
                $_SESSION['afterActionMessage'] = "Action failded, DB Problem..";
            
            $this->redirect(__CLASS__);
        } else {
            $_SESSION['validationErrors'] = $validator->getErrors();
            $this->redirect(__CLASS__, 'add');
        }
    }

    public function update($id = null)
    {
        $model = $this->model('Checklist');
        if ($model->load($id)) {
            
            $this->render(__CLASS__, __FUNCTION__, 'checklist/update', [
                'checklist' => $model
            ], 'updatePost');
        } else
            $this->redirect(__CLASS__);
    }

    public function rmPost()
    {
        $id = htmlspecialchars(trim($_POST['id']));
        if (isset($id)) {
            $model = $this->model('Checklist');
            if ($model->remove($id))
                $_SESSION['afterActionMessage'] = "Action Successfully Completed";
            else
                $_SESSION['afterActionMessage'] = "Action failded, DB Problem..";
        }
        $this->redirect(__CLASS__);
    }

    public function updatePost()
    {
        $id = htmlspecialchars(trim($_POST['id']));
        
        $model = $this->model('Checklist');
        $model->load($id);
        
        $validator = new Validation();
        $title = htmlspecialchars(trim($_POST['title']));
        
        $fields = [
            'title' => $title,
            'id' => $id
        ];
        
        if ($validator->validate($fields, $model->validationRules)) {
            $model->ChecklistName = $title;
            if ($model->save())
                $_SESSION['afterActionMessage'] = "Action Successfully Completed";
            else
                $_SESSION['afterActionMessage'] = "Action failded, DB Problem..";
            $this->redirect(__CLASS__);
        } else {
            $_SESSION['validationErrors'] = $validator->getErrors();
            $this->redirect(__CLASS__, 'update', [
                $id
            ]);
        }
    }

    public function addTaskPost()
    {
        // TODO check if unique in the list
        $returnData = [];
        
        $jsonData = json_decode($_POST['jsonData'], true);
        $model = $this->model('Task');
        
        $taskID = $jsonData['TaskID'];
        if ($taskID > 0){
            $model->load($taskID);
        }
        $model->TaskID = $jsonData['TaskID'];
        $model->ChecklistID = $jsonData['ChecklistID'];
        $model->TaskName = $jsonData['TaskName'];
        $model->TaskTime = null;
        
        if ($model->save()) {
            $returnData['afterActionMessage'] = "Action Successfully Completed";
        } else {
            $returnData['afterActionMessage'] = "Action failded, DB Problem..";
        }
        
        if ($jsonData['OptName'] != null && $jsonData['OptValue'] != null) {
            DebugLogger::log('kkk');
            $model->addParams($jsonData['OptName'], $jsonData['OptValue']);
        }
        
       // $returnData['id'] = $model->TaskID;
        echo json_encode($model);
    }

    public function removeTaskPost()
    {
        // validate
        $jsonData = json_decode($_POST['jsonData'], true);        
        $taskID = $jsonData['taskID'];
        $model = $this->model('Task');
        if ($model->remove($taskID)) {
            $data['actionCompleted'] = true;
            $data['afterActionMessage'] = "Action Successfully Completed";
        } else {
            $data['actionCompleted'] = false;
            $data['afterActionMessage'] = "Action failded, DB Problem..";
        }
        echo json_encode($data);
    }
}
