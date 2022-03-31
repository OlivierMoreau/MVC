<?php

include_once APP . "view/MainView.php";

class View extends MainView
{

    /**
     * Displays the list fetched from the DB in a table
     *
     * @param [string] $table the table name 
     * @param [array]  $list the list of rows
     * @param [array]  $columns names of columns
     * @return void
     */

    public function displayList($table_name, $list, $columns)
    {
        $this->page .= "<h1>" . ucfirst($table_name) . " </h1>";

        // table header 
        $table = "<table id='mainTable'class='table table-dark'>" . "<thead>";
        // fills table head with column titles
        foreach ($columns as $column) {
            $table .= "<th>" . $column . "</th>";
        }
        // adds edit and delete column
        $table .= "<th> edit </th><th> delete </th>";

        // start of body
        $table .=  "</thead>" . "<tbody>";

        // makes the rows
        foreach ($list as $row) {
            $table .= "<tr>";
            // fills in the cells
            for ($i = 0; $i < count($columns); $i++) {
                $table .= "<td>" . $row[$i] . "</td>";
            }
            // adds the edit and delete button to each row
            $table .= "<td>" . "<a href='" . URL . "?controller=Exemple&action=update&id=" . $row[0] . "&table=" . $table_name . "'><button type='button' class='btn btn-primary'><i class='fas fa-edit'></i></button></a></td>";
            $table .= "<td>" . "<a href='" . URL . "?controller=Exemple&action=delete&id=" . $row[0] . "&table=" . $table_name . "'><button type='button' class='btn btn-primary'><i class='fas fa-trash'></i></button></a></td>";
            $table .= "</tr>";
        }

        // end of body
        $table .= "</tbody></table>";

        $this->page .= $table; //Adding table

        $this->page .= "</br><div class='container'><div class='row no-gutters'><div class='col-2'><a class='btn btn-primary' href='" . URL . "?controller=Exemple&action=list'>Refresh</a></div>";
        $this->page .= "<div class='col-1'></div>";
        $this->page .= "<div class='col-2 text-align-right'><a class='btn btn-primary' href='" . URL . "?controller=Exemple&action=add'>Add</a></div></div></div>"; //Adding buttons

        $this->display();
    }
    /**
     *Creation/appel d'un formulaire
     *
     *@param $titre du formulaire dynamique
     *@param $display parametre de retour en post pour choisir la bonne instruction dans le controller
     *@param $parm renseigne les champs du formulaire en cas de modif ou laisse vide en cas de création
     */
    public function displayForm($titre, $parms, $action)
    {
        print_r($parms);

        $this->page .= "<h2>$titre</h2>";
        //$this->page .= file_get_contents(APP . "html/form.php");
        $form = include(APP . "html/form.php");

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