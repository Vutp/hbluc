<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_tra_ho_so extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if((!isset($_SESSION['name_user']))||
			(($_SESSION['level']!=12)&&
				($_SESSION['level']!=13))){
			redirect(base_url('trang_chu'));
		}
	}

	public function index()
	{
		$this->load->model('Ho_so');
		$data['title'] = 'Hồ sơ trả dân - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$query = $this->Ho_so->lay_ho_so_all($_SESSION['ma_can_bo'],13);
		$this->load->view('admin/tra_hs_view',array(
			'query'=>$query,

		));
		$this->load->view('templates/footer');
	}
	public function edit($id=1){
		$this->load->model('Ho_so');
		$this->db->where('id', $id);
		$this->db->update('ho_so',  array(
			'status' => 4,
			'mcb'=>$_SESSION['ma_can_bo'],
		));
		redirect(base_url('admin/admin_tra_ho_so'));
	}

	public function edit_error($id=1){
		$this->load->model('Ho_so');
		$this->db->where('id', $id);
		$this->db->update('ho_so',  array(
			'status' => 7,
			'mcb'=>$_SESSION['ma_can_bo'],
		));
		redirect(base_url('admin/admin_tra_ho_so'));
	}



	public function edit_stt($id=3){

		$ngay_tra = date("d/m/Y");
		$this->db->where('id', $id);
		$this->db->update('ho_so',  array(
			'status' => 5,

			'ngay_tra'=>$ngay_tra
		));
		redirect(base_url('admin/admin_tra_ho_so'));
	}

	public function edit_stt_error($id=3){

		$ngay_tra = date("d/m/Y");
		$this->db->where('id', $id);
		$this->db->update('ho_so',  array(
			'status' => 8,

			'ngay_tra'=>$ngay_tra
		));
		redirect(base_url('admin/admin_tra_ho_so'));
	}
}