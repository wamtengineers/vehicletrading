<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	doquery("delete from rixo where id='".slash($_GET["id"])."'",$dblink);
	header("Location: rixo_manage.php");
	die;
}