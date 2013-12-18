<?php  
class ControllerModuleTowelCateDetail extends Controller {
	protected function index() {
		//Lay ra danh sach cac loai khan
		$this->load->model('module/towel_cate');
		$this->load->model('module/towel');
		$towel_cate_id = isset($this->request->get['category_id'])? $this->request->get['category_id'] : 0;
		
		if($towel_cate_id == 0){ //lay danh sach cac category
            $towel_cates = $this->model_module_towel_cate->getTowelCateList(6);
            $towel_cates = $this->model_module_towel_cate->showTowelCateList($towel_cates);
            
            $this->data['list'] = $towel_cates;
            $this->data['type'] = 1;
    		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/towel_cate_list.tpl')) {
    			$this->template = $this->config->get('config_template') . '/template/module/towel_cate_list.tpl';
    		} else {
    			$this->template = 'default/template/module/towel_cate_list.tpl';
    		}
		}else{// lay danh sach cac towel thuoc towel_cate
    		$towel_cate = $this->model_module_towel_cate->getTowelCateById($towel_cate_id);
    	    $towels = $this->model_module_towel-> getTowelListByCateId($towel_cate_id);
    	    $towels = $this->model_module_towel-> showTowelList($towels);
    	    
    		$this->data['list'] = $towels;
    		$this->data['detail'] = $towel_cate;
    		$this->data['type'] = 2;
    		
    		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/towel_cate_detail.tpl')) {
    			$this->template = $this->config->get('config_template') . '/template/module/towel_cate_detail.tpl';
    		} else {
    			$this->template = 'default/template/module/towel_cate_detail.tpl';
    		}
		}
		
		$this->render();
	}
}
?>