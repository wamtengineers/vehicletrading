<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["make_edit"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="Update make set `title`='".slash($title)."', `sortorder`='".slash($sortorder)."' where id='".$id."'";
		doquery($sql,$dblink);
		unset($_SESSION["make_manage"]["edit"]);
		header('Location: make_manage.php?tab=list&msg='.url_encode("Sucessfully Updated"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["make_manage"]["edit"][$key]=$value;
		header("Location: make_manage.php?tab=edit&err=".url_encode($err)."&id=$id");
		die;
	}
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$rs=doquery("select * from make where id='".slash($_GET["id"])."'",$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
		if(isset($_SESSION["make_manage"]["edit"]))
			extract($_SESSION["make_manage"]["edit"]);
	}
	else{
		header("Location: make_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: make_manage.php?tab=list");
	die;
}