<?php  
class ControllerModuleHomeImage extends Controller {
	protected function index() {
		$this->load->model('module/home_image');
		$list = $this->model_module_home_image->getHomeImageList(6);
		
		$homeImageList = $this->model_module_home_image->showHomeImageList($list);
		
		$this->data['list'] = $homeImageList;
		
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/home_image.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/home_image.tpl';
		} else {
			$this->template = 'default/template/module/home_image.tpl';
		}
		
		$this->render();
	}
}
?>