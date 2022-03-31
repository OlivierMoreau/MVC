<?php
include_once APP . "model/MainModel.php";

class Model extends MainModel
{
    private $connec;


    public function set_connec($base)
    {
        array_key_exists($base, $this->databases) ? ($this->connec = $this->databases[$base]) : "";
    }

    /** 
     *return the content of a table in the database as a list of rows
     *
     *@param $table: the table name.
     *
     */
    public function getList($table)
    {

        if ($this->connec) {
            try {
                $requete = $this->connec->prepare("SELECT * FROM $table");
                $requete->execute();
                return $requete->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage() . "couldn't return the DB data with getList"; //return exception
            }
        } else {
            return "no connection to database";
        }
    }

    /**
     *
     *Return a single row from the table selected by id
     *
     *
     */
    public function getItem($id, $table)
    {
        $requete = $this->connec->prepare("SELECT * FROM $table WHERE employee_id=:id");
        $requete->bindParam(":id", $id);
        $result = $requete->execute();
        $list = array();
        if ($result) {
            $list = $requete->fetch(PDO::FETCH_ASSOC);
        } else {
            return "false";
        }
        return $list;
    }

    /**
     *
     *Updates the database using the post values submitted in the form.
     *
     *
     */
    public function updateDB($table, $vals)
    {
        $requete = $this->connec->prepare("UPDATE $table SET first_name = ?, last_name = ?, email = ? Where employee_id= ?");
        $result = $requete->execute($vals);

        if ($result) {

            return $result;
        } else {

            return false;
        }
    }
    /**
     *
     *Insert a new entry in the database using the post values submitted in the form.
     *
     *
     */
    public function insertDB($table, $vals)
    {

        if ($this->connec) {
            $requete = $this->connec->prepare("INSERT INTO $table (first_name, last_name, email) VALUES (?,?,?)");
            $result = $requete->execute($vals);

            if ($result) {
                echo "<h2 class='text-success'>Requete traitée</h2>";
                return $result;
            } else {
                echo "<h2 class='text-danger'>Erreur lors du traitement.</h2>";
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * Fetches the tables names 
     *
     * @param [type] $db the database name
     * @return array of table names
     */
    public function getDBTablesNames($db)
    {
        $sql = 'SHOW TABLES';

        $query = $this->connec->query($sql);
        try {
            return $query->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            return $e->getMessage(); //return exception
        }
    }

    /**
     * returns the names of the columns
     *
     * @param [type] $table the table name
     * @return array of table name strings 
     */
    public function getTableColumnNames($table)
    {


        $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = '$table'";
        $stmt = $this->connec->prepare($sql);
        try {

            $stmt->execute();
            $raw_column_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $column_names = [];
            foreach ($raw_column_data as &$column) {
                array_push($column_names, $column['column_name']);
            }
            return $column_names;
        } catch (Exception $e) {
            return $e->getMessage(); //return exception
        }
    }
}
