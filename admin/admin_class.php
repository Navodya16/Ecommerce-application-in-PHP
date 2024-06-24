<?php
//error_reporting(E_ALL);

session_start();

function verifyMobileNumber($mobileNumber) {
    // Remove any non-digit characters from the mobile number
    $digitsOnly = preg_replace('/\D/', '', $mobileNumber);

    // Check if the mobile number is 11 digits long and starts with "09"
    if (preg_match('/^09\d{9}$/', $digitsOnly)) {
        return true; // Mobile number is valid
    } else {
        return false; // Mobile number is invalid
    }
}

Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			//echo "there are records";
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}

	/*function login2(){
		extract($_POST);
		if(isset($_POST['g-recaptcha-response']))
    	{
			$recaptcha = $_POST['g-recaptcha-response'];
			if(!$recaptcha)
			{
				//file_put_contents('form_data.log', "not clicked recaptcha");
				return 2; //click the recaptcha button
			}
			else
			{
				$secret = "6LdKD7UmAAAAAFffLEA5Qsipur0q_2wI-lo9okHC";
				$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$recaptcha;
				$response = file_get_contents($url);
				$responsekeys = json_decode($response,true);

				//print_r($responsekeys);die();
				if($responsekeys['success'])
				{
					$qry = $this->db->query("SELECT * FROM user_info where email = '".$email."' and password = '".md5($password)."' ");
					if($qry->num_rows > 0){
						foreach ($qry->fetch_array() as $key => $value) {
							if($key != 'passwors' && !is_numeric($key))
								$_SESSION['login_'.$key] = $value;
						}
						//$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
						$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

						$this->db->query("UPDATE cart set user_id = '".$_SESSION['login_user_id']."' where client_ip ='$ip' ");
							return 1;
					}else{
						return 3;
					}
					//file_put_contents('form_data.log', "successfully clicked");
				}
			}
		}
		
	}*/

