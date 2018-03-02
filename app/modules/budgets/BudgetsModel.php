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
				`year`
			FROM
				`budget`
			ORDER BY
				`year` DESC
		";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function getPosts($budget_id, $type)
	{
		$sql = "
			SELECT
				`id`,
				`name`,
				`amount`
			FROM
				`post`
			WHERE
				`budget_id` = :budget_id
			AND
				`type`		= :type
			ORDER BY
				`name` ASC
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":budget_id", $budget_id);
		$stmt->bindParam(":type", $type);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
}