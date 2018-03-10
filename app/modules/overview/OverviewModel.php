<?php
class OverviewModel extends BaseModel {
	
    public function getYears()
    {
        $sql = "
            SELECT DISTINCT
                `year`
            FROM
                `post_value`
            ORDER BY
                `year` DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        if(!in_array(date("Y"), $result)) {
            array_unshift($result, date("Y"));
        }
        return $result;
    }
    
}