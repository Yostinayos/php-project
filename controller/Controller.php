<?php
class Controller{
    public static $method ,$request ;
    public function __construct($method,$request){

        self::$method = $method;
        self::$request = $request;
    }
}