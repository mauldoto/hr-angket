<?php

class Tamu extends Controller
{
    public function index()
    {
        $this->view('templates/header_tamu');
        $this->view('tamu/index_v2');
        $this->view('templates/footer_tamu');
    }

    public function input()
    {
        $data = json_decode($_POST['submited_data'], true);
        if (count($data) < 4) {
            Flasher::setMessage('failed', 'Semua kategori belum diberi penilaian', 'danger');
            header('location: ' . BASEURL . '/tamu');
            exit;
        }

        if ($this->model('SurveyTamuModel')->saveData($data) <= 0) {
            Flasher::setMessage('Failed,', 'Check your input', 'danger');
            header('location: ' . BASEURL . '/tamu');
            exit;
        }

        Flasher::setMessage('Successfully', 'Created', 'success');
        header('location: ' . BASEURL . '/tamu');
        exit;
    }
}
