<?php
if(!defined("APP_START")) die("No Direct Access");
$extra='';
$is_search=true;
if(isset($_GET["date"])){
	$date=slash($_GET["date"]);
	$_SESSION["reports"]["daily"]["date"]=$date;
}
if(isset($_SESSION["reports"]["daily"]["date"]))
	$date=$_SESSION["reports"]["daily"]["date"];
else
	$date=date("d/m/Y");

if($date != ""){
	$extra.=" and datetime_added BETWEEN '".date('Y-m-d',strtotime(date_dbconvert($date)))." 00:00:00' AND '".date('Y-m-d',strtotime(date_dbconvert($date)))." 23:59:59'";
}
$order_by = "datetime_added";
$order = "asc";
$orderby = $order_by." ".$order;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sales List</title>
<style>
body{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
.print-list{
}
.print-list h3{
	font-size:20px;
	text-transform:uppercase;
	text-align:center;
	margin: 10px 0 0;
}
.print-list p{
	font-size:16px;
	text-align:center;
	margin: 10px 0 10px;
}
.print-list table{
	width:100%;
	border-collapse: collapse;
	text-align:left;
}
.print-list table th,.print-list table td{
	border:1px solid #000;
	padding: 5px;
	font-size: 14px;
}
</style>
</head>
<body>
<div class="print-list">
	<h3>Daily Report</h3>
    <p>List of Daily Report</p>
	<table class="table table-hover list">
    	<thead>
            <tr>
                <th width="5%" class="text-center">S.no</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th class="text-right">Total Items</th>
                <th class="text-right" >Price</th>
                <th class="text-right" >Discount</th>
                <th class="text-right">Net Price</th>
            </tr>
            <tr class="head">
                <th colspan="3" class="text-right">Total</th>
                <?php
					$sql="select sum(total_items), sum(total_price), sum(discount), sum(net_price) from sales where 1 $extra and status=1 order by $orderby";
					$total=dofetch(doquery($sql, $dblink));
				?>
                <th class="text-right"><?php echo $total[ "sum(total_items)" ]?></th>
                <th class="text-right"> <?php echo curr_format($total[ "sum(total_price)" ])?></th>
                <th class="text-right"> <?php echo curr_format($total[ "sum(discount)" ])?></th>
                <th class="text-right"> <?php echo curr_format($total[ "sum(net_price)" ])?></th>
            </tr>
    	</thead>
    	<tbody>
			<?php 
            $sql="select * from sales where 1 $extra order by $orderby";
            $rs=show_page($rows, $pageNum, $sql);
            if(numrows($rs)>0){
                $sn=1;
                while($r=dofetch($rs)){             
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $sn;?></td>
                        
                        <td><?php echo datetime_convert($r["datetime_added"]); ?></td>
                        <td><?php echo get_field( unslash($r["customer_id"]), "customer", "customer_name" ); ?></td>
                        <td class="text-right"><?php echo unslash($r["total_items"]); ?></td>
                        <td class="text-right">Rs. <?php echo curr_format(unslash($r["total_price"])); ?></td>
                        <td class="text-right">Rs. <?php echo curr_format(unslash($r["discount"])); ?></td>
                        <td class="text-right">Rs. <?php echo curr_format(unslash($r["net_price"])); ?></td>
                    </tr>
                    <?php 
                    $sn++;
                }	
            }
            ?>
    	</tbody>
  	</table>
</div>
</body>
</html>
<?php
die;