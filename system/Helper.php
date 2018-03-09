<?php
class Helper {

	public $db;

    public function __construct($file, $db = null) {
		$this->db = $db;
        include_once($file);
    }
    
    function __call($functionName, $args) {
        if(function_exists($functionName)) {
			if($this->db != null) {
				$GLOBALS['db'] = $this->db;
			}
			$s = call_user_func_array($functionName, $args);
			if($this->db != null) {
				unset($GLOBALS['db']);
			}
            return $s;
        }
    }

}