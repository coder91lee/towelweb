<div class="container-contentsUser">
	<div class="contentsUser">
		<form action="<?php echo HTTP_SERVER . 'index.php?route=user&user_id=' .  $user['user_id']?>&type=1" 
				method="post" enctype="multipart/form-data" id="formProfile">
    		<span class="titleItem">Thông tin chính</span>
    			<ul class="pageacc formDialog">
                    <li class="smallfield"> <span class="name">Tên đăng nhập:</span>
                      <input type="text" disabled="disabled" placeholder="havietduc91">
                      <span class="nums">+10 ♥</span> </li>
                    <li class="smallfield"> <span class="name">Mật khẩu:</span>
                      <input type="password" name="pass">
                      <span class="nums current">+10 ♥</span> </li>
                    <li class="smallfield"> <span class="name">Xác nhận mật khẩu:</span>
                      <input type="password" name="repass">
                      <span class="nums current">+10 ♥</span> </li>
                    <li class="smallfield"><span class="name">Trạng thái kích hoạt:</span>
                    	<input type="text" disabled="disabled" value="Đã kích hoạt" placeholder="SMS">
                      <span class="nums">+10 ♥</span> </li>
                      
            	</ul>
    		<span class="titleItem">Thông tin phụ</span>
    			<ul class="pageacc formDialog">
                    <li class="smallfield"> <span class="name">Tên đầy đủ:</span>
                      <input type="text" name="full_name" 
                      value="<?php 
                                  if(isset($user['full_name']) && $user['full_name']){
                                      echo $user['full_name'];
                                  }
                              ?>">
                      <span class="nums">+10 ♥</span> </li>
                    <li class="smallfield"> <span class="name">Ngày sinh:</span>
                      <input type="text" id="birthday" name="birth_day" 
                      	value="<?php 
                      	            if(isset($user['birth_day']) && $user['birth_day'])
                      	                echo $user['birth_day'];
                      	        ?>" class="hasDatepicker">
                      <span class="nums current">+10 ♥</span> </li>
                    <li class="smallfield"> <span class="name">Số điện thoại:</span>
                      <input type="text" id="phone_number" name="phone_number" 
                      	value="<?php 
                      	            if(isset($user['phone_number']) && $user['phone_number'])
                      	                echo $user['phone_number'];
                      	        ?>">
                      <span class="nums current">+10 ♥</span> </li>
                    <li class="smallfield"> <span class="name">Giới tính:</span>
                      <select name="sex">
                      	<option selected="selected" value="1">Nam</option>
                        <option value="0">Nữ</option>
                      </select>
                      <span class="nums current">+10 ♥</span> </li>
                     
                     
                      <li class="smallfield"> <span class="name">Ảnh đại diện:</span>
                    	 <input type="file" name="image" size="80" />
                      <span class="nums current">+10 ♥</span> </li>
                      
    			</ul>
            <span class="titleItem">Xác nhận mật khẩu</span>  
            	<ul class="pageacc formDialog">
                    <li class="smallfield"> <span class="name">Nhập mật khẩu để cập nhật thông tin phía trên</span>
                      <input type="password" value="" name="curpassword">
                    </li>
                </ul>   
                <input name='submit_profile' value='10' type="hidden">
                <input name='user_id' value='<?php echo $user['user_id'];?>' type="hidden">
            <div class="buttonPanel bxPanel"> 
            	<a id="login-btt" class="btn btn-primary" type="submit" onClick="$('#formProfile').submit();">Lưu thông tin</a> 
            	<a class="btn btn-danger" href="/">Về trang chủ</a> 
        	</div>
    	</form>
	</div>
</div>