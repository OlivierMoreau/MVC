<?php

class MainView
{
    protected $page;
    
    public function __construct()
    {
        $this->page = file_get_contents(APP . "html/header.php");        
    }
    
    //compile et echo les éléments de la page pour l'affichage
    protected function display()
    {
        $this->page .= file_get_contents(APP . "html/footer.php");
        $this->page = str_replace('{URL}', URL, $this->page);
        echo $this->page;   
    }
    
    public function displayError($error = false)
    {
        $this->page = file_get_contents(APP . "html/error.html");
        if($error){
             $this->page = str_replace("{ERROR}", "<p><strong style='color: red; font-size: 20px;'> Error type : ". $error . "</strong></p>", $this->page);
         } else {
            $this->page = str_replace("{ERROR}", "", $this->page);
        }
        $this->page = str_replace('{URL}', URL, $this->page);
        echo $this->page;
    }
}