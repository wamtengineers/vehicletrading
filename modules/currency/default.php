<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	doquery("update currency set `default`='".slash($_GET["d"])."' where id='".slash($_GET["id"])."'",$dblink);
	header("Location: currency_manage.php");
	die;
}