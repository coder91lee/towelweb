<?php  
class ControllerManageTowelimage extends Controller {  
	public function index() {
		$this->load->language('manage/towel_image');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('manage/towel_image');

		$this->getList();
	}
	
	public function insert(){
		$this->load->language('manage/towel_image');

		$this->document->setTitle($this->language->get('heading_title'));

		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/towelimage', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		$this->load->model('manage/towel_image');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			
		    if ($_FILES['image']['name'] != '')
    		{
    			$towel_image_image = $_FILES['image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image']))
      			{
      			  	move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_TOWEL_IMAGE_SMALL . $towel_image_image);
      			  	//Resize towel_image towel image
      			}
    		}
    		else{
    			$towel_image_image = '';	
    		}
    		

    		$this -> model_manage_towel_image -> addTowelImage( $this->request->post,$towel_image_image,$this->request->get['towel_id']);
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			
			$this->redirect($this->url->link('manage/towelimage', 'token=' . $this->session->data['token'] . '&towel_id=' . $this->request->get['towel_id'] , 'SSL'));
		}

		$this->getForm();
	}
	
	public function  update(){
		$this->load->language('manage/towel_image');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/towel_image');		
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/towel_image', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {	
			
			$towel_image = $this->model_manage_towel_image->getTowelImageById($_GET['towel_image_id']);
		    if ($_FILES['image']['name'] != '')
    		{
    			$towel_image_image = $_FILES['image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image']))
      			{
      			  	move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_TOWEL_IMAGE_SMALL . $towel_image_image);   
      			}
    		}
    		else{
    			$towel_image_image = $towel_image['towel_image_image'];	
    		}
    		
			$this-> model_manage_towel_image ->editTowelImage($this->request->get['towel_image_id'], $this->request->post,$towel_image_image,$this->request->get['towel_id']);
			
			$this->redirect($this->url->link('manage/towelimage', 'token=' . $this->session->data['token'] . '&towel_id=' . $this->request->get['towel_id'], 'SSL'));
		}
	
	    $this -> getForm();
	}
	
	public function delete(){
		$this->load->language('manage/towel_image');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/towel_image');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/towelimage', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		else 
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				
				$this->model_manage_towel_image->deleteTowelImage($id);
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
            
			$this->redirect($this->url->link('manage/towelimage', 'token=' . $this->session->data['token'] . '&towel_id=' . $this->request->get['towel_id'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function getForm(){
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['entry_towel_image_name'] = $this->language->get('entry_title');
		$this->data['entry_towel_image_code'] = $this->language->get('entry_cate');
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
		'href'      => $this->url->link('manage/towel_image', 'token=' . $this->session->data['token'] . '&towel_id=' . $this->request->get['towel_id'] , 'SSL'),
		'separator' => ' :: '
		);
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
	    if (!isset($this->request->get['towel_image_id'])) {
			$this->data['action'] = $this->url->link('manage/towelimage/insert',  '&token=' . $this->session->data['token'] . '&towel_id=' . $this->request->get['towel_id'] , 'SSL');
		} else {
			$this->data['action'] = $this->url->link('manage/towelimage/update', 'token=' . $this->session->data['token'] . '&towel_image_id=' . $this->request->get['towel_image_id'] . '&towel_id=' . $this->request->get['towel_id'], 'SSL');
		}
			
			
		$this->data['cancel'] = $this->url->link('manage/towelimage',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
			
		   if (isset($this->request->get['towel_image_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$info = $this->model_manage_towel_image-> getTowelImageById($this->request->get['towel_image_id']);
			}
		
		    if (isset($this->request->post['towel_image_id'])) {
				$this->data['towel_image_id'] = $this->request->post['towel_image_id'];
			} elseif (isset($info)) {
				$this->data['towel_image_id'] = $info['towel_image_id'];
			} else {
				$this->data['towel_image_id'] = 0;
			} 
			
			
		$this->template = 'manage/towel_image_form.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	public function getList(){
    // Load file language
	$this->load->language('manage/towel_image');
    $this->data['breadcrumbs'] = array();

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('text_home'),
	'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
	'separator' => false
	);

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('heading_title'),
	'href'      => $this->url->link('manage/towelimage', 'token=' . $this->session->data['token'] , 'SSL'),
	'separator' => ' :: '
	);
	
	$this->data['insert'] = $this->url->link('manage/towelimage/insert', 'token=' . $this->session->data['token'] . '&towel_id=' . $this->request->get['towel_id'] , 'SSL');
	$this->data['delete'] = $this->url->link('manage/towelimage/delete', 'token=' . $this->session->data['token'] , 'SSL');

	$limit = $this->language->get('limit');
	
	//Truyen vao mang data
	$this->data['heading_title'] = $this->language->get('heading_title');
	$this->data['text_no_results'] = $this->language->get('text_no_results');
	$this->data['text_success'] = $this->language->get('text_success');
	$this->data['text_towel_image_name'] = $this->language->get('text_towel_image_name');
	$this->data['text_towel_image_code'] = $this->language->get('text_towel_image_code');
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
		
    if(isset($this->request->get['towel_id'])){
        $towel_id = $this->request->get['towel_id'];
    }else{
        $towel_id = 0;
    }
    $this->load->model('manage/towel');
    $towel = $this->model_manage_towel-> getTowelById($this->request->get['towel_id']);
		
		
	$this->load->model('manage/towel_image');
	
	$towel_images = $this->model_manage_towel_image-> getTowelImageListByTowelId($towel_id);
	$towel_imageList = array();
	if($towel_images){
		foreach ($towel_images as $t){
			$towel_image = array(
					'towel_image_id'  => $t['towel_image_id'],
			        'towel_name' => $towel['towel_name'],
					'image'      => $t['image'],
					'action'         => $this->url->link('manage/towelimage/update', 'token=' . $this->session->data['token'] . '&towel_image_id=' . $t['towel_image_id'] . '&towel_id=' . $towel_id, 'SSL'),
					'selected'       => isset($this->request->post['selected']) && in_array($t['towel_image_id'], $this->request->post['selected']),
			
			);
			
			$towel_imageList[] = $towel_image;
		}
		
		// Truyen vao mang data
        $this-> data['towel_images'] = $towel_imageList;
	}
	
	//Lien ket toi file template
	$this->template = 'manage/towel_image.tpl';
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
