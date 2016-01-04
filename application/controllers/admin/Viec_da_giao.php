<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viec_da_giao extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ((!isset($_SESSION['name_user'])) ||
            (
                ($_SESSION['level'] != 100) &&
                ($_SESSION['level'] != 21) &&
                ($_SESSION['level'] != 22)
            )
        ) {
            redirect(base_url('trang_chu'));
        }

    }

    public function index()
    {
        $this->load->model('Cong_viec');
        $data2 = $this->Cong_viec->get_cong_viec($_SESSION['ma_can_bo']);
        $data['title'] = 'Giao công việc  - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $this->load->view('admin/cong_viec_da_giao',array('data2'=>$data2));
        $this->load->view('templates/footer');
    }



}
