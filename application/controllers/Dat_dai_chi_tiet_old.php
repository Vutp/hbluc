<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dat_dai_chi_tiet extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index($number=2)
	{
		$data['title'] = 'Hành chính trong lĩnh vực đất đai - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->model('Map');
		$this->load->model('Ho_so');
		$this->load->model('thanh_phan');
		//$ret = $query->row($number);
		$this->db->where('node_id', $number);
		$node_map = $this->db->get('map')->row();
		if (!isset($node_map)) {
			$this->db->where('node_id', 33);
			$node_map = $this->db->get('map')->row();
		}
		$list_chi_tiet=$this->Map->lay_note($number);
		$thanh_phan_data=$this->thanh_phan
		->array_trans($list_chi_tiet[0]);
		if (count($list_chi_tiet)!=1)
			redirect(base_url('trang_chu'));
		if((!isset($_SESSION['name_user']))||
			(($_SESSION['level']!=12)&&
				($_SESSION['level']!=11))){//Neu la tp ngoai

			$this->load->view('dat_dai_chi_tiet_view',array(
				'node_map' =>$node_map
			,'thanh_phan_data'=>$thanh_phan_data

			));

		} else{

			$this->load->model('Ho_so');
			$this->form_validation->set_message('required', '%s chưa nhập.');
			$this->form_validation->set_message('min_length', '%s: It nhất là %s kí tự.');
			$this->form_validation->set_message('max_length', '%s: Nhiều nhất là %s kí tự.');
			$this->form_validation->set_error_delimiters('<span class="error">','</span>');
			$this->form_validation->set_rules('dname', 'Tên người dân ', 'required|min_length[3]|max_length[20]');
			$this->form_validation->set_rules('dcmnd', 'CMND', 'required|callback_regex_check');
			$this->form_validation->set_rules('dmobile', 'Số điện thoại ', 'required|min_length[10]|max_length[11]');
			$this->form_validation->set_rules('songay', 'Số ngày', 'required');

			if($this->form_validation->run() == false) {
				$this->load->view('admin/dat_dai_chi_tiet_admin_view'
					,array(
						'node_map'=>$node_map
					,'thanh_phan_data'=>$thanh_phan_data
					));

			}else{


				$myThuTuc =  $this->input->post('dying');

				$myThuTuc = str_replace(',','', $myThuTuc); // Replaces , by nothing
				$data1 = array(
					'name' => $this->input->post('dname'),
					'cmnd' => $this->input->post('dcmnd'),
					'sdt' => $this->input->post('dmobile'),
					'mshs' => $this->input->post('ma_Ho_So'),
					'dia_chi'=>$this->input->post('diachi'),
					'tt_giay_to_da_thu' =>$myThuTuc,
					'status'=> 0,
					'type'=> 1,
					'note'=>$this->input->post('note'),
					'mcb'=> $_SESSION['ma_can_bo']
				);
				//Truyen du lieu sang co model
				$this->Ho_so->add_ho_so($data1);
				$data1['message'] = 'Du lieu duoc nhap thanh cong';
				$this->load->view('admin/dat_dai_chi_tiet_admin_view'
					,array(
					'node_map'=>$node_map
					,'thanh_phan_data'=>$thanh_phan_data
					,'message'=>$data1['message']
					));
			}

		}
		$this->load->view('templates/footer');
	}
	public function regex_check($str){

				if(preg_match("/^[0-9]{9}$|^[0-9]{12}$/",$str,$matches)!==1){
						$this->form_validation->set_message('regex_check', ' Số %s có 9 hoặc 12 chữ số.');
						return FALSE;
		}else{
						return TRUE;
		}

	}
}