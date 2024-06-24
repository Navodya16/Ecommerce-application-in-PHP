<?php
if(isset($_GET['email']))
{
    $email = $_GET['email'];
}
if(isset($_GET['mobile']))
{
    $mobile = $_GET['mobile'];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

//$password = $_POST["password"]; 

$mail = new PHPMailer(true);
try{
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = ''; //your email
    $mail->Password = ''; //app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->Port = 587;

    //Recipients
    $mail->setFrom(''); //your email

    //Add a recipient
    $mail->addAddress($email);

    //Set email format to HTML
    $mail->isHTML(true);

    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

    $mail->Subject = 'Email verification';
    $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

    $mail->send();
    // echo 'Message has been sent';

    //$encrypted_password = password_hash($password, PASSWORD_DEFAULT);

    // connect with database
    //$conn = mysqli_connect("localhost:8889", "root", "root", "test");

    // insert in users table
    //$sql = "INSERT INTO users(name, email, password, verification_code, email_verified_at) VALUES ('" . $name . "', '" . $email . "', '" . $encrypted_password . "', '" . $verification_code . "', NULL)";
    //mysqli_query($conn, $sql);

    //header("Location: email-verification.php?email=" . $email);
    //exit();
}
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<div class="container-fluid">
	<form action="" id="email-verification-frm">
		<div class="form-group">
            <h2>Please verify your email address</h2><br>
            <p>Enter the verification code we sent to <?= $email; ?>.</p>
			<label for="" class="control-label">Enter verification code</label>
			<input type="text" name="code" required="" class="form-control">
		</div>
		<button class="button btn btn-info btn-sm">Verify</button>
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>

<script>
    var permittedTimes = 3;
	$('#email-verification-frm').submit(function(e){
		e.preventDefault()
		$('#email-verification-frm button[type="submit"]').attr('disabled',true).html('Saving...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
        // PHP-generated verification code
        var verificationCode = '<?php echo $verification_code; ?>';
        var email = '<?php echo $email ?>';
		$.ajax({
			//url:'admin/ajax.php?action=email_verification&verification_code=<?php echo $verification_code; ?>&permittedTimes='+ permittedTimes,
            url:'admin/ajax.php?action=email_verification&verification_code=<?php echo $verification_code; ?>',
			method:'POST',
			//data:$(this).serialize(),
            data: $(this).serialize() + '&verification_code=' + encodeURIComponent(verificationCode) + '&email=' + encodeURIComponent(email) + '&permittedTimes=' + permittedTimes , // Include verification code in the data
			error:err=>{
				console.log(err)
		$('#email-verification-frm button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success:function(resp){
				if(resp == 1){
                    //location.href = 'index.php?page=home' ; 
                    var mobile = <?php echo $mobile; ?>; // Get the email value from the input field
					//var mobile = $('input[name="mobile"]').val(); // Get the mobile value from the input field
					uni_modal("Verify your Account", 'mobileVerify.php?mobile=' + mobile);
				}
                else
                {
                    permittedTimes -= 1;
                    if(permittedTimes > 0)
                    {
                        $('#email-verification-frm').prepend('<div class="alert alert-danger">Enter the correct verification code (' + permittedTimes + ' attempts remaining)</div>')
					    $('#email-verification-frm button[type="submit"]').removeAttr('disabled').html('Create');
                    }
                    else
                    {
                        uni_modal("Register again",'signup.php?redirect=index.php?page=checkout');
                    }
                }
				/*else if(resp == 2){
                    //location.href = 'index.php?page=home' ;
                    uni_modal("Register again",'signup.php?redirect=index.php?page=checkout');
					//$('#email-verification-frm').prepend('<div class="alert alert-danger">verification code is not correct.</div>')
					//$('#email-verification-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}
                else if(resp == 3){
                    uni_modal("Register again code not",'signup.php?redirect=index.php?page=checkout');
					//$('#email-verification-frm').prepend('<div class="alert alert-danger">verification code is not correct.</div>')
					//$('#email-verification-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}*/
			}
		})
	})
</script>