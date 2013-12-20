<?php
class ModelManageTowelImage extends Model {
	public function getTowelImageListByTowelId($towel_id) {
	    if(isset($towel_id))
		    $query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".towel_image where towel_id = " . $towel_id);
		else 
		    $query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".towel_image");
		return $query->rows;
	}
	
	public  function addTowelImage($data,$towel_image_image,$towel_id){
		$this->db->query(" INSERT into " . DB_DATABASE_TOWEL . ".towel_image set image = '" .$this->db->escape($towel_image_image).
						  "', towel_id = " . (int)$towel_id);
	}
	
   public  function editTowelImage($id,$data,$towel_image,$towel_id){
		$this->db->query(" UPDATE " . DB_DATABASE_TOWEL . ".towel_image set image = '" .$this->db->escape($towel_image).
						  "', towel_id = " . (int)$towel_id .
						  " where towel_image_id = " . $id);
	}
	
	public function deleteTowelImage($id){
		$this->db->query("DELETE from " . DB_DATABASE_TOWEL . ".towel_image where towel_image_id = $id");
	}
	
	public function getTowelImageById($id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".towel_image WHERE towel_image_id = '" . (int)$id . "'");
	
		return $query->row;
	}
}
?>