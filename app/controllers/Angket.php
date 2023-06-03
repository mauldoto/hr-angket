<?php

class Angket extends Controller
{
    public function index()
    {
        $data['title'] = 'IT Asset - Maintain Department';
        $data['menu'] = 'Department';
        $data['menu-dsc'] = 'Maintain Department';
        $data['rdata'] = $this->model('Department_model')->getAllDept();
        $this->view('templates/header_a', $data);
        $this->view('department/department-list', $data);
        $this->view('templates/footer_a');
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
