<?php
class Message extends CI_Model {
    public $id;
    public $name;
    public $vs;
    public $message;
    public $date;
    public  function getAll(){
    $q = $this->db->get('message');

	return $q;

    }
public  function talkvs($vs1,$vs2){
	$out;   
   if ($vs1<$vs2) $out=$vs1.'-'.$vs2;
   if ($vs1==$vs2) $out='---';
   if ($vs1>$vs2) $out=$vs2.'-'.$vs1;
	return $out;

    }
public  function old_mess($vs,$week,$year){
    $q=new Message();
    $this->db->where('vs',$vs )
            ->where('week',$week)
            ->where('year', $year);
    $q = $this->db->get('message');

    return $q;


    }

}