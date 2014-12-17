<?php
class ChecklistController extends Controller
{

    public function index()
    {

         $model = $this->model('Checklist');
         $checklists = $model->getAll();
         $this->render('checklist/index',['users'=>$checklists ]);
    }


    public function details()
    {

       $model = $this->model('Checklist');
        $existChecklist = null;
        if ($id)
        {
            $existChecklist = $model->get($id);
        }
        
        $this->render('checklist/details',['clist'=>$existChecklist ]);
        
    }
}