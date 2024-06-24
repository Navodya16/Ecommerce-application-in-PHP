 <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4 page-title" style="background: rgba(0, 0, 0, 0);">
                    	<h3 class="text-white">Pure, refreshing water for everyone.</h3>
                       <!--  <?php echo $_SESSION['setting_name']; ?> -->
                        <a class="btn btn-info btn-xl js-scroll-trigger"href="#menu">Deliver Now</a>

                    </div>
                    
                </div>
            </div>
        </header>
	<section class="page-section" id="menu">
        <div id="menu-field" class="card-deck">
                <?php 
                    include'admin/db_connect.php';
                    $qry = $conn->query("SELECT * FROM  product_list order by rand() ");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <div class="col-lg-3">
                     <div class="card menu-item ">
                        <img src="assets/img/<?php echo $row['img_path'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $row['name'] ?></h5>
                          <h6 class="card-title">Unit Price : PHP <?php echo $row['price'] ?></h6>
                          <p class="card-text truncate">Available: alkaine, purified and mineral</p>
                          <div class="text-center">
                              <button class="btn btn-sm btn-outline-primary view_prod btn-block" data-id=<?php echo $row['id'] ?>><i class="fa fa-eye"></i> View</button>
                              
                          </div>
                        </div>
                        
                      </div>
                      </div>
                    <?php endwhile; ?>
        </div>
    </section>
    <script>
        
        $('.view_prod').click(function(){
            uni_modal_right('Product','view_prod.php?id='+$(this).attr('data-id'))
        })
    </script> 
	
