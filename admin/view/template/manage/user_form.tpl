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
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
        	<tr>
				<td>Username</td>
				<td>
				<input type="text" name="user_name" value="<?php if(isset($user_name)) echo $user_name; ?>"  /></td>           
			</tr>      
          
          <tr>
            <td>Password</td>
            <td><input type="password" name="pass" value="<?php if(isset($pass)) echo $pass; ?>"  /></td>
          </tr>
          <tr>
		     <td>Fullname</td>
			  <td><input type="text" name="full_name" value="<?php if(isset($full_name)) echo $full_name; ?>"  /></td>            
			</tr>      
          <tr>
      		<td>Email</td>
				<td>
				<input type = "text" name= "email" value =" <?php if(isset($email)) echo $email?>" />
			  </td>            
			</tr>       
          <tr>
          	<td>Birthday</td>
          	<td><input type = "text" name= "birth_day" value =" <?php if(isset($birth_day)) echo $birth_day?>" />
          </tr>
          
         <tr>
			<td>Quyền</td>
			<td>
		  	 <select name="role" onchange="showGuide()">
		    	<option value="1" selected="selected">Thành viên</option>
		    	<option value="2" selected="selected">Nhà cung cấp</option>                  
            </select>
		  </td>            
		 </tr> 
		 
		 <tr>
			<td>Code</td>
			<td><input type="text" name="code_user" value="<?php if(isset($code_user)) echo $code_user;?>"/></td>
		 </tr>   
			
		<tr>
		  	<td> Ảnh </td>
			<td>
				<table>
					<tr><td><input type="file" name="image" size="80" />	</td></tr>
				</table>		  
			</td>
		</tr>  
		
		<tr>
			<td>Thông tin</td>				
			<td><textarea name="info" id="content1">
			<?php echo isset($info) ? $info : ''; ?></textarea></td>
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
CKEDITOR.replace('content1', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
	});	
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