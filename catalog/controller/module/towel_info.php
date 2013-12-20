<?php  
class ControllerModuleTowelInfo extends Controller {
	protected function index() {
		//Lay ra danh sach cac loai khan
		$this->load->model('module/towel_cate');
		$list = $this->model_module_towel_cate->getTowelCateList(5);
		
		$towelCateList = $this->model_module_towel_cate->showTowelCateList($list);
		$this->data['list'] = $towelCateList;
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/towel_info.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/towel_info.tpl';
		} else {
			$this->template = 'default/template/module/towel_info.tpl';
		}
		$this->render();
	}
}
?>