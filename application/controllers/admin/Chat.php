<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		if((!isset($_SESSION['name_user']))||
			($_SESSION['level']==4))
		{
			redirect('trang_chu');
		}
	}
	public function index()
	{


	}
	public function chatvs($vs=1){
		$data['title'] = 'Chat với nhân sự';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
		if ($this->db->where('id',$vs)->count_all_results('user')!=1)
			redirect('trang_chu');
		$this->load->model('Message');
		$vs_data= $this->Message->talkvs($_SESSION['id'],$vs);
		if ($vs_data=='---')
			redirect(base_url('trang_chu'));
        $date = new DateTime( date("Y-m-d"));
        $query = $this->Message->old_mess($vs_data,$date->format('W'),date("Y"));

		$this->load->model('User');
		$namevs= $this->User->lay_ten_chat_vs($vs);
		$avatar= $this->User->lay_avatar_link($_SESSION['id']);
		$avatarvs= $this->User->lay_avatar_link($vs);
		$this->load->view('admin/chat_view',array(
				'query'=>$query
				,'vs'=>$vs
				,'vs_data'=>$vs_data
				,'avatar'=>$avatar[0]
				,'avatarvs'=>$avatarvs[0]
				,'namevs'=>$namevs[0])
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
	public function push()
	{	
	$name=$this->input->post('name');
	$message=$this->input->post('message');
	$chat_vs=$this->input->post('chat_vs');

	$date = new DateTime( date("Y-m-d"));
	$data = array(
   'name' =>$name,
   'message' => $message ,
   'vs' => $chat_vs ,
   'year' =>  date("Y"),
   'date' =>  date("d-m-Y"),
   'week'=>	$date->format('W')
	);
	$this->db->insert('message', $data); 
	}
	public function load_more()
	{	

		$name=$this->input->post('name');
		$chat_vs=$this->input->post('chat_vs');
		$vs=$this->input->post('vs');
		$week_back=$this->input->post('week_back');
		$week_format = new DateTime($week_back);
		$week=$week_format->format('W');
		$year= explode('-', $week_back);
		
		$this->load->model('Message');
		$query = $this->Message->old_mess($chat_vs,$week,$year[0]);
//$k= date('Y-m-d', strtotime(' +34 day'));
		//$k = date('Y-m-d', strtotime(' -7 day'));
		$this->load->model('User');

		$avatar= $this->User->lay_avatar_link($_SESSION['id']);
		$avatarvs= $this->User->lay_avatar_link($vs);
		$date_chat=date("Y-m-d", strtotime(' +7 day'));
		foreach ($query->result() as $row){
			if ($date_chat!=$row->date){
                $date_chat=$row->date;
              
              echo '<div class="dw"><span class="dt">'.$date_chat.'</span></div><br>';
                }
			if ($_SESSION['name_user']==$row->name) {
            echo' <div class="col-xs-12 col-md-12 col-lg-12 pad">
                    <div class="bubble you ">'.$row->message.'</div>
                </div>';
    					}else
			 echo '<div class="col-xs-12 col-md-12 col-lg-12 pad"><span class="chat-img pull-left">
                <img src="'.base_url('upload/'.$avatarvs[0].'').'" 
                alt="User Avatar" class="img-circle size" /></span>
            <div class="bubble me">'.$row->message.'</div>
            </div>';
			}
	}
}