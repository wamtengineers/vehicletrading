<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["rixo_edit"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="Update rixo set `title`='".slash($title)."', `phone`='".slash($phone)."', `date`='".slash(date_dbconvert($date))."', `price`='".slash($price)."', `sortorder`='".slash($sortorder)."', `comments`='".slash($comments)."' where id='".$id."'";
		doquery($sql,$dblink);
		unset($_SESSION["rixo_manage"]["edit"]);
		header('Location: rixo_manage.php?tab=list&msg='.url_encode("Sucessfully Updated"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["rixo_manage"]["edit"][$key]=$value;
		header("Location: rixo_manage.php?tab=edit&err=".url_encode($err)."&id=$id");
		die;
	}
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$rs=doquery("select * from rixo where id='".slash($_GET["id"])."'",$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
			$date=date_convert($date);
		if(isset($_SESSION["rixo_manage"]["edit"]))
			extract($_SESSION["rixo_manage"]["edit"]);
	}
	else{
		header("Location: rixo_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: rixo_manage.php?tab=list");
	die;
}