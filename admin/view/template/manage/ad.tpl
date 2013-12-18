<?php
/*******************************************************************
* 
* Author:  Ha Viet Duc
* Created: 15.11.2012
* update:  15.10.2013
* Desciption : Manage Ad
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
		    <td class="left" width = "10%">Vị trí</td>
		    <td class="left" width = "10%">Bắt đầu</td>
		    <td class="left" width = "10%">Kết thúc</td>
		    <td class="left" width = "10%">Tiêu đề</td>
            <td class="left" width = "20%">Ảnh</td>
            <td class="left" width = "10%">Kiểu</td>
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
         	 <?php foreach ($list as $ad) { ?>
         	 
           <tr>
            <td style="text-align: right;"><?php if ($ad['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $ad['ad_id'];?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $ad['ad_id'];?>" />
                <?php } ?>
            </td>
		  	<td class="left"><?php echo html_entity_decode($ad['name']);?>
		  	</td>
		  	
		  	<td class="left">
		  		<?php 
		  		    if(isset($ad['position']) && $ad['position'] == 1)
		  		        echo "Top";
		  		    elseif (isset($ad['position']) && $ad['position'] == 2)
		  		        echo "Left";
		  		    elseif (isset($ad['position']) && $ad['position'] == 3)
		  		        echo "Right";
		  		    else 
		  		        echo "Bottom";     
		  		?>
		  	</td>
		  	
		  	<td class="left">
		  		<?php echo  date("Y-m-d H:i:s",$ad['start_time']);?>
		  	</td>
		  	
		  	<td class="left">
		  		<?php echo  date("Y-m-d H:i:s",$ad['end_time']);?>
		  	</td>
		  	
		  	<td class="left"><?php echo  html_entity_decode($ad['title']);?>
		  	</td>
		  	
		  	<td class="left">
		  		<img src="<?php echo HTTP_IMAGE_AD_SMALL . $ad['image'];?>"
		  		 	 alt="Image App" height="42" width="126"> 
		  	</td>
		  	
		  	<td class="left"><?php
	  	        if (isset($ad['status']) && $ad['status'] == 1)
	  	            echo "Tin";
	  	        else
	  	            echo "Quảng cáo";
	  	        ?>
		  	  </td>
		  	
            <td class="right">
              [ <a href="<?php echo $ad['action']; ?>">Edit</a> ]</td>
            </tr>
          <?php } ?>
          <?php  } else { ?>  
           <tr>
            <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
           </tr>
          <?php } ?> 
        </tbody>
      </table>
	  </form>
    </div>
  </div>
</div>

<?php echo $footer; ?>