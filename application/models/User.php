
<?php
class User extends CI_Model {
    public $id;
    public $name;
    public $pass;
    public $hoten;
    public $level;
    public $ma_can_bo;
    public function verify($name,$pass){
        $q=new user();

        $this
            ->db
            ->where('name',$name)
            ->where('pass',sha1($pass))
            ->limit(1);
            
        $q = $this->db->get('user');

        if($q->row()>0){
            return $q;
        }
        return FALSE;
    }
    public function check_name($id){
        $query = $this->db->get('user');
        $id=trim($id);
      
      foreach($query->result_array() as $row){
            if (trim($row['name']) == $id) {
                return false;
            } 
        }
    return true;
      
    }
    public function check_mcb($id){
        $query = $this->db->get('user');
        $id=trim($id);
      
      foreach($query->result_array() as $row){
            if (trim($row['ma_can_bo']) == $id) {
                return false;
            } 
        }
    return true;
      
    }    
    public function view($query,$namelevel){
        if ($namelevel=='Tiếp nhận Hồ sơ')$level=11;
        if ($namelevel=='Tiếp nhận và trả Hồ sơ')$level=12;
        if ($namelevel=='Trả Hồ sơ')$level=13;
        if ($namelevel=='Phòng ban Tư Pháp')$level=21;
        if ($namelevel=='Phòng ban Đất đai')$level=22;
        echo'    
        <div class="panel panel-info">
        <div class="panel-heading">
        <h3 class="panel-title">'.$namelevel.'</h3>
        </div>
        <div class="panel-body"> 
        <table class="table">
        <tr><td>Họ và tên</td>
        <td>Tên đăng nhập</td>
        <td></td>
        </tr>';  
        foreach ($query->result() as $row){
           if ($row->level==$level)
           echo '
           
            <tr><td>'.$row->hoten.'</td>
            <td><a href="'.base_url('admin/Profile/view_nhan_su/'.$row->id.'').'">
                <h5 class="truncate">'.$row->name.' </h5></a></td>
            <td>'.anchor('Admin/delete/'.$row->id.'','<button class="btn btn-danger">
                <i class="icon-plus"></i>Xóa tài khoản</button>',array(
                    'onclick'=>"return confirm('Bạn có chắc không?')",
                    )).'</td>   
            </tr>
            ';}
        echo'</table></div></div>';
    }   
public function lay_ten_user($id){
    $query = $this->db->get('user');
    $array = array();
    foreach($query->result_array() as $row){
        if (($row['level']!=4)&& ($row['id']!=$id))
        $array[] = $row['name']; 
        }
    return $array;
    }
public function lay_avatar_link($id){
    $query = $this->db->get('user');
    $array = array();
    foreach($query->result_array() as $row){
        if (($row['level']!=4)&& ($row['id']==$id))
        $array[] = $row['avatar']; 
        }
    return $array;
    }    
public function lay_ten_chat_vs($id){
    $query = $this->db->get('user');
    $array = array();
    foreach($query->result_array() as $row){
        if (($row['level']!=4)&& ($row['id']==$id))
        $array[] = $row['name']; 
        }
    return $array;
    }
public function lay_id_user($id){
    $query = $this->db->get('user');
    $array = array();
    foreach($query->result_array() as $row)
        {
         if (($row['level']!=4)&& ($row['id']!=$id))
           $array[] = $row['id']; 
        }
    return $array;
    }




}
