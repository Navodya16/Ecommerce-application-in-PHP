<?php
ob_start();
$action = $_GET['action'];
//$verification_code = $_GET['verification_code']; 
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}
if($action == "delete_category"){
	$save = $crud->delete_category();
	if($save)
		echo $save;
}
if($action == "save_menu"){
	$save = $crud->save_menu();
	if($save)
		echo $save;
}
if($action == "delete_menu"){
	$save = $crud->delete_menu();
	if($save)
		echo $save;
}
if($action == "add_to_cart"){
	$save = $crud->add_to_cart();
	if($save)
		echo $save;
}
if($action == "get_cart_count"){
	$save = $crud->get_cart_count();
	if($save)
		echo $save;
}
if($action == "update_cart_qty"){
	$save = $crud->update_cart_qty();
	if($save)
		echo $save;
}
if($action == "delete_cart_item"){
	$save = $crud->delete_cart_item();
	if($save)
		echo $save;
}
if($action == "save_order"){
	$save = $crud->save_order();
	if($save)
		echo $save;
}
/*if($action == "confirm_order"){
	$save = $crud->confirm_order();
	if($save)
		echo $save;
}*/
if($action == "update_order_status"){
	$save = $crud->update_order_status();
	if($save)
		echo $save;
}
/*if($action == "update_order_details"){
	$save = $crud->update_order_details();
	if($save)
		echo $save;
}*/
if($action == "email_verification"){
	$save = $crud->email_verification();
	if($save)
		echo $save;
}
if($action == "signupAdmin"){
	$save = $crud->signupAdmin();
	if($save)
		echo $save;
}
if($action == "updateAdmin"){
	$id = $_GET['id'];
	$save = $crud->updateAdmin($id);
	if($save)
		echo $save;
}
if($action == "delete_admin"){
	$save = $crud->delete_admin();
	if($save)
		echo $save;
}
if($action == "delete_user"){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == "updateUser"){
	$id = $_GET['id'];
	$save = $crud->updateUser($id);
	if($save)
		echo $save;
}
if($action == "mobile_verification"){
	$save = $crud->mobile_verification();
	if($save)
		echo $save;
}


