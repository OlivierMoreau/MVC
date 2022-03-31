<?php   

 class Dispatcher 
    {
        /**
        *Main router of the application, chose proper controller and method depending on GET parameters.
        *    
        *Format your controllers name as "Name" + "Controller".
        *    
        *Format the controllers methods as "Name" + "Action".
        *    
        *As an exemple will start by loading ExempleController and call the listAction method.
        *
        *Handles wrong controller or method by redirecting to the Problem controller.
        */
        public function dispatch()
        {
            //Exemple is the default controller loaded on start, replace with your initial controller's name
            $controller = (isset($_GET['controller']))?$_GET['controller']:"Exemple";
            $controller = $controller."Controller";
            
            //list is default method called on start, replace with your own controller's method
            $action = (isset($_GET['action']))?$_GET['action']:"list";
            $action = $action."Action";
            
            //If the requested controller exists initialize it. Else redirects to the error page.
            if(file_exists(APP . "controller/" . $controller . ".php"))
            {
                $my_controller = new $controller();
                
                //If the requested method exists execute it. Else redirects to the error page.
                if (method_exists($my_controller, $action))
                {
                    $my_controller->$action();
                } else {
                    $this->error("wrong action");         
                }
            
            } else {
                $this->error("wrong controller");
            }     
        }
        // 404 error
        public function error($error_type)
        {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            $problemCont = new ProblemController();
            $problemCont->display($error_type);
        }
    }
