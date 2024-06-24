<?php session_start() ?>

<?php 
  include 'db_connect.php';

  $editing = false; // Initialize the flag for editing

  if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM users WHERE id = " . $_GET['id']);
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


<div class="container-fluid">
    <form action="" id="signup-frm-admin">
        <div class="form-group">
            <label for="" class="control-label">Name</label>
            <input type="text" name="name" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['name'] . '"'; ?> >
        </div>
        <div class="form-group">
            <label for="" class="control-label">User Name</label>
            <input type="text" name="username" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['username'] . '"'; ?> >
        </div>

        <div class="form-group">
            <label for="" class="control-label">User Type</label>
            <select name="type" required="" class="form-control">
                <option value="admin" <?php if ($editing && $row['type'] == 1) echo 'selected'; ?>>Admin</option>
                <option value="staff" <?php if ($editing && $row['type'] == 2) echo 'selected'; ?>>Staff</option>
            </select>
                <!-- <option value="admin">Admin</option>
                <option value="staff">Staff</option> -->
            </select>
        </div>

        <div class="form-group">
            <label for="" class="control-label">Password</label>
            <input type="password" name="password" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['password'] . '"'; ?>>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Reconfirm Password</label>
            <input type="password" name="reconfirmPassword" required="" class="form-control" <?php if ($editing) echo 'value="' . $row['password'] . '"'; ?> >
        </div>
        <button class="btn btn-info btn-sm"><?php echo $editing ? 'Update' : 'Create'; ?></button>
    </form>
</div>

<style>
    #uni_modal .modal-footer {
        display: none;
    }
</style>

<script>
    $('#signup-frm-admin').submit(function (e) {
        e.preventDefault();
        $('#signup-frm-admin button[type="submit"]').attr('disabled', true).html('Saving...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();
        $.ajax({
            <?php 
                if (!$editing){
                    ?> url: 'ajax.php?action=signupAdmin', <?php }
                else {
                    ?> url: 'ajax.php?action=updateAdmin&id=<?php echo $_GET['id']; ?>', <?php }
            ?>
            //url: 'ajax.php?action=signupAdmin',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err);
                $('#signup-frm-admin button[type="submit"]').removeAttr('disabled').html('Create');
            },
            success: function (resp) {
                if (resp == 1) {
                    location.href = 'index.php?page=home';
                    //var email = $('input[name="email"]').val(); // Get the email value from the input field
                    //uni_modal("Verify your Account", 'emailVerify.php?email=' + email);
                } else if (resp == 2) {
                    $('#signup-frm-admin').prepend('<div class="alert alert-danger">password and reconfirm passwords do not match</div>');
                    $('#signup-frm-admin button.btn[type="submit"]').removeAttr('disabled').html('Create'); // Use .btn class selector
                } else {
                    $('#signup-frm-admin').prepend('<div class="alert alert-danger">Unrecognized error exists.</div>');
                    $('#signup-frm-admin button.btn[type="submit"]').removeAttr('disabled').html('Create'); // Use .btn class selector
                }
            }
        });
    });
</script>
