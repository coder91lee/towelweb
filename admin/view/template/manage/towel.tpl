<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
   
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/user.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left " width = "20%">Thể loại</td>
              <td class="left " width = "20%">Tên</td>
              <td class="left" width = "10%">Giá</td>
              <td class="left" width = "20%">Ảnh</td>
              <td class="left" width = "10%">Gallery</td>
             <td class="left" width = "10%">Trạng thái</td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($towels) && $towels): ?>
                <?php foreach ($towels as $towel): ?>
                <tr>
                  <td style="text-align: center;"><?php if ($towel['selected']) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $towel['towel_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $towel['towel_id']; ?>" />
                    <?php } ?></td>
                  <td class="left"><?php echo $towel['towel_cate_name']; ?></td>
                  <td class="left"><?php echo $towel['towel_name']; ?></td>
                  <td class="left"><?php echo $towel['price']; ?></td>
                  <td class="left">
                    <?php if(isset($towel['towel_image']) && $towel['towel_image']):?>
        		  		<img src="<?php echo HTTP_IMAGE_TOWEL_SMALL . $towel['towel_image']?>"
        		  		 	 alt="<?php echo $towel['towel_name'];?>" height="42" width="42"> 
    		  		<?php endif;?>
    		  	  </td>
    		  	  <td> <a href="<?php HTTP_SERVER?>index.php?route=manage/towelimage&token=<?php echo  $token?>&towel_id=<?php echo $towel['towel_id'];?>">Edit gallery</a></td>
                  <td class="left"><?php
    		  	        if(isset($towel['status']) && $towel['status'] == 3) 
    		  	            echo "Spam";
    		  	        elseif (isset($towel['status']) && $towel['status'] == 2)
    		  	            echo "Ẩn";
    		  	        else
    		  	            echo "Hiện";
    		  	        ?>
    		  	  </td>
                 
                  <td class="right">
                  	[ <a href="<?php echo $towel['action']; ?>">Edit</a> ]
                  </td>
                </tr>
                
                <?php endforeach;?>
            <?php else:?>
                <tr>
                  <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
                </tr>
            <?php endif;?>
          </tbody>
        </table>
      </form>
      
    </div>
  </div>
</div>
<?php echo $footer; ?>
