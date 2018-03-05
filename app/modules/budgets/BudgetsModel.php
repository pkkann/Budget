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
	
}