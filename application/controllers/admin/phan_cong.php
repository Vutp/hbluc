<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phan_cong extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ((!isset($_SESSION['name_user'])) ||
            (($_SESSION['level'] != 12) &&
                ($_SESSION['level'] != 11) &&
                ($_SESSION['level'] != 13) &&
                ($_SESSION['level'] != 21) &&
                ($_SESSION['level'] != 22)
                )
        ) {
            redirect(base_url('trang_chu'));
        }

    }

    public function index()
    {

        $data['title'] = 'Lịch của tôi - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $this->load->view('admin/phan_cong_view');
        $this->load->view('templates/footer');
    }

    public function getCongViec(){

        $mcb = $_SESSION['ma_can_bo'];

        $where = "ma_can_bo_nhan = '$mcb' AND status = 2 ";
        $this->db->where($where);
        $query = $this->db->get('calendar');
        $events = array();
        foreach($query->result_array() as $row )
        {
            $array = array();
            $array['title'] = $row['title'];
            $array['start'] = $row['enddate'];
            $array['end'] = $row['enddate'];
            $array['id'] = $row['id'];
            array_push($events,$array);

        }

        echo json_encode($events);

    }

    public function deleteCongViec(){
        $deletedID = $_POST['myID'];
        $this->db->where('id',$deletedID);
        $this->db->delete('calendar');
        $lastid = $this->db->insert_id();
        echo json_encode(array('status'=>'success','eventid'=>$lastid));
    }

    public function updateCongViec(){
        $id = $_POST['myID'];
        $data = array(
            'title' => $_POST['myTitle']
        );

        $this->db->where('id',$id);
        $this->db->update('calendar',$data);
        $this->db->where('id',$id);
        $q = $this->db->get('calendar')->row();
        $events = array();
        $array['title'] = $q->title;
        $array['start'] = $q->startdate;
        $array['end'] = $q->enddate;
        $array['id']=$id;
        array_push($events,$array);

        echo json_encode($events);

    }

    public function getIndividual(){
        $id = $_POST['id'];
        $this->db->where('id',$id);
        $q = $this->db->get('calendar')->row();
        $myarray['startTime'] = $q->startdate;
        $myarray['endTime'] = $q->enddate;
        $myarray['phan_tram'] = $q->phan_tram;
        echo json_encode($myarray);
    }



}
