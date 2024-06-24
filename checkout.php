  <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end mb-4 page-title">
                	<h3 class="text-white">Checkout</h3>
                    <hr class="divider my-4" />
                </div>
                
            </div>
        </div>
    </header>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="" id="checkout-frm">
                            <h4>Confirm Delivery Information</h4>
                            <div class="form-group">
                                <label for="" class="control-label">First Name</label>
                                <input type="text" name="first_name" required="" class="form-control" value="<?php echo $_SESSION['login_first_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Last Name</label>
                                <input type="text" name="last_name" required="" class="form-control" value="<?php echo $_SESSION['login_last_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Address</label>
                                <textarea cols="30" rows="3" name="address" required="" class="form-control"><?php echo $_SESSION['login_address'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Contact Number</label>
                                <input type="text" name="mobile" required="" class="form-control" value="<?php echo $_SESSION['login_mobile'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Contact Email</label>
                                <input type="email" name="email" required="" class="form-control" value="<?php echo $_SESSION['login_email'] ?>">
                            </div> 
                            <div class="form-group">
                                <!--<label for="" class="control-label">City</label>
                                    <br>
                                    <label>
                                        <input type="radio" name="city" value="makati" required /> Makati City
                                    </label>
                                    <br />
                                    <label>
                                        <input type="radio" name="city" value="outside_makati" required />
                                        Outside Makati
                                    </label>-->

                                    <label for="" class="control-label">City</label><br>
                                    <select name="city" id="cities" class="custom-select browser-default">
                                        <option name="" value="">select city</option>
                                        <option name="city" value="makati">Makati city</option>
                                        <option name="city" value="outside_makati">Outside Makati</option>
                                    </select> 

                                    <br />
                                    <div id="barangay-selection" style="display: none">
                                    <label>
                                    <input type="radio" name="barangay" value="east_rembo"/> East Rembo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="south_cembo" /> South Cembo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="west_rembo" /> West Rembo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="pinagkaisahan" /> Pinagkaisahan
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="cembo" /> Cembo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="comembo" /> Comembo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="guadalupe_nuevo" /> Guadalupe Nuevo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="guadalupe_viejo" /> Guadalupe Viejo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="pembo" /> Pembo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="pitogo" /> Pitogo
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="post_proper_northside" /> Post Proper Northside
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="post_proper_southside" /> Post Proper Southside
                                    </label>
                                    <label>
                                    <input type="radio" name="barangay" value="rizal" /> Rizal
                                    </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label">Payment Method</label>
                            <select name="payment_method" id="" class="custom-select browser-default">
									<option value="ewallat_gcash">Cash on Delivery</option>
                                    <option value="credit_debit_card">E-wallet</option>
							</select>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-block btn-outline-primary">Place Order</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky">
        			<div class="card">
        				<div class="card-body">
                            <?php $total = isset($_GET['total']) ? $_GET['total'] : 0; ?>
        					<p><large>Total Amount & Delivery Fee</large></p>
        					<hr>
                            <p class="text-right"><b>Total Amount: PHP <?php echo number_format($total,2) ?></b></p>
                            <hr>
        					<div id="delivery-fee" class= "text-right" style="display: none">
                               <b>Delivery Fee: &nbsp;&nbsp;&nbsp; PHP <span id="fee">0.00</span></b>
                            </div>
                            <hr>
                                <p class="text-right"><b>Total Payment: PHP <span id="tot"></span></b></p>
                            <hr>
        					
        				</div>
        			</div>
        		</div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
          $('#checkout-frm').submit(function(e){
            e.preventDefault()
          
            start_load()
            $.ajax({
                url:"admin/ajax.php?action=save_order",
                method:'POST',
                data:$(this).serialize(),
                success:function(resp){
                    if(resp==1){
                        swal({
                            title: "We received your order.",
                            text: "Thank you for your order! Please expect a call from us.",
                            icon: "success",
                            button: "Ok!",
                            customClass: {
                                content: 'text-center',
                            },
                        }).then(function () {
                            location.replace('index.php?page=home');
                        });

                    }
                    else if(resp==2){
                        swal({
                            title: "We received your order.",
                            text: "Thank you for your order! Estimated time to deliver is within 15-30 minutes. Please expect call from us.",
                            icon: "success",
                            button: "Ok!",
                            customClass: {
                                content: 'text-center',
                            },
                        }).then(function () {
                            location.replace('index.php?page=home');
                        });
                    }
                    else if(resp==3){
                        swal({
                            title: "Reminder!",
                            text: "sorry we don’t deliver outside Makati. For pick-up Please call 8896-194 or 09568037097",
                            icon: "warning",
                            button: "Ok!",
                            dangerMode: true,
                            customClass: {
                                content: 'text-center',
                            },
                        }).then(function () {
                            location.replace('index.php?page=home');
                        });
                    }
                    else if(resp==4){
                        swal({
                            title: "Error!",
                            text: "Please select a valid city and try again.",
                            icon: "error",
                            button: "Ok!",
                            dangerMode: true,
                            customClass: {
                                content: 'text-center',
                            },
                        }).then(function () {
                            location.replace('index.php?page=home');
                        });
                    }
                }
            })
        })
        })
    </script>

    <script>
      //const cityRadios = document.querySelectorAll('input[name="city"]');
      const cityRadios = document.querySelector('select[name="city"]');
      const selectedCity = cityRadios.value;
      const barangaySelection = document.getElementById("barangay-selection");
      const deliveryFee = document.getElementById("delivery-fee");
      const fee = document.getElementById("fee");
      const tot = document.getElementById("tot");

      /*for (let i = 0; i < cityRadios.length; i++) {
        cityRadios[i].addEventListener("change", function () {
          if (this.value === "makati") {
            barangaySelection.style.display = "block";
            deliveryFee.style.display = "block";
          } else {
            barangaySelection.style.display = "none";
            deliveryFee.style.display = "none";
          }
        });
      }*/

      
        cityRadios.addEventListener("change", function () {
          if (this.value === "makati") {
            barangaySelection.style.display = "block";
            deliveryFee.style.display = "block";
          } else {
            barangaySelection.style.display = "none";
            deliveryFee.style.display = "none";
          }
        });
      

      const calculateTotalPayment = () => {
        const total = <?php echo $total; ?>;
        const deliveryFee = parseFloat(fee.textContent);
        if (isNaN(deliveryFee)) {
            return total.toFixed(2);
        }
  
        const totalPayment = total + deliveryFee;
        return totalPayment.toFixed(2);
        };
        tot.textContent = calculateTotalPayment();


      const barangayRadios = document.querySelectorAll(
        'input[name="barangay"]'
      );
      for (let i = 0; i < barangayRadios.length; i++) {
        barangayRadios[i].addEventListener("change", function () {
          if (this.value === "cembo" || this.value === "comembo" || this.value === "post_proper_southside" || this.value === "rizal") {
            fee.textContent = "20.00";
          } else {
            fee.textContent = "60.00";
          }
          const totalPayment = calculateTotalPayment();
            tot.textContent = totalPayment;
        });
      }

      /*for (let i = 0; i < barangayRadios.length; i++) {
        barangayRadios[i].addEventListener("change", function () {
            const city = this.value;
          if (this.value === "cembo" || this.value === "comembo" || this.value === "post_proper_southside" || this.value === "rizal") {
            fee.textContent = "20.00";
          } else {
            fee.textContent = "60.00";
          }
          const totalPayment = calculateTotalPayment();
            tot.textContent = totalPayment;

        // Send data to the backend
        updateDatabase(city, totalPayment);
        });
      }

      function updateDatabase(city, totalPayment) {
        // Send data to the backend using AJAX
        $.ajax({
            url: 'admin/ajax.php?action=update_order_details', // Replace with your backend file URL
            method: 'POST',
            data: {
            city: city,
            totalPayment: totalPayment
            },
            success: function (resp) {
            if (resp == 1) {
                alert_toast("Order details successfully updated");
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
        }
        });
        }*/

    </script>

    