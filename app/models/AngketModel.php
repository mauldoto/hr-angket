<?php

class AngketModel
{

    private $db;
    private $table = 'hr_angket';
    private $tableJawaban = 'hr_angket_jawaban';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllData()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' order by NO');
        return $this->db->resultSet();
    }

    public function getJawaban($nik)
    {
        $this->db->query("SELECT * FROM " . $this->tableJawaban . " WHERE NIK='" . $nik . "'");
        return $this->db->resultSet();
    }

    public function saveData($data)
    {
        if (count($this->check($data['nik'])) > 0) {
            $query = "UPDATE hr_angket_jawaban set JAWABAN=:jawaban, INPUTDATE=:inputdate, ALASAN=:alasan WHERE NIK=:nik and NO=:no";
        } else {
            $query = "INSERT INTO hr_angket_jawaban (NIK, NO, JAWABAN, INPUTDATE, ALASAN) 
            VALUES(:nik, :no, :jawaban, :inputdate, :alasan)";
        }

        $data['inputdate'] = strtoupper(date('d-M-y'));

        $this->db->query($query);

        // $this->db->bind('nik', $data['nik']);
        // $this->db->bind('no', $data['no']);
        // $this->db->bind('jawaban', $data['jawaban']);
        // $this->db->bind('inputdate', date('dmY'));
        // $this->db->bind('alasan', $data['alasan']);
        $this->db->executeOracle($data);

        return $this->db->rowCount();
    }

    public function saveDataMultipleRow($dataPOST)
    {

        if (count($this->check($dataPOST['nik'])) > 0) {
            $query = "UPDATE hr_angket_jawaban set JAWABAN=:jawaban, INPUTDATE=:inputdate, ALASAN=:alasan WHERE NIK=:nik and NO=:no";
        } else {
            $query = "INSERT INTO hr_angket_jawaban (NIK, NO, JAWABAN, INPUTDATE, ALASAN) 
            VALUES(:nik, :no, :jawaban, :inputdate, :alasan)";
        }

        $data['angket'] = $this->getAllData();

        $this->db->query($query);

        try {
            $this->db->beginTransaction();
            foreach ($data['angket'] as $key => $angket) {
                $_POSTMOD['nik'] = $dataPOST['nik'];
                $_POSTMOD['no'] = $angket['NO'];
                $_POSTMOD['jawaban'] = isset($_POST['angket_' . $angket['NO']]) ? $_POST['angket_' . $angket['NO']] : '';
                $_POSTMOD['alasan'] = isset($_POST['alasan_angket_' . $angket['NO'] . $_POSTMOD['jawaban']]) ? $_POST['alasan_angket_' . $angket['NO'] . $_POSTMOD['jawaban']] : '';
                $_POSTMOD['inputdate'] = strtoupper(date('d-M-y'));

                $this->db->executeOracle($_POSTMOD);
            }
            $this->db->commit();
        } catch (\Throwable $th) {
            $this->db->rollback();
            throw $th;
        }

        // $this->db->bind('nik', $data['nik']);
        // $this->db->bind('no', $data['no']);
        // $this->db->bind('jawaban', $data['jawaban']);
        // $this->db->bind('inputdate', date('dmY'));
        // $this->db->bind('alasan', $data['alasan']);
        // $this->db->executeOracle($data);

        return $this->db->rowCount();
    }

    public function check($nik)
    {
        $this->db->query("SELECT NIK FROM " . $this->tableJawaban . " WHERE NIK='" . $nik . "'");
        return $this->db->resultSet();
    }
}
