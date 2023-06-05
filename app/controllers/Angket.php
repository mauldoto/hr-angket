<?php

class Angket extends Controller
{
    public function index()
    {
        $data['title'] = 'HR Angket - isi angket';
        $data['angket'] = $this->model('AngketModel')->getAllData();
        $this->view('templates/header_new', $data);
        $this->view('department/isi_angket', $data);
        $this->view('templates/footer_new');
    }

    public function create()
    {
        $data['rdata'] = $this->model('Department_model')->getMaxID();
        $maxID =  $data['rdata']['deptId'] + 1;

        if ($this->model('Department_model')->saveData($maxID, $_POST) > 0) {
            Flasher::setMessage('New Department Successfully', 'Created', 'success');
            header('location: ' . BASEURL . '/department');
            exit;
        } else {
            Flasher::setMessage('Failed,', 'Check your input', 'danger');
            header('location: ' . BASEURL . '/department');
            exit;
        }
    }
}
