 <div id="banner">
    <div id="banner_towels">
	    <div id='coin-slider'>
	    <?php if(isset($list) && count($list) > 0):?>
	    	<?php foreach ($list as $home_image):?>
    	    	<a href='#'>
    	    		<img src="<?php echo HTTP_IMAGE_HOME_IMAGE_SMALL . $home_image['image'];?>" 
    	    				alt='<strong>PRICE</strong><br />COMPETITIVE'/>
    	    			<span><br />
    	    				<span class="pBanner"><strong>PRICE</strong>
    	    					<br />COMPETITIVE</span>
    					 </span>
    			 </a>
			 <?php endforeach;?>
	    <?php endif;?>
        </div>
     </div> 
 </div>