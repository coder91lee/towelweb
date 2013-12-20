<div id="wrapper">
	<div class="box box100p">
        <h1 class="title">
            About DZL Bros International</h1>
            <p style="text-align: justify;">Established by a professional team with many years of experience in serving oversea clients, especially Japanese clients, we, DZL International commit to bring to our clients the products with high quality, competitive price and firmed delivery.</p>
            <p style="text-align: justify;">To meet the requirement of our clients, we are able to provide the wide range of products with flexible order, customized design and diversified materials.</p>
            <p style="text-align: justify;">We create a strictly controlled workflow of order processing – production – logistics – exporting transaction to ensure the product quality and the delivery time.</p>
            <p style="text-align: justify;">Professionally serving you esteemed clients is the aim of DZL International.</p>
    </div>
    <div class="box box350 h120 float_l">
        <strong>Direct contact:<br />
            (T): +84-4-62822118<br />
            (F): +84-4-62822119<br />
            (M): +84-934 56 56 57 (ENG)<br />
            (M): +84-972 703 901 (JP)<br />
            (E):sales@towelofvietnam.com</strong>
    </div>
	<div class="box box590 h120 float_r">
        <div class="live-tile">
            <ul id="phome">
				<?php if(isset($list) && count($list) > 0):?>
					<?php foreach ($list as $cate):?>
                        <li><span class="tile-title">
                            <a class="title" href="<?php echo $cat['href'];?>"><?php echo $cate['towel_cate_name'];?></a></span>
                            	<div id='lit3' href="<?php echo $cate['href'];?>">
                                    <img src="<?php echo HTTP_IMAGE_TOWEL_CATE_SMALL . $cate['towel_cate_image'];?>"
                                     alt="Images 2" />
                            </div>
                        </li>
                    <?php endforeach;?>
				<?php endif;?>    
            </ul> 
        </div>
	</div>
</div>
<div class="clear">
</div>