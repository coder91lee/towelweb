<div class="urlsite_map">
    <a href="/">
        Homepage
    </a> » <strong>Products</strong>
</div>
<h1 class="title">
            Products</h1>
<div class="live-tile">
    <ul id="plist">
    	<?php if(isset($list) && count($list)):?>
    		<?php $i = 0;?>
    		<?php foreach ($list as $twc):?>
                <li><span class="tile-title">
                    <a href="<?php echo $twc['href'];?>" class="title"><?php echo $twc['towel_cate_name']?></a></span>
                    <div href="<?php echo $twc['href'];?>" id="towel-cate-<?php echo $i;?>">
                    	<img alt="<?php echo $twc['towel_cate_name']?>" 
                    		src="<?php echo HTTP_IMAGE_TOWEL_CATE_SMALL. $twc['towel_cate_image'];?>" style="display: block;">
                		<img alt="<?php echo $twc['towel_cate_name']?>" 
                		src="<?php echo HTTP_IMAGE_TOWEL_CATE_SMALL. $twc['towel_cate_image'];?>" style="display: block;">
            		</div>
                </li>
                <?php $i ++;?>
    		<?php endforeach;?>
    	<?php endif;?>
    </ul>
</div>
        
<div class="PageNav">
    <span class="pageNavHeader">
        Page</span>
    <nav>
    	<?php $length = count($list)/ $limit + 1;?>
    	<?php for($i = 1;$i <= $length;$i ++):?>
            <a href="/index.php?route=category&page=<?php echo $i;?>" <?php if($i == $page):?>class="currentPage"<?php endif;?>><?php echo $i;?></a>
    	<?php endfor;?>
	</nav>
</div>