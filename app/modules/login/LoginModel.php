<?php
class LoginModel extends BaseModel {
	
	public function findUser($username) {
		$sql = "
			SELECT
				`id`,
				`name`,
				`username`,
				`password`
			FROM
				`user`
			WHERE
				`username` = :username
			LIMIT 1
		";
		$stmt = $this->db->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
		if($stmt->rowCount() == 0) {
			return false;
		}
		return $stmt->fetch(PDO::FETCH_OBJ);
	}
	
}