<?php
class ModelManageTowelFeedback extends Model {
	public function getTowelFeedbackList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".towel_feedback");
		return $query->rows;
	}
	public  function addTowelFeedback($data){
		$this->db->query(" INSERT into " . DB_DATABASE . ".towel_feedback set
						  email = '" .$this->db->escape($data['email']).
						  "', name = '" .$this->db->escape($data['name']).
						  "', content = '" .$this->db->escape($data['content']).
						  "', status = " .(int)$data['status'].
						  ", creat_date = "  . time());
	}
	public  function editTowelFeedback($towel_feedback_id,$data){
		$this->db->query(" UPDATE " . DB_DATABASE . ".towel_feedback set 
						  email = '" .$this->db->escape($data['email']).
						  "', name = '" .$this->db->escape($data['name']).
						  "', content = '" .$this->db->escape($data['content']).
						  "', status = " .(int)$data['status'].
						  ", creat_date = "  . time() . " where towel_feedback_id = $towel_feedback_id");
	}
			
	public function deleteTowelFeedback($towel_feedback_id) {
		$this->db->query("DELETE FROM " . DB_DATABASE . ".towel_feedback WHERE towel_feedback_id = $towel_feedback_id ");
	}
	
	public function getTowelFeedbackById($towel_feedback_id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".towel_feedback WHERE towel_feedback_id = $towel_feedback_id ");
	
		return $query->row;
	}
}
?>