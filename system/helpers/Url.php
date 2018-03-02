<?php
function redirect() {
    $args = func_get_args();
    if(count($args) == 1) {
        $location = $args[0];
    } else if(count($args) == 2) {
        $location = action($args[0], $args[1]);
    }
    header("location: ".$location);
    die();
}

function action($module, $action) {
    return base_url("?module=".$module."&action=".$action);
}

function base_url($url) {
    return $GLOBALS['base_url'].$url;
}

function currentAction() {
    $action = $_GET['action'];
    return $action;
}

function currentModule() {
    $module = $_GET['module'];
    return $module;
}