<?php
class ModelSettingExtension extends Model {
	function getExtensions($type) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "'");

		return $query->rows;
	}
	
	function getModuleInLayout($layout_id,$layout_pos){
		$query = $this->db->query("select m.*, i.sort_order  from module m, module_in_layout i where i.layout_id = $layout_id and i.layout_pos = $layout_pos and m.module_id =  i.module_id");
		return $query->rows;
	}
}
?>