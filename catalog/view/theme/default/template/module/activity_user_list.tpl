<div class="top_cat">
    <div class="padlr10" style="margin-bottom: 5px; margin-top: 5px;">
        <!--  <a class="heading" href="">Trang cá nhân</a>-->
        <div class="avatar heading" style="height: 50px;">
                <a style="margin-right: 5px;" id="change_avatar" class="picUser" href="http://appstore.vn/ios/user/uploadavatar">
                	<span class="picAvatar"> <?php //v?>
                		<img style="height: 50px;" src="<?php echo $user['image'];?>">
                	</span>
                </a>     
                <a class="nameUser" href="http://appstore.vn/ios/user">
                	<span class="nameAvatar"><?php echo $user['full_name'];?>
                	</span>
                </a>

    	</div>
        <i class="icon-right-arrow"></i>
    </div>
    <div class="hr hr_top"></div>
    <div class="top_shadow"></div>
    <div class="body scrollable" style="margin-top: 10px;">
        <div class="padlr10" style="margin-bottom: 17px;
    			margin-top: -11px; padding: 0 10px;">
			<a href="">
            <div class="cat">
                
            </div>
            </a>
            <a href="<?php echo $user['href'];?>&type=1">
                <div class="cat">
                <i class="color-green-btn icon icon-user" ></i>
                    Thông tin cá nhân
                </div>
            </a>
            
            <a href="<?php echo $user['href'];?>&type=2">
                <div class="cat">
                <i class="icon icon-gift"></i>
                    Thông tin tài khoản
                </div>
            </a>
            
            <a href="<?php echo $user['href'];?>&type=3">
                <div class="cat">
                <i class="icon icon-heart"></i>
                    Nạp thẻ
                </div>
            </a>
            
            <a href="<?php echo $user['href'];?>&type=4">
                <div class="cat">
                <i class="icon icon-download-alt"></i>
                    Thông kê giao dịch
                </div>
            </a>
            
            <a href="<?php echo $user['href'];?>&type=5">
                <div class="cat">
                <i class="icon icon-download-alt"></i>
                    Thống kê tải
                </div>
            </a>
            
            </div>
    </div>
    <div class="bottom_shadow" style="display: block"></div>
    <div class="hr hr_bottom" style="display: none"></div>
</div>