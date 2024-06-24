<div class="container-fluid">
	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Qty</th>
				<th>Order</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$total = 0;
			include 'db_connect.php';
			$qry = $conn->query("SELECT * FROM order_list o inner join product_list p on o.product_id = p.id  where order_id =".$_GET['id']);
			while($row=$qry->fetch_assoc()):
				$total += $row['qty'] * $row['price'];
			?>
			<tr>
				<td><?php echo $row['qty'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo number_format($row['qty'] * $row['price'],2) ?></td>
			</tr>
		<?php endwhile; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2" class="text-right">TOTAL</th>
				<th ><?php echo number_format($total,2) ?></th>
			</tr>

		</tfoot>
	</table>
	<!--<div class="text-center">
		<button class="btn btn-primary" id="confirm" type="button" onclick="confirm_order()">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

	</div>-->
	<div class="text-center">
		<div class="row justify-content-between">
			<div class="col-md-auto">
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Select Status
					</button>
					<div class="dropdown-menu" aria-labelledby="statusDropdown">
						<a class="dropdown-item" href="#" onclick="update_order_status('confirmed_order')">Confirm Order</a>
						<a class="dropdown-item" href="#" onclick="update_order_status('out_for_delivery')">Out for Delivery</a>
						<a class="dropdown-item" href="#" onclick="update_order_status('delivered')">Delivered</a>
					</div>
				</div>
			</div>
			<div class="col-md-auto">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>



</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>
<script>
	/*function confirm_order(){
		start_load()
		$.ajax({
			url:'ajax.php?action=confirm_order',
			method:'POST',
			data:{id:'<?php echo $_GET['id'] ?>'},
			success:function(resp){
				if(resp == 1){
					alert_toast("Order confirmed.")
                        setTimeout(function(){
                            location.reload()
                        },1500)
				}
			}
		})
	}*/
	function update_order_status(status) {
    start_load();
    $.ajax({
        url: 'ajax.php?action=update_order_status',
        method: 'POST',
        data: { id: '<?php echo $_GET['id'] ?>', status: status },
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Order status updated to " + status + ".");
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
        }
    });
}

</script>