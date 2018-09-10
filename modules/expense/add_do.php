<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["expense_add"])){
	extract($_POST);
	$err="";
	if(empty($datetime_added) || empty($amount))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO expense (branch_id, datetime_added, expense_category_id, account_id, details, amount, currency_id, added_by) VALUES ('".$_SESSION["current_branch_id"]."', '".slash(datetime_dbconvert($datetime_added))."', '".slash($expense_category_id)."', '".slash($account_id)."', '".slash($details)."', '".slash($amount)."', '".slash($currency_id)."', '".$_SESSION["logged_in_admin"]["id"]."')";
		doquery($sql,$dblink);
		unset($_SESSION["expense_manage"]["add"]);
		header('Location: expense_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["expense_manage"]["add"][$key]=$value;
		header('Location: expense_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}