 <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: rgba(0, 0, 0, 0);">
                    	 <h1 class="text-uppercase text-white font-weight-bold">Order History</h1>
                        <!-- <hr class="divider my-4" /> -->
                    </div>
                    
                </div>
            </div>
        </header>

    <section class="page-section">
        <div class="container">
    
        <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                        <thead>
                            <tr>

                            <th>#</th>
                            <th>City</th>
                            <th>Payment method</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            include 'admin/db_connect.php';
                            $qry = $conn->query("SELECT * FROM orders WHERE user_id=".$_SESSION['login_user_id']);
                            while($row=$qry->fetch_assoc()):
                            ?>
                            <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['city'] ?></td>
                                    <td>
                                    <?php if($row['payment_method'] == 1):
                                        echo "Credit/Debit Card";
                                    else: 
                                        echo "Ewallet/Gcash";
                                    endif; ?>
                                    </td>

                                    <?php if($row['status'] == 1): ?>
                                        <td class="text-center"><span class="badge badge-success">Confirmed Order</span></td>
                                    <?php elseif($row['status'] == 2): ?>
                                        <td class="text-center"><span class="badge badge-primary">Out for Delivery</span></td>
                                    <?php elseif($row['status'] == 3): ?>
                                        <td class="text-center"><span class="badge badge-secondary">Delivered</span></td>
                                    <?php else: ?>
                                        <td class="text-center"><span class="badge badge-info">For Verification</span></td>
                                    <?php endif; ?>
                                    <td>
                                        <button class="btn btn-sm btn-primary view_order" data-id="<?php echo $row['id'] ?>" >View Order</button>
                                    </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                        </div>
                    </div>
                    
                </div>
            
        </div>
        </section>

<script>
	$('.view_order').click(function(){
		uni_modal('Order','view_order.php?id='+$(this).attr('data-id'))
	})
</script>