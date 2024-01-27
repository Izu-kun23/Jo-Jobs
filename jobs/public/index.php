<?php
session_start();
require 'autoload.php';
use Controllers\PageController;
use functions\DatabaseTable;

require '../functions/loadTemplate.php';
require '../Controllers/PageController.php';
require '../functions/DatabaseTable.php';


$jobsTable = new DatabaseTable('job', 'id');
$controller = new PageController('job', 'id');

if ($_SERVER['REQUEST_URI'] !== '/') {
    $path = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
    if (str_contains($path, '/')) {
//        list($controllerName, $functionName) = explode('/', $path);
        $explode = explode('/', $path);
        $controller = ucfirst($explode[0]) . 'Controller';
        require "../Controllers/$controller.php";
        $controller = new $controller();
        $path = $explode[1] ?? 'home';
    }
    $page = $controller->$path();
} else {
   $controller = new PageController('jobs', 'id');
    $page = $controller->home();
}

$output = loadTemplate('../templates/' . $page['template'], $page['variables']);
$title = $page['title'];

require '../templates/layout/layout.html.php';



//$jobsTable = new functions\DatabaseTable('job', 'id');
//$controllers = new \Controllers\PageController($jobsTable, 'id');
//
//if ($_SERVER['REQUEST_URI'] !== '/') {
//	$path = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
//	if(str_contains($path, '/')){
//        list($controllerName, $functionName) = explode('/', $path);
//        $r = "\Controllers\\". ucfirst($controllerName) . "Controllers";
//        $controllers = new $r();
//        $path = $functionName;
//	}
//    $page = $controllers->$path();
//} else {
//	$page = $controllers->home();
//}
//
//$output = loadTemplate('../templates/' . $page['template'], $page['variables']);
//$title = $page['title'];
//
//require '../templates/layout.html.php';



