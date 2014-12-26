<?php

class Controller
{

    public $db = null;

    public $model = null;


    function __construct()
    {
        $this->db = $this->db_connect();//new PDO('mysql:host=localhost;dbname=Checklist;charset=utf8', 'root', '');
        
    }
    
    private function db_connect(){
          return  new PDO('mysql:host=localhost;dbname=Checklist;charset=utf8', 'root', '');
    }


    public function model($model)
    {
       require APP . '/models/' .$model. '.php';
        
       return new $model($this->db);
    }
    
    public function render($activeController, $activeControllerMethod, $view, $data = [],$callbackMethod = null){
        
        $activeController = strtolower(str_replace('Controller', '', $activeController));
        require APP . 'views/_shared/header.php';
        require APP . 'views/'.$view.'.php';
        require APP . 'views/_shared/footer.php';
    }
    
    public function redirect($Controller, $ControllerMethod = null, $params = []){
        $Controller = strtolower(str_replace('Controller', '', $Controller));
        header('Location: '.RESOURCE.'/'.$Controller.'/'.$ControllerMethod.'/'.$this->builParams($params));
        exit;
    }
    
    private function builParams($params = []){
        $param_str = "";
        if (count($params) > 0){
            foreach ($params as $val) {
                $param_str .= $val.'/';
            }
        }
        return trim($param_str);
    }
}
