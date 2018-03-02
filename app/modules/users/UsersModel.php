<?php
class UsersModel extends BaseModel {

	public function getUsers() {
		$sql = "
			SELECT
				`id`,
				`name`,
				`username`
			FROM
				`user`
			ORDER BY
				`name`
		";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
}