<?php
/*******************************************************************
* 
* Author:  Ha Viet Duc
* Created: 15.11.2012
* update:  15.10.2013
* Desciption : Manage App
********************************************************************/ 

?>
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
  <?php if ($error) { ?>
  <div class="warning"><?php echo $error; ?></div>
  <?php } ?>
 
  <div class="box">
    <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><span><?php echo $button_insert; ?></span></a><a onclick="$('form').submit();" class="button"><span><?php echo $button_delete; ?></span></a></div>
    </div>
    
	<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
    <div class="content">
      <table class="list">
        <thead>
        <tr>
        
		  	<td width="1px" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
		  	<td class="left" width = "20%">Tên</td>
		    <td class="left" width = "10%">Nhà cung cấp</td>
		    <td class="left" width = "10%">Chuyên mục</td>
		    <td class="left" width = "10%">Thời gian</td>
            <td class="left" width = "10%">Ảnh</td>
            <td class="left" width = "10%">Gallery</td>
            <td class="left" width = "10%">Trạng thái</td>
            <td class="left" width = "10%">Action</td>
          </tr>
        </thead>
        <tbody>
        	<tr class="filter">
	            <td></td> 
	          	<td></td>      
	          	<td></td> 
	          	<td></td>  
				<td></td> 
				<td></td>  
				<td></td>       
				<td></td> 
	            <td align="right"><a onclick="filter();" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
        	
        	
          <?php if (isset($list) && $list!=null) { ?>
         	 <?php foreach ($list as $app) { ?>
         	 
           <tr>
            <td style="text-align: right;"><?php if ($app['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $app['app_id'];?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $app['app_id'];?>" />
                <?php } ?>
            </td>
		  	<td class="left"><?php echo $app['app_name'];?>
		  	</td>
		  	
		  	<td class="left"><?php echo $app['product_id'];?>
		  	</td>
		  	
		  	<td class="left"><?php echo $app['category_name'];?>
		  	</td>
		  	
		  	<td class="left">
		  		<?php echo  date("Y-m-d H:i:s",$app['date_time']);?>
		  	</td>
		  
		  	<td class="left">
		  		<img src="<?php echo HTTP_IMAGE_APP_SMALL . $app['image_small'];?>"
		  		 	 alt="Image App" height="42" width="42"> 
		  	</td>
		  	
		  	
      		<td>
      			<a href="<?php HTTP_SERVER?>index.php?route=manage/gallery&token=<?php echo  $token?>&app_id=<?php echo $app['app_id'];?>">Edit gallery</a>
			</td>
		  	
		  	<td class="left"><?php
	  	        if(isset($app['status']) && $app['status'] == 3) 
	  	            echo "Spam";
	  	        elseif (isset($app['status']) && $app['status'] == 2)
	  	            echo "Ẩn";
	  	        else
	  	            echo "Hiện";
	  	        ?>
		  	  </td>
		  	
            <td class="right">
              [ <a href="<?php echo $app['action']; ?>">Edit</a> ]</td>
            </tr>
          <?php } ?>
          <?php  } else { ?>  
           <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?> 
        </tbody>
      </table>
	  </form>
    </div>
  </div>
</div>

<?php echo $footer; ?>