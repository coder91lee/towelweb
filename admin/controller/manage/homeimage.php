<?php  
class ControllerManageHomeimage extends Controller {  
	public function index() {
		$this->load->language('manage/home_image');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('manage/home_image');

		$this->getList();
	}
	
	public function insert(){
		$this->load->language('manage/home_image');

		$this->document->setTitle($this->language->get('heading_title'));

		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/homeimage', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		$this->load->model('manage/home_image');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			
		    if ($_FILES['image']['name'] != '')
    		{
    			$home_image_image = $_FILES['image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image']))
      			{
      			  	move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_HOME_IMAGE_SMALL . $home_image_image);
      			}
    		}
    		else{
    			$home_image_image = '';	
    		}
    		

    		$this -> model_manage_home_image -> addHomeImage($this->request->post,$home_image_image);
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			
			$this->redirect($this->url->link('manage/homeimage', 'token=' . $this->session->data['token'] . '&home_image_id=' . $this->request->get['home_image_id'] , 'SSL'));
		}

		$this->getForm();
	}
	
	public function  update(){
		$this->load->language('manage/home_image');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/home_image');		
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/homeimage', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {	
			
			$home_image = $this->model_manage_home_image->getHomeImageById($_GET['home_image_id']);
		    if ($_FILES['image']['name'] != '')
    		{
    			$home_image_image = $_FILES['image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image']))
      			{
      			  	move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_HOME_IMAGE_SMALL . $home_image_image);   
      			}
    		}
    		else{
    			$home_image_image = $home_image['image'];	
    		}
    		
			$this-> model_manage_home_image ->editHomeImage($this->request->get['home_image_id'], $this->request->post,$home_image_image);
			
			$this->redirect($this->url->link('manage/homeimage', 'token=' . $this->session->data['token'] . '&home_image_id=' . $this->request->get['home_image_id'], 'SSL'));
		}
	
	    $this -> getForm();
	}
	
	public function delete(){
		$this->load->language('manage/home_image');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/home_image');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/homeimage', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		else 
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				
				$this->model_manage_home_image->deleteHomeImage($id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
            
			$this->redirect($this->url->link('manage/homeimage', 'token=' . $this->session->data['token']. $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function getForm(){
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['entry_home_image_name'] = $this->language->get('entry_title');
		$this->data['entry_home_image_code'] = $this->language->get('entry_cate');
		$this->data['entry_title'] = $this->language->get('entry_title');
		

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
		'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
		'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('manage/homeimage', 'token=' . $this->session->data['token'], 'SSL'),
		'separator' => ' :: '
		);
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
	    if (!isset($this->request->get['home_image_id'])) {
			$this->data['action'] = $this->url->link('manage/homeimage/insert',  '&token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('manage/homeimage/update', 'token=' . $this->session->data['token'] . '&home_image_id=' . $this->request->get['home_image_id'], 'SSL');
		}
			
			
		$this->data['cancel'] = $this->url->link('manage/homeimage',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
			
		   if (isset($this->request->get['home_image_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$info = $this->model_manage_home_image-> getHomeImageById($this->request->get['home_image_id']);
			}
		
		    if (isset($this->request->post['home_image_id'])) {
				$this->data['home_image_id'] = $this->request->post['home_image_id'];
			} elseif (isset($info)) {
				$this->data['home_image_id'] = $info['home_image_id'];
			} else {
				$this->data['home_image_id'] = 0;
			} 
			
	    if (isset($this->request->post['name'])) {
				$this->data['name'] = $this->request->post['name'];
			} elseif (isset($info)) {
				$this->data['name'] = $info['name'];
			} else {
				$this->data['name'] = '';
			}
				
		$this->template = 'manage/home_image_form.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	public function getList(){
    // Load file language
	$this->load->language('manage/home_image');
    $this->data['breadcrumbs'] = array();

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('text_home'),
	'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
	'separator' => false
	);

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('heading_title'),
	'href'      => $this->url->link('manage/homeimage', 'token=' . $this->session->data['token'] , 'SSL'),
	'separator' => ' :: '
	);
	
	$this->data['insert'] = $this->url->link('manage/homeimage/insert', 'token=' . $this->session->data['token'], 'SSL');
	$this->data['delete'] = $this->url->link('manage/homeimage/delete', 'token=' . $this->session->data['token'] , 'SSL');

	$limit = $this->language->get('limit');
	
	//Truyen vao mang data
	$this->data['heading_title'] = $this->language->get('heading_title');
	$this->data['text_no_results'] = $this->language->get('text_no_results');
	$this->data['text_success'] = $this->language->get('text_success');
	$this->data['text_home_image_name'] = $this->language->get('text_home_image_name');
	$this->data['text_home_image_code'] = $this->language->get('text_home_image_code');
	$this->data['column_name'] = $this->language->get('column_name');
	$this->data['column_module_type'] = $this->language->get('column_module_type'); 
	$this->data['column_module_cate'] = $this->language->get('column_module_cate');
	$this->data['column_action'] = $this->language->get('column_action');
	$this->data['column_status'] = $this->language->get('column_status');
	$this->data['button_filter'] = $this->language->get('button_filter');
	$this->data['button_insert'] = $this->language->get('button_insert');
	$this->data['button_delete'] = $this->language->get('button_delete');
	
		
	 if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			$this->session->data['success'] = null;
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		if (isset($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];

			$this->session->data['error'] = null;
			unset($this->session->data['error']);
		} else {
			$this->data['error'] = '';
		}
		
    if(isset($this->request->get['home_image_id'])){
        $home_image_id = $this->request->get['home_image_id'];
    }else{
        $home_image_id = 0;
    }

    $this->load->model('manage/home_image');
	
	$home_images = $this->model_manage_home_image-> getHomeImageList();
	$home_imageList = array();
	if($home_images){
		foreach ($home_images as $himage){
			$home_image = array(
					'home_image_id'  => $himage['home_image_id'],
					'image'      => $himage['image'],
					'name'      => $himage['name'],
					'action'         => $this->url->link('manage/homeimage/update', 'token=' . $this->session->data['token'] . '&home_image_id=' . $himage['home_image_id'], 'SSL'),
					'selected'       => isset($this->request->post['selected']) && in_array($himage['home_image_id'], $this->request->post['selected']),
			
			);
			
			$home_imageList[] = $home_image;
		}
		
		// Truyen vao mang data
        $this-> data['home_images'] = $home_imageList;
	}
	
	//Lien ket toi file template
	$this->template = 'manage/home_image.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

    $this->response->setOutput($this->render());
	}
	
	private function validateDelete() {
		$error = null;
		if (!$this->user->hasPermission('modify', 'extension/module')) {
			$error = $this->language->get('error_permission');
			$this->error['warning'] = $error;
		}

		if (!$error) {
			return true;
		} else {
			return false;
		}
	}
	
	private function validateForm() {
	    $error = null; 
    	if (!$this->user->hasPermission('modify', 'extension/module')) {
      		$error = $this->language->get('error_permission');
			$this->error['warning'] = $error;
    	}
					
    	if (!$error) {
			return true;
    	} else {
      		return false;
    	}
  	}
	
}

?>
