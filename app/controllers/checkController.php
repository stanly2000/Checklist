<?php
require_once APP . '/utilities/Validation.php';
require_once APP . '/utilities/DebugLogger.php';

class CheckController extends Controller
{

    public function index()
    {
        if (!isset($_SESSION['UserID']))
        {
            $this->redirect('login/index');
        }
        $model = $this->model('Check');
       // $checklists = $model->getAll();
        $checklists = $model->loadActiveLists();
        //print_r($checklists);die();
        $this->render(__CLASS__, __FUNCTION__, 'check/index', [
            'checklists' => $checklists
        ]);
    }
    
    public function getTasks()
    {
        
        $jsonData = json_decode($_POST['jsonData'], true);
       // DebugLogger::logAr($jsonData);
        $model = $this->model('Check');
        
        $assignID = $jsonData['assignID'];
        
       
        
        //$model->getTasksWithStatus();
        $tasks = $model->getTasks( $assignID);
        
       // print_r($model->Tasks);die();
        
        echo json_encode($tasks);
        
    }
    
    public function updateTaskPost()
    {
        $jsonData = json_decode($_POST['jsonData'], true);
        $taskID = $jsonData['taskID'];
        $assignID = $jsonData['assignID'];
      //  DebugLogger::log('taskID = '.$taskID);
        $model = $this->model('Check');
        $model->updateTask($taskID,$assignID);
        echo json_encode("ok");
    }
    
}