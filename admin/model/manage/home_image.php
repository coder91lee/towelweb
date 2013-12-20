<?php
class ModelManageHomeImage extends Model {
	public function getHomeImageList() {
	    $query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".home_image");

	    return $query->rows;
	}
	
	public  function addHomeImage($data,$image){
		$this->db->query(" INSERT into " . DB_DATABASE_TOWEL . ".home_image set image = '" .$this->db->escape($image).
						  "', link = '" . $this->db->escape($data['link']) .
						  "', name = '" . $this->db->escape($data['name']) ."'");
	}
	
   public  function editHomeImage($id,$data,$image){
		$this->db->query(" UPDATE " . DB_DATABASE_TOWEL . ".home_image set image = '" .$this->db->escape($image).
						  "', link = '" . $this->db->escape($data['link']).
						  "', name = '" . $this->db->escape($data['name']) .
						  "' where home_image_id = " . $id);
	}
	
	public function deleteHomeImage($id){
		$this->db->query("DELETE from " . DB_DATABASE_TOWEL . ".home_image where home_image_id = $id");
	}
	
	public function getHomeImageById($id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".home_image WHERE home_image_id = '" . (int)$id . "'");
	
		return $query->row;
	}
}
?>