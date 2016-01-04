<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Android extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index(){

	}
		public function get($cmnd=123456789){
		header('Content-Type: application/json;charset=utf-8'); 
		header('Content-disposition: attachment; filename=content.json');
		$this->db->where('cmnd', $cmnd);

		$query = $this->db->get('ho_so');
		$response = array("African_Music" => FALSE);
		$linklist=array();
		$link=array();
		foreach ($query->result() as $row){
			
	
       
        $link["mshs"] = $row->mshs ;
        $link["song_name"] = $row->name;
        $link["song_id"] =$row->status;
        $link["artist_name"] = $row->mcb;
         array_push($linklist,$link);
       // $link['tutorial']=$res['tutorial'];
 		//$link['url']=$res['url'];
    //    echo  $response["name"] .'<br>';
		}
 $response["African_Music"] =$linklist;
		echo json_encode($response);
		$write['posts'] = $response;

$fp = fopen('content.json', 'w');
fwrite($fp, json_encode($write));
fclose($fp);
	}
}