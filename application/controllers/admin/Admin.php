<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index()
	{
		$data['title'] = 'Đăng nhập - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		if (isset($_SESSION['name_user'])){
			redirect(base_url('admin/Profile'));
		}
			/*$this->load->helper('form');
			$this->load->library('form_validation');*/
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">','</div>');
			$this->form_validation->set_rules('name','Tên','required');
			$this->form_validation->set_rules('pass','Mật khẩu','required');
			$this->form_validation->set_message('required', '%s chưa nhập.');
			if($this->form_validation->run()){

			$this->load->model('user');
			$res=new user();
			$res=$this->user->
				verify($this->input->post('name'),$this->input->post('pass'));
				if($res!==FALSE){
				$_SESSION['name_user']=$this->input->post('name');
				$query = $this->db->get('user');

    			foreach($query->result_array() as $row){
    			if ($row['name']==$_SESSION['name_user']) {
					$level = $row['level'];
					$ma_can_bo = $row['ma_can_bo'];
					$id_user = $row['id'];
					$avatar = $row['avatar'];
				}
        		}
				$_SESSION['level']=$level;
				$_SESSION['ma_can_bo'] = $ma_can_bo;
                $_SESSION['id'] = $id_user;
                $_SESSION['avatar'] = $avatar;
                //$this->db->where('id', $id_user);
                //$this->db->update('user',  array('online' => 1));
				redirect(base_url('admin/Profile'));


				}else{

					$data["error"]="Sai tên đăng nhập hoặc sai mật khẩu";
    				
				}

			}else{

			}
			$this->load->view('admin/login_form',$data);
			$this->load->view('templates/footer');

	}
		public function logout()
	{
		session_destroy();
		redirect(base_url('trang_chu'));
	}
		public function delete($id=1)
	{
		if((!isset($_SESSION['name_user']))
			||($_SESSION['level']!=100)){
			redirect(base_url('trang_chu'));
		}
		$this->load->model('user');
		$this->db->delete('user', array('id' => $id));
		redirect(base_url('admin/quan_ly_nhan_su'));
	}
}