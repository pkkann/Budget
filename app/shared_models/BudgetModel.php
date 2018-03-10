<?php
class BudgetModel extends BaseModel {

    public function getBudgets()
    {
        $sql = "
            SELECT
                `id`,
                `name`,
                DATE_FORMAT(FROM_UNIXTIME(`inserttimestamp`), '%d-%m-%Y kl. %H:%i:%s') AS 'created'
            FROM
                `budget`
            WHERE
                `deleted` = '0'
            ORDER BY
                `name`
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getBudget($id)
    {
        $sql = "
            SELECT
                `id`,
                `name`,
                DATE_FORMAT(FROM_UNIXTIME(`inserttimestamp`), '%d-%m-%Y kl. %H:%i:%s') AS 'created'
            FROM
                `budget`
            WHERE
                `id` = :id
            AND
                `deleted` = '0'
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insertBudget($name)
    {
        $sql = "
            INSERT INTO
                `budget`
            SET
                `name`              = :name,
                `inserttimestamp`   = UNIX_TIMESTAMP(),
                `updatetimestamp`   = UNIX_TIMESTAMP()
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":name", $name);
        return $stmt->execute();
    }

    public function updateBudget($id, $name)
    {
        $sql = "
            UPDATE
                `budget`
            SET
                `name`              = :name,
                `updatetimestamp`   = UNIX_TIMESTAMP()
            WHERE
                `id`                = :id
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        return $stmt->execute();
    }

    public function deleteBudget($id)
    {
        $sql = "
            UPDATE
                `budget`
            SET
                `deleted`           = '1',
                `updatetimestamp`   = UNIX_TIMESTAMP()
            WHERE
                `id`                = :id
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

}