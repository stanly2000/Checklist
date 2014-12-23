<?php
class groupController extends Controller {
    
    public function index() {
        
         $model = $this->model('Group');
         $groups = $model->GetGroups();
         $this->render( __CLASS__,__FUNCTION__,'group/index',['groups'=>$groups]);
        
    }
    
}
