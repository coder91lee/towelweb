<?php
/*******************************************************************
* 
* Author:  Ha Viet Duc
* Created: 15.11.2012
* Update: 15.10.2013
* Desciption : Manage Ad
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
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span>
      <?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" 
      class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
          
          	<tr>
          		<td>Tên Ad</td>
          		<td><input type="text" name="name" 
          			value="<?php if(isset($name)) {echo $name;} ?>" size="100" /> </td>
          	</tr>
          
			<tr>
				<td>Nội dung</td>				
				<td><textarea name="ad_content" id="content1">
				    <?php echo isset($ad_content) ? $ad_content : ''; ?></textarea></td>
			</tr>
         
			<tr>
			  	<td> Ảnh</td>
				<td>
					<table>
						<tr><td><input type="file" name="image" 
						 value="<?php if(isset($image)) { echo $image; }?>" size="80" />	
						</td></tr>
					</table>		  
				</td>
				
			</tr>
			
          	<tr>
          		<td>Vị trí</td>
          		<td>
              		<select name="position">
                      <option value="1">Top</option>
                      <option value="2">left</option>
                      <option value="3">Right</option>
                      <option value="4">Bottom</option>
                    </select>
          	    </td>
          	</tr>
          	
          	<tr>
          		<td>Bắt đầu</td>
          		<td><input type="text" name="start_time" 
          			value="<?php if(isset($start_time)) {echo $start_time;} ?>" size="100" /> </td>
          	</tr>
          	
          	<tr>
          		<td>Kết thúc</td>
          		<td><input type="text" name="end_time" 
          			value="<?php if(isset($end_time)) {echo $end_time;} ?>" size="100" /> </td>
          	</tr>
          	
            <tr>
          		<td>Tiêu đề</td>
          		<td><textarea name="title" id="content2">
          		    <?php echo isset($title) ? $title : ''; ?></textarea></td>
          	</tr>
			
			<tr>
          		<td>Link Ad</td>
          		<td><input type="text" name="link" 
          		value="<?php if(isset($link)){ echo $link; }?>" size="100" /> </td>
          	</tr>
          	
			<tr>
          		<td>Kiểu</td>
          		<td>
              		<select name="type">
                      <option value="1">Quảng cáo</option>
                      <option value="2">Tin</option>
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
for(var i = 1; i <= 2; i ++){
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