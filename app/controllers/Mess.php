<?php

class Mess extends Controller
{
    public function index()
    {
        $this->view('templates/header_mess');
        $this->view('mess/index');
        $this->view('templates/footer_mess');
    }

    public function input()
    {

        if (!$_POST['kepuasan']) {
            Flasher::setMessage('failed', 'Pilih salah satu opsi', 'danger');
            header('location: ' . BASEURL . '/mess');
            exit;
        }

        if ($this->model('SurveyMessModel')->saveData($_POST) <= 0) {
            Flasher::setMessage('Failed,', 'Check your input', 'danger');
            header('location: ' . BASEURL . '/mess');
            exit;
        }

        Flasher::setMessage('Successfully', 'Created', 'success');
        header('location: ' . BASEURL . '/mess');
        exit;
    }
}
