<?php session_start(); 

?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="container-fluid">
	<form action="" id="login-frm">
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="email" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
			<small><a href="javascript:void(0)" id="new_account">Create New Account</a></small>
		</div>
		<div class="form-group">
			<label for="" class="text-info">Captcha Security Code</label>
			<input type="text" name="securityCode" id="securityCode" required="" class="form-control">
		</div>
		<div class="form-group">								
			<img src="get_captcha.php?rand=<?php echo rand(); ?>" id='captcha'>
			<br>
			<p><br>Need another security code? <a href="javascript:void(0)" id="reloadCaptcha">click</a></p>
		</div>
		<!--<div class="g-recaptcha" data-sitekey="6LdKD7UmAAAAAIUeEKNid8lu3oE6Og5bbfU3GF0m"></div>-->
		<button class="button btn btn-info btn-sm">Login</button>
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>

<script>
	$('#new_account').click(function(){
		uni_modal("Create an Account",'signup.php?redirect=index.php?page=checkout')
	})
	$('#login-frm').submit(function(e){
		e.preventDefault()
		$('#login-frm button[type="submit"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=login2',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
				}else if (resp==2){
					$('#login-frm').prepend('<div class="alert alert-danger">Please enter the correct captcha code.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}else{
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
	$("#reloadCaptcha").click(function(){
		var captchaImage = $('#captcha').attr('src');	
		captchaImage = captchaImage.substring(0,captchaImage.lastIndexOf("?"));
		captchaImage = captchaImage+"?rand="+Math.random()*1000;
		$('#captcha').attr('src', captchaImage);
	});
</script>