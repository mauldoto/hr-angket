<?php

class Mess extends Controller
{
    public function index()
    {
        $this->view('templates/header_mess');
        $this->view('mess/index_v2');
        $this->view('templates/footer_mess');
    }

    public function input()
    {
        $data = json_decode($_POST['submited_data'], true);
        if (count($data) < 4) {
            Flasher::setMessage('failed', 'Semua kategori belum diberi penilaian', 'danger');
            header('location: ' . BASEURL . '/mess');
            exit;
        }

        if ($this->model('SurveyMessModel')->saveData($data) <= 0) {
            Flasher::setMessage('Failed,', 'Check your input', 'danger');
            header('location: ' . BASEURL . '/mess');
            exit;
        }

        Flasher::setMessage('Successfully', 'Created', 'success');
        header('location: ' . BASEURL . '/mess');
        exit;
    }
}
