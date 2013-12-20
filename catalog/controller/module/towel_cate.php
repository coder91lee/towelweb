<?php  
class ControllerModuleTowelCate extends Controller {
	protected function index() {
		//Lay ra danh sach cac loai khan
		$this->load->model('module/towel_cate');
		
		$towel_cates = $this->model_module_towel_cate->getTowelCateList(6);

		$towel_cates = $this->model_module_towel_cate->showTowelCateList($towel_cates);
		$this->data['list'] = $towel_cates;
		
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/towel_cate.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/towel_cate.tpl';
		} else {
			$this->template = 'default/template/module/towel_cate.tpl';
		}
		$this->render();
	}
}
?>