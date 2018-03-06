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
	
	public function getPosts($type, $formatNumbers = true, $totalsOnly = false) 
	{
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
		
		$disposables = array();
		for($i = 1; $i <= 12; $i++) {
			$disposables[$i] = $income[$i] - $expenses[$i];
			
			if($disposables[$i] == 0.0) {
				$disposables[$i] = "";
			}
			
			if($formatNumbers) {
				if($disposables[$i] != "") {
					$disposables[$i] = number_format($disposables[$i], 2, ",", ".");
				}
			}
		}
		return $disposables;
	}
}