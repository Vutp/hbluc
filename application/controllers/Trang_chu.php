<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Trang_chu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $data['title'] = 'UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $this->load->model('Map');
        $data = $this->Map->lay_ten_muc(0);
        $num = $this->Map->lay_id(0);
        $com = array_combine($num, $data);
        $this->load->view('container',array('com'=>$com));
         if(isset($_SESSION['name_user'])){
            $this->load->model('User');
            $dataname = $this->User->lay_ten_user($_SESSION['id']);
            $idchat = $this->User->lay_id_user($_SESSION['id']); 
            $datachat = array_combine($idchat, $dataname);
            $this->load->view('templates/sideright',array('datachat'=>$datachat));
        }
        else $this->load->view('templates/sideright');
        $this->load->view('templates/footer');
    }
}