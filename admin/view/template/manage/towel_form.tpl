<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/user.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
      		<a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
      		<a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
        
          <tr>
          		<td>Tên</td>
          		<td><input type="text" name="towel_name" value="<?php if(isset($towel_name)) {echo $towel_name;} ?>" size="100" /> </td>
          	</tr>
        	<tr>
				<td>Chuyên mục</td>
				<td>
				<?php $id = 0?>
			  	 <select name="towel_cate_id" onchange="showGuide()">
				  <?php 
				  	if(isset($cates) && $cates):
						 foreach ($cates as $cate):?>
            				 <?php if ($towel_cate_id == $cate['towel_cate_id']) { ?>
            				  	<option value="<?php echo $cate['towel_cate_id']?>" 
            				  			selected="selected"><?php echo $cate['towel_cate_name']?></option>
            					<?php $id = $towel_cate_id?>
            				 <?php }else{?>
            				  	<option value="<?php echo $cate['towel_cate_id']?>">
            				  	<?php echo $cate['towel_cate_name']?></option>
    				         <?php }?>
				         <?php endforeach;?>
				  <?php endif;?>                  
                </select>
			  </td>              
			</tr>      
       	  <tr>
            <td> Giá</td>
            <td><input type="text" name="price" value="<?php if(isset($price)) {echo $price;} ?>" />
             </td>
          </tr>
           <tr>
          		<td>Trạng thái giá</td>
          		<td>
              		<select name="price_status">
                      <option value="1">Hiện</option>
                      <option value="2">Ẩn</option>
                      <option value="3">Spam</option>
                    </select>
          	    </td>
          </tr>
          	
          <tr>
			  	<td> Ảnh </td>
				<td>
					<table>
						<tr><td><input type="file" name="towel_image" value="<?php if(isset($towel_image)) { echo $towel_image; }?>" size="80" />	</td></tr>
					</table>		  
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
          
          <tr>
          		<td>Tổng quan</td>
          		<td><textarea name="overview" id="content3">
          		<?php echo isset($overview) ? $overview : ''; ?></textarea></td>
          	</tr>
          	
          	<tr>
          		<td>Chi tiết</td>
          		<td><textarea name="specification" id="content2">
          		<?php echo isset($specification) ? $specification : ''; ?></textarea></td>
          	</tr>
          	
            <tr>
          		<td>Phân phối</td>
          		<td><textarea name="delivery" id="content4">
          		<?php echo isset($delivery) ? $delivery : ''; ?></textarea></td>
          	</tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 
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
for(var i = 2; i <= 4; i ++){
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