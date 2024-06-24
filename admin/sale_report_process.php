
<?php
$isOrder = false;
$isProduct = false;
if(isset($_POST['submit_order'])) 
{
  $isOrder = true;
  $startDate = $_POST['order_start-date'];
  $endDate = $_POST['order_end-date'];
    
} 

else if(isset($_POST['submit_product'])) 
{
  $isProduct = true;
  $startDate = $_POST['product_start-date'];
  $endDate = $_POST['product_end-date'];
    
} 
else 
{
  echo "Please select both start and end dates.";
}

// Ensure that $startDate and $endDate are not empty before proceeding
if(!empty($startDate) && !empty($endDate)) 
{
  $startDate = date("Y-m-d", strtotime($startDate));
  $endDate = date("Y-m-d", strtotime($endDate));

  include 'db_connect.php';

  if($isProduct)
  {
    //$query = "SELECT product_id, SUM(qty) AS total_quantity FROM order_list GROUP BY product_id";
    $query = "SELECT o.product_id, p.name, p.price, SUM(o.qty) AS total_quantity 
          FROM order_list o 
          INNER JOIN product_list p ON o.product_id = p.id INNER JOIN orders ord ON o.order_id = ord.id 
          WHERE DATE(ord.created_at) >= '$startDate' AND DATE(ord.created_at) <= '$endDate' 
          GROUP BY o.product_id, p.name, p.price";
  }
  else if($isOrder)
  {
    $query = "SELECT * FROM orders WHERE DATE(created_at) >= '$startDate' AND DATE(created_at) <= '$endDate'";
  }

  $results = $conn->query($query);
  $conn->close();
}

?>

<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Order Page Title</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
  <?php if($results && $isOrder): 
    $grandTotal = 0;?>
    <div class="page-break">
       <div class="sale-head">
           <h1>MJB Water Refilling System - Order Report</h1>
           <strong><?php echo $startDate; ?> TILL DATE <?php echo $endDate; ?> </strong>
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              <th>Date</th>
              <th>Customer Name</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Payment method</th>
              <th>TOTAL PAYMENT (PHP)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              <td class=""><?php echo $result['created_at']; ?></td>
              <td class=""><?php echo $result['name']; ?></td>
              <td class=""><?php echo $result['mobile']; ?></td>
              <td class=""><?php echo $result['email']; ?></td>
              
              <?php if($result['payment_method'] == 1):?>
                <td class=""><?php echo "Credit/Debit Card"; ?></td>
              <?php else:?>
                <td class=""><?php echo "Ewallet/Gcash"; ?></td>     
              <?php endif;?>

              <?php
                $total = 0;
                include 'db_connect.php';
                $qry = $conn->query("SELECT * FROM order_list o inner join product_list p on o.product_id = p.id  where order_id =".$result['id']);
                while($row=$qry->fetch_assoc()):
                  $total += $row['qty'] * $row['price'];
                endwhile;
                $grandTotal += $total;
              ?>
              <td class="text-right"><?php echo number_format($total,2); ?></td>
              
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
         <tr class="text-right">
           <td colspan="4"></td>
           <td colspan="1">Grand Total</td>
           <td> 
           <?php echo number_format($grandTotal,2); ?>
          </td>
         </tr>
         
        </tfoot>
      </table>
    </div>
  <?php
     endif;
  ?>

<?php if($results && $isProduct): 
    $grandTotal = 0;?>
    <div class="page-break">
       <div class="sale-head">
           <h1>MJB Water Refilling System - Sales Report</h1>
           <strong><?php echo $startDate; ?> TILL DATE <?php echo $endDate; ?> </strong>
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              <th>Product Name</th>
              <th>Unit Price (PHP)</th>
              <th>Quantity</th>
              <th>TOTAL REVENUE (PHP)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              <td class=""><?php echo $result['name']; ?></td>
              <td class=""><?php echo $result['price']; ?></td>
              <td class=""><?php echo $result['total_quantity']; ?></td>
              
              <?php
              $total = $result['total_quantity'] * $result['price'];
              $grandTotal += $total;
              ?>
              
              <td class="text-right"><?php echo number_format($total,2); ?></td>             
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
         <tr class="text-right">
           <td colspan="2"></td>
           <td colspan="1">Grand Total</td>
           <td> 
           <?php echo number_format($grandTotal,2); ?>
          </td>
         </tr>
         
        </tfoot>
      </table>
    </div>
  <?php
     endif;
  ?>


</body>
</html>

