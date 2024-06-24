

<?php 
  include'admin/db_connect.php';
    $qry = $conn->query("SELECT * FROM  product_list where id = ".$_GET['id'])->fetch_array();
?>

<div class="container-fluid">

	<div class="card " style="display: flex; justify-content: center; align-items: center;">
        <img src="assets/img/<?php echo $qry['img_path'] ?>" class="card-img-top" alt="..." style="max-width: 200px; max-height: 150px; width: auto; height: auto;">
        <div class="card-body">
          <h5 class="card-title"><?php echo $qry['name'] ?></h5>
		  <h6 class="card-title">Unit Price : PHP <?php echo $qry['price'] ?></h6>
          <div class="form-group">
          </div>
          <div class="row">
          	<div class="col-md-2"><label class="control-label">Qty</label></div>
          	<div class="input-group col-md-7 mb-3">
			  <div class="input-group-prepend">
			    <button class="btn btn-outline-secondary" type="button" id="qty-minus"><span class="fa fa-minus"></button>
			  </div>
			  <input type="number" readonly value="1" min = 1 class="form-control text-center" name="qty" >
			  <div class="input-group-prepend">
			    <button class="btn btn-outline-secondary" type="button" id="qty-plus"><span class="fa fa-plus"></span></button>
			  </div>
			</div>
          </div>
		  <?php
			include'admin/db_connect.php';
            //$qry2 = $conn->query("SELECT * FROM product_list WHERE name = '".$qry['name']."'");
			$qry2 = $conn->query("SELECT p.*, c.name AS category_name FROM product_list p JOIN category_list c ON p.category_id = c.id WHERE p.name = '".$qry['name']."' ");
			


            //while($row = $qry2->fetch_assoc()):?>
		  <!--<div class="text-center">
				<label class="radio-label"><input type="radio" name="product_type" value="" class="radio_button" data-id=<?php //echo $row['id'] ?> ><?php //echo $row['category_name'] ?> <?php //echo $row['price'] ?></label>
		  </div> -->

		  	<?php while($row = $qry2->fetch_assoc()): ?>
			<div class="text-center">
				<?php
				//$isChecked = ($row['id'] === $qry['category_id']) ? 'checked' : ''; // Check if this category matches the product's category
				$isChecked = ($row['category_id'] === $qry['category_id']);
				?>
				<script>
				console.log(<?php echo $row['category_id']; ?>); 
				console.log(<?php echo $qry['category_id']; ?>);
				</script>
				<?php
				if ($isChecked)
				{
					?>
					<label class="radio-label"><input type="radio" name="product_type" value="" class="radio_button" data-id=<?php echo $row['id'] ?> checked><?php echo $row['category_name'] ?> <?php echo $row['price'] ?></label>
					<?php
				}
				else
				{
					?>
					<label class="radio-label"><input type="radio" name="product_type" value="" class="radio_button" data-id=<?php echo $row['id'] ?> ><?php echo $row['category_name'] ?> <?php echo $row['price'] ?></label>
					<?php
				}
				?>
			</div>


		  <?php endwhile; ?>
          <div class="text-center">
          	<button class="btn btn-outline-primary btn-sm btn-block" id="add_to_cart_modal"><i class="fa fa-cart-plus"></i> Add to Cart</button>
          </div>
        </div>
        
      </div>
</div>

<style>
	#uni_modal_right .modal-footer{
		display: none;
	}
</style>

<script>
	$('#qty-minus').click(function(){
		var qty = $('input[name="qty"]').val();
		if(qty == 1){
			return false;
		}else{
			$('input[name="qty"]').val(parseInt(qty) -1);
		}
	})
	$('#qty-plus').click(function(){
		var qty = $('input[name="qty"]').val();
			$('input[name="qty"]').val(parseInt(qty) +1);
	})
	$('#add_to_cart_modal').click(function(){
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=add_to_cart',
			method:'POST',
			data:{pid:'<?php echo $_GET['id'] ?>',qty:$('[name="qty"]').val()},
			success:function(resp){
				if(resp == 1 )
					alert_toast("Order successfully added to cart");
					$('.item_count').html(parseInt($('.item_count').html()) + parseInt($('[name="qty"]').val()))
					$('.modal').modal('hide')
					end_load()
			}
		})
	})
	$('.radio_button').click(function() {
    uni_modal_right('Product', 'view_prod.php?id=' + $(this).attr('data-id'));
  	}); 
	
</script>


