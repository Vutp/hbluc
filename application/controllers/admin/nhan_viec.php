<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nhan_viec extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ((!isset($_SESSION['name_user'])) ||
            (
                ($_SESSION['level'] != 11) &&
                ($_SESSION['level'] != 12) &&
                ($_SESSION['level'] != 13) &&
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
        $data2 = $this->Cong_viec->get_cong_viec_da_nhan();
        $data['title'] = 'Giao công việc  - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $this->load->view('admin/nhan_cong_viec_view',array('data2'=>$data2));
        $this->load->view('templates/footer');
    }

    public function updateCongViec(){
        $id = $_POST['id'];
        $data = array(
            'status' => $_POST['status']
            ,'phan_tram'=>$_POST['percent']
        );

        $this->db->where('id',$id);
        $this->db->update('calendar',$data);

        echo "success";


        //echo "sussess";
    }





}
