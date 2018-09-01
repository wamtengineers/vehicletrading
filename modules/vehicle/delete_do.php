<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	doquery("delete from vehicle where id='".slash($_GET["id"])."'",$dblink);
	header("Location: vehicle_manage.php");
	die;
}