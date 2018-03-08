<?php
class BudgetsModel extends BaseModel {
	
	public $months = array(
		1 	=> "Jan",
		2 	=> "Feb",
		3 	=> "mar",
		4 	=> "Apr",
		5 	=> "Maj",
		6 	=> "Jun",
		7 	=> "Jul",
		8 	=> "Aug",
		9 	=> "Sep",
		10 	=> "Okt",
		11 	=> "Nov",
		12 	=> "Dec"
	);
	
	public $postTypes = array(
		'expense'		=> "Udgift",
		'income'		=> "Indtægt"
	);
	
	public function getBudgets() 
	{
		$sql = "
			SELECT
				`id`,
				`name`
			FROM
				`budget`
			ORDER BY
				`name` ASC
		";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function getYears()
	{
		return array("2018");
	}
	
	public function insertPost($name, $type)
	{
		$sql = "
			INSERT INTO
				`post`
			SET
				`name` 				= :name,
				`type`				= :type,
				`budget_id`			= :budget_id,
				`createtimestamp`	= UNIX_TIMESTAMP(),
				`updatetimestamp`	= UNIX_TIMESTAMP()
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":type", $type);
		$stmt->bindParam(":budget_id", $_SESSION['budget_id']);
		$stmt->execute();
	}
	
	public function getPosts($type, $formatNumbers = true, $totalsOnly = false) 
	{
		if($type == "disposable") {
			return $this->getDisposables($formatNumbers);
		}
		$return = (object)array();
		$total = array();
		for($i = 1; $i <= 12; $i++) {
			$total[$i] = 0.0;
		}
		
		$sql = "
			SELECT
				`id`,
				`name`
			FROM
				`post`
			WHERE
				`budget_id`		= :budget_id
			AND
				`type`			= :type
			ORDER BY
				`name`
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":budget_id", $_SESSION['budget_id']);
		$stmt->bindParam(":type", $type);
		$stmt->execute();
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		foreach($posts as &$post) {
			$sql = "
				SELECT
					`id`,
					`month`,
					`value`
				FROM
					`post_value`
				WHERE
					`post_id` 	= :post_id
				AND
					`year`		= :year
			";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(":post_id", $post->id);
			$stmt->bindParam(":year", $_SESSION['year']);
			$stmt->execute();
			$values = $stmt->fetchAll(PDO::FETCH_OBJ);
			
			$post->values = array();
			foreach($values as &$v) {
				$total[$v->month] += $v->value;
				
				if($formatNumbers) {
					$v->value = number_format($v->value, 2, ",", ".");
				}
				$post->values[$v->month] = $v;
			}
		}
		
		if($formatNumbers) {
			for($i = 1; $i <= 12; $i++) {
				$total[$i] = number_format($total[$i], 2, ",", ".");
			}
		}
		
		if(!$totalsOnly) {
			$return->posts = $posts;
		}
		$return->total = $total;
		
		return $return;
	}
	
	public function getDisposables($formatNumbers = true)
	{
		$income 	= $this->getPosts("income", false, true)->total;
		$expenses 	= $this->getPosts("expense", false, true)->total;
		$return		= (object)array();
		
		// Calculate total
		$total = array();
		for($i = 1; $i <= 12; $i++) {
			$total[$i] = $income[$i] - $expenses[$i];
		}
		
		$posts = array();
		
		// Weekly post
		$weekly = (object)array(
			'name' 		=> "Ugentlig",
			'values'	=> array()
		);
		for($i = 1; $i <= 12; $i++) {
			if(!empty($total[$i])) {
				$v = $total[$i] / 4;
				if($formatNumbers) {
					$v = number_format($v, 2, ",", ".");
				}
				$weekly->values[$i] = (object)array(
					'month' 	=> $i,
					'value'		=> $v
				);
			}
		}
		array_push($posts, $weekly);
		
		// Daily post
		$daily = (object)array(
			'name'		=> "Dagligt",
			'values'	=> array()
		);
		for($i = 1; $i <= 12; $i++) {
			if(!empty($total[$i])) {
				$days = date("t", strtotime($_SESSION['year']."-".$i."-01"));
				$v = $total[$i] / $days;
				if($formatNumbers) {
					$v = number_format($v, 2, ",", ".");
				}
				$daily->values[$i] = (object)array(
					'month'		=> $i,
					'value'		=> $v
				);
			}
		}
		array_push($posts, $daily);
		
		// Format total
		if($formatNumbers) {
			foreach($total as &$t) {
				$t = number_format($t, 2, ",", ".");
			}
		}
		
		$return->posts = $posts;
		$return->total = $total;
		
		return $return;
	}
}