<?php

require_once APP . "controller/MainController.php";



/*
*Exemple controller on this squeleton
*
*Gets called by the dispatcher on start 
*
*Format your methods as "name" + "Action" to be recognised by the dispatcher
*/

class ExempleController extends MainController
{


    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();

        //Ask the model to connect to a Database connection param is db name 

        $this->model->connectDB("test");
        $this->model->set_connec("test");
    }

    /** 
     *
     *Tells the model to connect to the provided DB and to fetch the exemple table and the view to display it in a table.
     *
     */
    public function listAction()
    {
        $table = 'employees';
        if (array_key_exists('table', $_GET)) {
            $table = $_GET['table'];
        }
        
        $col_names = $this->model->getTableColumnNames($table);

        //Call model method to returns a list of the table rows
        $list = $this->model->getList($table);
        if (gettype($list) === 'array') {
            $this->view->displayList($table, $list, $col_names);
        } else {
            $this->view->displayError($list . "<- getList returned this");
        }
    }

    /*
    *
    *Display the form to Updates a row of the table. Id of the row passed as a GET param.
    *
    */
    public function updateAction()
    {
        $table = 'employees';
        if (array_key_exists('table', $_GET)) {
            $table = $_GET['table'];
        }
        
        //checks for id Param
        if (isset($_GET['id'])) {
            $row =  $this->model->getItem($_GET['id'], $table);
            $this->view->displayForm("Edition profil", $row, 'update');
        } else {
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
        if ($vals && isset($_POST["id"])) {
            array_push($vals, $_POST["id"]);
            $return = $this->model->updateDB("employees", $vals);
            $return ? $this->listAction() : $this->listAction('updating');
        } else {
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
        $this->view->displayForm("Add new entry", ['', '', '', ''], 'add');
    }

    /*
    *
    *Calls the model for an insert on the database
    *
    */
    public function addDBAction()
    {
        $vals = $this->checkUserInputs();
        if ($vals) {
            $return = $this->model->insertDB("employees", $vals);
            $return ? $this->listAction() : $this->listAction('insert in');
        } else {
            $this->listAction();
        }
    }

    private function checkUserInputs()
    {

        $prénom = $nom = $email = "";

        if (isset($_POST["prénom"]) && is_string($_POST["prénom"])) {
            $prénom = $_POST["prénom"];
        } else {
            return false;
        }

        if (isset($_POST["nom"]) && is_numeric($_POST["nom"])) {
            $nom = $_POST["nom"];
        } else {
            return false;
        }
        if (isset($_POST["email"]) && is_string($_POST["email"])) {
            $email = $_POST["email"];
        } else {
            $email = "";
        }

        return [$prénom, $nom, $email];
    }


    private function getTableNamesAction()
    {
        $names = $this->model->getDBTablesNames('test');
        print_r($names);
    }
}
