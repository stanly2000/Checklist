<?php
require_once APP . '/utilities/Validation.php';
require_once APP . '/utilities/DebugLogger.php';

class CheckController extends Controller
{

    public function index()
    {
        // display all active checklists for groups wich logged user belongs to 
        $model = $this->model('Check');
       // $checklists = $model->getAll();
        $checklists = $model->loadActiveLists();
        //print_r($checklists);die();
        $this->render(__CLASS__, __FUNCTION__, 'check/index', [
            'checklists' => $checklists
        ]);
    }
    
}