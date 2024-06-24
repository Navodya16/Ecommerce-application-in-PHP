<?php session_start() ?>

<?php 
  include 'admin/db_connect.php';

  $editing = false; // Initialize the flag for editing

  if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM user_info WHERE user_id = " . $_GET['id']);
    if ($qry) {
      if (mysqli_num_rows($qry) > 0) {
        $row = $qry->fetch_array();
        $editing = true; // Set the flag to indicate that editing is taking place
      }
    } else {
      echo "Query failed: " . mysqli_error($conn);
    }
  }
?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="container-fluid">
	<form action="" id="signup-frm">
		<div class="form-group">
			<label for="" class="control-label">Firstname</label>
			<input type="text" name="first_name" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['first_name'] . '"'; ?> >
		</div>
		<div class="form-group">
			<label for="" class="control-label">Last Name</label>
			<input type="text" name="last_name" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['last_name'] . '"'; ?>>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact</label>
			<input type="text" name="mobile" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['mobile'] . '"'; ?>>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows="3" name="address" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['address'] . '"'; ?>></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="email" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['email'] . '"'; ?>>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control" >
		</div>
		<div class="form-group">
			<label for="" class="control-label">Reconfirm Password</label>
			<input type="password" name="reconfirmPassword" required="" class="form-control">
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
		<button class="button btn btn-info btn-sm"> <?php echo $editing ? 'Update' : 'Create'; ?></button>
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>

<script>
	$('#signup-frm').submit(function(e){
		e.preventDefault()
		$('#signup-frm button[type="submit"]').attr('disabled',true).html('Saving...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			<?php 
                if (!$editing){
                    ?> url: 'admin/ajax.php?action=signup', <?php }
                else {
                    ?> url: 'admin/ajax.php?action=updateUser&id=<?php echo $_GET['id']; ?>', <?php }
            ?>
			//url:'admin/ajax.php?action=signup',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success:function(resp){
				if(resp == 1){
					//location.href = 'index.php?page=home' ;
					var email = $('input[name="email"]').val(); // Get the email value from the input field
					var mobile = $('input[name="mobile"]').val(); // Get the mobile value from the input field
					uni_modal("Verify your Account", 'emailVerify.php?email=' + email + '&mobile=' + mobile);
				}
				else if (resp==4){
					$('#signup-frm').prepend('<div class="alert alert-danger">Mobile number is not valid</div>')
					$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}
				else if (resp==2){
					$('#signup-frm').prepend('<div class="alert alert-danger">your account is already exist. try to login</div>')
					$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}
				else if (resp==3){
					$('#signup-frm').prepend('<div class="alert alert-danger">please enter the correct captcha code</div>')
					$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}
				else if (resp==5){
					$('#signup-frm').prepend('<div class="alert alert-danger">password and reconfirm passwords do not match</div>')
					$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}
				else{
					$('#signup-frm').prepend('<div class="alert alert-danger">Email already exist.</div>')
					$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
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