<?php
class ChecklistController extends Controller
{
    public function index()
    {
        
         $model = $this->model('Checklist');
         $checklists = $model->getAll();
         $this->render(str_replace('Controller', '', __CLASS__),__FUNCTION__,'checklist/index',['checklists'=>$checklists ]);
    }


    public function view($id)
    {

       $model = $this->model('Checklist');
        $existChecklist = null;
        if ($id)
        {
            $existChecklist = $model->get($id);
        }
        
        $this->render(str_replace('Controller', '', __CLASS__),__FUNCTION__,'checklist/view',['checklist'=>$existChecklist ]);
        
    }
    public function update($id=null)
    {
        $model = $this->model('Checklist');
        if (isset($_POST['actn'])){
            echo "<BR>ID=".$_POST['id'];
            echo "<BR>title=".$_POST['title'];
          //TODO actual update db
        }
        else
        {
       
        $existChecklist = null;
        if ($id)
        {
            $existChecklist = $model->get($id);
        }
        
        $this->render(str_replace('Controller', '', __CLASS__),__FUNCTION__,'checklist/update',['checklist'=>$existChecklist ]);
        }
        
    }
    
}