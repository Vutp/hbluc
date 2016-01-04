<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xem_ho_so extends CI_Controller {

	public function index()
	{
		$this->load->model('ho_so');
		$data['title'] = 'Hồ sơ chi tiết - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$query = $this->ho_so->search_ho_so($this->input->post('num_search'),
			100,0);

		if($query){
			$this->load->view('ho_so_view',array(
					'query'=>$query
				));
		}else{
			redirect(base_url('trang_chu'));//Ying
		}
		$this->load->view('templates/footer');

	}
	public function details($id=10)
	{
		$this->load->model('ho_so');
		$data['title'] = 'Hồ sơ chi tiết - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		//Get the name of procedure
		$q = $this->db->get('map');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}

		}

		$this->db->where('id', $id);
		$details = $this->db->get('ho_so')->row();
		if (!isset($details)) {
			redirect(base_url('trang_chu'));
		}
		$mshs = $details->mshs;
		$tp1 = substr($mshs,7,2);//day
		$tp2 = substr($mshs,9,2);//month
		$tp3 = substr($mshs,11,2);//year
		$so_ngay_giai_quyet=explode('-', $mshs);
		$sngq = substr($so_ngay_giai_quyet[3],0,2);
		$ngay_nhan = $tp2."/".$tp1."/20".$tp3;
		$time = strtotime($ngay_nhan);
		$ngay_nhan = date('d/m/Y',$time);//Ngay_nhan_cuoi_cung

		$ngay_nhan_function = date('Y-m-d');


		$ngay_tra = date('d/m/Y', strtotime($ngay_nhan_function."+".$sngq." days"));//ngay_tra_cuoi_cung

		$this->load->view('admin/ho_so_chi_tiet',array(
		'details'=>$details
		,'node_map'=>$data
		,'ngay_nhan'=>$ngay_nhan
		,'ngay_tra' =>$ngay_tra
		,'id', $id
		));
		$this->load->view('templates/footer');

	}
}
