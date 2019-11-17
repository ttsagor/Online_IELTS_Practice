 <?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class WebRegistrationModel extends CI_Model
{	
	
	//Generic update function
	public function getSingleData($select,$where,$table)
	{
		$this->db->select($select);	
		$this->db->from($table);	
		$this->db->where($where);		
		$query=$this->db->get();
		return $query->row(); 			
	}
	
	public function getSingleDataOr($select,$where,$table)
	{
		$this->db->select($select);	
		$this->db->from($table);	
		$this->db->or_where($where);		
		$query=$this->db->get();
		return $query->row(); 			
	}

    public function insertUpdatedb($table,$data,$key){
        $sql = $this->db->insert_string($table, $data) . " ON DUPLICATE KEY UPDATE $key";
        $this->db->query($sql);
        $id = $this->db->insert_id();
		return $id;
	}

	public function updateDb($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table, $data); 
	}

        public function deleteDb($table,$where){
		$this->db->where($where);
		$this->db->delete($table); 
	}

	public function getdata($select,$where,$table)
	{	
		$this->db->select($select);	
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();			
		return  $query->result();			
	}
	public function getdataOrderBy($select,$where,$table,$oderby)
	{	
		$this->db->select($select);	
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($oderby);
		$query = $this->db->get();			
		return  $query->result();			
	}	
	
	public function getdataOr($select,$where,$table)
	{	
		$this->db->select($select);	
		$this->db->from($table);
		$this->db->or_where($where);
		$query = $this->db->get();			
		return  $query->result();			
	}
	
	public function getdataOderBy($select,$where,$table,$order)
	{	
		$this->db->select($select);	
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, "asc");
		$query = $this->db->get();			
		return  $query->result();			
	}
	  public function insertDb($table,$data){
	   	$id = $this->db->insert($table, $data); 
		return $id;
	}
}