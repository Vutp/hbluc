<?php
class Map extends CI_Model {

	public $node_id;
	public $node_name;
	public $p_id;
	public $note;
    public function format($input){
        if ($input=="")return;
        $test=explode('/', $input);
        return $test;
    }
    public function getAll(){
        $q = $this->db->get('map');

        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }

    }
    public function lay_ten_muc($p_id){
    $query = $this->db->get('map');
    $array = array();
    foreach($query->result_array() as $row){
    	if ($row['p_id']==$p_id)
        $array[] = $row['node_name']; 
        }
    return $array;
    }
    public function lay_id($p_id){
    $query = $this->db->get('map');
    $array = array();
    foreach($query->result_array() as $row)
        {
        if ($row['p_id']==$p_id)
           $array[] = $row['node_id']; 
        }
    return $array;
    }
    public function lay_note($id){
        $query = $this->db->get('map');
        $test=array();
        foreach($query->result_array() as $row){
            if( $row['node_id']==$id){
                $test=$this->format($row['note']);
                return $test;
            }
        }
        $q=$query->row(1);
        $test=$this->format($q->note);
        return $test;
        
    }
    public function loc_ten($id){
        $query = $this->db->get('map');
        $array=array();
        $low_key=strtolower($id);
      foreach($query->result_array() as $row){
        $low_search=strtolower($row['node_name']);
        $pos = strpos($low_search, $low_key);
        if (($pos === false)||($row['p_id']!=1)) {
  
            } else {
                $array[] = $row['node_name']; 
            }
        }

        return $array;
    }
    public function loc_id($id){
        $query = $this->db->get('map');
        $array=array();
        $low_key=strtolower($id);
      foreach($query->result_array() as $row){
        $low_search=strtolower($row['node_name']);
        $pos = strpos($low_search, $low_key);
        if (($pos === false)||($row['p_id']!=1)) {
  
            } else {
                $array[] = $row['node_id']; 
            }
        }

        return $array;
    }
    public function loc_ten_left($data){
        $query = $this->db->get('map');
        $array=array();
        foreach($query->result_array() as $row){
            $pos2 = strpos(strtolower($row['node_name']), strtolower($data[2]));
            $pos1 = strpos(strtolower($row['node_name']), strtolower($data[1]));
            $pos  = strpos(strtolower($row['node_name']), strtolower($data[0]));
            $pos3 = strpos(strtolower($row['node_name']),strtolower( $data[3]));
            $pos4 =strpos(strtolower($row['node_name']), strtolower($data[4]));
            $pos5 =strpos(strtolower($row['node_name']), strtolower($data[5]));
                if (($pos === false)&&($pos1 === false)&&
                    ($pos2 === false)&&($pos3 === false)&&
                    ($pos4 === false)&&($pos5 === false)&&
                    ($row['p_id']==1)) {
                    $array[] = $row['node_name'];
                } else {
                }
        }
        return $array;
    }
    public function loc_id_left($data){
    $query = $this->db->get('map');
    $array=array();
    foreach($query->result_array() as $row){
            $pos2 = strpos(strtolower($row['node_name']), strtolower($data[2]));
            $pos1 = strpos(strtolower($row['node_name']), strtolower($data[1]));
            $pos  = strpos(strtolower($row['node_name']), strtolower($data[0]));
            $pos3 = strpos(strtolower($row['node_name']),strtolower( $data[3]));
            $pos4 =strpos(strtolower($row['node_name']), strtolower($data[4]));
            $pos5 =strpos(strtolower($row['node_name']), strtolower($data[5]));
        if (($pos === false)&&($pos1 === false)&&
            ($pos2 === false)&&($pos3 === false)&&
            ($pos4 === false)&&($pos5 === false)&&
            ($row['p_id']==1)) {
            $array[] = $row['node_id'];
        } else {
            }
        }
        return $array;
    }

    

    public function is_match($ten){
        $query = $this->db->get('map');
    foreach($query->result_array() as $row)
        {
            if($row['node_name']==$ten) return TRUE;

        }

    return FALSE;
    }

    public function set_pagination(&$config){
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['first_link'] = 'Trang đầu';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Trang cuối';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        return;
    }
}