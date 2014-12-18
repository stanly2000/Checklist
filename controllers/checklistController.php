<?php
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
    
    public function updatePost()
    {
        $model = $this->model('Checklist');
            $params['title'] = $_POST['title'];
            $params['id'] = $_POST['id'];
            $model->update($params);
        $this->redirect(__CLASS__);
    }
    
}