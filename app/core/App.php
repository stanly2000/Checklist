<?php

class App
{

    private $url_controller = null;

    private $url_action = null;

    private $url_params = array();

    /**
     * "Start" the application:
     */
    public function __construct()
    {
        // echo "APP CONSTRUCT<br>";
        // echo "<br>".$this->url_controller;
        // echo "<br>".$this->url_action;
        session_start();
        
        $this->splitUrl();
        // $this->validateRouterParams();
        if ($this->url_controller)
            $this->url_controller = $this->url_controller . 'Controller';
        
        if (! $this->url_controller) {
            
            require APP . 'controllers/homeController.php';
            $page = new HomeController();
            $page->index();
        } elseif (file_exists(APP . 'controllers/' . $this->url_controller . '.php')) {
            require APP . 'controllers/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();
            
            if (method_exists($this->url_controller, $this->url_action)) {
                
                if (! empty($this->url_params)) {
                    call_user_func_array(array(
                        $this->url_controller,
                        $this->url_action
                    ), $this->url_params);
                } else {
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                if (strlen($this->url_action) == 0) {
                    $this->url_controller->index();
                } else {
                    
                    echo "ERROR ELSE bad method";
                }
            }
        } else {
            
            echo "ERROR ELSE Controller not exists";
        }
    }

    private function splitUrl()
    {
        // echo "<BR>URL=".$_GET['url']."<BR><BR>";
        if (isset($_GET['url'])) {
            
            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;
            
            unset($url[0], $url[1]);
            
            $this->url_params = array_values($url);
        }
        if (isset($_POST['cntr']) && isset($_POST['actn'])) {
            // TODO SECURITY CHECK!!!! ONLY LOGGED USERS CAN "POST" THINGS
            $this->url_controller = $_POST['cntr'];
            $this->url_action = $_POST['actn'];
        }
    }

    private function validateRouterParams()
    {
        $controllers = array(
            'home',
            'user',
            'checklist',
            'task',
            'login',
            'assignedChecklist'
        );
        if (! in_array($this->url_controller, $controllers)) {
            die("ERROR BAD CONTROLLER");
        }
        // TODO ADD same for methods
    }
}
