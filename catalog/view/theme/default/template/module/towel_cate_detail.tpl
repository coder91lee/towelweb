<div class="urlsite_map">
    <a href="<?php echo HTTP_SERVER;?>">
        Homepage
    </a> » <a href="/products">Products</a> » <strong><?php echo $detail['towel_cate_name'];?></strong>
</div>
<h1 class="title">
            <?php echo $detail['towel_cate_name'];?></h1>
<div class="live-tile">
    <ul id="plist">
    	<?php if(isset($list) && count($list) > 0):?>
    		<?php foreach ($list as $towel):?>
                <li><span class="tile-title">
                    <a style="cursor: pointer;" href="<?php echo $towel['href'];?>" class="title">
                        <?php echo $towel['towel_name'];?></a></span>
                    <div style="cursor: pointer;" href="<?php echo $towel['href'];?>">
                        <img alt="<?php echo $towel['towel_name'];?>" 
                        	src="<?php echo HTTP_IMAGE_TOWEL_SMALL . $towel['towel_image'];?>">
                       <img alt="GL 28x28 300g/dz" 
                    		src="<?php echo HTTP_IMAGE_TOWEL_SMALL . $towel['towel_image'];?>">
                   </div>
                </li>
    		<?php endforeach;?>
    	<?php endif;?>
	</ul>
</div>

<div class="PageNav">
        <span class="pageNavHeader">
            Page</span>
        <nav>
        <a href="wipe-towel-page-1" class="currentPage">1</a>
	</nav>
    </div>