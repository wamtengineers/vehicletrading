<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	$id=slash($_GET["id"]);
	$prev_icon=doquery("select icon from menu where id=$id",$dblink);
	if(numrows($prev_icon)>0){
		$p_icon=dofetch($prev_icon);
		deleteFile($file_upload_root."menu/".$p_icon["icon"]);
	}
	doquery("delete from menu where id='".$id."'",$dblink);
	header("Location: menu_manage.php");
	die;
}