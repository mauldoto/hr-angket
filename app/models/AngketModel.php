<?php

class AngketModel
{

    private $db;
    private $table = 'hr_angket';
    private $tableJawaban = 'hr_angket';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllData()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' order by NO');
        return $this->db->resultSet();
    }

    public function saveData($data)
    {
        // var_dump($data);
        $data['inputdate'] = null;
        $query = "INSERT INTO hr_angket_jawaban (NIK, NO, JAWABAN, INPUTDATE, ALASAN) 
				  VALUES(:nik, :no, :jawaban, :inputdate, :alasan)";

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
        $data['angket'] = $this->getAllData();

        $query = "INSERT INTO hr_angket_jawaban (NIK, NO, JAWABAN, INPUTDATE, ALASAN) 
				  VALUES(:nik, :no, :jawaban, :inputdate, :alasan)";

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
}
