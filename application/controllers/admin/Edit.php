<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		if((!isset($_SESSION['name_user']))||
			($_SESSION['level']!=4)){
			redirect(base_url('trang_chu'));
		} else{

		}
	}
public function index()
	{
		$data['title'] = 'UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->model('Map');
		/*$this->load->library('table');*/
		$data = $this->Map->lay_ten_muc(1);
		$num = $this->Map->lay_id(1);
		$com = array_combine($num, $data);

		$this->load->view('admin/edit_view_pre',array(
			'com'=>$com,
		));
		$this->load->view('templates/footer');
	}
public function begin_edit()
	{
		$data['title'] = 'UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->model('Map');
		/*$this->load->library('table');
		$this->load->helper('form');*/
		$id_node=$this->input->post('name_select');

		$this->load->model('trinh_tu');//1
		$this->load->model('thoi_gian');//
		$this->load->model('cach_thuc');
		$this->load->model('thanh_phan');
		$this->load->model('giai_quyet');
		$this->load->model('doi_tuong');
		$this->load->model('co_quan');
		$this->load->model('ket_qua');
		$this->load->model('le_phi');
		$this->load->model('mau_don');
		$this->load->model('yeu_cau');
		$this->load->model('can_cu');


		/*$this->load->library('table');*/
		//$ret = $query->row($number);
		$this->db->where('node_id', $id_node);
		$node_map = $this->db->get('map')->row();
		$list_chi_tiet=$this->Map->lay_note($id_node);

		$trinh_tu_data=$this->trinh_tu->array_trans($list_chi_tiet[0]);
		$thoi_gian_data=$this->thoi_gian->array_trans($list_chi_tiet[1]);
		$cach_thuc_data=$this->cach_thuc->array_trans($list_chi_tiet[2]);
		$thanh_phan_data=$this->thanh_phan->array_trans($list_chi_tiet[3]);
		$thanh_phan_data_1=$this->thanh_phan->array_trans_1($list_chi_tiet[3]);

		$giai_quyet_data=$this->giai_quyet->array_trans($list_chi_tiet[4]);
		$doi_tuong_data=$this->doi_tuong->array_trans($list_chi_tiet[5]);
		$co_quan_data=$this->co_quan->array_trans($list_chi_tiet[6]);
		$ket_qua_data=$this->ket_qua->array_trans($list_chi_tiet[7]);
		$le_phi_data=$this->le_phi->array_trans($list_chi_tiet[8]);
		$mau_don_data=$this->mau_don->array_trans($list_chi_tiet[9]);
		$yeu_cau_data=$this->yeu_cau->array_trans($list_chi_tiet[10]);
		$can_cu_data=$this->can_cu->array_trans($list_chi_tiet[11]);

		$phan_muc=array(

			'h1' => '1/ Trình tự thực hiện:',
			'h2'=>'2/ Thời gian tiếp nhận hồ sơ và trả kết quả:',
			'h3' => '3/ Cách thức thực hiện:',
			'h4' => '4/ Thành phần, số lượng hồ sơ:',
			'h4_1' => 'a) Thành phần hồ sơ bao gồm:',
			'h4_2' => 'b) Số lượng hồ sơ:',
			'h5' => '5/ Thời hạn giải quyết:',
			'h6' => '6/ Đối tượng thực hiện thủ tục hành chính:',
			'h7' => '7/ Cơ quan thực hiện thủ tục hành chính:',
			'h8' => '8/ Kết quả thực hiện thủ tục hành chính:',
			'h9' => '9/ Phí, lệ phí:',
			'h10' => '10/ Tên mẫu đơn, mẫu tờ khai:',
			'h11' => '11/ Yêu cầu, điều kiện thực hiện thủ tục hành chính:',
			'h12' => '12/ Căn cứ pháp lý của thủ tục hành chính:',

		);


		$this->load->view('admin/edit_view',array(
			'id_node'=>$id_node
		,'node_map'=>$node_map

		,'trinh_tu_data'=>$trinh_tu_data
		,'thoi_gian_data'=>$thoi_gian_data
		,'cach_thuc_data'=>$cach_thuc_data
		,'thanh_phan_data'=>$thanh_phan_data
		,'thanh_phan_data_1'=>$thanh_phan_data_1
		,'giai_quyet_data'=>$giai_quyet_data
		,'doi_tuong_data'=>$doi_tuong_data
		,'co_quan_data'=>$co_quan_data
		,'ket_qua_data'=>$ket_qua_data
		,'le_phi_data'=>$le_phi_data
		,'mau_don_data'=>$mau_don_data
		,'yeu_cau_data'=>$yeu_cau_data
		,'can_cu_data'=>$can_cu_data


		));
		$this->load->view('templates/footer');
	}
