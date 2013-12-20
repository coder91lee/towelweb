<?php  
class ControllerModuleTowelDetail extends Controller {
	protected function index() {
		//Lay ra danh sach cac loai khan
		$this->load->model('module/towel');
		$towel_id = isset($this->request->get['towel_id'])? $this->request->get['towel_id'] : 0;
		
		$towel = $this->model_module_towel->getTowelById($towel_id);
	    $towel_images = $this->model_module_towel-> getTowelIMageList($towel_id);

	    $this->data['image_list'] = $towel_images;
		$this->data['detail'] = $towel;
		
		//Lay danh sach chuyen muc khac
		$this->load->model('module/towel_cate');
		
		$towel_cates = $this->model_module_towel_cate->getTowelCateList(6);

		$towel_cates = $this->model_module_towel_cate->showTowelCateList($towel_cates);
		$this->data['cate_list'] = $towel_cates;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/towel_detail.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/towel_detail.tpl';
		} else {
			$this->template = 'default/template/module/towel_detail.tpl';
		}
		
		$this->render();
	}
}
?>