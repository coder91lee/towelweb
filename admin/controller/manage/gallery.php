<?php  
class ControllerManageGallery extends Controller {  
	public function index() {
		$this->load->language('manage/gallery');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('manage/gallery');

		$this->getList();
	}
	
	public function insert(){
		$this->load->language('manage/gallery');

		$this->document->setTitle($this->language->get('heading_title'));

		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/gallery', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		$this->load->model('manage/gallery');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			
		    if ($_FILES['gallery_image']['name'] != '')
    		{
    			$gallery_image = $_FILES['gallery_image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['gallery_image']))
      			{
      			  	move_uploaded_file($_FILES['gallery_image']['tmp_name'], DIR_IMAGE_GALLERY_SMALL . $gallery_image);
      			  	//Resize gallery app image
			        $this->resizeGalleryAppImages(DIR_IMAGE_GALLERY_SMALL,$gallery_image);   
      			}
    		}
    		else{
    			$gallery_image = '';	
    		}
    		

    		$this -> model_manage_gallery -> addGallery( $this->request->post,$gallery_image,$this->request->get['app_id']);
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			
			$this->redirect($this->url->link('manage/gallery', 'token=' . $this->session->data['token'] . '&app_id=' . $this->request->get['app_id'] , 'SSL'));
		}

		$this->getForm();
	}
	
	public function  update(){
		$this->load->language('manage/gallery');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/gallery');		
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/gallery', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {	
			
			$gallery = $this->model_manage_gallery->getGalleryById($_GET['gallery_id']);
		    if ($_FILES['gallery_image']['name'] != '')
    		{
    			$gallery_image = $_FILES['gallery_image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['gallery_image']))
      			{
      			  	move_uploaded_file($_FILES['gallery_image']['tmp_name'], DIR_IMAGE_GALLERY_SMALL . $gallery_image);   
      			}
      			
      			//Resize gallery app image
			    $this->resizeGalleryAppImages(DIR_IMAGE_GALLERY_SMALL,$gallery_image); 
    		}
    		else{
    			$gallery_image = $gallery['gallery_image'];	
    		}
    		
			$this-> model_manage_gallery ->editGallery($this->request->get['gallery_id'], $this->request->post,$gallery_image,$this->request->get['app_id']);
			
			$this->redirect($this->url->link('manage/gallery', 'token=' . $this->session->data['token'] . '&app_id=' . $this->request->get['app_id'], 'SSL'));
		}
	
	    $this -> getForm();
	}
	
	public function delete(){
		$this->load->language('manage/gallery');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/gallery');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/gallery', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		else 
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				
				$this->model_manage_gallery->deleteGallery($id);
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
            
			$this->redirect($this->url->link('manage/gallery', 'token=' . $this->session->data['token'] . '&app_id=' . $this->request->get['app_id'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function getForm(){
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['entry_gallery_name'] = $this->language->get('entry_title');
		$this->data['entry_gallery_code'] = $this->language->get('entry_cate');
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
		'href'      => $this->url->link('manage/gallery', 'token=' . $this->session->data['token'] . '&app_id=' . $this->request->get['app_id'] , 'SSL'),
		'separator' => ' :: '
		);
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
	    if (!isset($this->request->get['gallery_id'])) {
			$this->data['action'] = $this->url->link('manage/gallery/insert',  '&token=' . $this->session->data['token'] . '&app_id=' . $this->request->get['app_id'] , 'SSL');
		} else {
			$this->data['action'] = $this->url->link('manage/gallery/update', 'token=' . $this->session->data['token'] . '&gallery_id=' . $this->request->get['gallery_id'] . '&app_id=' . $this->request->get['app_id'], 'SSL');
		}
			
			
		$this->data['cancel'] = $this->url->link('manage/gallery',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
			
		   if (isset($this->request->get['gallery_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$info = $this->model_manage_gallery-> getGalleryById($this->request->get['gallery_id']);
			}
		
		    if (isset($this->request->post['gallery_id'])) {
				$this->data['gallery_id'] = $this->request->post['gallery_id'];
			} elseif (isset($info)) {
				$this->data['gallery_id'] = $info['gallery_id'];
			} else {
				$this->data['gallery_id'] = 0;
			} 
			
			
		$this->template = 'manage/gallery_form.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	public function getList(){
    // Load file language
	$this->load->language('manage/gallery');
    $this->data['breadcrumbs'] = array();

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('text_home'),
	'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
	'separator' => false
	);

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('heading_title'),
	'href'      => $this->url->link('manage/gallery', 'token=' . $this->session->data['token'] , 'SSL'),
	'separator' => ' :: '
	);
	
	$this->data['insert'] = $this->url->link('manage/gallery/insert', 'token=' . $this->session->data['token'] . '&app_id=' . $this->request->get['app_id'] , 'SSL');
	$this->data['delete'] = $this->url->link('manage/gallery/delete', 'token=' . $this->session->data['token'] , 'SSL');

	$limit = $this->language->get('limit');
	
	//Truyen vao mang data
	$this->data['heading_title'] = $this->language->get('heading_title');
	$this->data['text_no_results'] = $this->language->get('text_no_results');
	$this->data['text_success'] = $this->language->get('text_success');
	$this->data['text_gallery_name'] = $this->language->get('text_gallery_name');
	$this->data['text_gallery_code'] = $this->language->get('text_gallery_code');
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
		
    if(isset($this->request->get['app_id'])){
        $app_id = $this->request->get['app_id'];
    }else{
        $app_id = 0;
    }
    $this->load->model('manage/app');
    $app = $this->model_manage_app-> getAppById($this->request->get['app_id']);
		
		
	$this->load->model('manage/gallery');
	
	$gallerys = $this->model_manage_gallery-> getGalleryListByAppId($app_id);
	$galleryList = array();
	if($gallerys){
		foreach ($gallerys as $glery){
			$gallery = array(
					'gallery_id'  => $glery['gallery_id'],
			        'app_name' => $app['app_name'],
					'gallery_image'      => $glery['gallery_image'],
					'action'         => $this->url->link('manage/gallery/update', 'token=' . $this->session->data['token'] . '&gallery_id=' . $glery['gallery_id'] . '&app_id=' . $app_id, 'SSL'),
					'selected'       => isset($this->request->post['selected']) && in_array($glery['gallery_id'], $this->request->post['selected']),
			
			);
			
			$galleryList[] = $gallery;
		}
		
		// Truyen vao mang data
        $this-> data['gallerys'] = $galleryList;
	}
	
	//Lien ket toi file template
	$this->template = 'manage/gallery.tpl';
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
  	
    public function resizeImage($dir_image,$img){
	    $folderImage = array('50','170','370','500','1000');
	    $sizeImage = array('50','170','370','500','1000');
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
	public function resizeGalleryAppImages($dir_image,$url){
        preg_match('#\.([^\.]+)$#',$url,$matches);
		$img['id'] =  str_replace($matches[0],'',$url);
        $img['ext'] = str_replace('.','',$matches[0]);;
        
        if(in_array($img['ext'], array('jpg', 'gif', 'png', 'bmp', 'ico', 'tiff'))){
            $this->resizeImage($dir_image,$img);
        }
	}
}

?>
