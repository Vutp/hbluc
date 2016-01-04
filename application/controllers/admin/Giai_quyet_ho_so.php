<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giai_quyet_ho_so extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ((!isset($_SESSION['name_user'])) ||
            (
            ($_SESSION['level'] != 100)
            )
        ) {
            redirect(base_url('trang_chu'));
        }

    }

    public function index()
    {

        /*
         Calculations
        *Get the related admin
         *
         */

        $where = "level = 11 OR level = 12 OR level = 21 OR level = 22 ";
        $this->db->where($where);
        $q = $this->db->get('user');

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $relatedAdmindata[] = $row;
            }
        }
        $this->load->model('Cong_viec');
        $my_phong_ban = $this->Cong_viec->my_phong_ban($relatedAdmindata);

        /*end phase related admin*/

        /*get the error time*/

        /*create the admin object*/
        for ($i = 0; $i < count($relatedAdmindata); $i++) {
            $strClassName = 'MyCanBo';
            $arrayOfConstructorArgs = array($relatedAdmindata[$i]->ma_can_bo, 0, 0, 0);
            $r = new ReflectionClass($strClassName);
            $adminObj = $r->newInstanceArgs($arrayOfConstructorArgs);
            $canbo[] = $adminObj;

        }

        /* The list of canbo is saved in array canbo*/

        /*$where = "status = 5 OR status = 8";

        $this->db->where($where);*/
        $q = $this->db->get('ho_so');
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {

                $danhsachadmin[] = $row->lich_su_ho_so . "/" . $row->status;

            }
        }else{
            echo "Lỗi cơ sỡ dữ liệu - CSDL trống !";
            return;
        }


        for ($i = 0; $i < count($danhsachadmin); $i++) {
            $pieces = explode("/", $danhsachadmin[$i]);
            array_shift($pieces);
            $myAdminThamGia[] = $pieces;
        }


        //For all sections

            for ($h = 0; $h < count($myAdminThamGia); $h++) {
                for ($k = 0; $k < count($myAdminThamGia[$h]); $k++) {
                    $allParticipant[] = $myAdminThamGia[$h][$k];
                }
            }

        for($i = 0; $i < count($canbo);$i++){
            for($j = 0; $j <count($allParticipant);$j++){
                if($canbo[$i]->ma_can_bo == $allParticipant[$j]){
                    $canbo[$i]->so_lan_giai_quyet = $canbo[$i]->so_lan_giai_quyet +1;
                }
            }

        }


        //For successful sections

        for ($h = 0; $h < count($myAdminThamGia); $h++) {
            for ($k = 0; $k < count($myAdminThamGia[$h]); $k++) {
                if($myAdminThamGia[$h][count($myAdminThamGia[$h])-1]==3||
                    $myAdminThamGia[$h][count($myAdminThamGia[$h])-1]==4||
                    $myAdminThamGia[$h][count($myAdminThamGia[$h])-1]==5)

                $successArray[] = $myAdminThamGia[$h][$k];

            }
        }

        if(empty($successArray)==false){
            for($j = 0; $j <count($successArray);$j++){
                if($successArray[$j]==3||$successArray[$j]==4||$successArray[$j]==5){
                    $arrayForDung[] = $successArray[$j-1];
                    $arrayForDung[] = $successArray[$j-2];
                }
            }
        }




        if(empty($arrayForDung)==false){
            for($i = 0; $i<count($canbo);$i++){
                for($j = 0; $j<count($arrayForDung);$j++){
                    if($canbo[$i]->ma_can_bo == $arrayForDung[$j]){
                        $canbo[$i]->so_lan_dung = $canbo[$i]->so_lan_dung +1;
                    }
                }

            }

        }




        /*End Success case*/

        /**Count the wrong cases*/


        for($i = 0; $i<count($myAdminThamGia);$i++){

            if($myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==3||
                $myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==4||
                $myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==5
            ){
                for($j = 0; $j <count($myAdminThamGia[$i])-3;$j++){
                    //echo "<-->".$myAdminThamGia[$i][$j]."<-->";
                    $arraySucces[] = $myAdminThamGia[$i][$j];
                }

            }

            if($myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==6||
                $myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==7||
                $myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==8||
                $myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==0
            ){
                for($j = 0; $j <count($myAdminThamGia[$i])-1;$j++){
                   // echo "<-->".$myAdminThamGia[$i][$j]."<-->";
                    $arrayFailed[] = $myAdminThamGia[$i][$j];
                }

            }

            if($myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==1||
                $myAdminThamGia[$i][count($myAdminThamGia[$i])-1]==2
            ){
                for($j = 0; $j <count($myAdminThamGia[$i])-2;$j++){
                    //echo "<-->".$myAdminThamGia[$i][$j]."<-->";
                    $arrayFailedCase12[] = $myAdminThamGia[$i][$j];
                }
            }

        }


        if(empty($arraySucces)==false){
            for($i = 0; $i<count($canbo);$i++){
                for($j = 0; $j<count($arraySucces);$j++){
                    if($canbo[$i]->ma_can_bo == $arraySucces[$j]){
                        $canbo[$i]->so_lan_sai = $canbo[$i]->so_lan_sai +1;
                    }
                }

            }
        }

        if(empty($arrayFailed)==false){
            for($i = 0; $i<count($canbo);$i++){
                for($j = 0; $j<count($arrayFailed);$j++){
                    if($canbo[$i]->ma_can_bo == $arrayFailed[$j]){
                        $canbo[$i]->so_lan_sai = $canbo[$i]->so_lan_sai +1;
                    }
                }

            }
        }


        if(empty($arrayFailedCase12)==false){
            for($i = 0; $i<count($canbo);$i++){
                for($j = 0; $j<count($arrayFailedCase12);$j++){
                    if($canbo[$i]->ma_can_bo == $arrayFailedCase12[$j]){
                        $canbo[$i]->so_lan_sai = $canbo[$i]->so_lan_sai +1;
                    }
                }

            }
        }

        $data['title'] = 'Tình hình giải quyết hồ sơ  - UBND Huyện Bến Lức';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/aside');
            $this->load->view('templates/nav');
            $this->load->view('admin/tinh_hinh_ho_so_view', array('relatedAdminData' => $relatedAdmindata, 'my_phong_ban' => $my_phong_ban,'canbo'=>$canbo));
            $this->load->view('templates/footer');

        }


    }

class MyCanBo
{
    public $ma_can_bo;
    public $so_lan_sai;
    public $so_lan_dung;
    public $so_lan_giai_quyet;

    function MyCanBo($a, $b, $c, $d)
    {
        $this->ma_can_bo = $a;
        $this->so_lan_dung = $b;
        $this->so_lan_sai = $c;
        $this->so_lan_giai_quyet = $d;
    }

}
