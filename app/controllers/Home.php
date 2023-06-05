<?php

class Home extends Controller
{
    public function index()
    {
        $data['title'] = 'HR Angket - isi angket';
        $data['angket'] = $this->model('AngketModel')->getAllData();
        $this->view('templates/header_new', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer_new');
    }

    public function input()
    {
        $data['angket'] = $this->model('AngketModel')->getAllData();
        foreach ($data['angket'] as $key => $angket) {
            $_POSTMOD['nik'] = $_POST['nik'];
            $_POSTMOD['no'] = $angket['NO'];
            $_POSTMOD['jawaban'] = isset($_POST['angket_' . $angket['NO']]) ? $_POST['angket_' . $angket['NO']] : '';
            $_POSTMOD['alasan'] = isset($_POST['alasan_angket_' . $angket['NO'] . $_POSTMOD['jawaban']]) ? $_POST['alasan_angket_' . $angket['NO'] . $_POSTMOD['jawaban']] : '';
            if ($this->model('AngketModel')->saveData($_POSTMOD) <= 0) {
                Flasher::setMessage('Failed,', 'Check your input', 'danger');
                header('location: ' . BASEURL . '/home');
                exit;
            }
        }

        Flasher::setMessage('Successfully', 'Created', 'success');
        header('location: ' . BASEURL . '/home');
        exit;
    }

    public function inputmultiple()
    {
        try {
            $this->model('AngketModel')->saveDataMultipleRow($_POST);
        } catch (\Throwable $th) {
            Flasher::setMessage('Failed,', 'Check your input', 'danger');
            header('location: ' . BASEURL . '/home');
            exit;
        }

        Flasher::setMessage('Successfully', 'Created', 'success');
        header('location: ' . BASEURL . '/home');
        exit;
    }

    public function select2()
    {
        $search = explode('=', $_SERVER['REQUEST_URI']);
        $results = $this->model('KaryawanModel')->getSearchData($search[1]);
        echo json_encode($results);
    }
}
