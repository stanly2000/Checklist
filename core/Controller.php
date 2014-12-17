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
    
    public function render($view, $data = []){
        require APP . 'views/_shared/header.php';
        require APP . 'views/'.$view.'.php';
        require APP . 'views/_shared/footer.php';
    }
}
