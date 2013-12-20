<?php
class ModelManageTowel extends Model {
	public function getTowelList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".towel");
		return $query->rows;
	}
	
	public  function addTowel($data,$towel_image){
		$this->db->query(" INSERT into " . DB_DATABASE_TOWEL . ".towel set towel_name = '" . $this->db->escape($data['towel_name']).
		 				  "',  towel_image = '" .$this->db->escape($towel_image).
		 				  "',  towel_cate_id = " .$this->db->escape($data['towel_cate_id']).
						  ",  overview = '" .$this->db->escape($data['overview']).
						  "',  specification = '" .$this->db->escape($data['specification']).
						  "',  delivery = '" .$this->db->escape($data['delivery']).
						  "',  price = '" .$this->db->escape($data['price']).
						  "', status = " . (int)$data['status']. 
						  ", price_status = " . (int)$data['status']);
	}
	
   public  function editTowel($id,$data,$towel_image){
		$this->db->query(" UPDATE " . DB_DATABASE_TOWEL . ".towel set towel_name = '" . $this->db->escape($data['towel_name']).
						  "',  towel_image = '" .$this->db->escape($towel_image).
						  "',  towel_cate_id = " .$this->db->escape($data['towel_cate_id']).
						  ", status = " . (int)$data['status'].
						  ", price_status = " . (int)$data['price_status'].
						  ",  overview = '" .$this->db->escape($data['overview']).
						  "',  specification = '" .$this->db->escape($data['specification']).
						  "',  delivery = '" .$this->db->escape($data['delivery']).
		 				  "',  price = '" .$this->db->escape($data['price']).
						  "' where towel_id = $id");
	}
	
	public function deleteTowel($id){
		$this->db->query("DELETE from " . DB_DATABASE_TOWEL . ".towel where towel_id = $id");
	}
	
	public function getTowelById($id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".towel WHERE towel_id = '" . (int)$id . "'");
	
		return $query->row;
	}
	
	public function increaseCountApp($towel_id){
	    $sql = "update " . DB_DATABASE_TOWEL . ".towel a set count_app = count_app + 1 where a.towel_id = $towel_id";
		$rtn=$this->db->query($sql);
	}
	
    public function decreaseCountApp($towel_id){
	    $sql = "update " . DB_DATABASE_TOWEL . ".towel a set count_app = count_app - 1 where a.towel_id = $towel_id";
		$rtn=$this->db->query($sql);
	}
}
?>