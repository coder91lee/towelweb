<?php
class ModelManageUser extends Model {
	public function getUserList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".user");
		return $query->rows;
	}
	public  function addUser($data,$image){
		$this->db->query(" INSERT into " . DB_DATABASE_APPSTORE . ".user set user_name = '" . $this->db->escape($data['user_name']).
						  "',  pass = '" .$this->db->escape(md5($data['pass'])).
						  "', full_name = '" .$this->db->escape($data['full_name']).
						  "', birth_day= '" .$this->db->escape($data['birth_day']).
						  "', email = '" .$this->db->escape($data['email']).
						  "', image = '" .$this->db->escape($image).
						  "', role = " .(int)$data['role'].
						  ", status = " .(int)$data['status'].
		                  ", code_user = '" .$this->db->escape($data['code_user']).
		 				  "', info = '" .$this->db->escape($data['info']).
						  "', creat_date = "  . time());
	}
	public  function editUser($user_id,$data,$image){
		$this->db->query(" UPDATE " . DB_DATABASE_APPSTORE . ".user set user_name = '" . $this->db->escape($data['user_name']).
						  "',  pass = '" .$this->db->escape(md5($data['pass'])).
						  "', full_name = '" .$this->db->escape($data['full_name']).
						  "', birth_day= '" .$this->db->escape($data['birth_day']).
						  "', email = '" .$this->db->escape($data['email']).
						  "', image = '" .$this->db->escape($image).
						  "', role = " .(int)$data['role'].
						  ", status = " .(int)$data['status'].
		                  ", code_user = '" .$this->db->escape($data['code_user']).
		 				  "', info = '" .$this->db->escape($data['info']).
						  "', creat_date = "  . time() . " where user_id = $user_id");
	}
			
	public function deleteUser($user_id) {
		$this->db->query("DELETE FROM " . DB_DATABASE_APPSTORE . ".user WHERE user_id = $user_id ");
	}
	
	public function getUserById($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".user WHERE user_id = $user_id ");
	
		return $query->row;
	}
	
	public function getUserByUsername($username) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE_APPSTORE . ".user WHERE user_name = '" . $this->db->escape($username) . "'");
	
		return $query->row;
	}
}
?>