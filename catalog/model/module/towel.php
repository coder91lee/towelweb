<?php
class ModelModuleTowel extends Model {
	public function getTowelListByCateId($id) {
	    if($id != ''){
            $query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".towel where towel_cate_id = $id");
	    }else{
	        $query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".towel");
	    }
		//$query = $this->db->query("SELECT * FROM towel.towel");
		return $query->rows;
	}
	
    public function  showTowelList($list){
	    $towelList = array();
		if(isset($list) && $list)
		{
			foreach ($list as $towel)
			{
				$towelItem = array(
				'towel_image'    => $towel['towel_image'],
				'towel_name'    => $towel['towel_name'],
				'href'  => HTTP_SERVER . 'index.php?route=towel&towel_id=' .  $towel['towel_id'],
				);
				
				$towelList[] = $towelItem;
			}
		}
		
		return $towelList;
	}
	
	public function deleteTowel($id){
		$this->db->query("DELETE from " . DB_DATABASE . ".towel where towel_id = $id");
	}
	
	
	public function getTowelById($id){
		$query = $this->db->query("select * from " . DB_DATABASE . ".towel where towel_id = $id");
		return  $query->row;
	}
	
	public function getTowelIMageList($id){
	    $query = $this->db->query("select * from " . DB_DATABASE . ".towel_image where towel_id = $id");
		return  $query->row;
	}
}
?>