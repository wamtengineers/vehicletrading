<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["transaction_add"])){
	extract($_POST);
	$err="";
	if($account_id == "")
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO transaction (branch_id, account_id, reference_id, datetime_added, amount, details, currency_id) VALUES ('".$_SESSION["current_branch_id"]."', '".slash($account_id)."','".slash($reference_id)."','".slash(datetime_dbconvert($datetime_added))."','".slash($amount)."','".slash($details)."','".slash($currency_id)."')";
		doquery($sql,$dblink);
		unset($_SESSION["transaction_manage"]["add"]);
		header('Location: transaction_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["transaction_manage"]["add"][$key]=$value;
		header('Location: transaction_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}