<?php
class Cong_viec extends CI_Model{
    public function get_users($level,$mcb){
        if($level==100||$level==21||$level==22){
            $where1 = "(level='11' OR level='12'OR level='13'OR level='21' OR level='22')";
            $where2 = "ma_can_bo != '$mcb'";
            $where = "$where1 AND $where2";
        }


        $this->db->where($where);
        $q = $this->db->get('user');

        if($q->num_rows() >0 ){
            foreach ($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }

    public function my_phong_ban($arrayOfUsers){
        for($i = 0; $i<count($arrayOfUsers);$i++){
            switch ($arrayOfUsers[$i]->level) {
                case 11:
                    $my_phong_ban[] = "PHÒNG TIẾP NHẬN HỒ SƠ";
                    break;
                case 12:
                    $my_phong_ban[] = "PHÒNG TIẾP NHẬN VÀ GIAO TRẢ HỒ SƠ";
                    break;
                case 13:
                    $my_phong_ban[] = "PHÒNG GIAO TRẢ HỒ SƠ";
                    break;
                case 21:
                    $my_phong_ban[] = "PHÒNG TƯ PHÁP";
                    break;
                case 22:
                    $my_phong_ban[] = "PHÒNG ĐỊA CHÍNH";
                    break;
                case 100:
                    $my_phong_ban[] = "CHỦ TỊCH";
                    break;
                default:
                    break;
            }
        }

        return  $my_phong_ban;
    }

    public function get_cong_viec($mcb){

        $this->db->where('ma_can_bo_giao',$mcb);
        $q = $this->db->get('calendar');

        if($q->num_rows() >0 ){
            foreach ($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }

    public function get_cong_viec_da_nhan(){
        $mcb = $_SESSION['ma_can_bo'];
        $where1 = "status = 1 AND ma_can_bo_nhan = '$mcb' ";
        $where2 = "status = 2 AND ma_can_bo_nhan = '$mcb' ";

        $where = "$where1 OR $where2";

        $this->db->where($where);
        $q = $this->db->get('calendar');

        if($q->num_rows() >0 ){
            foreach ($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }

}