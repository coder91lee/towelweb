<?php
class ModelManageAd extends Model {
	public function getAdList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".ad");
		return $query->rows;
	}
	
	public  function addAd($data,$image,$width,$height){
		$this->db->query(" INSERT into " . DB_DATABASE_APPSTORE . ".ad set name = '" . $this->db->escape($data['name']).
						  "', ad_content = '" . $this->db->escape($data['ad_content']).
						  "', image = '" .$this->db->escape($image).
		  				  "', position = " . (int)$data['position'].
		                  ", width = " . (float)$width.
		                  ", height = " . (float)$height.
						  ", start_time = " . (int)$data['start_time'].
						  ", end_time = " . (int)$data['end_time'].
						  ", title = '" . $this->db->escape($data['title']).
		                  "', link = '" .$this->db->escape($data['link']).
		 				  "', status = " . (int)$data['status'].
		 				  ", type = " . (int)$data['type']);
	}
	
	public  function editAd($id,$data,$image,$width,$height){
		$this->db->query("UPDATE  " . DB_DATABASE_APPSTORE . ".ad set name = '" . $this->db->escape($data['name']).
					      "', ad_content = '" . $this->db->escape($data['ad_content']).
						  "', image = '" .$this->db->escape($image).
		  				  "', position = " . (int)$data['position'].
		                  ", width = " . (float)$width.
		                  ", height = " . (float)$height.
						  ", start_time = " . (int)$data['start_time'].
						  ", end_time = " . (int)$data['end_time'].
						  ", title = '" . $this->db->escape($data['title']).
		                  "', link = '" .$this->db->escape($data['link']).
		 				  "', type = " . (int)$data['type'].
						  ", status = " . (int)$data['status'].
						  "  where ad_id = $id");
	}
	
	public function deleteAd($id){
		$this->db->query("DELETE from " . DB_DATABASE_APPSTORE . ".ad where ad_id = $id");
	}
	
	
	public function getAdById($id){
		$query = $this->db->query("select * from " . DB_DATABASE_APPSTORE . ".ad where ad_id = $id");
		return  $query->row;
	}
}
?>