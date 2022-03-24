<?php 

require_once APP . "controller/MainController.php";



/*
*Exemple controller on this squeleton
*
*Gets called by the dispatcher on start 
*
*Fromat your methods as "name" + "Action" to be recognised by the dispatcher
*/

class ExempleController extends MainController
{


    public function __construct(){
        $this->view = new View();
        $this->model = new Model();
        
        //Ask the model to connect to a Database connection param is db name 
        $this->model->connectDB("test2");
        $this->model->connectDB("test");
        $this->model->set_connec("test2");

    }
    
    /** 
    *
    *Tells the model to connect to the provided DB and to fetch the exemple table and the view to display it in a table.
    *
    */
    public function listAction($return = null)
    {
        //Call model method to returns a list of the table rows
        $list = $this->model->getList("user");
        
        $this->view->displayList($list, $return);       
    }
    
    /*
    *
    *Display the form to Updates a row of the table. Id of the row passed as a GET param.
    *
    */
    public function updateAction()
    {
        //checks for id Param
        if(isset($_GET['id']))
        {
            $row =  $this->model->getItem($_GET['id'], "user");
            $this->view->displayForm("Edition profil", $row, 'update'); 
        }else {
            $this->listAction();
        }  
    }
        
    /*
    *
    *Calls the model for an update on the database 
    *
    */
    public function updateDBAction()
    {
        $vals = $this->checkUserInputs();
        if($vals && isset($_POST["id"]))
        {
            array_push($vals, $_POST["id"]);
            $return = $this->model->updateDB("user", $vals);
            $return ? $this->listAction() : $this->listAction('updating');
        }else{
            $this->listAction();
        }
    }
    
    /*
    *
    *Display the form to add entry to the DB
    *
    */
    public function addAction()
    {
        $this->view->displayForm("Add new entry", ['','','',''], 'add');
    }
    
    /*
    *
    *Calls the model for an insert on the database
    *
    */
    public function addDBAction()
    {
        $vals = $this->checkUserInputs();
        if($vals){
            $return = $this->model->insertDB("user", $vals);
            $return ? $this->listAction() : $this->listAction('insert in');
        }else{
            $this->listAction();
        }
    }
    
    private function checkUserInputs()
    {
        
         $name = $age = $comment = "";
        
        if(isset($_POST["name"]) && is_string($_POST["name"]))
        {
            $name = $_POST["name"];
        }
        else {
            return false;
        }
        
        if(isset($_POST["age"]) && is_numeric($_POST["age"]))
        {
            $age = $_POST["age"];
        }else {
            return false;
        }
        if(isset($_POST["comment"]) && is_string($_POST["comment"]))
        {
            $comment = $_POST["comment"];
        }else {
            $comment = "";
        }
        
        return [$name, $age, $comment];
    }
          
}