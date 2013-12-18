<?php
class ModelManageDevice extends Model {
	public function getDeviceList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".device");
		return $query->rows;
	}
	
	public  function addDevice($data,$device_image){
		$this->db->query(" INSERT into " . DB_DATABASE_APPSTORE . ".device set device_name = '" . $this->db->escape($data['device_name']).
		 				  "',  device_image = '" .$this->db->escape($device_image).
						  "', status = " . (int)$data['status'].
						  ",  device_code = '" .$this->db->escape($data['device_code'])."'");
	}
	
   public  function editDevice($id,$data,$device_image){
		$this->db->query(" UPDATE " . DB_DATABASE_APPSTORE . ".device set device_name = '" . $this->db->escape($data['device_name']).
						  "',  device_image = '" .$this->db->escape($device_image).
						  "', status = " . (int)$data['status'].
						  ",  device_code = '" .$this->db->escape($data['device_code']).
						  "'where device_id = $id");
	}
	
	public function deleteDevice($id){
		$this->db->query("DELETE from " . DB_DATABASE_APPSTORE . ".device where device_id = $id");
	}
	
	public function getDeviceById($id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".device WHERE device_id = '" . (int)$id . "'");
	
		return $query->row;
	}
}
?>