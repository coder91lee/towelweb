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
    		<?php foreach ($list as $twc):?>
                <li><span class="tile-title">
                    <a href="<?php echo $twc['href'];?>" class="title"><?php echo $twc['towel_cate_name']?></a></span>
                    <div href="<?php echo $twc['href'];?>" id="lit2">
                    	<img alt="Dt 40x60 52g/pcs U$0.31/pcs(ref.)" 
                    		src="<?php echo $twc['towel_cate_image'];?>" style="display: block;">
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
        <a href="products-page-1" class="currentPage">1</a><a href="products-page-2">2</a>
	</nav>
</div>