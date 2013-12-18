<?php
class ModelManageApp extends Model {
	public function getAppList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".app");
		return $query->rows;
	}
	
	public  function addApp($data,$image_small,$image_big,$source_link,$category,
	    $source_android,$source_ios,$source_blackberry,$source_java,$source_windows_phone){
		$this->db->query(" INSERT into " . DB_DATABASE_APPSTORE . ".app set app_name = '" . $this->db->escape($data['app_name']).
						  "', version = '" . $this->db->escape($data['version']).
						  "', price = '" . $this->db->escape($data['price']).
						  "', size = '" . "'".
						  ", image_small = '" .$this->db->escape($image_small).
						  "', image_big = '" .$this->db->escape($image_big).
		                  "', ad_link = '" .$this->db->escape($data['ad_link']).
						  "', source_link = '" .$this->db->escape($source_link).
		                  "', source_ios = '" .$this->db->escape($source_ios).
		                  "', source_android = '" .$this->db->escape($source_android).
		                  "', source_blackberry = '" .$this->db->escape($source_blackberry).
		                  "', source_java = '" .$this->db->escape($source_java).
		                  "', source_windows_phone = '" .$this->db->escape($source_windows_phone).
		                  "', source_google = '" .$this->db->escape($data['source_google']).
						  "', guide_video = '" .$this->db->escape($data['guide_video']).
						  "', description = '" . $this->db->escape($data['description']).
						  "', status = " . (int)$data['status'].
		 				  ", category_id = " . (int)$data['category_id'].
		                  ", category_name = '" . $this->db->escape($category['category_name']).
		                  "', category_code = '" . $this->db->escape($category['category_code']).
						  "', code = '" . $this->db->escape($data['code']).
						  "', date_time = " . time().
		 				  ", type_hot = " . (int)$data['type_hot'].
						  ", guide = '" . $this->db->escape($data['guide']).
						  "', seo_title = '" . $this->db->escape($data['seo_title']).
						  "', seo_content = '" . $this->db->escape($data['seo_content'])."'");
	}
	
	public  function editApp($id,$data,$image_small,$image_big,$source_link,$category,
	        $source_android,$source_ios,$source_blackberry,$source_java,$source_windows_phone){
		$this->db->query("UPDATE  " . DB_DATABASE_APPSTORE . ".app set app_name = '" . $this->db->escape($data['app_name']).
					      "', version = '" . $this->db->escape($data['version']).
						  "', price = '" . $this->db->escape($data['price']).
						  "', size = '" . "'".
						  ", image_small = '" .$this->db->escape($image_small).
						  "', image_big = '" .$this->db->escape($image_big).
		                  "', ad_link = '" .$this->db->escape($data['ad_link']).
						  "', source_link = '" .$this->db->escape($source_link).
		                  "', source_ios = '" .$this->db->escape($source_ios).
		                  "', source_android = '" .$this->db->escape($source_android).
		                  "', source_blackberry = '" .$this->db->escape($source_blackberry).
		                  "', source_java = '" .$this->db->escape($source_java).
		                  "', source_windows_phone = '" .$this->db->escape($source_windows_phone).
		                  "', source_google = '" .$this->db->escape($data['source_google']).
						  "', guide_video = '" .$this->db->escape($data['guide_video']).
						  "', description = '" . $this->db->escape($data['description']).
						  "', status = " . (int)$data['status'].
		                  ", category_id = " . (int)$data['category_id'].
		                  ", category_name = '" . $this->db->escape($category['category_name']).
		                  "', category_code = '" . $this->db->escape($category['category_code']).
						  "', code = '" . $this->db->escape($data['code']).
						  "', date_time = " . time().
		 				  ", type_hot = " . (int)$data['type_hot'].
						  ", guide = '" . $this->db->escape($data['guide']).
						  "', seo_title = '" . $this->db->escape($data['seo_title']).
						  "', seo_content = '" . $this->db->escape($data['seo_content']).
						  "'  where app_id = $id");
	}
	
	public function deleteApp($id){
		$this->db->query("DELETE from " . DB_DATABASE_APPSTORE . ".app where app_id = $id");
	}
	
	
	public function getAppById($id){
		$query = $this->db->query("select * from " . DB_DATABASE_APPSTORE . ".app where app_id = $id");
		return  $query->row;
	}
}
?>