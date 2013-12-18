<?php
class ModelDesignLayout extends Model {
	public function addLayout($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "layout SET name = '" . $this->db->escape($data['name']) . "'");
	
		$layout_id = $this->db->getLastId();
		
		if (isset($data['layout_route'])) {
			foreach ($data['layout_route'] as $layout_route) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_route SET layout_id = " . (int)$layout_id . ", route = '" . $this->db->escape($layout_route['route']) . "'");
			}	
		}
	}
	
	public function editLayout($layout_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "layout SET name = '" . $this->db->escape($data['name']) . "' WHERE layout_id = '" . (int)$layout_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_route WHERE layout_id = '" . (int)$layout_id . "'");
		
		if (isset($data['layout_route'])) {
			foreach ($data['layout_route'] as $layout_route) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_route SET layout_id = " . (int)$layout_id . ", route = '" . $this->db->escape($layout_route['route']) . "'");
			}
		}
	}
	
	public function deleteLayout($layout_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout WHERE layout_id = '" . (int)$layout_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_route WHERE layout_id = '" . (int)$layout_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "module_in_layout WHERE layout_id = '" . (int)$layout_id . "'");
	}
	
	public function deleteModuleInLayout($layout_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "module_in_layout WHERE layout_id = '" . (int)$layout_id . "'");
	}
	
	public function getLayout($layout_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "layout WHERE layout_id = '" . (int)$layout_id . "'");
		
		return $query->row;
	}
	
	public function getLayoutModule($layout_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module_in_layout ml, module m WHERE ml.module_id = m.module_id and layout_id = " . (int)$layout_id . " order by sort_order");
		
		return $query->rows;
	}
	
	public function getAllLayouts() {
		$sql = "SELECT * FROM " . DB_PREFIX . "layout";
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
		 
	public function getLayouts($data = array()) {
	if ($data) {
			$sql = "SELECT a.*, r.route as route FROM layout a, layout_route r where r.layout_id = a.layout_id "; 
			if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
				$sql .= " AND LCASE(a.name) LIKE LCASE('%" . $this->db->escape($data['filter_name']) . "%')";
			}

			if (isset($data['filter_route']) && !is_null($data['filter_route'])) {
				$sql .= " AND LCASE(r.route) LIKE LCASE('%" . $this->db->escape($data['filter_route']) . "%')";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
			
			$query = $this->db->query($sql);
			return $query->rows;
		}
		else
		{
			$sql="select * from layout limit order by name desc";
			$app_data = $query->rows;
			$rtn = $this->db->query($sql);

			if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
			{
				return null;
			}
			return $rtn-> rows;

	}	
	
	}
	public function getLayoutRoute($layout_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_route WHERE layout_id = '" . (int)$layout_id . "'");
		
		return $query->row;
	}
		
	public function getTotalLayouts($data=array()) {
      //	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "layout");
		$sql = "select count(a.layout_id) as total from layout a, layout_route r where 1=1 and   r.layout_id = a.layout_id";
		if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
				$sql .= " AND LCASE(a.name) LIKE LCASE('%" . $this->db->escape($data['filter_name']) . "%')";
			}
		if (isset($data['filter_route']) && !is_null($data['filter_route'])) {
				$sql .= " AND LCASE(r.route) LIKE LCASE('%" . $this->db->escape($data['filter_route']) . "%')";
			}
		$rtn = $this->db->query($sql);
		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}
		
		return $rtn -> row['total'];
	}	
	
	public function addModuleInLayout($layout_id, $module_id, $count, $pos)
	{	
		$this->db->query("INSERT INTO " . DB_PREFIX . "module_in_layout 
						SET module_id = " . $module_id . 
						", layout_id = " . $layout_id . 
						", layout_pos = " . $pos . 
						", sort_order = " . $count);
	}
	
	
}
?>