<?php
class thanh_phan extends CI_Model {
	public $id;
	public $noi_dung;
	public $note;

	public function array_trans($val){
		$data= array();
		$this->db->where('id', $val);
		$q = $this->db->get('thanh_phan')->row();
		$data= $q->noi_dung;

		return $data;
	}
	public function array_trans_1($val){
		$data= array();
		$this->db->where('id', $val);
		$q = $this->db->get('thanh_phan')->row();
		$data= $q->note;

		return $data;
	}

	public function is_match($ten,$note){
    	$query = $this->db->get('thanh_phan');
    foreach($query->result_array() as $row)
        {
    		if(($row['noi_dung']==$ten)
                && ($row['note']==$note)) return TRUE;

        }

    return FALSE;
    }

	public function add_edit($noi_dung,$note,
		&$list_chi_tiet){
		if(($noi_dung=='')||($note==''))
			return ;
    	$array=array(
		
				'noi_dung'=>$noi_dung,
				'note'=>$note,			
						);

			$this->db->insert('thanh_phan',$array);
			
			$this->db->select_max('id');
			$query = $this->db->get('thanh_phan')->result_array();
	
			$list_chi_tiet=$query[0]['id'];


		}

	public function edit_edit($noi_dung,
		&$list_chi_tiet){
			if($noi_dung=='')
				return ;
			$this->db->where('noi_dung', $noi_dung);
   			$node_map = $this->db->get('thanh_phan')->row();

			$list_chi_tiet=$node_map->id;
			
		}
}