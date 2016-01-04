<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Read extends CI_Controller {

	public function read_file($filename='Phiếu_yêu_cầu_chứng_thực_(mẫu_số_31PYC).pdf'){
		//$filename1="Tờ khai đăng ký khai sinh.pdf";
		//$name = trim(strip_tags($name));
		$file=''.base_url().'doc/'.$filename.'.pdf';
		//$filename=$name;
		header('Content-Type: application/pdf');
//header('Content-Type: application/octet-stream');
		header('Content-Disposition: inline; filename="'.$filename.'.pdf"');
//header ('Content-Transfer-Encoding:binary');
//header('Accept-Ranges:bytes');

		readfile($file);

}
	public function index(){
		$filename='tên%20b.pdf';
		$file=''.base_url().'doc/'.$filename.'';
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename="'.$filename.'"');
		readfile($file);

}
}