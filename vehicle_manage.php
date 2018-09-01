<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'vehicle_manage.php';
include("include/admin_type_access.php");
$tab_array=array("list", "status", "delete", "bulk_action", "addedit");
if(isset($_REQUEST["tab"]) && in_array($_REQUEST["tab"], $tab_array)){
	$tab=$_REQUEST["tab"];
}
else{
	$tab="list";
}

switch($tab){
	case 'addedit':
		include("modules/vehicle/addedit_do.php");
	break;
	case 'delete':
		include("modules/vehicle/delete_do.php");
	break;
	case 'status':
		include("modules/vehicle/status_do.php");
	break;
	case 'bulk_action':
		include("modules/vehicle/bulkactions.php");
	break;
}
?>
<?php include("include/header.php");?>
	<div class="container-widget row">
    	<div class="col-md-12">
		  <?php
            switch($tab){
				case 'addedit':
					include("modules/vehicle/addedit.php");
				break;
                case 'list':
                    include("modules/vehicle/list.php");
                break;
            }
          ?>
    	</div>
  	</div>
</div>
<?php include("include/footer.php");?>