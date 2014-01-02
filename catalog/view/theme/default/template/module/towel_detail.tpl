<div class="urlsite_map">
    <a href="/">
        Homepage
    </a> » <a href="<?php echo HTTP_SERVER . 'index.php?route=category'?>">Products</a> » 
    	<a href="<?php echo HTTP_SERVER . 'index.php?route=category'?>">Bath Towel</a> » 
    		<strong><?php echo $detail['towel_name'];?></strong>
</div>

<h1 class="title">
            <?php echo $detail['towel_name'];?></h1>
            <div id="pdetail">
    <div id="pdetail_l">
        
        <ul id="iproduct">
       
           <?php if(isset($image_list) && count($image_list)):?>
           		<?php foreach ($image_list as $image):?>
                    <li>
                        <a data-fancybox-group="thumb" 
                        	href="" 
                        		title="" class="fancybox-thumbs">
            			<img alt="" src="<?php echo HTTP_IMAGE_TOWEL_IMAGE_SMALL . $image['image'];?>">
            			</a>
        			</li>
           		<?php endforeach;?>
           <?php endif;?>
        </ul>
    </div>
    <div id="pdetail_r">
        <div id="tabbed_box_1" class="tabbed_box">
            <div class="tabbed_area">
                <ul class="tabs">
                    <li><a class="tab" title="content_1" href="#">Payment &amp; Delivery</a></li><li><a class="tab" title="content_2" href="#">Specification</a></li><li><a class="tab active" title="content_3" href="#">Overview</a></li></ul>
            </div>
            <div class="content" id="content_1" style="display: none;">
               <?php echo html_entity_decode($detail['delivery']);?>
           </div>
            
            <div class="content" id="content_2" style="display: none;">
             <?php
                 echo html_entity_decode($detail['specification']);
             ?>
            </div>
            <div class="content" id="content_3" style="display: block;">
              <?php echo html_entity_decode($detail['overview']);?>
                <br>
            </div>
        </div>
    </div>
</div>

<div style="height: 25px" class="clear">
    </div>
    
    <h1 class="title">
        Other Products:</h1>
        
        <div class="live-tile">
            <ul id="plist">
            <?php if(isset($cate_list) && count($cate_list) > 0):?>
            	<?php foreach ($cate_list as $cate):?>
                    <li><span class="tile-title">
                        <a href="<?php echo $cate['href'];?>" 
                        	class="title"><?php echo $cate['towel_cate_name'];?></a></span>
                        <div href="<?php echo $cate['href'];?>">
                        	<img alt="<?php echo $cate['towel_cate_name'];?>" 
                        		src="<?php echo HTTP_IMAGE_TOWEL_CATE_SMALL . $cate['towel_cate_image'];?>"
                        	 style="display: block;">
                    	 </div>
                    </li>
            	<?php endforeach;?>
            <?php endif;?>
            </ul> </div>