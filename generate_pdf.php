<?php 
require 'database.php';
require('pdf/fpdf.php');

$pdf = new FPDF();

$pdf -> AddPage();
$pdf -> SetFont('Arial','B',19);

$query = "SELECT 
YEAR(date_of_payment) AS `Year`,
monthname(date_of_payment) AS `Month`, 
SUM(total_amount) AS `total`
FROM 
payment p, invoice i, booking b
WHERE 
p.invoice_id = i.invoice_id
AND
b.booking_id = i.booking_id
AND
b.booking_status = 3"; 

$query_run = mysqli_query($connection,$query);



if(mysqli_num_rows($query_run) > 0 ){

        while($data = mysqli_fetch_array($query_run)){
               $total = $data['total'];
       
        }
     
    }

$query2 = "SELECT 

p.pickup_area,
COUNT(b.booking_id) as count2
FROM 
pickup_schedule p, booking b
WHERE 
p.schedule_id = b.schedule_id";

$query_run2 = mysqli_query($connection,$query2);

if(mysqli_num_rows($query_run2) > 0 ){

        while($data = mysqli_fetch_array($query_run2)){
               $count2 = $data['count2'];
       
        }
     
    }
$query3 = "

SELECT 
	scrap_name,
    COUNT(*) AS `Total`
FROM 
	scrap_type s, weight_ledger w
WHERE 
	s.scrap_id = w.scrap_id
GROUP BY 
	s.scrap_name
ORDER BY 
	`total` DESC";

 
$pdf -> Cell(100,10,"Description",1, 0);
$pdf -> Cell(50,10,"Amount",1, 0);

$pdf -> Cell(100,10,"",2, 0);
$pdf -> Cell(50,10,"",2, 1);
$pdf -> Cell(100,10,"Total Payment",2, 0);
$pdf -> Cell(50,10,$total,2, 1);
$pdf -> Cell(100,10,"Total Booking",2, 0);
$pdf -> Cell(50,10,$count2,2, 1);
$pdf -> Cell(50,10,"",2, 1); 
$pdf -> Cell(100,10,"Total Scrap Sold",2, 0);
$pdf -> Cell(50,10,"",2, 1);
$pdf -> Cell(100,10,"Description",2, 0);
$pdf -> Cell(50,10,"Quantity",2, 1);

$query_run3 = mysqli_query($connection,$query3);
        if(mysqli_num_rows($query_run3) > 0 ){

                while($data = mysqli_fetch_array($query_run3)){
                        $pdf -> Cell(100,10,$data['scrap_name'],2, 0);
                        $pdf -> Cell(50,10,$data['Total'],2, 1);
               
                }
             
            }

            $pdf -> Cell(50,10,"",2, 1);  
            $pdf -> Cell(100,10,"Total Numbers of Booking per Area",2, 0);
            $pdf -> Cell(50,10,"",2, 1);  

$query4 = "SELECT 
p.pickup_area as area,
COUNT(b.booking_id) as count3
FROM 
pickup_schedule p, booking b
WHERE 
p.schedule_id = b.schedule_id
GROUP BY 
p.pickup_area";

$query_run4 = mysqli_query($connection,$query4);
        if(mysqli_num_rows($query_run4) > 0 ){

                while($data = mysqli_fetch_array($query_run4)){
                        $pdf -> Cell(100,10,$data['area'],2, 0);
                        $pdf -> Cell(50,10,$data['count3'],2, 1);
               
                }
             
            }

            $query5= "SELECT 
            YEAR(date_of_payment) AS `Year`,
            monthname(date_of_payment) AS `Month`, 
            SUM(total_amount) AS `total`
    FROM 
            payment p, invoice i, booking b
    WHERE 
            p.invoice_id = i.invoice_id
    AND
            b.booking_id = i.booking_id
    AND
            b.booking_status = 3 -- check if ang booking is done na. meaning 'paid'
    GROUP BY 
            YEAR(date_of_payment), MONTH(date_of_payment)
    ORDER BY 
            YEAR(date_of_payment), MONTH(date_of_payment);
    ";

$pdf -> Cell(50,10,"",2, 1);  
$pdf -> Cell(100,10,"Breakdown of Payments",2, 0);
$pdf -> Cell(50,10,"",2, 1);  
$query_run5 = mysqli_query($connection,$query5);
if(mysqli_num_rows($query_run5) > 0 ){

        while($data = mysqli_fetch_array($query_run5)){
                $pdf -> Cell(100,10,$data['Month'],2, 0);
                $pdf -> Cell(50,10,$data['total'],2, 1);
       
        }
     
    }
 

$pdf -> Output();

?>