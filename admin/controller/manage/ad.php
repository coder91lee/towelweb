<?php
/*******************************************************************
* 
* Updated by: Ha Viet Duc
* Update Date: 14/11/2012
 * Update Date: 14/11/2012 @C: appstore
* 
********************************************************************/
class ControllerManageAd extends Controller {
	public function index() {
		$this->load->language('manage/ad');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('manage/ad');

		$this->getList();
	}
	
	public function insert(){
		$this->load->language('manage/ad');

		$this->document->setTitle($this->language->get('heading_title'));

		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/ad', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		$this->load->model('manage/ad');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			
			//TODO: xu ly du lieu truoc khi insert vao csdl 
			if ($_FILES['image']['name'] != '')
    		{
    			$image= $_FILES['image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image']))
      			{
      			  	move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_AD_SMALL . $image);
      			  	//Resize ad image
			        $this->resizeAdImages(DIR_IMAGE_AD_SMALL,$image);   
      			}
    		}
    		else 
    			$image = '';
    			
    	    //TODO: Lấy chiều dài và chiều rộng của banner
    	    $width = 0;
    	    $height = 0;
    			
    		$this -> model_manage_ad -> addAd( $this->request->post,$image,$width,$height);
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('manage/ad', 'token=' . $this->session->data['token'] , 'SSL'));
		}

		$this->getForm();
	}
	
	public function  update(){
		$this->load->language('manage/ad');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/ad');		
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/ad', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
		    $ad = $this->model_manage_ad->getAdById($_GET['ad_id']);	
		    
            //TODO: xu ly du lieu truoc khi insert vao csdl 
			if ($_FILES['image']['name'] != '')
    		{
    			$image= $_FILES['image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image']))
      			{
      			  	move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_AD_SMALL . $image);
      			  	//Resize ad image
			        $this->resizeAdImages(DIR_IMAGE_AD_SMALL,$image);    
      			}
      			
      			//TODO: Lấy chiều dài và chiều rộng của banner
        	    $width = 0;
        	    $height = 0;
    		}
    		else {
    			$image = $ad['image'];
                //TODO: Lấy chiều dài và chiều rộng của banner
        	    $width = $ad['width'];
        	    $height = $ad['height'];    		    
    		}
    			
			$this-> model_manage_ad ->editAd($this->request->get['ad_id'], $this->request->post,$image,$width,$height);
			
			$this->redirect($this->url->link('manage/ad', 'token=' . $this->session->data['token'], 'SSL'));
		}
	
	    $this -> getForm();
	}
	
	public function delete(){
		$this->load->language('manage/ad');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/ad');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/ad', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		else 
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				$this->model_manage_ad->deleteAd($id);
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

			$this->redirect($this->url->link('manage/ad', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_content'] = $this->language->get('entry_content');
		$this->data['entry_time_length'] = $this->language->get('entry_time_length');
		$this->data['entry_download_link'] = $this->language->get('entry_download_link');
		$this->data['entry_link_page'] = $this->language->get('entry_link');
		$this->data['entry_source'] = $this->language->get('entry_source');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_start_time'] = $this->language->get('entry_start_time');
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
		 if (!isset($this->request->get['ad_id'])) {
				$this->data['action'] = $this->url->link('manage/ad/insert',  '&token=' . $this->session->data['token'] , 'SSL');
			} else {
				$this->data['action'] = $this->url->link('manage/ad/update', 'token=' . $this->session->data['token'] . '&ad_id=' . $this->request->get['ad_id'], 'SSL');
			}
	
			
		$this->data['cancel'] = $this->url->link('manage/ad',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
			
	    if (isset($this->request->get['ad_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$ad = $this->model_manage_ad-> getAdById($this->request->get['ad_id']);
		}
	    elseif (isset($this->request->post['ad_id'])) {
			$this->data['ad_id'] = $this->request->post['ad_id'];
		} elseif (isset($ad)) {
			$this->data['ad_id'] = $ad['ad_id'];
		} else {
			$this->data['ad_id'] = 0;
		} 
		
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} else if (isset($ad)) {
			$this->data['name'] = $ad['name'];
		} else {
			$this->data['name'] = '';
		}
		
	    if (isset($this->request->post['link'])) {
			$this->data['link'] = $this->request->post['link'];
		} else if (isset($ad)) {
			$this->data['link'] = $ad['link'];
		} else {
			$this->data['link'] = '';
		}
		
		//TODO: Xay dung ham lay ra id cua admin
  		if (isset($this->request->post['ad_content'])) {
			$this->data['ad_content'] = $this->request->post['ad_content'];
		} elseif (isset($ad)) {
			$this->data['ad_content'] = $ad['ad_content'];
		} else {
			$this->data['ad_content'] = '';
		}
		
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (isset($ad)) {
			$this->data['image'] = $ad['image'];
		} else {
			$this->data['image'] = '';
		}

		if (isset($this->request->post['position'])) {
			$this->data['position'] = $this->request->post['position'];
		} elseif (isset($ad)) {
			$this->data['position'] = $ad['position'];
		} else {
			$this->data['position'] = 1;
		}
		
		if (isset($this->request->post['start_time'])) {
			$this->data['start_time'] = $this->request->post['start_time'];
		} elseif (isset($ad)) {
			$this->data['start_time'] = $ad['start_time'];
		} else {
			$this->data['start_time'] = time();
		}
		
		if (isset($this->request->post['end_time'])) {
			$this->data['end_time'] = $this->request->post['end_time'];
		} elseif (isset($ad)) {
			$this->data['end_time'] = $ad['end_time'];
		} else {
			$this->data['end_time'] = time();
		}
		
        if (isset($this->request->post['title'])) {
			$this->data['title'] = $this->request->post['title'];
		} elseif (isset($ad)) {
			$this->data['title'] = $ad['title'];
		} else {
			$this->data['title'] = '';
		}
		
		if (isset($this->request->post['type'])) {
			$this->data['type'] = $this->request->post['type'];
		} elseif (isset($ad)) {
			$this->data['type'] = $ad['type'];
		} else {
			$this->data['type'] = 1;
		}
		
		$this->template = 'manage/ad_form.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	public function getList(){
    // Load file language
	$this->load->language('manage/ad');
	
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
		'href'      => $this->url->link('manage/ad', 'token=' . $this->session->data['token'] , 'SSL'),
		'separator' => ' :: '
		);
		
		$this->data['insert'] = $this->url->link('manage/ad/insert', 'token=' . $this->session->data['token'] , 'SSL');
		$this->data['delete'] = $this->url->link('manage/ad/delete', 'token=' . $this->session->data['token'] , 'SSL');

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
		
		
	$this->load->model('manage/ad');
	
	$list = $this->model_manage_ad-> getAdList();
	/*
	 *  Tempalte:
	 *  File hien thi ra cho nguoi dung xem
	 * 
	 */
	
	$adList = array();
	if(isset($list) && $list){
		foreach ($list as $ad){
			$adItem = array(
					'ad_id'  => $ad['ad_id'],
					'image'  => $ad['image'],
					'name'  => $ad['name'],
					'position' => $ad['position'],
					'start_time' => $ad['start_time'],
					'end_time' => $ad['end_time'],
					'title' => $ad['title'],
			        'type' => $ad['type'],
					'action' => $this->url->link('manage/ad/update', 'token=' . $this->session->data['token'] . '&ad_id=' . $ad['ad_id'], 'SSL'),
					'selected' => isset($this->request->post['selected']) && in_array($ad['ad_id'], $this->request->post['selected']),
			);
			
			$adList[] = $adItem;
		}
		
		// Truyen vao mang data
		$this-> data['list'] = $adList;
	}
	
	//Lien ket toi file template
	$this->template = 'manage/ad.tpl';
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
	public function resizeAdImages($dir_image,$url){
        preg_match('#\.([^\.]+)$#',$url,$matches);
		$img['id'] =  str_replace($matches[0],'',$url);
        $img['ext'] = str_replace('.','',$matches[0]);;
        
        if(in_array($img['ext'], array('jpg', 'gif', 'png', 'bmp', 'ico', 'tiff'))){
            $this->resizeImage($dir_image,$img);
        }
	}
}

?>