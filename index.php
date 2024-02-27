<?php
require_once 'controller/Controller.php';
require_once 'model/Model.php';


echo 'hi';
// headers

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH');


$method=$_SERVER['REQUEST_METHOD'];
$request=$_SERVER['REQUEST_URI'];
$request=trim($request, '/');
$request=explode("/",$request);
var_dump($request[0]);
$controller=$request[0]=='' ? 'HomeController' : ucfirst(strtolower($request[0])).'Controller';
var_dump($file="controller/$controller.php");

if (!file_exists($file)) {
    echo 'error';}
    else {
        require_once $file;
        $class=new $controller($method,$request);
       
    }
    $class::router();