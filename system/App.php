<?php
class App {

    public function __construct() {
        
    }

    public function run() {
        session_start();
        require '../app/config.php';
        require '../system/Autoloader.php';
        Autoloader::load();
        if($GLOBALS['debug']) {
            Router::instance()->route();
        } else {
            try {
                Router::instance()->route();
            } catch ( AccessException $e ) {
                //require '../system/errorpages/403_forbidden.php';
                header("location: ".$GLOBALS['base_url']."?module=login&action=index");
                die();
            } catch ( JellyException $e ) {
                require '../system/errorpages/404_pagenotfound.php';
                die(1);
            }
        }
    }

}