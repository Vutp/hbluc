<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['name_user'])){

			redirect(base_url('trang_chu'));
		} else{

		}
	}
	public function index()
	{
		$data['title'] = 'Trang cá nhân - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->model('user');

		$this->load ->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$query = $this->db->get_where('user',
			array('name' => $_SESSION['name_user']),1,0);

		$this->load->view('admin/profile_view',array(
			'query'=>$query,
		
			));
		$this->load->view('templates/footer');

	}
public function view_nhan_su($id=1)
	{
		$data['title'] = 'Trang cá nhân - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->model('user');
		if((!isset($_SESSION['name_user']))||
			($_SESSION['level']!=100))
		{
			redirect(base_url('trang_chu'));
		}
		$query = $this->db->get_where('user',
			array('id' => $id),1,0);

		$this->load->view('admin/admin_profile_view',array(
			'query'=>$query,
		
			));
		$this->load->view('templates/footer');

	}	
public function check_upload_1()
	{

		$config_upload=array(
					'upload_path'=>'upload/',
					'allowed_types'=>'gif|jpg|png',
					'max_size'=>'250',
					'max_width'=>'1920',
					'max_height'=>'1080',
				);
		$this->load->library('upload',$config_upload);
		$check_file=FALSE;
		if(isset($_FILE['avatar']['error']) && $_FILE['avatar']['error']!=4){
			$check_file=TRUE;
		}
		if($check_file && !$this->upload->do_upload('avatar')){
			redirect('trang_chu');
		}else{
			$upload_data=$this->upload->data();
			if(isset($upload_data['file_name'])){
				//redirect('trang_chu');
				foreach ($upload_data as $item => $value){
					echo $item;
					echo'<br>';
					echo $value;

				}
echo anchor('admin/Profile', 'Upload Another File!');
				$data_file=$upload_data['file_name'];
			}
			
		}
	}
	public function check_upload()	{

		$config_upload=array(
					'upload_path'=>'upload/',
					'allowed_types'=>'gif|jpg|png',
					'max_size'=>'250',
					'max_width'=>'1920',
					'max_height'=>'1080',
				);

		$this->load->library('upload', $config_upload);

		if ( ! $this->upload->do_upload())
		{
echo "loi";
		}
		else
		{
			$upload_data=$this->upload->data();
			$this->db->where('id', $_SESSION['id']);
            $this->db->update('user',  array('avatar' => $upload_data['file_name']));
			redirect('admin/Profile');
		}

	}
	public function change_pass()
	{
		$this->load->model('user');
		$query = $this->db->get_where('user',
			array('name' => $_SESSION['name_user']),1,0);
		$res=$this->user->
				verify($_SESSION['name_user'],$this->input->post('old'));
		if($res!==FALSE){
			if ($this->input->post('new')!=$this->input->post('renew')){
				$error=1;
    			redirect(base_url('admin/profile/errorview/'.$error.''));
			}else{
				$newpass=sha1($this->input->post('new'));
				$data = array(
               'pass' => $newpass

            );

			$this->db->where('name', $_SESSION['name_user']);
			$this->db->update('user', $data);
			 $error=3;
			redirect(base_url('admin/profile/errorview/'.$error.''));
			}
		}else{
			$error=2;
    		redirect(base_url('admin/profile/errorview/'.$error.''));
		}


	}

	public function change_info_name()
	{
		$this->load->model('user');
        $this->form_validation->set_rules('hoten', 'Username', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $error = 7;
            redirect(base_url('admin/profile/errorview/'.$error.''));
        }
        else
        {
            $data = array(
                'hoten' => $this->input->post('hoten'),

            );
			$this->db->where('name', $_SESSION['name_user']);
            $this->db->update('user', $data);
         $error=8;
			redirect(base_url('admin/profile/errorview/'.$error.''));


        }

    }


	public function change_info_address()
	{
		$this->load->model('user');
        $this->form_validation->set_rules('dia_chi', 'Username', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $error = 7;
            redirect(base_url('admin/profile/errorview/'.$error.''));
        }
        else
        {
            $data = array(
                'dia_chi' => $this->input->post('dia_chi'),
            );
			$this->db->where('name', $_SESSION['name_user']);
            $this->db->update('user', $data);
            $error=8;
			redirect(base_url('admin/profile/errorview/'.$error.''));
        }

    }

public function change_info_phoneno()
	{
		$this->load->model('user');
        $this->form_validation->set_rules('Sdt', 'Username', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $error = 7;
            redirect(base_url('admin/profile/errorview/'.$error.''));
        }
        else
        {
            $data = array(
                'Sdt' => $this->input->post('Sdt'),
            );
			$this->db->where('name', $_SESSION['name_user']);
            $this->db->update('user', $data);
           $error=8;
			redirect(base_url('admin/profile/errorview/'.$error.''));
        }
    }

public function change_info_birthdate()
	{
		$this->load->model('user');
        $this->form_validation->set_rules('ngay_sinh', 'Username', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $error = 7;
            redirect(base_url('admin/profile/errorview/'.$error.''));
        }
        else
        {
            $data = array(
                'ngay_sinh' => $this->input->post('ngay_sinh'),

            );
			$this->db->where('name', $_SESSION['name_user']);
			$this->db->update('user', $data);
			$error=8;
			redirect(base_url('admin/profile/errorview/'.$error.''));
        }

	}

	public function change_name()
	{
		$this->load->model('user');
		$data = array(
               'name' => $this->input->post('namenew')
            );
		$check=$this->user->check_name($this->input->post('namenew'));
		if ($check){
			$this->db->where('name', $_SESSION['name_user']);
			$this->db->update('user', $data);
			$error=4;
			$_SESSION['name_user']= $this->input->post('namenew');
			redirect(base_url('admin/profile/errorview/'.$error.''));
		}else {
			$error=5;
			redirect(base_url('admin/profile/errorview/'.$error.''));
		}

	}
	public function errorview($e=1)
	{
		$data['title'] = 'Trang cá nhân - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->model('user');

		$query = $this->db->get_where('user',
			array('name' => $_SESSION['name_user']),1,0);
		if($e==2)$error="Sai mật khẩu";	
		if($e==1)$error="Mật khẩu mới không trùng nhau";	
		if($e==3)$error="Đã đổi mật khẩu";	
		if($e==4)$error="Đã đổi tên";
		if($e==5)$error="Đã có người sử dụng tên này";
        if($e==6)$error="Kiểm tra lại các thông tin đã nhập, thông tin nhập không được trống";
		if($e==7)$error="Thay đổi không thành công, mục cần điền không được để trống  ";
		if($e==8)$error="Đã thay đổi";
		$this->load->view('admin/profile_view',array(
			'query'=>$query,
			'error'=>$error
			));
		$this->load->view('templates/footer');

	}	
}