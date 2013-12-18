<?php
/*******************************************************************
* 
* Author:  Ha Viet Duc
* Created: 15.11.2012
* Update: 15.10.2013
* Desciption : Manage App
********************************************************************/ 

?>
<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>">
        <?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
          
          	<tr>
          		<td>Tên Ứng Dụng</td>
          		<td><input type="text" name="app_name" 
          			value="<?php if(isset($app_name)) {echo $app_name;} ?>" size="100" /> </td>
          	</tr>
          	
          	<tr>
          		<td>Code</td>
          		<td><input type="text" name="code" 
          		value="<?php if(isset($code)){ echo $code; }?>" size="100" /> </td>
          	</tr>
          
			<tr>
				<td>Chuyên mục</td>
				<td>
				<?php $id = 0?>
			  	 <select name="category_id" onchange="showGuide()">
				  <?php 
				  	if(isset($cateList) && $cateList):
						 foreach ($cateList as $cate):?>
            				 <?php if ($category_id == $cate['category_id']) { ?>
            				  	<option value="<?php echo $cate['category_id']?>" 
            				  			selected="selected"><?php echo $cate['category_name']?></option>
            					<?php $id = $category_id?>
            				 <?php }else{?>
            				  	<option value="<?php echo $cate['category_id']?>">
            				  	<?php echo $cate['category_name']?></option>
    				         <?php }?>
				         <?php endforeach;?>
				  <?php endif;?>                  
                </select>
			  </td>              
			</tr>      
			 
			<tr>
				<td>Phiên bản</td>	
					<td><input type="text" name="price" 
              		value="	<?php echo isset($version) ? $version : ''; ?>" size="100" />	
              		</td>
          		</td>		
			</tr>
         
			<tr>
				<td>Giá</td>
          		<td><input type="text" name="price" 
          		value="<?php if (isset($price)) {echo $price; }?>" size="100" /> </td>
			</tr>
           
			<tr>
			  	<td> Ảnh nhỏ </td>
				<td>
					<table>
						<tr><td><input type="file" name="image_small" 
						value="<?php if(isset($image_small)) { echo $image_small; }?>" size="80" />	
						</td></tr>
					</table>		  
				</td>
				
			</tr>
			
			<tr>
          		<td>Ảnh lớn</td>
          		<td>
          			<table>
              			<tr><td>
              			   <input type="file" name="image_big"
              			    value="<?php if(isset($image_big)) { echo $image_big; }?>" size="100" />
              			 </td></tr>
          			</table>
          	</tr>
          	
          	<tr>
          		<td>File Ứng dụng</td>
          		<td>
          			<table>
              			<tr><td>
              			   <input type="file" name="source_link" 
              			   value="<?php if(isset($source_link)) { echo $source_link; }?>" size="100" />
              			 </td></tr>
          			</table>
          	</tr>
          	
          	<tr>
          		<td>Link Android</td>
          		<td>
          			<table>
              			<tr><td>
              			   <input type="file" name="source_android" 
              			   value="<?php if(isset($source_android)){ echo $source_android; }?>" size="100" />
              			 </td></tr>
          			</table>
          	</tr>
          	
          	<tr>
          		<td>Link IOS</td>
          		<td>
          			<table>
              			<tr><td>
              			   <input type="file" name="source_ios" 
              			   value="<?php if(isset($source_ios)){ echo $source_ios; }?>" size="100" />
              			 </td></tr>
          			</table>
          	</tr>
          	
          	<tr>
          		<td>Link Blackberry</td>
          		<td>
          			<table>
              			<tr><td>
              			   <input type="file" name="source_blackberry" 
              			   value="<?php if(isset($source_blackberry)){ echo $source_blackberry; }?>" size="100" />
              			 </td></tr>
          			</table>
          	</tr>
          	
          	<tr>
          		<td>Link Java</td>
          		<td>
          			<table>
              			<tr><td>
              			   <input type="file" name="source_java" 
              			   value="<?php if(isset($source_java)){ echo $source_java; }?>" size="100" />
              			 </td></tr>
          			</table>
          	</tr>
          	
          	<tr>
          		<td>Link Windows Phone</td>
          		<td>
          			<table>
              			<tr><td>
              			   <input type="file" name="source_windows_phone" 
              			   value="<?php if(isset($source_windows_phone)){ echo $source_windows_phone; }?>" size="100" />
              			 </td></tr>
          			</table>
          	</tr>
          	
          	<tr>
          		<td>Link Ad</td>
          		<td><input type="text" name="ad_link" 
          		value="<?php if(isset($ad_link)){ echo $ad_link; }?>" size="100" /> </td>
          	</tr>
          	
          	<tr>
          		<td>Link Google</td>
          		<td><input type="text" name="source_google" 
          		value="<?php if(isset($source_google)){ echo $source_google; }?>" size="100" /> </td>
          	</tr>
          	
          
          	<?php if(isset($app_id) && $app_id):?>
              	<tr>
              		<td>Gallery</td>
              		<td>
              			<a href="<?php HTTP_SERVER?>index.php?route=manage/gallery&token=<?php echo  $token?>&app_id=<?php echo $app_id?>">Link gallery</a>
    				</td>
              	</tr>
          	<?php endif;?>
          	
          	<tr>
          		<td>Youtube (Hướng dẫn)</td>
          		<td><input type="text" name="guide_video" 
          		value="<?php if(isset($guide_video)){ echo $guide_video; }?>" size="100" /> </td>
          	</tr>

          	<tr>
          		<td>Hướng dẫn</td>
          		<td><textarea name="guide" id="content3">
          		<?php echo isset($guide) ? $guide : ''; ?></textarea></td>
          	</tr>
          	
          	<tr>
          		<td>Mô tả</td>
          		<td><textarea name="description" id="content2">
          		<?php echo isset($description) ? $description : ''; ?></textarea></td>
          	</tr>
          	
            <tr>
          		<td>Tiêu đề (SEO)</td>
          		<td><textarea name="seo_title" id="content4">
          		<?php echo isset($seo_title) ? $seo_title : ''; ?></textarea></td>
          	</tr>
          	
          	<tr>
          		<td>Nội dung (SEO)</td>
          		<td><textarea name="seo_content" id="content5">
          		<?php echo isset($seo_content) ? $seo_content : ''; ?></textarea></td>
          	</tr>
			
			<tr>
          		<td>Kiểu (HOT)</td>
          		<td>
              		<select name="type_hot">
                      <option value="1">Normal</option>
                      <option value="2">Hot</option>
                      <option value="3">Sugget</option>
                    </select>
          	    </td>
          	</tr>
          	
          	<tr>
          		<td>Trạng thái</td>
          		<td>
              		<select name="status">
                      <option value="1">Hiện</option>
                      <option value="2">Ẩn</option>
                      <option value="3">Spam</option>
                    </select>
          	    </td>
          	</tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
function image_upload(field, preview) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: 'anh dep',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>',
					type: 'POST',
					data: 'image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + preview).replaceWith('<img src="' + data + '" alt="" id="' + preview + '" class="image" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');
					}
				});
			}
			
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
	
</script> 
<script type="text/javascript">
$('#tabs a').tabs(); 
</script> 
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
for(var i = 2; i <= 5; i ++){
	CKEDITOR.replace('content' + i, {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
	});	
}
</script> 
<script>
	function showGuide()
	{
		var id = document.formName.category_id.value;
		$(".category_guide").attr("style", "display:none");
		$("#guide_" + id).attr("style", "");
	}
</script>
<?php echo $footer; ?>