function login2()
{
	extract($_POST);
	if(isset($_POST['securityCode']))
	{
		$recaptcha = $_POST['securityCode'];
		if (empty($recaptcha))
		{
			//file_put_contents('form_data.log', "not clicked recaptcha");
			return 2; //click the recaptcha button
		}
		else
		{
			if(strcasecmp($_SESSION['captcha'], $_POST['securityCode']) != 0)
			{
				return 2;
			}else
			{
				$qry = $this->db->query("SELECT * FROM user_info where email = '".$email."' and password = '".md5($password)."' ");
					if($qry->num_rows > 0){
						foreach ($qry->fetch_array() as $key => $value) {
							if($key != 'passwors' && !is_numeric($key))
								$_SESSION['login_'.$key] = $value;
						}
						//$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
						$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

						$this->db->query("UPDATE cart set user_id = '".$_SESSION['login_user_id']."' where client_ip ='$ip' ");
							return 1;
					}else{
						return 3;
					}
			}
		}
	}

}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '$password' ";
		$data .= ", type = '$type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}

	/*function signup(){
		extract($_POST);
		$data = " first_name = '$first_name' ";
		$data .= ", last_name = '$last_name' ";
		$data .= ", mobile = '$mobile' ";
		$data .= ", address = '$address' ";
		$data .= ", email = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		//$data .= ", reconfirmPassword = '".md5($reconfirmPassword)."' ";
		//$reconfirmPassword

		if(isset($_POST['g-recaptcha-response']))
    	{
			$recaptcha = $_POST['g-recaptcha-response'];
			if(!$recaptcha)
			{
				//file_put_contents('form_data.log', "not clicked recaptcha");
				return 3; //click the recaptcha button
			}
			else
			{
				if (verifyMobileNumber($mobile)){
					$chk = $this->db->query("SELECT * FROM user_info where email = '$email' ")->num_rows;
					if($chk > 0){
						return 2;
						exit;
					}
					else if($password != $reconfirmPassword)
					{
						return 5;
						exit;
					}
					$save = $this->db->query("INSERT INTO user_info set ".$data);
					if($save){
						$login = $this->login2();
						return 1;
					}
					return 1;
				}
				else{
					return 4;
				}
			}
		}
	}*/

	function signup()
	{
		extract($_POST);
		$data = " first_name = '$first_name' ";
		$data .= ", last_name = '$last_name' ";
		$data .= ", mobile = '$mobile' ";
		$data .= ", address = '$address' ";
		$data .= ", email = '$email' ";
		$data .= ", password = '".md5($password)."' ";

		if(isset($_POST['securityCode']))
		{
			$recaptcha = $_POST['securityCode'];
			if (empty($recaptcha))
			{
				//file_put_contents('form_data.log', "not clicked recaptcha");
				return 3; //click the recaptcha button
			}
			else
			{
				if(strcasecmp($_SESSION['captcha'], $_POST['securityCode']) != 0)
				{
					return 3;
				}
				else
				{
					if (verifyMobileNumber($mobile)){
						$chk = $this->db->query("SELECT * FROM user_info where email = '$email' ")->num_rows;
						if($chk > 0){
							return 2;
							exit;
						}
						else if($password != $reconfirmPassword)
						{
							return 5;
							exit;
						}
						$save = $this->db->query("INSERT INTO user_info set ".$data);
						if($save){
							$login = $this->login2();
							return 1;
						}
						//return 1;
					}
					else{
						return 4;
					}
				}
				
			}
		}

	}

	function email_verification(){
		extract($_POST);
		$data = " code = '$code' ";
		$data .= ", verification_code = '$verification_code' ";
		$data .= ", email = '$email' ";

		if($code == $verification_code)
		{
			return 1;
		}
		else
		{
			if($permittedTimes == 1)
			{
				$unsave = $this->db->query("DELETE FROM user_info WHERE email = '$email'");
			}
			return 2;
			
		}
	}

	function mobile_verification(){
		extract($_POST);
		$data = " code = '$code' ";
		$data .= ", verification_code = '$verification_code' ";
		$data .= ", mobile = '$mobile' "; 

		if($code == $verification_code)
		{
			return 1;
		}
		else
		{
			if($permittedTimes == 1)
			{
				$unsave = $this->db->query("DELETE FROM user_info WHERE mobile = '$mobile'");
			}
			return 2;
			
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data." where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}

			return 1;
				}
	}

	function save_category(){
		extract($_POST);
		$data = " name = '$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO category_list set ".$data);
		}else{
			$save = $this->db->query("UPDATE category_list set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM category_list where id = ".$id);
		if($delete)
			return 1;
	}
	function save_menu(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", price = '$price' ";
		$data .= ", category_id = '$category_id' ";
		$data .= ", description = '$description' ";
		if(isset($status) && $status  == 'on')
		$data .= ", status = 1 ";
		else
		$data .= ", status = 0 ";

		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
					$data .= ", img_path = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO product_list set ".$data);
		}else{
			$save = $this->db->query("UPDATE product_list set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_menu(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM product_list where id = ".$id);
		if($delete)
			return 1;
	}

	function add_to_cart(){
		extract($_POST);
		$data = " product_id = $pid ";	
		$qty = isset($qty) ? $qty : 1 ;
		$data .= ", qty = $qty ";	
		if(isset($_SESSION['login_user_id'])){
			$data .= ", user_id = '".$_SESSION['login_user_id']."' ";	
		}else{
			//$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
			$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
			$data .= ", client_ip = '".$ip."' ";	

		}
		$save = $this->db->query("INSERT INTO cart set ".$data);
		if($save)
			return 1;
	}
	function get_cart_count(){
		extract($_POST);
		if(isset($_SESSION['login_user_id'])){
			$where =" where user_id = '".$_SESSION['login_user_id']."'  ";
		}
		else{
			//$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
			$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

			$where =" where client_ip = '$ip'  ";
		}
		$get = $this->db->query("SELECT sum(qty) as cart FROM cart ".$where);
		if($get->num_rows > 0){
			return $get->fetch_array()['cart'];
		}else{
			return '0'; 
		}
	}

	function update_cart_qty(){
		extract($_POST);
		$data = " qty = $qty ";
		$save = $this->db->query("UPDATE cart set ".$data." where id = ".$id);
		if($save)
		return 1;	
	}

	function delete_cart_item(){
		extract($_POST);
		$data = " id = $id ";
		$save = $this->db->query("DELETE FROM cart where ".$data);
		if($save)
		return 1;	
	}

	function save_order(){
		extract($_POST);
		$data = " name = '".$first_name." ".$last_name."' ";
		$data .= ", address = '$address' ";
		$data .= ", mobile = '$mobile' ";
		$data .= ", email = '$email' ";
		if(isset($_SESSION['login_user_id'])){
			$data .= ", user_id = '".$_SESSION['login_user_id']."' ";	
		}
		//$data .= ", user_id = '$email' ";
		$city = $city;
		$paymentmethod = $payment_method;
		$data .= ", city = '$city' ";
		if($payment_method == "ewallat_gcash") //2 is ewallet_cash
			$data .= ", payment_method = 2 ";
		else if($payment_method == "credit_debit_card") //1 is credit_debit_card
			$data .= ", payment_method = 1 ";
		
		if($city != "makati" && $city != "outside_makati")
		{
			return 4;
		}
		else
		{
		$save = $this->db->query("INSERT INTO orders set ".$data);
		
		if($save){
		$id = $this->db->insert_id;
		$qry = $this->db->query("SELECT * FROM cart where user_id =".$_SESSION['login_user_id']);
		while($row= $qry->fetch_assoc()){

				$data = " order_id = '$id' ";
				$data .= ", product_id = '".$row['product_id']."' ";
				$data .= ", qty = '".$row['qty']."' ";
				$save2=$this->db->query("INSERT INTO order_list set ".$data);
				if($save2){
					$this->db->query("DELETE FROM cart where id= ".$row['id']);
				}
		}
		if($city == "makati")
		{
			if($paymentmethod== "ewallat_gcash") //ewallat_gcash
			{
				return 1;
			}
			else //credit_debit_card
			{
				return 2;
			}
		}	
		else
			return 3;
		}
		}
		
		
		
	}

