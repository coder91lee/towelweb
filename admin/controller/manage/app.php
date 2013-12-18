<?php
/*******************************************************************
* 
* Updated by: Ha Viet Duc
* Update Date: 14/11/2012
 * Update Date: 14/11/2012 @C: appstore
* 
********************************************************************/
class ControllerManageApp extends Controller {
	public function index() {
		$this->load->language('manage/app');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('manage/app');

		$this->getList();
	}
	
	public function insert(){
		$this->load->language('manage/app');

		$this->document->setTitle($this->language->get('heading_title'));

		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/app', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		$this->load->model('manage/app');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			
			//TODO: xu ly du lieu truoc khi insert vao csdl 
			if ($_FILES['image_small']['name'] != '')
    		{
    			$image_small= $_FILES['image_small']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image_small']))
      			{
      			  	move_uploaded_file($_FILES['image_small']['tmp_name'], DIR_IMAGE_APP_SMALL . $image_small);   
      			}
    		}
    		else 
    			$image_small = '';
    			
    	    if ($_FILES['image_big']['name'] != '')
    		{
    			$image_big = $_FILES['image_big']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image_big']))
      			{
      			  	move_uploaded_file($_FILES['image_big']['tmp_name'], DIR_IMAGE_APP_BIG . $image_big);   
      			}
    		}
    		else 
    			$image_big = '';	
    			
    	    if ($_FILES['source_link']['name'] != '')
    		{
    			$source_link = $_FILES['source_link']['name'];
    			
    			// upload source_link
      			if (isset($_FILES['source_link']))
      			{
      			  	move_uploaded_file($_FILES['source_link']['tmp_name'], DIR_FILE_APP . $source_link);   
      			}
    		}
    		else 
    			$source_link = '';
    			
           if ($_FILES['source_android']['name'] != '')
    		{
    			$source_android = $_FILES['source_android']['name'];
    			
    			// upload source_android
      			if (isset($_FILES['source_android']))
      			{
      			  	move_uploaded_file($_FILES['source_android']['tmp_name'], DIR_FILE_APP . $source_android);   
      			}
    		}
    		else 
    			$source_android = '';
    			
    	    if ($_FILES['source_ios']['name'] != '')
    		{
    			$source_ios = $_FILES['source_ios']['name'];
    			
    			// upload source ios
      			if (isset($_FILES['source_ios']))
      			{
      			  	move_uploaded_file($_FILES['source_ios']['tmp_name'], DIR_FILE_APP . $source_ios);   
      			}
    		}
    		else 
    			$source_ios = '';
    			
    	    if ($_FILES['source_blackberry']['name'] != '')
    		{
    			$source_blackberry = $_FILES['source_blackberry']['name'];
    			
    			// upload source_blackberry
      			if (isset($_FILES['source_blackberry']))
      			{
      			  	move_uploaded_file($_FILES['source_blackberry']['tmp_name'], DIR_FILE_APP . $source_blackberry);   
      			}
    		}
    		else 
    			$source_blackberry = '';
    		
    		if ($_FILES['source_java']['name'] != '')
    		{
    			$source_java = $_FILES['source_java']['name'];
    			
    			// upload source_java
      			if (isset($_FILES['source_java']))
      			{
      			  	move_uploaded_file($_FILES['source_java']['tmp_name'], DIR_FILE_APP . $source_java);   
      			}
    		}
    		else 
    			$source_java = '';
    			
    		if ($_FILES['source_windows_phone']['name'] != '')
    		{
    			$source_windows_phone = $_FILES['source_windows_phone']['name'];
    			
    			// upload source_windows_phone
      			if (isset($_FILES['source_windows_phone']))
      			{
      			  	move_uploaded_file($_FILES['source_windows_phone']['tmp_name'], DIR_FILE_APP . $source_windows_phone);   
      			}
    		}
    		else 
    			$source_windows_phone = '';
    			
    	    //Lay ra size cua app do cho vao co so du lieu
    		
    		$this->load->model('manage/category');
    		$category = $this->model_manage_category->getCategoryById($this->request->post['category_id']);

    		$this -> model_manage_app -> addApp( $this->request->post,$image_small,$image_big,$source_link,
    		    $category,$source_android,$source_ios,$source_blackberry,$source_java,$source_windows_phone);
    		
		    //Tang so app trong category
    		if($category){
    		    $this->model_manage_category->increaseCountApp($category['category_id']);
    		}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			//Resize big image and small image
			$this->resizeAppImages(DIR_IMAGE_APP_BIG,$image_big,2);
			$this->resizeAppImages(DIR_IMAGE_APP_SMALL,$image_small,1);

			$this->redirect($this->url->link('manage/app', 'token=' . $this->session->data['token'] , 'SSL'));
		}

