<?php

/*
*Parent class of all models
*Include here parameters and methods common to your models
*/


class MainModel
{
    /*ini file content*/
    private $ini_array = [];
    /*databases stored as name=>pdo connection*/
    protected $databases = [];


    /*
    *Stores the content of the DBconfig file into an array
    */
    public function __construct()
    {
        $this->ini_array = parse_ini_file(APP . "config/DBSconfig.ini", true);
    }


    /*
    *Creates a PDO connexion to a database and stores it in the $databases array
    *
    *Databases are indexed by name in the array
    *
    *@param DBname = the name of databased as written in the config file
    */
    public function connectDB($DBname)
    {
        $DBinfos = $this->ini_array[$DBname];
        try {
            $db = new PDO(
                "mysql:host=" .
                    $DBinfos["server"] . ";dbname=" .
                    $DBinfos["base"],
                $DBinfos["user"],
                $DBinfos["password"],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
            );

            $this->databases += [$DBname => $db];
        } catch (Exception $e) {
            error_log("erreur de connection Base de Donnée " . $DBname . " " . $e->getMessage());
        }
    }

}
