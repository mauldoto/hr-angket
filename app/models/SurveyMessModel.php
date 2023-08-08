<?php

class SurveyMessModel
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

        $_POSTMOD['inputdate'] = strtoupper(date('d-M-y'));
        $_POSTMOD['pelayanan'] = $data['saran'] == 'pelayanan' ? '1' : '0';
        $_POSTMOD['hidangan'] = $data['saran'] == 'hidangan' ? '1' : '0';
        $_POSTMOD['kebersihan'] = $data['saran'] == 'kebersihan' ? '1' : '0';
        $_POSTMOD['fasilitas'] = $data['saran'] == 'fasilitas' ? '1' : '0';
        $_POSTMOD['id'] = $data['kepuasan'];
        // $this->db->bind('nik', $data['nik']);
        // $this->db->bind('no', $data['no']);
        // $this->db->bind('jawaban', $data['jawaban']);
        // $this->db->bind('inputdate', date('dmY'));
        // $this->db->bind('alasan', $data['alasan']);
        $this->db->executeOracle($_POSTMOD);

        return $this->db->rowCount();
    }
}