		$this->getForm();
	}
	
	public function  update(){
		$this->load->language('manage/app');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/app');		
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/app', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
		    $app = $this->model_manage_app->getAppById($_GET['app_id']);	
		    
            if ($_FILES['image_small']['name'] != '')
    		{
    			$image_small= $_FILES['image_small']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image_small']))
      			{
      			  	move_uploaded_file($_FILES['image_small']['tmp_name'], DIR_IMAGE_APP_SMALL . $image_small);   
      			}
      			$this->resizeAppImages(DIR_IMAGE_APP_SMALL,$image_small,1);
    		}
    		else {
    			$image_small = $app['image_small'];
    		}
    			
    	    if ($_FILES['image_big']['name'] != '')
    		{
    			$image_big = $_FILES['image_big']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image_big']))
      			{
      			  	move_uploaded_file($_FILES['image_big']['tmp_name'], DIR_IMAGE_APP_BIG . $image_big);   
      			}
      			
      			$this->resizeAppImages(DIR_IMAGE_APP_BIG,$image_big,2);
    		}
    		else{
    			$image_big = $app['image_big'];	
    		}
    			
    	    if ($_FILES['source_link']['name'] != '')
    		{
    			$source_link = $_FILES['source_link']['name'];
    			
    			// upload small image
      			if (isset($_FILES['source_link']))
      			{
      			  	move_uploaded_file($_FILES['source_link']['tmp_name'], DIR_FILE_APP . $source_link);   
      			}
    		}
    		else {
    			$source_link = $app['source_link'];    			
    		}
    		
    		if ($_FILES['source_android']['name'] != '')
    		{
    			$source_android = $_FILES['source_android']['name'];
    			
    			// upload source_android
      			if (isset($_FILES['source_android']))
      			{
      			  	move_uploaded_file($_FILES['source_android']['tmp_name'], DIR_FILE_APP . $source_android);   
      			}
    		}
    		else 
    			$source_android = $app['source_android'];
    			
    	    if ($_FILES['source_ios']['name'] != '')
    		{
    			$source_ios = $_FILES['source_ios']['name'];
    			
    			// upload source ios
      			if (isset($_FILES['source_ios']))
      			{
      			  	move_uploaded_file($_FILES['source_ios']['tmp_name'], DIR_FILE_APP . $source_ios);   
      			}
    		}
    		else 
    			$source_ios = $app['source_ios'];
    			
    	    if ($_FILES['source_blackberry']['name'] != '')
    		{
    			$source_blackberry = $_FILES['source_blackberry']['name'];
    			
    			// upload source_blackberry
      			if (isset($_FILES['source_blackberry']))
      			{
      			  	move_uploaded_file($_FILES['source_blackberry']['tmp_name'], DIR_FILE_APP . $source_blackberry);   
      			}
    		}
    		else 
    			$source_blackberry = $app['source_blackberry'];
    		
    		if ($_FILES['source_java']['name'] != '')
    		{
    			$source_java = $_FILES['source_java']['name'];
    			
    			// upload source_java
      			if (isset($_FILES['source_java']))
      			{
      			  	move_uploaded_file($_FILES['source_java']['tmp_name'], DIR_FILE_APP . $source_java);   
      			}
    		}
    		else 
    			$source_java = $app['source_java'];
    			
    		if ($_FILES['source_windows_phone']['name'] != '')
    		{
    			$source_windows_phone = $_FILES['source_windows_phone']['name'];
    			
    			// upload source_windows_phone
      			if (isset($_FILES['source_windows_phone']))
      			{
      			  	move_uploaded_file($_FILES['source_windows_phone']['tmp_name'], DIR_FILE_APP . $source_windows_phone);   
      			}
    		}
    		else 
    			$source_windows_phone = $app['source_windows_phone'];
			
    		$this->load->model('manage/category');
    		$category = $this->model_manage_category->getCategoryById($this->request->post['category_id']);
    		
    		/**
    		 * Can bang count_app trong category
    		 * 
    		 * Neu day la lan dau cap nhat category:
    		 *  	- tang so app cua category
    		 *  Neu cap nhat category moi:
    		 *  	- giam so app cua category cu di
    		 *  	- tang so app cua category moi len
    		 */
    		
    		if(!isset($app['category_id']) || $app['category_id'] == null){
    		    $this->model_manage_category->increaseCountApp($category['category_id']);
    		}
    		elseif($app['category_id'] != $category['category_id']){
    		    $this->model_manage_category-> increaseCountApp($category['category_id']);
    		    
    		    $category2 = $this->model_manage_category->getCategoryById($app['category_id']);
    		    if(isset($category2['count_app']) && $category2['count_app'] > 0 && $app['category_id'] > 0)
    		        $this->model_manage_category-> decreaseCountApp($app['category_id']);
    		}
			$this-> model_manage_app ->editApp($this->request->get['app_id'], $this->request->post,$image_small,
			    $image_big,$source_link,$category,$source_android,$source_ios,$source_blackberry,$source_java,$source_windows_phone);
			
			$this->redirect($this->url->link('manage/app', 'token=' . $this->session->data['token'], 'SSL'));
		}
	
	    $this -> getForm();
	}
	
	public function delete(){
		$this->load->language('manage/app');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/app');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/app', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		else 
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				$this->model_manage_app->deleteApp($id);
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

			$this->redirect($this->url->link('manage/app', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function getForm(){
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_cate'] = $this->language->get('entry_cate');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_content'] = $this->language->get('entry_content');
		$this->data['entry_time_length'] = $this->language->get('entry_time_length');
		$this->data['entry_download_link'] = $this->language->get('entry_download_link');
		$this->data['entry_link_page'] = $this->language->get('entry_link');
		$this->data['entry_source'] = $this->language->get('entry_source');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_code'] = $this->language->get('entry_code');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_play_link'] = $this->language->get('entry_play_link');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

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
		'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'] , 'SSL'),
		'separator' => ' :: '
		);
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		 if (!isset($this->request->get['app_id'])) {
				$this->data['action'] = $this->url->link('manage/app/insert',  '&token=' . $this->session->data['token'] , 'SSL');
			} else {
				$this->data['action'] = $this->url->link('manage/app/update', 'token=' . $this->session->data['token'] . '&app_id=' . $this->request->get['app_id'], 'SSL');
			}
	
			
		$this->data['cancel'] = $this->url->link('manage/app',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
			
	    if (isset($this->request->get['app_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$app = $this->model_manage_app-> getAppById($this->request->get['app_id']);
		}
		
	    if (isset($this->request->post['app_id'])) {
			$this->data['app_id'] = $this->request->post['app_id'];
		} else if (isset($app)) {
			$this->data['app_id'] = $app['app_id'];
		} else {
			$this->data['app_id'] = 0;
		} 
		
		if (isset($this->request->post['app_name'])) {
			$this->data['app_name'] = $this->request->post['app_name'];
		} elseif (isset($app)) {
			$this->data['app_name'] = $app['app_name'];
		} else {
			$this->data['app_name'] = '';
		}
		
	    if (isset($this->request->post['ad_link'])) {
			$this->data['ad_link'] = $this->request->post['ad_link'];
		} elseif (isset($app)) {
			$this->data['ad_link'] = $app['ad_link'];
		} else {
			$this->data['ad_link'] = '';
		}
		
		
		//TODO: Xay dung ham lay ra id cua admin
  		if (isset($this->request->post['product_id'])) {
			$this->data['product_id'] = $this->request->post['product_id'];
		} else if (isset($app)) {
			$this->data['product_id'] = $app['product_id'];
		} else {
			$this->data['product_id'] = 1;
		}
		
		if (isset($this->request->post['version'])) {
			$this->data['version'] = $this->request->post['version'];
		} else if (isset($app)) {
			$this->data['version'] = $app['version'];
		} else {
			$this->data['version'] = '';
		}

		if (isset($this->request->post['price'])) {
			$this->data['price'] = $this->request->post['price'];
		} elseif (isset($app)) {
			$this->data['price'] = $app['price'];
		} else {
			$this->data['price'] = '';
		}
		
		if (isset($this->request->post['code'])) {
			$this->data['code'] = $this->request->post['code'];
		} elseif (isset($app)) {
			$this->data['code'] = $app['code'];
		} else {
			$this->data['code'] = '';
		}
		
		if (isset($this->request->post['guide_video'])) {
			$this->data['guide_video'] = $this->request->post['guide_video'];
		} elseif (isset($app)) {
			$this->data['guide_video'] = $app['guide_video'];
		} else {
			$this->data['guide_video'] = '';
		}
		
        if (isset($this->request->post['description'])) {
			$this->data['description'] = $this->request->post['description'];
		} elseif (isset($app)) {
			$this->data['description'] = $app['description'];
		} else {
			$this->data['description'] = '';
		}
		
		if (isset($this->request->post['guide'])) {
			$this->data['guide'] = $this->request->post['guide'];
		} elseif (isset($app)) {
			$this->data['guide'] = $app['guide'];
		} else {
			$this->data['guide'] = '';
		}
		
		if (isset($this->request->post['seo_title'])) {
			$this->data['seo_title'] = $this->request->post['seo_title'];
		} elseif (isset($app)) {
			$this->data['seo_title'] = $app['seo_title'];
		} else {
			$this->data['seo_title'] = '';
		}
		
		
        if (isset($this->request->post['seo_content'])) {
			$this->data['seo_content'] = $this->request->post['seo_content'];
		} elseif (isset($app)) {
			$this->data['seo_content'] = $app['seo_content'];
		} else {
			$this->data['seo_content'] = '';
		}
		
        if (isset($this->request->post['type_hot'])) {
			$this->data['type_hot'] = $this->request->post['type_hot'];
		} elseif (isset($app)) {
			$this->data['type_hot'] = $app['type_hot'];
		} else {
			$this->data['type_hot'] = '';
		}
		
		//Get source down list
	    if (isset($this->request->post['description'])) {
			$this->data['description'] = $this->request->post['description'];
		} elseif (isset($app)) {
			$this->data['description'] = $app['description'];
		} else {
			$this->data['description'] = '';
		}
		
	    if (isset($this->request->post['source_android'])) {
			$this->data['source_android'] = $this->request->post['source_android'];
		} elseif (isset($app)) {
			$this->data['source_android'] = $app['source_android'];
		} else {
			$this->data['source_android'] = '';
		}
		
	    if (isset($this->request->post['source_ios'])) {
			$this->data['source_ios'] = $this->request->post['source_ios'];
		} elseif (isset($app)) {
			$this->data['source_ios'] = $app['source_ios'];
		} else {
			$this->data['source_ios'] = '';
		}
		
		
	    if (isset($this->request->post['source_google'])) {
			$this->data['source_google'] = $this->request->post['source_google'];
		} elseif (isset($app)) {
			$this->data['source_google'] = $app['source_google'];
		} else {
			$this->data['source_google'] = '';
		}
		
	    if (isset($this->request->post['description'])) {
			$this->data['source_blackberry'] = $this->request->post['source_blackberry'];
		} elseif (isset($app)) {
			$this->data['source_blackberry'] = $app['source_blackberry'];
		} else {
			$this->data['source_blackberry'] = '';
		}
		
	    if (isset($this->request->post['source_java'])) {
			$this->data['source_java'] = $this->request->post['source_java'];
		} elseif (isset($app)) {
			$this->data['source_java'] = $app['source_java'];
		} else {
			$this->data['source_java'] = '';
		}
		
	    if (isset($this->request->post['source_windows_phone'])) {
			$this->data['source_windows_phone'] = $this->request->post['source_windows_phone'];
		} elseif (isset($app)) {
			$this->data['source_windows_phone'] = $app['source_windows_phone'];
		} else {
			$this->data['source_windows_phone'] = '';
		}
		
		
			
		//Get cate list
		$this->load->model('manage/category');
		
		$cateList = $this->model_manage_category-> getCategoryList();

		$this->data['cateList'] = $cateList;
		
		$this->template = 'manage/app_form.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	public function getList(){
    // Load file language
	$this->load->language('manage/app');
	
	//Load model
	/*
	 * Truy xuat co so du lieu
	 */
	
	 $this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
		'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
		'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('manage/app', 'token=' . $this->session->data['token'] , 'SSL'),
		'separator' => ' :: '
		);
		
		$this->data['insert'] = $this->url->link('manage/app/insert', 'token=' . $this->session->data['token'] , 'SSL');
		$this->data['delete'] = $this->url->link('manage/app/delete', 'token=' . $this->session->data['token'] , 'SSL');

		$limit = $this->language->get('limit');
		
		//Truyen vao mang data
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_success'] = $this->language->get('text_success');
		$this->data['text_enabled'] = $this->language->get('text_enable');
		$this->data['text_disabled'] = $this->language->get('text_disable');
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
		
	$this->data['token'] = $this->session->data['token'];	
	$this->load->model('manage/app');
	
	$list = $this->model_manage_app-> getAppList();
	/*
	 *  Tempalte:
	 *  File hien thi ra cho nguoi dung xem
	 * 
	 */
	
	$appList = array();
	if(isset($list) && $list){
		foreach ($list as $app){
		    //$this->load->model('manage/user');
		    //TODO:Get name product
		    
			$ap = array(
				'app_id'  => $app['app_id'],
				'image_small'  => $app['image_small'],
				'date_time'  => $app['date_time'],
				'app_name'      => $app['app_name'],
				'product_id'      => $app['product_id'],
		        'category_name'  => $app['category_name'],
				'action'         => $this->url->link('manage/app/update', 'token=' . $this->session->data['token'] . '&app_id=' . $app['app_id'], 'SSL'),
				'selected'       => isset($this->request->post['selected']) && in_array($app['app_id'], $this->request->post['selected']),
			);
			
			$appList[] = $ap;
		}
		
		// Truyen vao mang data
		$this-> data['list'] = $appList;
	}
	
	//Lien ket toi file template
	$this->template = 'manage/app.tpl';
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
  	
    public function resizeImage($dir_image,$img,$type){
        if($type == 1)//Small image
        {
            $sizeImage = array('50','100','150','200','250');
	        $folderImage = array('50','100','150','200','250');
        }else{//Big image
            $sizeImage = array('50','170','370','500','1000');
	        $folderImage = array('50','170','370','500','1000'); 
        }
	    //$sizeImageWM = array('20','40','120','160','180');
	    
	    for ($i=0;$i<count($sizeImage);$i++){
	        if(!is_dir($dir_image. '/' . $folderImage[$i]))
			mkdir($dir_image. '/' . $folderImage[$i], 0777, true);
			
	        $filename = $dir_image .'/'. $img['id'] . '.' . $img['ext'];
            $outputFile = $dir_image. '/'. $folderImage[$i] . '/' . $img['id'] . '.' . $img['ext'];
            
            $image = new Bedeabza_Image($filename);
            $image->resize($sizeImage[$i],NULL, Bedeabza_Image::RESIZE_TYPE_CROP);
            
            /*if(SITE_URL == 'http://thaifun.net'){
                $image->watermark(WM_DIR.'/thaifunwm.png', Bedeabza_Image::WM_POS_BOTTOM_RIGHT,$sizeImageWM[$i],NULL);    
            }else{
                $image->watermark(WM_DIR.'/watermark.png', Bedeabza_Image::WM_POS_BOTTOM_RIGHT,$sizeImageWM[$i],NULL);
            }*/
            
            
            $image->save($outputFile, 100);
	    }
	   
	}
	
	/**
	 * Resize all images of a story
	 * @param Story $row
	 * @param PostData $data
	 */
	public function resizeAppImages($dir_image,$url,$type){
        preg_match('#\.([^\.]+)$#',$url,$matches);
		$img['id'] =  str_replace($matches[0],'',$url);
        $img['ext'] = str_replace('.','',$matches[0]);;
        
        if(in_array($img['ext'], array('jpg', 'gif', 'png', 'bmp', 'ico', 'tiff'))){
            $this->resizeImage($dir_image,$img,$type);
        }
	}
}
?>