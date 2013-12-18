<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle('PicoStore - ' . PAGE_SEO);
		$this->document->setDescription('PicoStore: Pico app store');

		$this->data['heading_title'] = $this->config->get('config_title');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		} else {
			$this->template = 'default/template/common/home.tpl';
		}
		
		$this->children = array(
			'common/column_right',
			'common/column_left',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);

		$this->response->setOutput($this->render());
		
		
	}
}
?>