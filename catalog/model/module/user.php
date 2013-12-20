<?php
class ModelModuleUser extends Model {
    public function checkRegister($data){
        if($data['user_name']==null || $data['pass'] ==null)
    		{
    			echo("<script type='text/javascript'>
    				alert('Vui lòng nhập đầy đủ thông tin!');
    				window.history.back(1);
    				</script>");
    			exit;
    			return null;
    		}
    		else 
    		{
    			$sql = "SELECT * FROM " . DB_DATABASE . ".user WHERE user_name = '" 
    			        . $data['user_name'] . "' and pass = '". md5($data['pass']) ."'";
    		
    			$rtn = $this->db->query($sql);
    			
    			if (!isset($rtn) || $rtn == null || $rtn->num_rows <= 0)
    			{
    				echo("<script type='text/javascript'>
    				alert('Tên đăng nhập hoặc mật khẩu không đúng');
    				window.history.back(1);
    				</script>");
    				exit;
    				return null;
    			}
    				
    			return $rtn->row;
    		}
    }
    
	public function getUserList() {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".user");
		return $query->rows;
	}
	
	public  function addUser($data,$image){
		$this->db->query(" INSERT into " . DB_DATABASE . ".user set user_name = '" . $this->db->escape($data['user_name']).
						  "',  pass = '" .$this->db->escape(md5($data['pass'])).
						  "', full_name = '" .$this->db->escape($data['full_name']).
						  "', birth_day= '" .$this->db->escape($data['birth_day']).
						  "', email = '" .$this->db->escape($data['email']).
						  "', image = '" .$this->db->escape($image).
						  "', role = " .(int)$data['role'].
						  ", status = " .(int)$data['status'].
		                  ", code_user = '" .$this->db->escape($data['code_user']).
		 				  "', info = '" .$this->db->escape($data['info']).
						  "', creat_date = "  . time());
	}
	
	public  function editUser($user_id,$data,$image){
		$this->db->query(" UPDATE " . DB_DATABASE . ".user set user_name = '" . $this->db->escape($data['user_name']).
						  "',  pass = '" .$this->db->escape(md5($data['pass'])).
						  "', full_name = '" .$this->db->escape($data['full_name']).
						  "', birth_day= '" .$this->db->escape($data['birth_day']).
						  "', email = '" .$this->db->escape($data['email']).
						  "', image = '" .$this->db->escape($image).
						  "', role = " .(int)$data['role'].
						  ", status = " .(int)$data['status'].
		                  ", code_user = '" .$this->db->escape($data['code_user']).
		 				  "', info = '" .$this->db->escape($data['info']).
						  "', creat_date = "  . time() . " where user_id = $user_id");
	}
	
    public  function updateProfile($pass, $data, $image){
		/**
		 * Kiem tra xem nguoi nay xac nhan mat khau co dung khong?
		 * Hai mat khau thay doi co dung khong
		 */
        
        if(!isset($data['curpassword'])  || $data['curpassword'] == ''){
            echo("<script type='text/javascript'>
    				alert('Bạn chưa nhập mật khẩu!');
    				window.history.back(1);
    				</script>");
    			exit;
    			return null;
        }
        elseif(md5($data['curpassword']) != $pass){
            echo("<script type='text/javascript'>
    				alert('Mật khẩu bạn nhập vào không đúng!');
    				window.history.back(1);
    				</script>");
    			exit;
    			return null;
        }elseif ($data['pass'] != '' && $data['repass'] != ''){ //Truong hop muon thay doi mat khau
            if($data['repass'] == $data['pass']){
                $this->db->query(" UPDATE " . DB_DATABASE . ".user set pass = '" .$this->db->escape(md5($data['pass'])).
						  "', full_name = '" .$this->db->escape($data['full_name']).
                          "', sex= " .$this->db->escape($data['sex']).
             			  ", phone_number = '" .$this->db->escape($data['phone_number']).
                		  "', image = '" .$this->db->escape($image).
						  "', birth_day= '" .$this->db->escape($data['birth_day']).
						  "' where user_id = " . $data['user_id']);
            }else{
                echo("<script type='text/javascript'>
    				alert('Mật khẩu và xác nhận mật khẩu không trùng nhau');
    				window.history.back(1);
    				</script>");
    			exit;
    			return null;
            }
        }
        else{
            $this->db->query(" UPDATE " . DB_DATABASE . ".user set full_name = '" .$this->db->escape($data['full_name']).
                          "', sex= " .$this->db->escape($data['sex']).
             			  ", phone_number = '" .$this->db->escape($data['phone_number']).
                          "', image = '" .$this->db->escape($image).
						  "', birth_day= '" .$this->db->escape($data['birth_day']).
						  "' where user_id = ". $data['user_id']);
        }
        
        
	}
			
	public function deleteUser($user_id) {
		$this->db->query("DELETE FROM " . DB_DATABASE . ".user WHERE user_id = $user_id ");
	}
	
	public function getUserById($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".user WHERE user_id = $user_id ");
	
		return $query->row;
	}
	
	public function getUserByUsername($username) {
		$query = $this->db->query("SELECT * FROM " . DB_DATABASE . ".user WHERE user_name = '" . $this->db->escape($username) . "'");
	
		return $query->row;
	}
	
    public function checkExistUsername($user_name)
	{
		$sql= "SELECT * from " . DB_DATABASE . ".user where LOWER(user_name) = '" . strtolower($user_name) ."'";
		$sql1= "SELECT * from " . DB_DATABASE . ".user where user_name= '$user_name'";
		$qry = $this->db->query($sql1);			
		
		if($qry->num_rows >0 )		
		{	
			echo("<script type='text/javascript'>
				alert('User name bạn đăng ký đã tồn tại');
				window.history.back(1);
				</script>");
			exit;
			return false;
		}
		
		return true;
		
	}
	
	public function checkExistEmail($email)
	{
		$sql1= "SELECT * from " . DB_DATABASE . ".user where email= '$email'";
		$qry = $this->db->query($sql1);	
		if($qry->num_rows >0 )		
		{	
			echo("<script type='text/javascript'>
				alert('Email bạn đăng ký đã tồn tại');
				window.history.back(1);
				</script>");
			exit;
			return false;
		}
		else 
		{
		if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+(\\.[a-z]{2,3})+$/", $email) )
		{
			echo("<script type='text/javascript'>
				alert('Email không đúng định dạng. e.g: alex@gmail.com . Vui lòng nhập lại');
				window.history.back(1);
				</script>");
			exit;
			return false;
		}
		}
		
		return true;
	}
	
    public function checkExistPassNull($pass)
	{
		if(!isset($pass) || $pass == '')		
		{	
			echo("<script type='text/javascript'>
				alert('Password rỗng');
				window.history.back(1);
				</script>");
			exit;
			return false;
		}
		
		return true;
		
	}
	
	public function register($data){
	    $this->db->query(" INSERT into " . DB_DATABASE . ".user set user_name = '" . $this->db->escape($data['user_name']).
						  "',  pass = '" .$this->db->escape(md5($data['pass'])).
						  "', email = '" .$this->db->escape($data['email']).
						  "', creat_date = "  . time());
	}
}
?>