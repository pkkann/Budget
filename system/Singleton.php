<?php
class Singleton {

    private function __construct()
    {

    }

    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $class = get_called_class();
            $inst = new $class();
        }
        return $inst;
    }


}