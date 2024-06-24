<style>
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
}
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
	span.card-icon {
    position: absolute;
    font-size: 3em;
    bottom: .2em;
    color: #ffffff80;
}
.file-item{
	cursor: pointer;
}
a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}
table th,td{
	/*border-left:1px solid gray;*/
}
a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
}
.candidate {
    margin: auto;
    width: 23vw;
    padding: 0 10px;
    border-radius: 20px;
    margin-bottom: 1em;
    display: flex;
    border: 3px solid #00000008;
    background: #8080801a;

}
.candidate_name {
    margin: 8px;
    margin-left: 3.4em;
    margin-right: 3em;
    width: 100%;
}
	.img-field {
	    display: flex;
	    height: 8vh;
	    width: 4.3vw;
	    padding: .3em;
	    background: #80808047;
	    border-radius: 50%;
	    position: absolute;
	    left: -.7em;
	    top: -.7em;
	}
	
	.candidate img {
    height: 100%;
    width: 100%;
    margin: auto;
    border-radius: 50%;
}
.vote-field {
    position: absolute;
    right: 0;
    bottom: -.4em;
}
</style>

<div class="containe-fluid">

	<div class="row">
		<div class="col-lg-12">
			
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
				<?php echo "Welcome back ".$_SESSION['login_name']."!"  ?>
				</div>
			</div>
		</div>
	</div>

</div>

<br>

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    <p class="card-text"><i class="fas fa-shopping-cart"></i> Products</p>
                </div>
                <div class="card-body text-dark">
					<?php
						include'db_connect.php';
    					$qry = $conn->query("SELECT COUNT(*) AS total_count FROM product_list");
						$row = $qry->fetch_assoc();
						$totalCount = $row['total_count'];
					?>
                    <h5 class="card-title">Total Products: <?php echo $totalCount; ?></h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    <p class="card-text"><i class="fas fa-wallet"></i> Orders</p>
                </div>
                <div class="card-body text-dark">
                    <?php
						include'db_connect.php';
    					$qry = $conn->query("SELECT COUNT(*) AS total_count FROM orders");
						$row = $qry->fetch_assoc();
						$totalCount = $row['total_count'];
					?>
                    <h5 class="card-title">Total Orders: <?php echo $totalCount; ?></h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    <p class="card-text"><i class="fas fa-user"></i> Customers</p>
                </div>
                <div class="card-body text-dark">
                    <?php
						include'db_connect.php';
    					$qry = $conn->query("SELECT COUNT(*) AS total_count FROM user_info");
						$row = $qry->fetch_assoc();
						$totalCount = $row['total_count'];
					?>
                    <h5 class="card-title">Total Customers: <?php echo $totalCount; ?></h5>
                </div>
            </div>
        </div>
        
		<div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    <p class="card-text"><i class="fas fa-coins"></i> Revenue</p>
                </div>
                <div class="card-body text-dark">
                    <?php
                        $total = 0;
                        $qry2 = $conn->query("SELECT * FROM order_list o inner join product_list p on o.product_id = p.id ");
                        while($row2=$qry2->fetch_assoc()):
                            $total += $row2['qty'] * $row2['price'];
                        endwhile;
					?>
                    <h5 class="card-title">Total Revenue: PHP <?php echo number_format($total,2) ?></h5>
                </div>
            </div>
        </div>
        
    </div>
</div>

<br><br>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card mb-3" style="max-width: 750px;">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <img src="../assets/img/money.png" class="card-img" alt="Centered Image">
                    </div>

                    <?php
                    include 'db_connect.php';
                    $qry = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 1");
                    $row = $qry->fetch_assoc();

                    if ($row) {
                        $name = $row['name'];
                        $city = $row['city'];
                        if($row['payment_method'] == 1):
                            $paymentMethod = "Credit/Debit Card";
                        else:
                            $paymentMethod = "Ewallet/Gcash";
                        endif;
                        $hasOrders = true;
                    } else {
                        $hasOrders = false;
                    }

                    $total = 0;
                    if($hasOrders){
                    $qry2 = $conn->query("SELECT * FROM order_list o inner join product_list p on o.product_id = p.id  where order_id =".$row['id']);
                    while($row2=$qry2->fetch_assoc()):
                        $total += $row2['qty'] * $row2['price'];
                    endwhile;
                    }

                    ?>

                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title"><b>YOUR LAST ORDER</b></h2><br>
                            <?php if ($hasOrders): ?>
                                <h5 class="card-text">Customer name: <?php echo $name; ?></h5>
                                <h5 class="card-text">Customer city: <?php echo $city; ?></h5>
                                <h5 class="card-text">Customer payment method: <?php echo $paymentMethod; ?></h5>
                                <h5 class="card-text">Customer total Amount: PHP <?php echo number_format($total,2) ?></h5>
                            <?php else: ?>
                                <p>No orders available.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>














</div>
<script>
	
</script>