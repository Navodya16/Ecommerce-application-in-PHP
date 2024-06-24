<?php
require('../fpdfn/fpdf.php');

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


<?php


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm



if($results && $isOrder)
{
  $pdf = new FPDF('P','mm','A4');
  $pdf->AddPage();

  $grandTotal = 0;
  $pdf->SetFont('Arial','B',16);
  $pdf->setTextColor(0,0,0);
  $pdf->Cell(200,10, "MJB Water Refilling System - Order Report", "0", "1", "C");
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(200,5, $startDate." TILL DATE ".$endDate , "0", "1", "C");
  $pdf->Cell(200,5, "" , "0", "1", "C");

  //invoice contents
  $pdf->SetFont('Arial','B',10);

  $pdf->Cell(25	,5,'Date',1,0);
  $pdf->Cell(35	,5,'Customer Name',1,0);
  $pdf->Cell(25	,5,'Mobile',1,0);
  $pdf->Cell(40	,5,'Email',1,0);
  $pdf->Cell(25	,5,'Type',1,0);
  $pdf->Cell(25	,5,'TOTAL (PHP)',1,1);//end of line

  $pdf->SetFont('Arial','',8);

  foreach($results as $result):
      //$pdf->Cell(25	,5, $result['created_at'], 1,0);
      $pdf->Cell(25	,5, date("Y-m-d", strtotime($result['created_at'])), 1,0);
      $pdf->Cell(35	,5, $result['name'], 1,0);
      $pdf->Cell(25	,5, $result['mobile'], 1,0);
      $pdf->Cell(40	,5, $result['email'], 1,0);

      if($result['payment_method'] == 1):
          $pdf->Cell(25	,5, 'Credit/Debit Card', 1,0);
      else:
          $pdf->Cell(25	,5, 'Ewallet/Gcash', 1,0);
      endif;

      $total = 0;
      include 'db_connect.php';
      $qry = $conn->query("SELECT * FROM order_list o inner join product_list p on o.product_id = p.id  where order_id =".$result['id']);
      while($row=$qry->fetch_assoc()):
          $total += $row['qty'] * $row['price'];
      endwhile;
      $grandTotal += $total;
      
      $pdf->Cell(25	,5, number_format($total,2) , 1, 1, 'R');//end of line

  endforeach;

  $pdf->Cell(25	,5, "", 1,0);
  $pdf->Cell(35	,5, "", 1,0);
  $pdf->Cell(25	,5, "", 1,0);
  $pdf->Cell(40	,5, "", 1,0);
  $pdf->Cell(25	,5, 'Grand Total (PHP)', 1,0);
  $pdf->Cell(25	,5, number_format($grandTotal,2) , 1, 1, 'R');//end of line
  
  $pdf->Output();

}


if($results && $isProduct)
{
  $pdf = new FPDF('P','mm','A4');
  $pdf->AddPage();

  $grandTotal = 0;
  $pdf->SetFont('Arial','B',16);
  $pdf->setTextColor(0,0,0);
  $pdf->Cell(200,10, "MJB Water Refilling System - Sales Report", "0", "1", "C");
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(200,5, $startDate." TILL DATE ".$endDate , "0", "1", "C");
  $pdf->Cell(200,5, "" , "0", "1", "C");

  //invoice contents
  $pdf->SetFont('Arial','B',10);

  $pdf->Cell(90	,5,'Product Name',1,0);
  $pdf->Cell(30	,5,'Unit Price (PHP)',1,0);
  $pdf->Cell(30	,5,'Quantity',1,0);
  $pdf->Cell(30	,5,'Total (PHP)',1,1);

  $pdf->SetFont('Arial','',8);

  foreach($results as $result):
      $pdf->Cell(90	,5, $result['name'], 1,0);
      $pdf->Cell(30	,5, $result['price'], 1,0);
      $pdf->Cell(30	,5, $result['total_quantity'], 1,0);

      $total = $result['total_quantity'] * $result['price'];
      $grandTotal += $total;
      
      $pdf->Cell(30	,5, number_format($total,2) , 1, 1, 'R');//end of line

  endforeach;

  $pdf->Cell(90	,5, "", 1,0);
  $pdf->Cell(30	,5, "", 1,0);
  //$pdf->Cell(25	,5, "", 1,0);
  //$pdf->Cell(40	,5, "", 1,0);
  $pdf->Cell(30	,5, 'Grand Total (PHP)', 1,0);
  $pdf->Cell(30	,5, number_format($grandTotal,2) , 1, 1, 'R');//end of line
  
  $pdf->Output();

}


?>
