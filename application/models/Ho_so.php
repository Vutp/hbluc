<?php
class Ho_so extends CI_Model {
	public $id;
	public $mshs;
	public $name;
	public $cmnd;
	public $date;
	public $status;	
	public $note;
    public $mcb;
	public function format($input){
        $test=explode('/', $input);
        return $test;
    }
    public function lay_ho_so($mcb,$level, $limit, $offset){
       // $q=new ho_so();
        $f=0;
    
        if($f==0)
            return FALSE;
        $this->db->limit($limit);
        $this->db->offset($offset);
        $q = $this->db->get('ho_so');   
        return $q;

    }
    public function lay_ho_so_all($mcb,$level){
        $f=0;
        if(($level==11)){
            $this->db->where('status', 0) 
                 ->where('mcb',$mcb);
            $this->db->or_where('status', 1) 
                 ->where('mcb',$mcb);

            $f=1;
            }
        if($level==21){
            $this->db->where('status', 1) ;
            $this->db->where('type', 0) ;
            
            $this->db->or_where('status', 2) 
                 ->where('mcb',$mcb);
            $this->db->or_where('status', 3) 
                 ->where('mcb',$mcb);
            $this->db->or_where('status', 6) 
                 ->where('mcb',$mcb);
            $f=1;
            }
            if($level==22){
            $this->db->where('status', 1) ;
            $this->db->where('type', 1) ;
            
            $this->db->or_where('status', 2) 
                 ->where('mcb',$mcb);
            $this->db->or_where('status', 3) 
                 ->where('mcb',$mcb);
            $this->db->or_where('status', 6) 
                 ->where('mcb',$mcb);
            $f=1;
            }
        if(($level==13)){//Tra ve
            $this->db->where('status', 3 ); 
                 
            $this->db->or_where('status', 4 ) 
                 ->where('mcb',$mcb);
            $this->db->or_where('status', 6 ); 
                 
            $this->db->or_where('status', 7 ) 
                 ->where('mcb',$mcb); 
                 
            $f=1;
            }  
        $q = $this->db->get('ho_so');   
        if($f==0)
            return FALSE;        
            return $q;

    }
    public function search_ho_so($id, $limit, $offset){
        $query = $this->db->get('ho_so');
        $array=array();
        $low_key=strval ($id);
       $low_key=strtolower($low_key);
      foreach($query->result_array() as $row){
        $low_search=strtolower($row['mshs']);
        $pos = strpos($low_search, $low_key);
        $pos1 = strpos($row['cmnd'], $low_key);
        if (($pos === false)&&($pos1 === false)) {
             } else {
                 $array[] = $row['id']; 
            }

        }
        if(count($array)==0) return FALSE;
        for ($i=0;$i<count($array);$i++){
            $this->db->or_where('id',  $array[$i]);  
             }
        $this->db->limit($limit);
        $this->db->offset($offset);
        $q = $this->db->get('ho_so');

        return $q;

       
    }
    public function search_ho_so_all($id){
        $query = $this->db->get('ho_so');
        $array=array();
        $low_key=strval ($id);
       $low_key=strtolower($low_key);
      foreach($query->result_array() as $row){
        $low_search=strtolower($row['mshs']);
        $pos = strpos($low_search, $low_key);
        $pos1 = strpos($row['cmnd'], $low_key);
        if (($pos === false)&&($pos1 === false)) {
 
            } else {
 
                $array[] = $row['id']; 
            }

        }
        return count($array);
    }
    public function loc_mshs($id){
        $query = $this->db->get('ho_so');
        $array=array();
        $low_key=strval ($id);
       $low_key=strtolower($low_key);
      foreach($query->result_array() as $row){
        $low_search=strtolower($row['mshs']);
        $pos = strpos($low_search, $low_key);
        $pos1 = strpos($row['cmnd'], $low_key);
        if (($pos === false)&&($pos1 === false)) {
 
            } else {
 
                $array[] = $row['id']; 
            }

        }

        return $array;
    }
    public  function getRecordsForTK($level,$mcb){

        if(($level==12)||($level==13)){

            $where = "status = '5' AND mcb = '$mcb' ";
            $this->db->where($where);
        }

        if($level==21){
            $where = "status = '5'  AND type='0' ";
            $this->db->where($where);

        }

        if($level==22){
            $where = "status = '5' AND type= '1' ";
            $this->db->where($where);

        }

        if($level==100){
            $where = "status = '5'";
            $this->db->where($where);

        }

        $q = $this->db->get('ho_so');

        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }

    }
	public function format_num($input){
        if($input<10)$test='0'.$input.'';
        	else $test=(string)$input;
        return $test;
    }
	public function array_trans($val){
		$data= array();
		$this->db->where('id', $val);
   		$q = $this->db->get('ho_so')->row();
		$data= $q->noi_dung;
	
	    return $data;
	}

	public function lay_note($id){
      //  $query = $this->db->get('map');
      //  $test=array();
       // foreach($query->result_array() as $row){
          //  if( $row['node_id']==$id)
                $test=$this->format($id);
       // }
        return $test;
    }
    public function lay_ten_muc($p_id){
    $query = $this->db->get('ho_so');
    $array = array();
    foreach($query->result_array() as $row){
    	if ($row['status']==$p_id)
        $array[] = $row['node_name']; 
        }
    return $array;
    }
    public function lay_id($p_id){
    $query = $this->db->get('ho_so');
    $array = array();
    foreach($query->result_array() as $row)
        {
        if ($row['status']==$p_id)
           $array[] = $row['id']; 
        }
    return $array;
    }
	public function add_ho_so($data){
	$this->db->insert('ho_so', $data);
    }

    public  function list_all($number, $offset){
        $query =  $this->db->get('ho_so',$number,$offset);
        return $query->result_array();
    }

    // đếm tổng số record trong table book
    public function count_all(){
        return $this->db->count_all('ho_so');
    }
}