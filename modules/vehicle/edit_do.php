<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["vehicle_edit"])){
	extract($_POST);
	$err="";
	if(empty($model_id))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="Update vehicle set `title`='".slash($title)."', `make_id`='".slash($make_id)."', `model_id`='".slash($model_id)."', `year`='".slash($year)."', `stock_no`='".slash($stock_no)."', `chassis_no`='".slash($chassis_no)."', `month`='".slash($month)."', `mileage`='".slash($mileage)."', `grade`='".slash($grade)."', `condition_type`='".slash($condition_type)."', `body_type_id`='".slash($body_type_id)."', `fuel_tank`='".slash($fuel_tank)."', `transmission`='".slash($transmission)."', `engine_no`='".slash($engine_no)."', `engine_cc`='".slash($engine_cc)."', `doors`='".slash($doors)."', `seating`='".slash($seating)."', `drive`='".slash($drive)."', `drive_type`='".slash($drive_type)."', `color_interior`='".slash($color_interior)."', `color_exterior`='".slash($color_exterior)."', `options`='".slash($options)."', `fob_price`='".slash($fob_price)."', `discount_price`='".slash($discount_price)."', `cnf_price`='".slash($cnf_price)."', `status`='".slash($status)."' where id='".$id."'";
		doquery($sql,$dblink);
		unset($_SESSION["vehicle_manage"]["edit"]);
		header('Location: vehicle_manage.php?tab=list&msg='.url_encode("Sucessfully Updated"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["vehicle_manage"]["edit"][$key]=$value;
		header("Location: vehicle_manage.php?tab=edit&err=".url_encode($err)."&id=$id");
		die;
	}
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$rs=doquery("select * from vehicle where id='".slash($_GET["id"])."'",$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
		if(isset($_SESSION["vehicle_manage"]["edit"]))
			extract($_SESSION["vehicle_manage"]["edit"]);
	}
	else{
		header("Location: vehicle_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: vehicle_manage.php?tab=list");
	die;
}