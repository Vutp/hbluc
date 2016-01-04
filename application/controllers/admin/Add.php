<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if((!isset($_SESSION['name_user']))||
			($_SESSION['level']!=4)){
			redirect(base_url('trang_chu'));
		} else{

		}
	}
	public function index(){

		$data['title'] = 'UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->view('admin/add_view');

		$this->load->view('templates/footer');
	}
	public function add_thu_tuc(){

			$this->load->model('Map');
			/*$this->load->library('table');*/
 			$data = $this->Map->lay_ten_muc(); 
 			$num = $this->Map->lay_id(); 
			$com = array_combine($num, $data);

		/*$this->load->library('form_validation');*/
		$this->form_validation->set_rules(array(
			array(
				'field'=>'name_thu_tuc',
				'label'=>'name thu tuc',
				'rules'=>'required',
						),


			));
		$this->form_validation->set_error_delimiters('<div class="alert alert-success">','</div>');
		$this->load->model('map');
		$yeu_cau=new map();
			//$issue->publication_id=$this->input->post('publication_id');
		$yeu_cau->node_name=$this->input->post('name_thu_tuc');
		if($this->form_validation->run())
			if(!$this->map->is_match($yeu_cau->node_name)){
			$yeu_cau_array=array(
		
				'node_name'=>$yeu_cau->node_name,
				'p_id'=>1,	
				'note'=>'2/2/2/2/2/2/2/2/2/2/2/2',							
						);
			$this->db->insert('map',$yeu_cau_array);

		}
			
			redirect(base_url('admin/edit'));
	}
}