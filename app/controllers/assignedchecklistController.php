<?php
require_once APP . '/utilities/Validation.php';
require_once APP . '/utilities/DebugLogger.php';

class AssignedChecklistController extends Controller
{

    public function index()
    {
        $model = $this->model('AssignedChecklist');
        $assignedChecklist = $model->getAll();
        $this->render(__CLASS__, __FUNCTION__, 'assignedchecklist/index', [
            'assignedChecklist' => $assignedChecklist
                ]);
    }

    public function view($id)
    {
        $model = $this->model('AssignedChecklist');
        if ($model->load($id)) {
  
            
            $this->render(__CLASS__, __FUNCTION__, 'assignedchecklist/view', [
                'assignedChecklist' => $model
            ], 'updatePost');
        } else
            $this->redirect(__CLASS__);
    }
   
    public function add()
    {
        $modelChecklist = $this->model('Checklist');
        $checklists = $modelChecklist->getAll();
        
        $modelGroup = $this->model('Group');
        $groups = $modelGroup->getGroups();
        
        $this->render(__CLASS__, __FUNCTION__, 'assignedchecklist/add', ['checklists'=>$checklists, 'groups'=>$groups], 'addPost');
    }
    

    public function addPost()
    {
       
        $model = $this->model('AssignedChecklist');
        // adding this for using general model validation rules
        $dummyInt = 1;
        $validator = new Validation();
        $checklistid = htmlspecialchars(trim($_POST['checklistID']));
        $id = htmlspecialchars(trim($_POST['id']));
        $fields = [
            'checklistID' => $checklistid,
            'id' => $id
        ];
                
            $model->ChecklistID = $checklistid;
            if ($model->save())
                $_SESSION['afterActionMessage'] = "Action Successfully Completed";
            else
                $_SESSION['afterActionMessage'] = "Action failded, DB Problem..";
            
            $this->redirect(__CLASS__);      
            $this->redirect(__CLASS__, 'add');
        }
    }



