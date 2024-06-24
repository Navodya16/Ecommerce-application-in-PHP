<?php

if(isset($_GET['mobile']))
{
    $mobile = $_GET['mobile'];
}

?>

<?php

require_once 'vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic("", ""); 
$client = new \Vonage\Client($basic);

// Generate a random 4-digit verification code
$verificationCode = rand(1000, 9999);
$message = "Your verification code is: " . $verificationCode;

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS($mobile, 'Vonage APIs', $message)
);

$message = $response->current();

/*if ($message->getStatus() == 0) {
    echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}*/

?>


<div class="container-fluid">
	<form action="" id="mobile-verification-frm">
		<div class="form-group">
            <h2>Please verify your mobile number</h2><br>
            <p>Enter the verification code we sent to <?= $mobile; ?>.</p>
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
	$('#mobile-verification-frm').submit(function(e){
		e.preventDefault()
		$('#mobile-verification-frm button[type="submit"]').attr('disabled',true).html('Saving...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
        // PHP-generated verification code
        var verificationCode = '<?php echo $verificationCode; ?>';
        var mobile = '<?php echo $mobile ?>';
		$.ajax({
            url:'admin/ajax.php?action=mobile_verification&verification_code=<?php echo $verificationCode; ?>',
			method:'POST',
            data: $(this).serialize() + '&verification_code=' + encodeURIComponent(verificationCode) + '&mobile=' + encodeURIComponent(mobile) + '&permittedTimes=' + permittedTimes , // Include verification code in the data
			error:err=>{
				console.log(err)
		$('#mobile-verification-frm button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success:function(resp){
				if(resp == 1){
                    location.href = 'index.php?page=home' ; 
				}
                else
                {
                    permittedTimes -= 1;
                    if(permittedTimes > 0)
                    {
                        $('#mobile-verification-frm').prepend('<div class="alert alert-danger">Enter the correct verification code (' + permittedTimes + ' attempts remaining)</div>')
					    $('#mobile-verification-frm button[type="submit"]').removeAttr('disabled').html('Create');
                    }
                    else
                    {
                        uni_modal("Register again",'signup.php?redirect=index.php?page=checkout');
                    }
                }
			}
		})
	})
</script>