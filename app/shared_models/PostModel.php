<?php
class PostModel extends BaseModel {

    public $types = array(
        "expense"    => "Udgift",
        "income"     => "Indtægt"
    );

    public function createPost($name, $type, $year, $budget_id)
    {
        $sql = "
            INSERT INTO 
                `post`
            SET
                `name`              = :name,
                `type`              = :type,
                `year`              = :year,
                `budget_id`         = :budget_id,
                `createtimestamp`   = UNIX_TIMESTAMP(),
                `updatetimestamp`   = UNIX_TIMESTAMP()
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":year", $year);
        $stmt->bindParam(":budget_id", $budget_id);
        return $stmt->execute();
    }

}