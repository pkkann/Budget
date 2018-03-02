<?php
class Helper {

    public function __construct($file) {
        include_once($file);
    }
    
    function __call($functionName, $args) {
        if(function_exists($functionName)) {
            return call_user_func_array($functionName, $args);
        }
    }

}