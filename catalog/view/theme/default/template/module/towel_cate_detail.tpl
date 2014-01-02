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
                       <img alt="<?php echo $towel['towel_name'];?>" 
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
        <?php $length = count($list)/ $limit + 1;?>
    	<?php for($i = 1;$i <= $length;$i ++):?>
            <a href="/index.php?route=route=category&category_id=<?php echo $detail['towel_cate_id'];?>&page=<?php echo $i;?>" <?php if($i == $page):?>class="currentPage"<?php endif;?>>
                <?php echo $i;?></a>
    	<?php endfor;?>
	</nav>
    </div>