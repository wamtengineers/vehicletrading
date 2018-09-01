<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'report_manage.php';
include("include/admin_type_access.php");
$tab_array=array("daily", "report", "general_journal", "balance_sheet", "general_journal_print");
if(isset($_REQUEST["tab"]) && in_array($_REQUEST["tab"], $tab_array)){
	$tab=$_REQUEST["tab"];
}
else{
	$tab="daily";
}

switch($tab){
	case 'report':
		include("modules/reports/report.php");
		die;
	break;
	case 'general_journal':
		include("modules/reports/general_journal_do.php");
	break;
	case 'general_journal_print':
		include("modules/reports/general_journal_print.php");
	break;
}
?>
<?php include("include/header.php");?>
  <div class="container-widget row">
    <div class="col-md-12">
      <?php
		switch($tab){
			case 'daily':
				include("modules/reports/daily.php");
			break;
			case 'general_journal':
				include("modules/reports/general_journal.php");
			break;
			case 'balance_sheet': 
				include("modules/reports/balance_sheet.php");
			break;
		}
      ?>
    </div>
  </div>
</div>
<?php include("include/footer.php");?>