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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/towel_feedback.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
            	<td width="1px" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
    		  	<td class="left" width = "20%">Name</td>
    		    <td class="left" width = "20%">Email</td>
                <td class="left" width = "20%">Content</td>
                <td class="left" width = "20%">Status</td>
                <td class="left" width = "10%">Action</td>
             </tr>
          </thead>
          <tbody>
             <?php if (isset($list) && $list!=null) { ?>
         	 <?php foreach ($list as $item) { ?>
         	 
           <tr>
            <td style="text-align: right;"><?php if ($item['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $item['towel_feedback_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $item['towel_feedback_id']; ?>" />
                <?php } ?>
            </td>
		  	<td class="left"><?php echo $item['name']?>
		  	</td>
		  	
		  	<td class="left"><?php echo $item['email']?>
		  	</td>
		  	
		  	<td class="left"><?php echo $item['content']?>
		  	</td>
		  	
		  	<td class="left">
		  	    <?php 
		  	        if($item['status'] == 1)
		  	            echo "Hiện";
		  	        else
		  	            echo "Ẩn"
  	            ?>
		  	</td>
		  	
            <td class="right">
              [ <a href="<?php echo $item['action']; ?>">Edit</a> ]</td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      
    </div>
  </div>
</div>
<?php echo $footer; ?> 
