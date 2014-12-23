<?php
class groupController extends Controller {
    
    public function index() {
        
        if (!empty($_SESSION)) {
            
         $model = $this->model('Group');
         $groups = $model->GetGroups();
         $this->render( __CLASS__,__FUNCTION__,'group/index',['groups'=>$groups]);
         
        } 
        else{
            $this->redirect('home');
        }
    }
    public function view($id) {
        
        $model = $this->model('Group');
        $view = $model->GetView($id);
        $this->render( __CLASS__,__FUNCTION__,'group/view',['view'=>$view]);
        
    }
    
    
}
