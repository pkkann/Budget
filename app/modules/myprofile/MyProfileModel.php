<?php
class MyProfileModel extends BaseModel {
	
	public function saveProfile($id, $name) {
		$sql = "
			UPDATE
				`user`
			SET
				`name` = :name
			WHERE
				`id` = :id
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":name", $name);
		$stmt->execute();
	}
	
	public function setNewPass($id, $pass) {
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "
			UPDATE
				`user`
			SET
				`password` = :password
			WHERE
				`id` = :id
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":password", $pass);
		$stmt->execute();
	}
	
	public function getProfile($id) {
		$sql = "
			SELECT
				`id`,
				`name`,
				`username`
			FROM
				`user`
			WHERE
				`id` = :id
			LIMIT 1
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		if($stmt->rowCount() == 0) {
			return false;
		}
		return $stmt->fetch(PDO::FETCH_OBJ);
	}
	
}