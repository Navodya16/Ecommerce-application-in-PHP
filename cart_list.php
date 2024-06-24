
 <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4 page-title" style="background: rgba(0, 0, 0, 0);">
                    	<h3 class="text-white">Cart List</h3>
                        <!-- <hr class="divider my-4" /> -->
                    </div>
                    
                </div>
            </div>
        </header>
	<section class="page-section" id="menu">
        <div class="container">
        	<div class="row">
        	<div class="col-lg-8">
        		<div class="sticky">
	        		<div class="card">
	        			<div class="card-body">
	        				<div class="row">
		        				<div class="col-md-3"><b>Product</b></div>
								<div class="col-md-3"><b>Type</b></div>
								<div class="col-md-3"><b>Quantity</b></div>
		        				<div class="col-md-3 text-right"><b>Price</b></div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
        		<?php 
        		if(isset($_SESSION['login_user_id'])){
					$data = "where c.user_id = '".$_SESSION['login_user_id']."' ";	
				}else{
					//$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
					$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

					$data = "where c.client_ip = '".$ip."' ";	
				}
				$total = 0;
				$get = $conn->query("SELECT *,c.id as cid FROM cart c inner join product_list p on p.id = c.product_id ".$data);
				while($row= $get->fetch_assoc()):
					$total += ($row['qty'] * $row['price']);
					$qtyx = $row['qty'];
				
        		?>

        		<div class="card">
	        		<div class="card-body">
		        		<div class="row">
			        		<div class="col-md-3" style="text-align: -webkit-center">
			        			<a href="javascript:void(0)" class="rem_cart btn btn-sm btn-outline-danger" data-id="<?php echo $row['cid'] ?>"><i class="fa fa-trash"></i></a>
			        			<img src="assets/img/<?php echo $row['img_path'] ?>" alt="">
								<p><b><large><?php echo $row['name'] ?></large></b></p>
			        			<p> <b><small>Unit Price : PHP <?php echo number_format($row['price'],2) ?></small></b></p>
			        		</div>
							<div class="col-md-2" style="text-align: -webkit-center">
			        			
			        			<p><small><?php 
								$get2 = $conn->query("SELECT name from category_list where id = '".$row['category_id']."' ");
								while($row2= $get2->fetch_assoc()):
									echo $row2['name'] ;?>
								<?php endwhile; ?>
								</small></p>
			        		</div>
			        		<div class="col-md-3">
			        			<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <button class="btn btn-outline-secondary qty-minus" type="button"   data-id="<?php echo $row['cid'] ?>"><span class="fa fa-minus"></button>
								  </div>
								  <input type="number" readonly value="<?php echo $qtyx ?>" min = 1 class="form-control text-center" name="qty" >
								  <div class="input-group-prepend">
								    <button class="btn btn-outline-secondary qty-plus" type="button" id=""  data-id="<?php echo $row['cid'] ?>"><span class="fa fa-plus"></span></button>
								  </div>
								</div>
			        		</div>
			        		<div class="col-md-4 text-right">
			        			<!--<b><large><?php //echo number_format($qtyx * $row['price'],2) ?></large></b> -->
								<b><input type="number" readonly value="<?php echo number_format($qtyx * $row['price'],2) ?>" name="UnitTotalPrice" ></b>
			        		</div>
		        		</div>
	        		</div>
	        	</div>

	        <?php endwhile; ?>
        	</div>
        	<div class="col-md-4">
        		<div class="sticky">
        			<div class="card">
        				<div class="card-body">
        					<p><large>Total Amount</large></p>
        					<hr>
        					<p class="text-right"><b><input type="number" readonly value="<?php echo number_format($total, 2) ?>" name="TotPrice"></b></p>
							<!--<p class="text-right"><b><input type="number" readonly value="<?php echo number_format($_SESSION['cart_total'], 2) ?>" name="TotPrice"></b></p>-->

        					<hr>
        					<div class="text-center">
        						<button class="btn btn-block btn-outline-primary" type="button" id="checkout">Proceed to Checkout</button>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	</div>
        </div>
    </section>
    <style>
    	.card p {
    		margin: unset
    	}
    	.card img{
		    max-width: calc(100%);
		    max-height: calc(59%);
    	}
    	div.sticky {
		  position: -webkit-sticky; /* Safari */
		  position: sticky;
		  top: 4.7em;
		  z-index: 10;
		  background: white
		}
		.rem_cart{
		   position: absolute;
    	   left: 0;
		}
    </style>  

