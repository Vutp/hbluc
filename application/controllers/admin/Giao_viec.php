<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giao_viec extends CI_Controller
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
        $data1 = $this->Cong_viec->get_users($_SESSION['level'],$_SESSION['ma_can_bo']);
        $my_phong_ban = $this->Cong_viec->my_phong_ban($data1);
        $data['title'] = 'Giao công việc  - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $this->load->view('admin/giao_cong_viec_view',array('data1'=>$data1,'my_phong_ban'=>$my_phong_ban));
        $this->load->view('templates/footer');
    }



    public function addCongViec(){

        $data1 = array(
        'title'=>$_POST['myTitle']
        ,'startdate'=>$_POST['startDate']
        ,'enddate'=>$_POST['endDate']
        ,'ma_can_bo_giao'=>$_SESSION['ma_can_bo']
        ,'ma_can_bo_nhan'=>$_POST['mcbNhan']
        ,'status'=>$_POST['status']
        );

        $this->db->insert('calendar',$data1);
        echo "ok";


    }



    public function xoaCongViec(){
        $deletedID = $_POST['id'];
        $this->db->where('id',$deletedID);
        $this->db->delete('calendar');
    }

    public function xoaTatCaTheoMaCanBo(){
        $deletedAllmcb = $_POST['mcb'];

        $where1 = " ma_can_bo_giao = '$deletedAllmcb' AND status = 0 ";
        $where2 = " ma_can_bo_giao = '$deletedAllmcb' AND status = 3 ";
        $where = "$where1 OR $where2";

        $this->db->where($where);
        $this->db->delete('calendar');
    }





}
