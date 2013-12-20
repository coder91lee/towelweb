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
              <td class="left " width = "30%">Thể loại</td>
              <td class="left" width = "30%">Ảnh</td>
             <td class="left" width = "30%">Trạng thái</td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($cates) && $cates): ?>
                <?php foreach ($cates as $cate): ?>
                <tr>
                  <td style="text-align: center;"><?php if ($cate['selected']) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $cate['towel_cate_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $cate['towel_cate_id']; ?>" />
                    <?php } ?></td>
                  <td class="left"><?php echo $cate['towel_cate_name']; ?></td>
                  <td class="left">
                    <?php if(isset($cate['towel_cate_image']) && $cate['towel_cate_image']):?>
        		  		<img src="<?php echo HTTP_IMAGE_TOWEL_CATE_SMALL . $cate['towel_cate_image']?>"
        		  		 	 alt="<?php echo $cate['towel_cate_name'];?>" height="42" width="42"> 
    		  		<?php endif;?>
    		  	  </td>
                  <td class="left"><?php
    		  	        if(isset($cate['status']) && $cate['status'] == 3) 
    		  	            echo "Spam";
    		  	        elseif (isset($cate['status']) && $cate['status'] == 2)
    		  	            echo "Ẩn";
    		  	        else
    		  	            echo "Hiện";
    		  	        ?>
    		  	  </td>
                 
                  <td class="right">
                  	[ <a href="<?php echo $cate['action']; ?>">Edit</a> ]
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