public function edit_thu_tuc($id_node=2)
	{
		$data['title'] = 'UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->model('Map');
		$this->load->model('mau_don');
		/*$this->load->library('table');*/
		$data = $this->Map->lay_ten_muc(1);
		$num = $this->Map->lay_id(1);
		$com = array_combine($num, $data);
		//$id_node=$this->input->post('publication_id');


		/*$this->load->library('form_validation');*/
		$this->form_validation->set_rules(array(
			array(
				'field'=>'publication_id',
				'label'=>'name yeu cau',
				'rules'=>'required',
			),


		));
		$this->form_validation->set_error_delimiters('<div class="alert alert-success">','</div>');
		$this->load->model('trinh_tu');//1
		$this->load->model('thoi_gian');//
		$this->load->model('cach_thuc');
		$this->load->model('thanh_phan');
		$this->load->model('giai_quyet');
		$this->load->model('doi_tuong');
		$this->load->model('co_quan');
		$this->load->model('ket_qua');
		$this->load->model('le_phi');
		$this->load->model('mau_don');
		$this->load->model('yeu_cau');
		$this->load->model('can_cu');


		$trinh_tu=new trinh_tu();
		$thoi_gian=new thoi_gian();
		$cach_thuc=new cach_thuc();
		$thanh_phan=new thanh_phan();
		$giai_quyet=new giai_quyet();
		$doi_tuong=new doi_tuong();
		$co_quan=new co_quan();
		$ket_qua=new ket_qua();
		$le_phi=new le_phi();
		$mau_don=new mau_don();
		$yeu_cau=new yeu_cau();
		$can_cu=new can_cu();

		$trinh_tu->noi_dung=$this->input->post('trinh_tu');
		$thoi_gian->noi_dung=$this->input->post('thoi_gian');
		$cach_thuc->noi_dung=$this->input->post('cach_thuc');
		$thanh_phan->noi_dung=$this->input->post('thanh_phan');
		$thanh_phan->note=$this->input->post('thanh_phan_note');
		$giai_quyet->noi_dung=$this->input->post('giai_quyet');

		$doi_tuong->noi_dung=$this->input->post('doi_tuong');
		$co_quan->noi_dung=$this->input->post('co_quan');
		$ket_qua->noi_dung=$this->input->post('ket_qua');
		$le_phi->noi_dung=$this->input->post('le_phi');

		$mau_don->noi_dung=$this->input->post('mau_don');
		$yeu_cau->noi_dung=$this->input->post('yeu_cau');
		$can_cu->noi_dung=$this->input->post('can_cu');


		$list_chi_tiet=$this->Map->lay_note($id_node);
		//if(($this->form_validation->run())
		if(!$this->trinh_tu->is_match($trinh_tu->noi_dung)){
			$this->trinh_tu->add_edit($trinh_tu->noi_dung,
				$list_chi_tiet[0],$id_node);
		}else
			$this->trinh_tu->edit_edit($trinh_tu->noi_dung,$list_chi_tiet[0],$id_node);


		if(!$this->thoi_gian->is_match($thoi_gian->noi_dung)){
			$this->thoi_gian->add_edit($thoi_gian->noi_dung,
				$list_chi_tiet[1],$id_node);
		}else
			$this->thoi_gian->edit_edit($thoi_gian->noi_dung,$list_chi_tiet[1],$id_node);


		if(!$this->cach_thuc->is_match($cach_thuc->noi_dung)){
			$this->cach_thuc->add_edit($cach_thuc->noi_dung,
				$list_chi_tiet[2],$id_node);
		}else
			$this->cach_thuc->edit_edit($cach_thuc->noi_dung,$list_chi_tiet[2],$id_node);

		if(!$this->thanh_phan->is_match($thanh_phan->noi_dung,$thanh_phan->note)){
			$this->thanh_phan->add_edit($thanh_phan->noi_dung,$thanh_phan->note,
				$list_chi_tiet[3]);
		}else
			$this->thanh_phan->edit_edit($thanh_phan->noi_dung,$list_chi_tiet[3]);


		if(!$this->giai_quyet->is_match($giai_quyet->noi_dung)){
			$this->giai_quyet->add_edit($giai_quyet->noi_dung,
				$list_chi_tiet[4],$id_node);
		}else
			$this->giai_quyet->edit_edit($giai_quyet->noi_dung,$list_chi_tiet[4],$id_node);


		if(!$this->doi_tuong->is_match($doi_tuong->noi_dung)){
			$this->doi_tuong->add_edit($doi_tuong->noi_dung,
				$list_chi_tiet[5],$id_node);
		}else
			$this->doi_tuong->edit_edit($doi_tuong->noi_dung,$list_chi_tiet[5],$id_node);


		if(!$this->co_quan->is_match($co_quan->noi_dung)){
			$this->co_quan->add_edit($co_quan->noi_dung,
				$list_chi_tiet[6],$id_node);
		}else
			$this->co_quan->edit_edit($co_quan->noi_dung,$list_chi_tiet[6],$id_node);


		if(!$this->ket_qua->is_match($ket_qua->noi_dung)){
			$this->ket_qua->add_edit($ket_qua->noi_dung,
				$list_chi_tiet[7],$id_node);
		}else
			$this->ket_qua->edit_edit($ket_qua->noi_dung,$list_chi_tiet[7],$id_node);


		if(!$this->le_phi->is_match($le_phi->noi_dung)){
			$this->le_phi->add_edit($le_phi->noi_dung,
				$list_chi_tiet[8],$id_node);
		}else
			$this->le_phi->edit_edit($le_phi->noi_dung,$list_chi_tiet[8],$id_node);



		if(!$this->mau_don->is_match($mau_don->noi_dung)){
			$this->mau_don->add_edit($mau_don->noi_dung,
				$list_chi_tiet[9],$id_node);
		}else
			$this->mau_don->edit_edit($mau_don->noi_dung,$list_chi_tiet[9],$id_node);


		if(!$this->yeu_cau->is_match($yeu_cau->noi_dung)){
			$this->yeu_cau->add_edit($yeu_cau->noi_dung,
				$list_chi_tiet[10],$id_node);
		}else
			$this->yeu_cau->edit_edit($yeu_cau->noi_dung,$list_chi_tiet[10],$id_node);



		if(!$this->can_cu->is_match($can_cu->noi_dung)){
			$this->can_cu->add_edit($can_cu->noi_dung,
				$list_chi_tiet[11],$id_node);
		}else
			$this->can_cu->edit_edit($can_cu->noi_dung,$list_chi_tiet[11],$id_node);



		$val= $list_chi_tiet[0].'/';
		for($i=1;$i<12;$i++)$val=$val.''. $list_chi_tiet[$i].'/';

		$data_up = array(
			'note' => $val,

		);

		$this->db->where('node_id', $id_node);
		$this->db->update('map', $data_up);

		redirect(base_url('trang_chu'));
	}
}