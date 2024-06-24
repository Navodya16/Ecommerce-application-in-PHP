<?php 

?>

<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_admin"><i class="fa fa-plus"></i> New Admin</button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td>
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo $row['name'] ?>
				 	</td>
				 	<td>
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_admin" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_admin" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>

<br><br>

<div class="container-fluid">
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Email</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT * FROM user_info order by first_name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td>
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo $row['first_name']; ?>  <?php echo $row['last_name']; ?>
				 	</td>
				 	<td>
				 		<?php echo $row['email'] ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['user_id'] ?>'>Delete</a>
								    <!--<div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php //echo $row['id'] ?>'>Delete</a> -->
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>



<script>
	
$('#new_admin').click(function(){
	uni_modal('New Admin','manage_admin.php')
})

$('.edit_admin').click(function(){
	uni_modal('Edit Admin','manage_admin.php?id='+$(this).attr('data-id'))
})

$('.delete_admin').click(function(){
		_conf("Are you sure to delete this admin?","delete_admin",[$(this).attr('data-id')])
	})
function delete_admin($id){
	start_load()
	$.ajax({
		url:'ajax.php?action=delete_admin',
		method:'POST',
		data:{id:$id},
		success:function(resp){
			if(resp==1){
				alert_toast("admin successfully deleted",'success')
				setTimeout(function(){
					location.reload()
				},1500)

			}
		}
	})
}

$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
function delete_user($id){
	start_load()
	$.ajax({
		url:'ajax.php?action=delete_user',
		method:'POST',
		data:{id:$id},
		success:function(resp){
			if(resp==1){
				alert_toast("user successfully deleted",'success')
				setTimeout(function(){
					location.reload()
				},1500)

			}
		}
	})
}

</script>

