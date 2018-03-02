<?php
class Autoloader {

    private function __construct() {
        
    }

    public static function load() {
        spl_autoload_register(function($class) {
            $dirs = array(
                "../system"
            );

            for($i = 0; $i < count($dirs); $i++) {
                $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirs[$i], RecursiveDirectoryIterator::SKIP_DOTS));
                foreach($objects as $name => $object){
                    $info = pathinfo($name);
                    $actualClass = explode("\\", $class);
                    $actualClass = end($actualClass);
                    if( strtolower($info['filename']) == strtolower($actualClass) ) {
                        $filename = $info['dirname']."/".$info['filename'].".".$info['extension'];
                        
                        if( file_exists( $filename ) ) {
                            require $filename;
                            return;
                        }
                    }
                }
            }
        });
    }

}