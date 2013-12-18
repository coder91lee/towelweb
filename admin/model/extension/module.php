<?php
/*******************************************************************
* 
* Updated by: Ha Viet Duc
* Date      : 14/11/2012
* Date      : 14/10/2013
* 
********************************************************************/
class ModelExtensionModule extends Model {
	
	public function getAllModules($start, $limit)
	{
			$sql="select * from " . DB_PREFIX . " module  order by name desc  limit " . $start . ", " . $limit;
			$rtn = $this->db->query($sql);

			if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
			{
				return null;
			}
			return $rtn-> rows;
	}
	
	public function getAllModulesNoLimit()
	{
			$sql="select * from " . DB_PREFIX . " module  order by name desc ";
			$rtn = $this->db->query($sql);

			if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
			{
				return null;
			}
			return $rtn-> rows;
	}

	public function getTotalModule()
	{
		$sql = "select count(module_id) as total from module a where 1=1";
		
		$rtn = $this->db->query($sql);

		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}

		return $rtn -> row['total'];
	}


	public function setEmptyImage($module_id)
	{
		$this->db->query("UPDATE " . DB_PREFIX . "module SET image = '' WHERE module_id = " . (int)$module_id);

		$this->cache->delete('module');

	}

	public function updateModule($image, $data, $module_id)
	{
		if($image != "" && $image)
		$this->db->query("UPDATE " . DB_PREFIX . "module SET
	      					 name = '" . $this->db->escape($data['name']) .
	      					 "', image = '" . $image .	      					 
	      					 "', module_type_id = " . (int)$data['module_type_id'] .
	      					 ", category_id = " . $data['category_id'] .
	      					 ", status = '" . $data['status'] .
	      					 "' WHERE module_id = " . (int)$module_id);
		 else
		 $this->db->query("UPDATE " . DB_PREFIX . "module SET
			 name = '" . $this->db->escape($data['name']) .	      	 				
			 "', module_type_id = " . (int)$data['module_type_id'] .
			 ", category_id = " . $data['category_id'] .
			 ", status = '" . $data['status'] .
			 "' WHERE module_id = " . (int)$module_id);
			 $this->cache->delete('module');
	}

	public function getAllEnableModules()
	{
		$sql = " select * from module where status = 1";

		$rtn = $this->db->query($sql);

		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}

		return $rtn -> rows;
	}

	public function getAllEnableFormModules()
	{
		$sql = " select m.* from module m, module_type mt
				where m.status = 1 and m.module_type_id = mt.module_type_id and mt.code = 'form'";

		$rtn = $this->db->query($sql);

		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}

		return $rtn -> rows;
	}

	public function getChildModule($module_id)
	{
		$sql = " select * from module_in_module mi, module m where mi.child_module_id = m.module_id and parent_module_id = ". $module_id. " order by sort_order";

		$rtn = $this->db->query($sql);

		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}

		return $rtn -> rows;
	}

	public function getModuleById($module_id)
	{
		$sql = " select * from module m where module_id = ".$module_id;

		$rtn = $this->db->query($sql);

		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}

		return $rtn -> row;
	}

	public function deleteChildModule($module_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "module_in_module WHERE parent_module_id = " . (int)$module_id );
	}
	
	public function deletePackagesOfModule($module_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "package_module WHERE module_id = " . (int)$module_id );
	}

	public function deleteModule($module_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "module WHERE module_id = " . (int)$module_id );
		$this->db->query("DELETE FROM " . DB_PREFIX . "module_in_layout WHERE module_id = " . (int)$module_id );
		//$this->db->query("DELETE FROM " . DB_PREFIX . "module_in_module WHERE child_module_id = " . (int)$module_id );
	}

	public function insertChildModule($module_id, $child, $count)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "module_in_module
						SET parent_module_id = " . $module_id . 
						", child_module_id = " . $child .
						", sort_order = " . $count);
	}

	public function addPackageForModule($module_id, $package)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "package_module
						SET status = 1, module_id = " . $module_id . 
						", package_id = " . $package);
	}

	public function editModule($module_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "module
      					SET name = '" . $this->db->escape($data['name']) . 
						"', code = '" . $data['code'].
      					"' WHERE module_id = '" . (int)$module_id . "'");
	}

	public function addModule($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "module
      					  SET name = '" . $this->db->escape($data['name']) . 
						  "', code = '" . $data['code'].
      					  "'");
	}
	
	public function getManuallyByModuleId($module_id)
	{
		$sql = " select * from module_manually where module_id = " . $module_id;

		$rtn = $this->db->query($sql);

		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}

		return $rtn -> rows;
	}
	
	public function insertModuleManually($module_id, $code)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "module_manually
      					  SET module_id = " . $module_id . 
      					  ", code = '" . $code .
      					  "', status = 1");
	}
	
	public function deleteModuleManually($module_id, $code)
	{
		$this->db->query("delete from module_manually
      					  where module_id = " . $module_id . 
      					  " and code = '" . $code . "'");
	}
	
	public function getModuleManuallyByCode($code)
	{
		$sql = " select ma.*, m.name from module_manually ma, module m where m.module_id = ma.module_id and code = '" . $code . "'";

		$rtn = $this->db->query($sql);

		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}

		return $rtn -> rows;
	}
	
	public function getModuleManuallyByCodeAndModuleId($code, $module_id)
	{
		$sql = " select ma.*, m.name from module_manually ma, module m where m.module_id = ma.module_id and code = '" . $code . "' and ma.module_id = " . $module_id;

		$rtn = $this->db->query($sql);

		if($rtn == null || !isset($rtn)|| $rtn-> num_rows <=0)
		{
			return null;
		}

		return $rtn -> rows;
	}
}
?>