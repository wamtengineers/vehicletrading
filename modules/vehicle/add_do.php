<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["vehicle_add"])){
	extract($_POST);
	$err="";
	if(empty($model_id))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO vehicle (title, make_id, model_id, year, stock_no, chassis_no, month, mileage, grade, condition_type, body_type_id, fuel_tank, transmission, engine_no, engine_cc, doors, seating, drive, drive_type, color_interior, color_exterior, options, fob_price, discount_price, cnf_price, status) VALUES ('".slash($title)."', '".slash($make_id)."', '".slash($model_id)."', '".slash($year)."', '".slash($stock_no)."', '".slash($chassis_no)."', '".slash($month)."', '".slash($mileage)."', '".slash($grade)."', '".slash($condition_type)."', '".slash($body_type_id)."', '".slash($fuel_tank)."', '".slash($transmission)."', '".slash($engine_no)."', '".slash($engine_cc)."', '".slash($doors)."', '".slash($seating)."', '".slash($drive)."', '".slash($drive_type)."', '".slash($color_interior)."', '".slash($color_exterior)."', '".slash($options)."', '".slash($fob_price)."', '".slash($discount_price)."', '".slash($cnf_price)."', '".slash($status)."')";
		doquery($sql,$dblink);
		unset($_SESSION["vehicle_manage"]["add"]);
		header('Location: vehicle_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["vehicle_manage"]["add"][$key]=$value;
		header('Location: vehicle_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}