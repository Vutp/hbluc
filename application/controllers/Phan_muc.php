<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phan_muc extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index($n=1)
	{
		$data['title'] = 'Hành chính tư pháp - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside');
		$this->load->view('templates/nav');
		$this->load->model('Map');
		/*$this->load->library('table');*/
		switch ($n) {
			case 1:
				$f="Chứng thực";
				break;
			case 2:
				$f="Khai sinh";
				break;
			case 3:
				$f="Khai tử";
				break;
			case 4:
				$f="Kết hôn";
				break;
			case 5:
				$f="Giám hộ";
				break;
			case 6:
				$f="Hộ tịch";
				break;
			case 7:
				 $f=" ";
				break;
			case 8:
				$f=$this->input->post('key_search');
				if ($f=="") $f=" ";
				break;

			default:
				$f=" ";
				break;
		}
		$dataname=array(
			 'Chứng thực',
			'Khai sinh',
			 'Khai tử',
			'Kết hôn',
			'Giám hộ',
			'Hộ tịch'

		);
		//$f="Chứng thực";
		if($f==" "){
			$data = $this->Map->loc_ten_left($dataname);
			$num = $this->Map->loc_id_left($dataname);
			$com = array_combine($num, $data);
		}else{
			$data = $this->Map->loc_ten($f);
			$num = $this->Map->loc_id($f);
			$com = array_combine($num, $data);
		}

//$text = mb_convert_encoding(' có cục ', 'UTF-8', 'UTF-8');
//$cleaner_input = trim(strip_tags(' ea bó  j . '));
//echo 'dd'.$text.'dd';
//echo 'aa'.$cleaner_input.'dd';

		if (($n<1)||($n>8))$n=7;
		$this->load->view('content_phan_muc',array(
			'com'=>$com,
			'name'=>$n)
		);
         if(isset($_SESSION['name_user'])){
            $this->load->model('User');
            $dataname = $this->User->lay_ten_user($_SESSION['id']);
            $idchat = $this->User->lay_id_user($_SESSION['id']); 
            $datachat = array_combine($idchat, $dataname); 
            
            $this->load->view('templates/sideright',array('datachat'=>$datachat));
        
        }
        else $this->load->view('templates/sideright');
        $this->load->view('templates/footer');
	}

}