/*function confirm_order(){
extract($_POST);
	$save = $this->db->query("UPDATE orders set status = 1 where id= ".$id);
	if($save)
		return 1;
}*/

function update_order_status(){
    extract($_POST);

	//0 - for verification
	//1 - confirmed order
	//2 - out for delivery
	//3 - delivered

    $s = 0; // Initialize the $status variable 

    // Determine the status based on the selected option
    if ($status == 'confirmed_order') {
        $s = 1;
    } elseif ($status == 'out_for_delivery') {
        $s = 2;
    } elseif ($status == 'delivered') {
        $s = 3;
    }

    // Update the order status in the database
    $save = $this->db->query("UPDATE orders SET status = '$s' WHERE id = $id");
    if ($save) {
        return 1;
    }
}

/*function update_order_details(){
    extract($_POST);
	$data = " city = '$city' ";
	$data .= ", total_payment = '$totalPayment' ";

	$update = $this->db->query("UPDATE orders SET ".$data." WHERE id = ".$id);

	if ($update) {
		return 1;
	}

    // Update the order status in the database
    $save = $this->db->query("UPDATE orders SET status = '$s' WHERE id = $id");
    if ($save) {
        return 1;
    }
}*/


function signupAdmin(){
	extract($_POST);
	$data = " name = '$name' ";
	$data .= ", username = '$username' ";
	$data .= ", password = '$password' ";
	if($type == "admin")
		$data .= ", type = 1 ";
	else
		$data .= ", type = 2 ";
	//$data .= ", reconfirmPassword = '".md5($reconfirmPassword)."' ";
	//$reconfirmPassword

	if($password != $reconfirmPassword)
	{
		return 2;
		exit;
	}
	$save = $this->db->query("INSERT INTO users set ".$data);
	if($save){
		//$login = $this->login();
		return 1;
	}
	return 3;
}

function updateAdmin($id){
	extract($_POST);
	$data = " name = '$name' ";
	$data .= ", username = '$username' ";
	$data .= ", password = '$password' ";
	if ($type == "admin")
		$data .= ", type = 1 ";
	else
		$data .= ", type = 2 ";

	if ($password != $reconfirmPassword) {
		return 2;
		exit;
	}

	$update = $this->db->query("UPDATE users SET ".$data." WHERE id = ".$id);

	if ($update) {
		return 1;
	}
	return 3;
}

function delete_admin(){
	extract($_POST);
	$delete = $this->db->query("DELETE FROM users where id = ".$id);
	if($delete)
		return 1;
}

function delete_user(){
	extract($_POST);
	$delete = $this->db->query("DELETE FROM user_info where user_id = ".$id);
	if($delete)
		return 1;
}

function updateUser($id){
		extract($_POST);
		$data = " first_name = '$first_name' ";
		$data .= ", last_name = '$last_name' ";
		$data .= ", mobile = '$mobile' ";
		$data .= ", address = '$address' ";
		$data .= ", email = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		//$data .= ", reconfirmPassword = '".md5($reconfirmPassword)."' ";
		//$reconfirmPassword

		if(isset($_POST['g-recaptcha-response']))
    	{
			$recaptcha = $_POST['g-recaptcha-response'];
			if(!$recaptcha)
			{
				//file_put_contents('form_data.log', "not clicked recaptcha");
				return 3; //click the recaptcha button
			}
			else
			{
				if (verifyMobileNumber($mobile)){
					/*$chk = $this->db->query("SELECT * FROM user_info where email = '$email' ")->num_rows;
					if($chk > 0){
						return 2;
						exit;
					}*/
					if($password != $reconfirmPassword)
					{
						return 5;
						exit;
					}
					$save = $this->db->query("UPDATE user_info SET ".$data." WHERE user_id = ".$id);
					if($save){
						$login = $this->login2();
						return 1;
					}
					return 1;
				}
				else{
					return 4;
				}
			}
		}
	}

}

