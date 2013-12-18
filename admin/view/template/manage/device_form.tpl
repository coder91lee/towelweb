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
          		<td>Dòng máy</td>
          		<td><input type="text" name="device_name" value="<?php if(isset($device_code)) {echo $device_name;} ?>" size="100" /> </td>
          	</tr>
          	<tr>
            <td> Code</td>
            <td><input type="text" name="device_code" value="<?php if(isset($device_code)) {echo $device_code;} ?>" />
             </td>
          </tr>
          <tr>
			  	<td> Ảnh </td>
				<td>
					<table>
						<tr><td><input type="file" name="device_image" value="<?php if(isset($device_image)) { echo $device_image; }?>" size="80" />	</td></tr>
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
          
          
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 