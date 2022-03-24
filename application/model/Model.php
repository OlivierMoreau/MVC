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
        
        if($this->connec)
        {
            $requete = $this->connec->prepare("SELECT * FROM $table");
            $result = $requete->execute();
        
            if($result)
            {
                $list= $requete->fetchALL(PDO::FETCH_NUM);
                return $list;
            }else{
                return "false";
            }
         
        } else{
            return false;
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
        $requete = $this->connec->prepare("SELECT * FROM $table WHERE id=:id");
        $requete->bindParam(":id",$id);
        $result = $requete->execute();
        $list = array();
        if($result){
            $list = $requete->fetch(PDO::FETCH_NUM);
        } else{
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
    public function updateDB($table, $vals){
        
        
        $requete = $this->connec->prepare("UPDATE $table SET name = ?, age = ?, comment = ? Where id= ?");
        $result = $requete->execute($vals);
        
        if($result){
             
             return $result; 
        }else{
             
             return false;
        }
    
    }
    /**
    *
    *Insert a new entry in the database using the post values submitted in the form.
    *
    *
    */
    public function insertDB($table, $vals){
        
        if($this->connec)
        {
            $requete = $this->connec->prepare("INSERT INTO $table (name, age, comment) VALUES (?,?,?)");
            $result = $requete->execute($vals);

            if($result){
                 echo "<h2 class='text-success'>Requete traitée</h2>";
                 return $result; 
            }else{
                 echo "<h2 class='text-danger'>Erreur lors du traitement.</h2>";
                 return false;
            }
        }else{
            return false;
        }
    }
    
}
