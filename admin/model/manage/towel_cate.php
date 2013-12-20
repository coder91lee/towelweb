<?php
class ModelManageTowelCate extends Model {
	public function getTowelCateList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".towel_cate");
		return $query->rows;
	}
	
	public  function addTowelCate($data,$towel_cate_image){
		$this->db->query(" INSERT into " . DB_DATABASE . ".towel_cate set towel_cate_name = '" . $this->db->escape($data['towel_cate_name']).
		 				  "',  towel_cate_image = '" .$this->db->escape($towel_cate_image).
						  "', status = " . (int)$data['status']);
	}
	
   public  function editTowelCate($id,$data,$towel_cate_image){
		$this->db->query(" UPDATE " . DB_DATABASE . ".towel_cate set towel_cate_name = '" . $this->db->escape($data['towel_cate_name']).
						  "',  towel_cate_image = '" .$this->db->escape($towel_cate_image).
						  "', status = " . (int)$data['status']. " where towel_cate_id = $id");
	}
	
	public function deleteTowelCate($id){
		$this->db->query("DELETE from " . DB_DATABASE . ".towel_cate where towel_cate_id = $id");
	}
	
	public function getTowelCateById($id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".towel_cate WHERE towel_cate_id = '" . (int)$id . "'");
	
		return $query->row;
	}
	
	public function increaseCountApp($towel_cate_id){
	    $sql = "update " . DB_DATABASE . ".towel_cate a set count_app = count_app + 1 where a.towel_cate_id = $towel_cate_id";
		$rtn=$this->db->query($sql);
	}
	
    public function decreaseCountApp($towel_cate_id){
	    $sql = "update " . DB_DATABASE . ".towel_cate a set count_app = count_app - 1 where a.towel_cate_id = $towel_cate_id";
		$rtn=$this->db->query($sql);
	}
}
?>