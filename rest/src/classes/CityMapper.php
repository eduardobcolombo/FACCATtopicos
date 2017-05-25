<?php

class CityMapper extends Mapper
{
    public function getCities() {
        $sql = "
            SELECT city
              FROM cities
            ";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new TicketEntity($row);
        }
        return $results;
    }