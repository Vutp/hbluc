<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tu_phap_chi_tiet extends CI_Controller {
  public function __construct()
  {
    parent::__construct();

  }
  public function index($name=1,$number=2)
  {
    /*header('Content-Type: text/html; charset=utf-8');
    ini_set('default_charset', 'utf-8');*/
    $data['title'] = 'Hành chính tư pháp - UBND Huyện Bến Lức';
    $this->load->view('templates/header', $data);
    $this->load->view('templates/aside');
    $this->load->view('templates/nav');
    $this->load->model('Map');

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

    $this->db->where('node_id', $number);
    $node_map = $this->db->get('map')->row();
    if (!isset($node_map)) {
      $this->db->where('node_id', 2);
      $node_map = $this->db->get('map')->row();
    }
    $list_chi_tiet=$this->Map->lay_note($number);
    if (count($list_chi_tiet)!=13)
      redirect(base_url('trang_chu'));
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


    $mau_don_after = trim(strip_tags($mau_don_data));
    $mau_don_after=str_replace(".","",$mau_don_after);
    $mau_don_array=explode('+', $mau_don_after);

    $data=array(

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

    if((!isset($_SESSION['name_user']))||
        (($_SESSION['level']!=12)&&
            ($_SESSION['level']!=11))){
      $this->load->view('content_chitiet',array(
          'node_map'=>$node_map

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
      ,'mau_don_array'=>$mau_don_array
      ,'yeu_cau_data'=>$yeu_cau_data
      ,'can_cu_data'=>$can_cu_data
      ,'data'=>$data
      ,'name'=>$name

      ));
    } else{

      $this->load->model('Ho_so');

      $this->form_validation->set_message('required', '%s chưa nhập.');
      $this->form_validation->set_message('min_length', '%s: It nhất là %s kí tự.');
      $this->form_validation->set_message('max_length', '%s: Nhiều nhất là %s kí tự.');
      $this->form_validation->set_message('regex_match', ' Số %s có 9 chữ số.');

      $this->form_validation->set_error_delimiters('<span class="error">','</span>');

      $this->form_validation->set_rules('dname', 'Tên người dân ', 'required|min_length[3]');

      $this->form_validation->set_rules('dcmnd', 'CMND', 'required|regex_match[/^[0-9]{9}$/]');

      $this->form_validation->set_rules('dmobile', 'Số điện thoại ', 'required|min_length[10]|max_length[11]');
      $this->form_validation->set_rules('songay', 'Số ngày', 'required');
      $this->form_validation->set_rules('sobang', 'Số bản', 'required');

      $pos1 = strpos($le_phi_data, "phí:");
      $pos2 = strpos($le_phi_data, "đồng");

      $length = abs($pos2 - $pos1-5);


      $le_phi_temp = (int)substr($le_phi_data,$pos1+5,$length);

      //$giai_quyet_data
      $pos = strpos($giai_quyet_data,"Trong ngày");

      if($pos===false){
        $pos12 = substr($giai_quyet_data,0,2);
        if(is_numeric($pos12)){
          $so_ngay = (int)$pos12;
        }else {
          $so_ngay = "";
        }
      }else{
        $so_ngay = 0;
      }

      if($le_phi_temp == 0){
        $le_phi = 0;
      }else{
        $le_phi = $le_phi_temp.".000";
      }

      if($this->form_validation->run() == false) {

        $this->load->view('admin/content_chitiet_admin'
            ,array(
                'node_map'=>$node_map
            ,'le_phi'=>$le_phi
            ,'so_ngay'=>$so_ngay
            ,'thanh_phan_data'=>$thanh_phan_data
            ,'aname'=>$name
            ));

      }else{
        $myThuTuc =  $this->input->post('dying');
        $myThuTuc = str_replace(',','', $myThuTuc); // Replaces , by nothing
        $data1 = array(
            'name' => $this->input->post('dname'),
            'cmnd' => $this->input->post('dcmnd'),
            'sdt' => $this->input->post('dmobile'),
            'mshs' => $this->input->post('ma_Ho_So'),
            'tien_thu' =>$this->input->post('tong_cong'),
            'dia_chi'=>$this->input->post('diachi'),
            'note'=>$this->input->post('note'),
            'tt_giay_to_da_thu' =>$myThuTuc,
            'status'=>0,
            'type'=> 0,
            'mcb'=>$_SESSION['ma_can_bo'],
       
        );
        //Truyen du lieu sang co model
        $this->Ho_so->add_ho_so($data1);
        $data1['message'] = 'Du lieu duoc nhap thanh cong';
        $this->load->view('admin/content_chitiet_admin'
            ,array(
                'node_map'=>$node_map
            ,'le_phi'=>$le_phi
            ,'so_ngay'=>$so_ngay
            ,'thanh_phan_data'=>$thanh_phan_data
            ,'message'=>$data1['message']
            ,'aname'=>$name
            ));
      }
    }
    $this->load->view('templates/footer');
  }


}