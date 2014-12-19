<?php
require_once ROOT.'/utilities/Validation.php';
require_once ROOT.'/utilities/DebugLogger.php';
class ChecklistController extends Controller
{
    public function index()
    {
       
        $arrr = ['asas'=>111,'ww'=>'ooo'];
        DebugLogger::logAr($_GET);
         $model = $this->model('Checklist');
         $checklists = $model->getAll();
         $this->render( __CLASS__,__FUNCTION__,'checklist/index',['checklists'=>$checklists ]);
    }


    public function view($id)
    {

       $model = $this->model('Checklist');
        $existChecklist = null;
        if ($id)
        {
            $existChecklist = $model->get($id);
        }
        
        $this->render( __CLASS__,__FUNCTION__,'checklist/view',['checklist'=>$existChecklist ]);
        
    }
    
    public function add()
    {
        $this->render(__CLASS__,__FUNCTION__,'checklist/add',null,'addPost' );
    }
    
    public function addPost()
    {
        $model = $this->model('Checklist');
        // adding this for using general model validation rules
        $dummyInt = 1;
        $validator = new Validation();
        $title = htmlspecialchars(trim($_POST['title']));
        $fields = ['title'=>$title, 'id'=>$dummyInt];

        if($validator->validate($fields, $model->validationRules)){
            $params['title'] = $title;
            $model->add($params);
            $_SESSION['afterActionMessage'] = "Action Successfully Completed";
        $this->redirect(__CLASS__);
        }
        else{
            $_SESSION['validationErrors'] = $validator->getErrors();
            $this->redirect(__CLASS__, 'add');
        }
    }
    
    public function update($id=null)
    {
        $model = $this->model('Checklist');

       
        $existChecklist = null;
        if ($id)
        {
            $existChecklist = $model->get($id);
        }
        
        $this->render(__CLASS__,__FUNCTION__,
                'checklist/update',
    ['checklist'=>$existChecklist ],'updatePost' );  
    }
    
    public function rmPost()
    {
        $id = htmlspecialchars(trim($_POST['id']));
        if (isset($id)){
            $model = $this->model('Checklist');
            $params['id'] = $id;
            $model->remove($params);
            $_SESSION['afterActionMessage'] = "Action Successfully Completed";
        }
        $this->redirect(__CLASS__);
    }
    
    public function updatePost()
    {
        $model = $this->model('Checklist');
  
        $validator = new Validation();
        $title = htmlspecialchars(trim($_POST['title']));
        $id = htmlspecialchars(trim($_POST['id']));
        $fields = ['title'=>$title, 'id'=>$id];

        if($validator->validate($fields, $model->validationRules)){
            $params['title'] = $title;
            $params['id'] = $id;
            $model->update($params);
            $_SESSION['afterActionMessage'] = "Action Successfully Completed";
        $this->redirect(__CLASS__);
        }
        else{
            $_SESSION['validationErrors'] = $validator->getErrors();
            $this->redirect(__CLASS__, 'update', [$id]);
        }
    }
    
}
