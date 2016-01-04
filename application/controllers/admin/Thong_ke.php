<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thong_ke extends CI_Controller
{

    public $data;
    public $data2;

    public function __construct()
    {
        parent::__construct();
        if ((!isset($_SESSION['name_user'])) ||
            (($_SESSION['level'] != 12) &&
                ($_SESSION['level'] != 13) &&
                ($_SESSION['level'] != 21) &&
                ($_SESSION['level'] != 22) &&
                ($_SESSION['level'] != 100))
        ) {
            redirect(base_url('trang_chu'));
        }

        $this->load->model('Ho_so');
        $this->data2 = $this->Ho_so->getRecordsForTK($_SESSION['level'],$_SESSION['ma_can_bo']);

    }

    public function index()
    {

        $data['title'] = 'Thống kê - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $this->load->model('Ho_so');
        $this->load->model('map');

        $this->load->view('admin/thong_ke_view'
            , array(

                'data2' => $this->data2

            ));
        $this->load->view('templates/footer');

    }

    public function  quarter_filter()
    {
        if (empty($_POST['yearQuarter'])) {
            redirect('admin/thong_ke');
        }
        $myQuater = 0;

        $quarter = $_POST["quarter"];
        $quarterSet = $_POST["quarter"];
        $nam = $_POST["yearQuarter"];
        if(empty($_POST["luachon"])){
            $luaChon="all";
        }else {
            $luaChon = $_POST["luachon"];
        }

        $namDaChonForTesting = (int)$nam;

        if ($namDaChonForTesting < 2000 || $namDaChonForTesting > 3000) {
            $nam = "Error";
        } else {
            $nam = substr($nam, 2, 2);
        }


        /*$this->load->helper('url');*/
        $data['title'] = 'Thống kê - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');

        $this->load->model('Ho_so');


        $this->load->view('admin/thong_ke_view'
            , array(
                'data2' => $this->data2
            , 'namCaseQuarter' => $nam
            , 'luaChonCaseQuarter' => $luaChon
            , 'quarterCaseQuarter' => $quarter
            , 'myQuarter' => $myQuater
            , 'quarterSet' => $quarterSet

            ));

        $this->load->view('templates/footer');
    }

    public function  year_filter()
    {
        if (empty($_POST['year'])) {
            redirect('admin/thong_ke');
        }
        $myYear = 0;
        $yearSet = $_POST["year"];
        $nam = $_POST["year"];
        if(empty($_POST["luachon"])){
            $luaChon="all";
        }else {
            $luaChon = $_POST["luachon"];
        }

        $namDaChonForTesting = (int)$nam;

        if ($namDaChonForTesting < 2000 || $namDaChonForTesting > 3000) {
            $nam = "Error";
        } else {
            $nam = substr($nam, 2, 2);
        }

        $data['title'] = 'Thống kê - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $this->load->model('Ho_so');

        $this->load->view('admin/thong_ke_view'
            , array(
                'data2' => $this->data2
            , 'namCaseYear' => $nam
            , 'luaChonCaseYear' => $luaChon
            , 'myYear' => $myYear
            , 'yearSet' => $yearSet

            ));

        $this->load->view('templates/footer');
    }

    public function month_filter()
    {
        if (empty($_POST['thangName']) || empty($_POST['yearName'])) {
            redirect('admin/thong_ke');
        }
        $myMonth = 0;
        $data['title'] = 'Thống kê - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $thangDaChon = $_POST["thangName"];
        $monthSet = $_POST["thangName"];
        $nam = $_POST["yearName"];
        if(empty($_POST["luachon"])){
            $luaChon="all";
        }else {
            $luaChon = $_POST["luachon"];
        }
        $namDaChonForTesting = (int)$nam;

        if ($namDaChonForTesting < 2000 || $namDaChonForTesting > 3000) {
            $nam = "Error";
        } else {
            $nam = substr($nam, 2, 2);
        }
        $this->load->view('admin/thong_ke_view'
            , array(
                'data2' => $this->data2
            , 'thangDaChonCaseMonth' => $thangDaChon
            , 'namCaseMonth' => $nam
            , 'luaChonCaseMonth' => $luaChon
            , 'myMonth' => $myMonth
            , 'monthSet' => $monthSet

            ));
        $this->load->view('templates/footer');
    }

    public function search()
    {
        $level = $_SESSION['level'];
        if ($_POST['searchVal']) {
            $searchq = addslashes($_POST['searchVal']);

            $searchq = trim($searchq);
            $this->db->like('node_name',$searchq);
            $q = $this->db->get('map');

            if ($q->num_rows() > 0) {

                foreach ($q->result() as $row) {


                    if($level==12||$level==13||$level==100){
                        if ( $row->p_id != 32 &&$row->p_id != 1) {
                        } else {
                            $this->data[] = $row;
                        }
                    }

                    if($level==21){
                        if ($row->p_id != 1) {
                        } else {
                            $this->data[] = $row;
                        }

                    }

                    if($level==22){
                        if ($row->p_id != 32) {
                        } else {
                            $this->data[] = $row;
                        }

                    }

                }

            }

            $q = $this->data;

            $output = "";
            if (count($q)) {
                for ($i = 0; $i < count($this->data); $i++) {
                    $output .= '<li class="lo"><a href=' . ($q[$i]->node_id - 1) . ' onclick="return false;">' . $q[$i]->node_name . '</a></li>';
                }
                echo $output;

            } else {
                echo "Không tìm thấy kết quả nào";
            }
        }
    }


    public function day_filter()
    {
        if (empty($_POST['datepicker1']) || empty($_POST['datepicker2'])) {
            redirect('admin/thong_ke');
        }

        /*$this->load->helper('url');*/
        $data['title'] = 'Thống kê - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $tuNgay = $_POST["datepicker1"];
        $denNgay = $_POST["datepicker2"];
        if(empty($_POST["luachon"])){
            $luaChon="all";
        }else {
            $luaChon = $_POST["luachon"];
        }

        $tuNgay = substr($tuNgay, 0, 2) . "-" . substr($tuNgay, 3, 2) . "-" . substr($tuNgay, 6, 4);
        $denNgay = substr($denNgay, 0, 2) . "-" . substr($denNgay, 3, 2) . "-" . substr($denNgay, 6, 4);

        $step = '+1 day';
        $output_format = 'd/m/Y';
        //Ref--Create a list of dates from A to B
        $dates = array();
        $current = strtotime($tuNgay);
        $last = strtotime($denNgay);

        while ($current <= $last) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        if ($tuNgay == null) {

            redirect(base_url('admin/thong_ke'));

        }
        $this->load->view('admin/thong_ke_view'
            , array(
                'data2' => $this->data2
            , 'tuNgay' => $tuNgay
            , 'denNgay' => $denNgay
            , 'myListDateCaseDay' => $dates
            , 'luaChonCaseDay' => $luaChon

            ));

        $this->load->view('templates/footer');

    }

    public function week_filter()
    {

        if (empty($_POST['weekName'])) {
            redirect('admin/thong_ke');
        }

        /*$this->load->helper('url');*/
        $data['title'] = 'Thống kê - UBND Huyện Bến Lức';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside');
        $this->load->view('templates/nav');
        $tuanDaChon = $_POST["weekName"];
        $tuanDaChon = substr($tuanDaChon, 0, 2) . "-" . substr($tuanDaChon, 3, 2) . "-" . substr($tuanDaChon, 6, 4);
        $yearInWeek = substr($tuanDaChon, 6, 4);
        if(empty($_POST["luachon"])){
            $luaChon="all";
        }else {
            $luaChon = $_POST["luachon"];
        }
        $date = new DateTime($tuanDaChon);
        $tuanDaChon = $date->format("W");

        $week_number = (int)$tuanDaChon;
        $year = (int)($yearInWeek);
        $myDateArray = [];

        for ($day = 1; $day <= 7; $day++) {
            array_push($myDateArray, date('dmy', strtotime($year . "W" . $week_number . $day)));
        }

        $this->load->view('admin/thong_ke_view'
            , array(
                'data2' => $this->data2
            , 'luaChonCaseWeek' => $luaChon
            , 'myDateOfWeekArrayCaseWeek' => $myDateArray
            , 'tuanDaChon' => $tuanDaChon

            ));

        $this->load->view('templates/footer');

    }
}
