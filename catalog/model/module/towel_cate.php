<?php
class ModelModuleTowelCate extends Model {
	public function getTowelCateList($limit) {
	    if(isset($limit) && $limit != ''){
            $query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".towel_cate limit $limit");
	    }else{
	        $query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".towel_cate");
	    }
		//$query = $this->db->query("SELECT * FROM towel.towel_cate");
		return $query->rows;
	}
	
    public function  showTowelCateList($list){
	    $towel_cateList = array();
		if(isset($list) && $list)
		{
			foreach ($list as $towel_cate)
			{
				$towel_cateItem = array(
				'towel_cate_image'    => $towel_cate['towel_cate_image'],
				'towel_cate_name'    => $towel_cate['towel_cate_name'],
				'href'  => HTTP_SERVER . 'index.php?route=category&category_id=' .  $towel_cate['towel_cate_id'],
				);
				
				$towel_cateList[] = $towel_cateItem;
			}
		}
		
		return $towel_cateList;
	}
	
	public function deleteTowelCate($id){
		$this->db->query("DELETE from " . DB_DATABASE . ".towel_cate where towel_cate_id = $id");
	}
	
	
	public function getTowelCateById($id){
		$query = $this->db->query("select * from " . DB_DATABASE . ".towel_cate where towel_cate_id = $id");
		return  $query->row;
	}
	
	public function getTowelCateIMageList($id){
	    $query = $this->db->query("select * from " . DB_DATABASE . ".towel_cate_image where towel_cate_id = $id");
		return  $query->row;
	}
}
?>