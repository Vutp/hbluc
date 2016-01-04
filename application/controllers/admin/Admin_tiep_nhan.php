<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_tiep_nhan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if((!isset($_SESSION['name_user']))||
			(($_SESSION['level']!=12)&&
				($_SESSION['level']!=11)))
		{
			redirect(base_url('trang_chu'));
		}

	}
	public function index(){
		$this->load->model('Ho_so');
		//$this->load->model('Map');
		//$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		//if(!is_numeric($page)){$page = 0;}
		$data['title'] = 'Hồ sơ đã nhận - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');

	//	$config_pagination['base_url'] = base_url('admin/Admin_tiep_nhan');
	//	$this->Map->set_pagination($config_pagination);

		$query = $this->Ho_so->lay_ho_so_all($_SESSION['ma_can_bo'], 11);
		//$query1 = $this->Ho_so->lay_ho_so($_SESSION['ma_can_bo'], $_SESSION['level'],$config_pagination['per_page'],$page);
		if($query){
			//$config_pagination['total_rows'] =$query->num_rows();
			//$this->pagination->initialize($config_pagination);
			$this->load->view('admin/tiep_nhan_view',array(
				'query'=>$query
				));
		}

		$this->load->view('templates/footer');
	}
	public function edit_stt($id=3,$cmnd=0){

		$this->load->model('Ho_so');
		/* Kiet */
		$this->db->where('id', $id);
		$q = $this->db->get('ho_so')->result();
		$myString = $q[0]->lich_su_ho_so."/".$q[0]->mcb;


		/*   End   */

		$this->db->where('id', $id);
		$this->db->update('ho_so',  array(
			'status' => 1,
			'lich_su_ho_so'=>$myString
		));
		$this->load->model('Gcm_model');
  		$selUsers =$cmnd;
		$greetMsg = 'Hồ sơ của bạn đang chờ xử lý';
		$respJson =  '{"greetMsg":"'.$greetMsg.'"}';
		$registation_ids = array();

		$this->db->where('cmnd', $selUsers);
 		$query = $this->db->get('gcm_user'); 
		$registation_ids = array();	
		foreach ($query->result() as $row){
		$registation_ids[0]=$row->gcmregid;
		}			  

	// JSON Msg to be transmitted to selected Users
		$message = array("m" => $respJson);  
		$pushsts = $this->Gcm_model->sendPushNotificationToGCM($registation_ids, $message); 

		redirect('admin/admin_tiep_nhan');
	}
	public function  deleteRow($id=2){
		$this->db->delete('ho_so',array('id'=>$id));
		redirect('admin/admin_tiep_nhan');
	}
	public function nhan_lai($id=2){
		$this->db->get('ho_so');
		$this->db->where('id', $id);
		$this->db->update('ho_so',  array(
			'status' => 0,
			'mcb'=>$_SESSION['ma_can_bo']
			// cộng thêm cột num_error
			
		));
		redirect(base_url('admin/Admin_tiep_nhan'));
	}
	public function edit($id=2){

		$this->db->where('id', $id);
		$details = $this->db->get('ho_so')->row();
		if (!isset($details)) {
			redirect(base_url('admin/admin_tiep_nhan'));
		}

		$this->form_validation->set_message('required', '%s chưa cập nhật.');
		$this->form_validation->set_message('min_length', '%s: It nhất là %s kí tự.');
		$this->form_validation->set_message('max_length', '%s: Nhiều nhất là %s kí tự.');

		$this->form_validation->set_error_delimiters('<div class="error">','</div>');

		$this->form_validation->set_rules('dname', 'Tên người dân ', 'required|min_length[3]|max_length[20]');
		$this->form_validation->set_rules('dcmnd', 'CMND', 'required|callback_regex_check');
		$this->form_validation->set_rules('dmobile', 'Số điện thoại ', 'required|min_length[10]|max_length[11]');
		$this->form_validation->set_rules('songay', 'Số ngày', 'required');

		$data['title'] = 'Hồ sơ đã nhận - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		if($this->form_validation->run() == false) {
			$this->load->view('admin/sua_ho_so_view', array(
				'details' => $details,
			));
		}else{
			$data1['message'] = 'Du lieu duoc nhap thanh cong';
			$this->load->model('Ho_so');
			$this->db->where('id', $id);
			$this->db->update('ho_so',  array(
				'name' => $this->input->post('dname'),
				'cmnd' => $this->input->post('dcmnd'),
				'sdt' => $this->input->post('dmobile'),
				'mshs' => $this->input->post('ma_Ho_So'),
				'dia_chi'=>$this->input->post('diachi'),
				'note'=>$this->input->post('note')

			));

			$this->load->view('admin/sua_ho_so_view', array(
					'details' => $details,
					'message'=>$data1['message']
			));

		}
		$this->load->view('templates/footer');
	}
	public function regex_check($str)
	{

		if (preg_match("/^[0-9]{9}$|^[0-9]{12}$/", $str, $matches) !== 1) {
			$this->form_validation->set_message('regex_check', ' Số %s có 9 hoặc 12 chữ số.');
			return FALSE;
		} else {
				return TRUE;
		}

	}
}