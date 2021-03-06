<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gcm extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$data['title'] = 'Hành chính trong lĩnh vực đất đai - UBND Huyện Bến Lức';
		$this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');

		$query = $this->db->get('gcm_user');
		$this->load->view('admin/gcm_sent',array('query'=>$query));


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
	public function xu_ly_noti(){

	//Generic php function to send GCM push notification
	$this->load->model('Gcm_model');
  	$selUsers =$this->input->post('name_select');

  	if($selUsers=='') {
    	echo("You didn't select any users.");
  	}else{	
	$resp = "<tr id='header'><td>GCM Response [".date("h:i:sa")."]</td></tr>";
	$greetMsg = $this->input->post('message');
	
	$respJson =  '{"greetMsg":"'.$greetMsg.'"}';
	//echo $greetMsg ;
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
	$resp = $resp."<br>".$pushsts;
	echo $resp;
  		}


	}
public function get_json($cmnd=123456789){
		header('Content-Type: application/json;charset=utf-8'); 
		header('Content-disposition: attachment; filename=content.json');
		$this->db->where('cmnd', $cmnd);

		$query = $this->db->get('ho_so');
		$response = array("ho_so_detail" => FALSE);
		$linklist=array();
		$link=array();
			$q = $this->db->get('map');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}

		}


	foreach ($query->result() as $row){
        $link["mshs"] = $row->mshs ;
        $link["ten_thu_tuc"] = $data[(int)substr($row->mshs, 16,2)]->node_name;
       	
       	$tp1 = substr($row->mshs,7,2);//day
		$tp2 = substr($row->mshs,9,2);//month
		$tp3 = substr($row->mshs,11,2);//year
		$so_ngay_giai_quyet=explode('-', $row->mshs);
		$sngq = substr($so_ngay_giai_quyet[3],0,2);
		$ngay_nhan = $tp2."/".$tp1."/20".$tp3;
		$time = strtotime($ngay_nhan);
		$ngay_nhan = date('d/m/Y',$time);//Ngay_nhan_cuoi_cung

		$ngay_nhan_function = date('Y-m-d');
 		if (($row->status!=5)||($row->status!=8))
		$ngay_tra = date('d/m/Y', strtotime($ngay_nhan_function."+".$sngq." days"));
		else  $ngay_tra =$details->ngay_tra;

        $link["ngay_tra"] = $ngay_tra;
        $link["ngay_nhan"] = $ngay_nhan;
        $link["status"] =$row->status;
//        $link["giay_to"] =$row->tt_giay_to_da_thu;
 //       $link["error"] =$row->error;
 //       $link["tien_thu"] =$row->tien_thu;
 //       $link["mcb"] = $row->mcb;
         array_push($linklist,$link);
		}
 		$response["ho_so_detail"] =$linklist;
		echo json_encode($response);
		$write['posts'] = $response;

		$fp = fopen('content.json', 'w');
		fwrite($fp, json_encode($write));
		fclose($fp);
	}
public function json_ho_so($id=5){
		header('Content-Type: application/json;charset=utf-8'); 
		header('Content-disposition: attachment; filename=content.json');
		$this->db->where('id', $id);

		$query = $this->db->get('ho_so');
		$response = array("ho_so_detail" => FALSE);
		$linklist=array();
		$link=array();
		$q = $this->db->get('map');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}

		}
		$this->db->where('id', $id);
		$details = $this->db->get('ho_so')->row();
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
 		if (($details->status!=5)||($details->status!=8))
		$ngay_tra = date('d/m/Y', strtotime($ngay_nhan_function."+".$sngq." days"));
		else  $ngay_tra =$details->ngay_tra;
	foreach ($query->result() as $row){
        $link["mshs"] = $row->mshs ;
        $link["ten_thu_tuc"] = $data[(int)substr($row->mshs, 16,2)]->node_name;
        $link["ngay_tra"] = $ngay_tra;
        $link["ngay_nhan"] = $ngay_nhan;
        $link["status"] =$row->status;
      //  $link["giay_to"] =$row->tt_giay_to_da_thu;
      //  $link["error"] =$row->error;
        $link["tien_thu"] =$row->tien_thu;
       // $link["mcb"] = $row->mcb;
        $link["cmnd"] = $row->cmnd;
         array_push($linklist,$link);
		}
 		$response["ho_so_detail"] =$linklist;
		echo json_encode($response);
		$write['posts'] = $response;

		$fp = fopen('content.json', 'w');
		fwrite($fp, json_encode($write));
		fclose($fp);
	}
	public function add_user(){
		$cmnd =  $_POST["CmndId"];//$this->input->post["emailId"];
		$regId =  $_POST["regId"];//$this->input->post["regId"];
		$data = array(
   			'cmnd' => $cmnd  ,
   			'gcmregId' => $regId 
			);
		 $data1 = array(
   			'gcmregId' => $regId);
		 $data2 = array(
   			'cmnd' => $cmnd );
		$count1=$this->db->where('cmnd',$cmnd )->count_all_results('gcm_user');
		$count2=$this->db->where('gcmregId',$regId)->count_all_results('gcm_user');
		if ($count1>=1||$count2>=1)
		{
			if ($count1>=1) {
				
			$this->db->where('cmnd', $cmnd);
			$this->db->update('gcm_user', $data1 );
			}
			if ($count2>=1) {
			$this->db->where('gcmregId', $gcmregId);
			$this->db->update('gcm_user',  $data2 );
			}
		}else{
 			$this->db->insert('gcm_user', $data);

		}
		
	}

}