<?php

class SurveyTamuModel
{

    private $db;
    private $table = 'hr_kepuasanpelanggan';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function saveData($data)
    {
        $query = "INSERT INTO hr_kepuasanpelanggan (TANGGAL, PELAYANAN, HIDANGAN, KEBERSIHAN, FASILITAS, ID) 
        VALUES(:inputdate, :pelayanan, :hidangan, :kebersihan, :fasilitas, :id)";

        $this->db->query($query);

        $_POSTMOD['inputdate'] = date("dmY");
        $_POSTMOD['pelayanan'] = $data['pelayanan'];
        $_POSTMOD['hidangan'] = $data['hidangan'];
        $_POSTMOD['kebersihan'] = $data['kebersihan'];
        $_POSTMOD['fasilitas'] = $data['fasilitas'];
        $_POSTMOD['id'] = time();

        // $this->db->bind('inputdate', strtoupper(date('d-M-y')));
        // $this->db->bind('pelayanan', $data['pelayanan']);
        // $this->db->bind('hidangan', $data['hidangan']);
        // $this->db->bind('kebersihan', date('kebersihan'));
        // $this->db->bind('fasilitas', $data['fasilitas']);
        // $this->db->bind('ids', $this->createIds() + 1);
        $this->db->executeOracle($_POSTMOD);

        return $this->db->rowCount();
    }
}
