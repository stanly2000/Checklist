<?php
require_once ROOT.'/utilities/Validation.php';
class ChecklistController extends Controller
{
    public function index()
    {
        
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
       // $model = $this->model('Checklist');$model->validationRules
        $validator = new Validation();
        $title = htmlspecialchars(trim($_POST['title']));
        $id = '100aa';
        $fields = ['title'=>$title,'id'=>$id];
        $validationRules = ['title'=>['notEmpty','lettersAndNumbers'],'id'=>['notEmpty','isInteger']];
        if($validator->validate($fields, $validationRules)){
        $model = $this->model('Checklist');
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
        if (isset($_POST['id'])){
            $model = $this->model('Checklist');
            $params['id'] = $_POST['id'];
            $model->remove($params);
        }
        $this->redirect(__CLASS__);
    }
    
    public function updatePost()
    {
        $model = $this->model('Checklist');
            $params['title'] = $_POST['title'];
            $params['id'] = $_POST['id'];
            $model->update($params);
        $this->redirect(__CLASS__);
    }
    
}
