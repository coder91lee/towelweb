<div class="box box220 float_r">
    <h2 class="title product">
        Products</h2>
            <ul id="menur">
            <?php if(isset($list) && count($list) > 0):?>
            	<?php foreach ($list as $cate):?>
                    <li>
                        <a href="<?php echo $cate['href'];?>">
                            <?php echo $cate['towel_cate_name'];?></a></li>
            	<?php endforeach;?>
            <?php endif;?>
            </ul>
</div>