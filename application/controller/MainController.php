<?php

/*
*Parent class of all models
*Include here parameters and methods common to your models
*/
require APP . "view/View.php";
require APP . "model/Model.php";

class MainController
{

    protected $view;
    protected $model;
    
    public function defaultAction(){
        echo "Nothing to see here";
    }
}