<?php
    


// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

require_once APP . 'config/config.php';

//Required files remember to include all your controllers.
require APP . 'controller/ExempleController.php';
require APP . 'controller/ProblemController.php';
require APP . 'dispatcher.php';

$dispatcher = new Dispatcher();
$dispatcher->dispatch();




