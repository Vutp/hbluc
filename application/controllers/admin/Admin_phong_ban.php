<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_phong_ban extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if((!isset($_SESSION['name_user']))||
			(($_SESSION['level']!=21)&&
			($_SESSION['level']!=22))){
			redirect(base_url('trang_chu'));
		}
	}
	public function index()
	{
		$this->load->model('Ho_so');

		$data['title'] = 'Hồ sơ xử lý - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$query = $this->Ho_so->lay_ho_so_all($_SESSION['ma_can_bo'], $_SESSION['level']);
 		$this->load->view('admin/phong_ban_view',array('query'=>$query,'level'=>$_SESSION['level']));
		$this->load->view('templates/footer');
	}
	public function edit($id=3,$cmnd=9){
	if ($cmnd!=999999999){
		$this->db->where('id', $id);
	
		$this->db->update('ho_so',  array(
               'status' => 2
		,'mcb'=>$_SESSION['ma_can_bo']
            ));
		}
		$this->load->model('Gcm_model');
  		$selUsers =$cmnd;
		$greetMsg = 'Hồ sơ của bạn đang được xử lý';
		$respJson =  '{"greetMsg":"'.$greetMsg.'","id":"'.$id.'"}';
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

	redirect(base_url('admin/admin_phong_ban'));
	}

	public function notifyError($id=3,$cmnd=9){

		//$id = $this->input->post('node_id');
		
		$val= $this->input->post('ten_rieng_0').'+'.$this->input->post('loi_rieng_0').'+';
		for ($i = 2;$i<$this->input->post('count')-1;$i++ ) {
			$val=$val.''.$this->input->post('ten_rieng_'.$i.'').'+'.$this->input->post('loi_rieng_'.$i.'').'+';
			$i++;
			}
		$val=$val.'-'.$this->input->post('error');	
		if ($cmnd!=999999998){
			/* Kiet*/
			$this->db->where('id', $id);
			$q = $this->db->get('ho_so')->result();
			$myString = $q[0]->lich_su_ho_so."/".$q[0]->mcb;
			$myNumerrors = $q[0]->num_error + 1;
			/*End*/

		$this->db->where('id', $id);
		
		$this->db->update('ho_so',array(
			'error'=>$val,
			'status'=>6,
			'lich_su_ho_so'=>$myString,
			'num_error'=>$myNumerrors
		));
		}
		$this->load->model('Gcm_model');
  		$selUsers =$cmnd;
		$greetMsg = 'Hồ sơ của bạn có lỗi';
		$respJson =  '{"greetMsg":"'.$greetMsg.'","id":"'.$id.'"}';
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

	redirect(base_url('admin/admin_phong_ban'));
	}
	public function edit_stt($id=3,$cmnd=9){
	if ($cmnd!=999999998){

		$this->db->where('id', $id);
		$q = $this->db->get('ho_so')->result();
		$myString = $q[0]->lich_su_ho_so."/".$q[0]->mcb;

	$this->db->where('id', $id);
	
	$this->db->update('ho_so',  array(
               'status' => 3
				,'lich_su_ho_so'=>$myString
            ));
}
		$this->load->model('Gcm_model');
  		$selUsers =$cmnd;
		$greetMsg = 'Hồ sơ của bạn đã xử lý xong';
		$respJson =  '{"greetMsg":"'.$greetMsg.'","id":"'.$id.'"}';
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

	redirect(base_url('admin/admin_phong_ban'));
	}
}