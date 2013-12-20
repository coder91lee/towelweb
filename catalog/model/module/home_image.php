<?php
class ModelModuleHomeImage extends Model {
	public function getHomeImageList() {
//		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".home_image");
		$query = $this->db->query("SELECT * FROM towel.home_image");
		return $query->rows;
	}
	
    public function getNewHomeImageList($limit) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_TOWEL . ".home_image order by start_time desc limit $limit");
		return $query->rows;
	}
	
    public function  showHomeImageList($list){
	    $home_imageList = array();
		if(isset($list) && $list)
		{
			foreach ($list as $home_image)
			{
				$home_imageItem = array(
				'image'    => $home_image['image'],
				'link'    => $home_image['link'],
				);
				
				$home_imageList[] = $home_imageItem;
			}
		}
		
		return $home_imageList;
	}

	public function deleteHomeImage($id){
		$this->db->query("DELETE from " . DB_DATABASE_TOWEL . ".home_image where home_image_id = $id");
	}
	
	
	public function getHomeImageById($id){
		$query = $this->db->query("select * from " . DB_DATABASE_TOWEL . ".home_image where home_image_id = $id");
		return  $query->row;
	}
}
?>