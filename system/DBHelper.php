<?php
class DBHelper extends Singleton 
{
    public $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=".$GLOBALS['mysql']['host'].";port=".$GLOBALS['mysql']['port'].";dbname=".$GLOBALS['mysql']['db'].";charset=utf8", $GLOBALS['mysql']['user'], $GLOBALS['mysql']['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
}