<script>
	$('.view_prod').click(function(){
		uni_modal_right('Product','view_prod.php?id='+$(this).attr('data-id'))
	})
	
	$('.qty-plus').click(function(){
		var qtyInput = $(this).parent().siblings('input[name="qty"]');
		var qty = parseInt(qtyInput.val());
		var unitTotalPriceInput = $(this).closest('.row').find('input[name="UnitTotalPrice"]');
		var price = parseFloat(unitTotalPriceInput.val()) / qty; // Calculate the price per unit

		qtyInput.val(qty + 1); // Increment the quantity value by 1

		var newUnitTotalPrice = (qty + 1) * price; // Calculate the new unit total price
		unitTotalPriceInput.val(newUnitTotalPrice.toFixed(2)); // Update the unit total price input
		//console.log("retrieve totPriceInput");

		update_qty(qty + 1, $(this).attr('data-id'));
	});

	$('.qty-minus').click(function(){
		var qtyInput = $(this).parent().siblings('input[name="qty"]');
		var qty = parseInt(qtyInput.val());
		var unitTotalPriceInput = $(this).closest('.row').find('input[name="UnitTotalPrice"]');
		var price = parseFloat(unitTotalPriceInput.val()) / qty; // Calculate the price per unit

		if (qty > 1) {
			qtyInput.val(qty - 1); // Decrement the quantity value by 1

			var newUnitTotalPrice = (qty - 1) * price; // Calculate the new unit total price
			unitTotalPriceInput.val(newUnitTotalPrice.toFixed(2)); // Update the unit total price input

			update_qty(qty - 1, $(this).attr('data-id'));
		}
	});

	var updateCounter = 0; // Counter variable for AJAX requests
	
	function update_qty(qty, id) {
		start_load();
		updateCounter++; // Increment the counter for each AJAX request
		return new Promise(function (resolve) {
		$.ajax({
			url: 'admin/ajax.php?action=update_cart_qty',
			method: "POST",
			data: {id: id, qty: qty},
			success: function (resp) {
				if (resp == 1) {
					// Update the unit total price for the specific product
					var unitTotalPriceInput = $('.card[data-id="' + id + '"]').find('input[name="UnitTotalPrice"]');
					var price = parseFloat(unitTotalPriceInput.val()) / qty;
					var newUnitTotalPrice = qty * price;
					unitTotalPriceInput.val(newUnitTotalPrice.toFixed(2));

					updateCounter--; // Decrement the counter for each response received

					if (updateCounter === 0) {
						// All responses received, update the total amount
						updateTotalAmount();
						load_cart();
						end_load();
						resolve();
					}
				}
			}
		});
	});
}

	function updateTotalAmount() {
		var total = 0;
		$('input[name="UnitTotalPrice"]').each(function () {
			total += parseFloat($(this).val());
		});
		$('input[name="TotPrice"]').val(total.toFixed(2));
		localStorage.setItem('totalAmount', total.toFixed(2));
		console.log("total amount is ", total);
	}

	function updateUnitTotalPrices() {
		$('input[name="UnitTotalPrice"]').each(function () {
			var id = $(this).closest('.card').data('id');
			var unitTotalPrice = $(this).val();
			localStorage.setItem('unitTotalPrice_' + id, unitTotalPrice);
			console.log("unit total is ", unitTotalPrice);
		});
	}

	$(document).ready(function () {
		updateTotalAmount(); // Calculate and display the initial total amount
		var storedTotalAmount = localStorage.getItem('totalAmount');
		$('input[name="TotPrice"]').val(storedTotalAmount);
		updateUnitTotalPrices();
	});

	$('#checkout').click(function(){
		if('<?php echo isset($_SESSION['login_user_id']) ?>' == 1){
			location.replace("index.php?page=checkout&total=<?php echo $total; ?>")
		}else{
			uni_modal("Checkout","login.php?page=checkout")
		}
	})

	$('.rem_cart').click(function(){
	var productId = $(this).attr('data-id');
	deleteCartItem(productId);
});

function deleteCartItem(id) {
	$.ajax({
		url: 'admin/ajax.php?action=delete_cart_item',
		method: "POST",
		data: {id: id},
		success: function (resp) {
			if (resp == 1) {
				// Remove the corresponding cart item from the DOM
				$('.cart-item[data-id="' + id + '"]').remove();

				// Update the total amount and other relevant cart details
				updateTotalAmount();
				// Update other cart-related elements if needed

				end_load();
				location.reload(); // Refresh the page
			}
		}
	});
}

		
</script>