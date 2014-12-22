<?php
class TaskController extends Controller
{
    public function index()
    {
        
         $model = $this->model('Task');
         $tasks = $model->getAll();
         $this->render( __CLASS__,__FUNCTION__,'task/index',['tasks'=>$tasks ]);
    }
    public function edit($id = null) {
        
        $model = $this->model('Task');
        $this->render(__CLASS__,__FUNCTION__,'checklist/edit',['tasks'=>$model ],'editpost' ); 
        
    }
    public function editpost() {
        
        
        
    }
}