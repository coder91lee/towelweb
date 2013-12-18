<?php
class ModelManageGallery extends Model {
	public function getGalleryListByAppId($app_id) {
	    if(isset($app_id))
		    $query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".gallery where app_id = " . $app_id);
		else 
		    $query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".gallery");
		return $query->rows;
	}
	
	public  function addGallery($data,$gallery_image,$app_id){
		$this->db->query(" INSERT into " . DB_DATABASE_APPSTORE . ".gallery set gallery_image = '" .$this->db->escape($gallery_image).
						  "', app_id = " . (int)$app_id);
	}
	
   public  function editGallery($id,$data,$gallery_image,$app_id){
		$this->db->query(" UPDATE " . DB_DATABASE_APPSTORE . ".gallery set gallery_image = '" .$this->db->escape($gallery_image).
						  "', app_id = " . (int)$app_id .
						  " where gallery_id = " . $id);
	}
	
	public function deleteGallery($id){
		$this->db->query("DELETE from " . DB_DATABASE_APPSTORE . ".gallery where gallery_id = $id");
	}
	
	public function getGalleryById($id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".gallery WHERE gallery_id = '" . (int)$id . "'");
	
		return $query->row;
	}
}
?>