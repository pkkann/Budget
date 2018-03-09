<?php
class BaseModel {
	
	public $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
}