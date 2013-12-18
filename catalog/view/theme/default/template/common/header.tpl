<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script type="text/javascript" src="<?php echo TOWEL_ASSETS_CDN?>/scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo TOWEL_ASSETS_CDN?>/scripts/coin-slider.min.js"></script>
<script type="text/javascript" src="<?php echo TOWEL_ASSETS_CDN?>/scripts/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo TOWEL_ASSETS_CDN?>/scripts/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript" src="<?php echo TOWEL_ASSETS_CDN?>/scripts/towels.js"></script>
<link href="<?php echo TOWEL_ASSETS_CDN?>/css/style.css" rel="stylesheet" media="screen">
<link href="<?php echo TOWEL_ASSETS_CDN?>/css/coin-slider-styles.css" rel="stylesheet" media="screen">
<link href="<?php echo TOWEL_ASSETS_CDN?>/css/css.css" rel="stylesheet" media="screen">
<link href="<?php echo TOWEL_ASSETS_CDN?>/css/jquery.fancybox.css" rel="stylesheet" media="screen">
<link href="<?php echo TOWEL_ASSETS_CDN?>/css/jquery.fancybox-thumbs.css" rel="stylesheet" media="screen">
	
<title>Bath Towel - Face Towel- Oshitori Towel - Wiper Towel - Duster Towel - <?php echo HTTP_SERVER;?></title>
    <meta name="keywords" content="Bath Towel - Face Towel- Oshitori Towel - Wiper Towel - Duster Towel - <?php echo HTTP_SERVER;?>"/>
    <meta name="description" content="Towel"/>
    <link rel="canonical" href="<?php echo HTTP_SERVER;?>"/>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
</head>
<body>
<!--<div id="container">  -->
<div id="top_menu">
    <div id="top_menu_content">
        <div id="logo">
            <a href="/">
                <img src="<?php echo TOWEL_ASSETS_CDN; ?>/images/logoHeader.png" /></a>
        </div>
        <div id="cssmenu">
            <ul>
            	<li><a href="/">Homepage</a></li>
            	<li><a href="<?php echo HTTP_SERVER;?>index.php?route=category">Products</a>
            		<ul>
            		   <?php if(isset($towel_cates) && count($towel_cates) > 0):?>
            		       <?php foreach ($towel_cates as $twc):?>
            		           <li><a href="<?php echo $twc['href'];?>">
            		               <?php echo $twc['towel_cate_name'];?></a></li>   
            		       <?php endforeach;?>
            		   <?php endif;?>
                	</ul>
            	</li>
            	<li><a href="<?php echo HTTP_SERVER;?>index.php?route=contact-us">Contact us</a></li>
        	</ul>
        </div>
        <div id="flag">
            <a href="">
                <img src="<?php echo TOWEL_ASSETS_CDN; ?>/images/en.png" alt="English" /></a> <a href="http://jp.towelofvietnam.com">
                    <img src="<?php echo TOWEL_ASSETS_CDN; ?>/images/jp.png" alt="Japan" /></a>
        </div>
        
    </div>
</div>