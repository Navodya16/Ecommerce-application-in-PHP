<br><br>
<h5><b>GENERATE ORDER REPORTS</b></h5>

<div class="panel-body">
  <form class="clearfix" method="post" action="OrderReport.php">
    <div class="form-group">
      <label class="form-label">Date Range</label>
      <div class="input-group">
        <input type="text" class="datepicker form-control" name="order_start-date" placeholder="From">
        <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
        <input type="text" class="datepicker form-control" name="order_end-date" placeholder="To">
      </div>
    </div>
    <div class="form-group">
      <button type="submit" name="submit_order" class="btn btn-primary">Generate Report</button>
    </div>
  </form>
</div>

<br><br>
<h5><b>GENERATE PRODUCT REPORTS</b></h5>

<div class="panel-body">
  <form class="clearfix" method="post" action="OrderReport.php">
    <div class="form-group">
      <label class="form-label">Date Range</label>
      <div class="input-group">
        <input type="text" class="datepicker form-control" name="product_start-date" placeholder="From">
        <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
        <input type="text" class="datepicker form-control" name="product_end-date" placeholder="To">
      </div>
    </div>
    <div class="form-group">
      <button type="submit" name="submit_product" class="btn btn-primary">Generate Report</button>
    </div>
  </form>
</div>

  <script>
    $(function() {
      // Initialize datepicker
      $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd", // Set the date format
        changeMonth: true, // Enable changing months
        changeYear: true // Enable changing years
      });
    });
  </script>
