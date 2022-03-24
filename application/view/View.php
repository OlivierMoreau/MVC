<?php 

include_once APP . "view/MainView.php";

class View extends MainView{

    /**
    *Insert the list passed into a table
    *
    *@param $list données de la DB récupérées dans le model pour remplir les champs du tableaux
    *
    *
    */
    public function displayList($list, $return=null)
    {
        $this->page .= "<h1>Exemple table</h1>"; //Adding title
        
        $table = "<table class='table table-dark table-striped'>" 
            ."<thead>"
            ."<th style='width: 25%;'>Name</th><th style='width: 25%;'>Age</th><th style='width: 25%;'>Comment</th><th style='width: 12,5%;'>Update</th><th style='width: 12,5%;'>Delete</th>"
            ."</thead>"
            ."<tbody>";
        
        foreach($list as $row){
        $table .= "<tr>
        <td>".$row[1]."</td>
        <td>".$row[2]."</td>
        <td>".$row[3]."</td>
        <td>"."<a href='".URL."?controller=Exemple&action=update&id=".$row[0]."'>"."<button type='button' class='btn btn-primary'><i class='fas fa-edit'></i></button></a></td>
        <td>"."<a href='".URL."?controller=Exemple&action=delete&id=".$row[0]."'>"."<button type='button' class='btn btn-primary'><i class='fas fa-trash'></i></button></a></td></tr>";
        }   
        $table .= "</tbody></table>";
        
        $this->page .= $table; //Adding table
        
        $this->page .= "</br><div class='container'><div class='row no-gutters'><div class='col-2'><a class='btn btn-primary' href='".URL."?controller=Exemple&action=list'>Refresh</a></div>";
        $this->page .= "<div class='col-1'></div>";
        $this->page .= "<div class='col-2 text-align-right'><a class='btn btn-primary' href='".URL."?controller=Exemple&action=add'>Add</a></div></div></div>"; //Adding buttons
        
        if($return)  //Error display
        {
            $this->page .= "</br><h2 class='text-danger'>Error, couldn't ".$return." the database.</h2>"; 
        }
        
        $this->display();  
    }
    /**
    *Creation/appel d'un formulaire
    *
    *@param $titre titre du formulaire dynamique
    *@param $display parametre de retour en post pour choisir la bonne instruction dans le controller
    *@param $parm renseigne les champs du formulaire en cas de modif ou laisse vide en cas de création
    */
    public function displayForm($titre, $parms, $action)
    {
        $this->page .= "<h2>$titre</h2>";
        $this->page .= file_get_contents(APP . "html/form.html");
        $this->page = str_replace("{parm0}", $parms[0], $this->page);
        $this->page = str_replace("{parm1}", $parms[1], $this->page);
        $this->page = str_replace("{parm2}", $parms[2], $this->page);
        $this->page = str_replace("{parm3}", $parms[3], $this->page);
        $this->page = str_replace("{parm4}", $action, $this->page);
        
        $this->display();
    }
    
    
    
    
    public function test()
    {
        $this->display();
    }

}