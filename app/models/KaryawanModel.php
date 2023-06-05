<?php

class KaryawanModel
{
    private $db;
    private $table = 'empmasterepms';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllData()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' order by NO');
        return $this->db->resultSet();
    }

    public function getSearchData($search)
    {
        $query = strtoupper($search);
        $this->db->query("SELECT empcode, empname FROM " . $this->table . " WHERE empcode LIKE '%" . $query . "%' OR empname LIKE '%" . $query . "%'");
        $results = $this->db->resultSet();

        $results = array_map(function ($result) {
            return [
                "id"    => $result['EMPCODE'],
                "text"  => $result['EMPCODE'] . ' - ' . $result['EMPNAME']
            ];
        }, $results);

        return $results;
    }
}
