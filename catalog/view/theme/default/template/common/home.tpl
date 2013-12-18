<?php echo $header; ?>
<?php echo $content_top; ?>
<div id="wrapper">
	<div id="wrapper_l">
        <?php echo $column_left; ?>
    </div>
    
    <div id="wrapper_r">
        <?php echo $column_right; ?>
    </div>
    <h1 style="display: none;"><?php echo $heading_title; ?></h1>
    <?php  echo $content_bottom; ?>
</div>
<div class="clearfix" style="clear: both;"> </div>
<?php echo $footer; ?>