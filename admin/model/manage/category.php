<?php
class ModelManageCategory extends Model {
	public function getCategoryList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".category");
		return $query->rows;
	}
	
	public  function addCategory($data,$category_image){
		$this->db->query(" INSERT into " . DB_DATABASE_APPSTORE . ".category set category_name = '" . $this->db->escape($data['category_name']).
		 				  "',  category_image = '" .$this->db->escape($category_image).
						  "', status = " . (int)$data['status'].
						  ",  category_code = '" .$this->db->escape($data['category_code'])."'");
	}
	
   public  function editCategory($id,$data,$category_image){
		$this->db->query(" UPDATE " . DB_DATABASE_APPSTORE . ".category set category_name = '" . $this->db->escape($data['category_name']).
						  "',  category_image = '" .$this->db->escape($category_image).
						  "', status = " . (int)$data['status'].
						  ",  category_code = '" .$this->db->escape($data['category_code']).
						  "' where category_id = $id");
	}
	
	public function deleteCategory($id){
		$this->db->query("DELETE from " . DB_DATABASE_APPSTORE . ".category where category_id = $id");
	}
	
	public function getCategoryById($id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".category WHERE category_id = '" . (int)$id . "'");
	
		return $query->row;
	}
	
	public function increaseCountApp($category_id){
	    $sql = "update " . DB_DATABASE_APPSTORE . ".category a set count_app = count_app + 1 where a.category_id = $category_id";
		$rtn=$this->db->query($sql);
	}
	
    public function decreaseCountApp($category_id){
	    $sql = "update " . DB_DATABASE_APPSTORE . ".category a set count_app = count_app - 1 where a.category_id = $category_id";
		$rtn=$this->db->query($sql);
	}
}
?>