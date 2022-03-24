<?php
require_once APP . 'controller/MainController.php';


class ProblemController extends MainController {
    
    
    protected $view;
    
    public function __construct()
    {
        $this->view = new View();
        
       
    }
    
    public function display($error = false)
    {
        $error ? $this->view->displayError($error) : $this->view->displayError();
    }
    

}