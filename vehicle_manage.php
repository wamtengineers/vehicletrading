<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'vehicle_manage.php';
include("include/admin_type_access.php");
$tab_array=array("list", "status", "delete", "bulk_action", "addedit", "main_image_upload");
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
	case "main_image_upload":
		if( isset( $_POST[ "id" ] ) ) {
			$id = slash( $_POST[ "id" ] );
			if( !empty( $_POST[ "img" ] ) ) {
				list( $img_type, $code) = explode(';', $_POST[ "img" ] );
				$ext = "jpg";
				switch( $img_type ) {
					case "data:image/jpeg":
					case "data:image/jpg": $ext = "jpg"; break;
					case "data:image/png": $ext = "png"; break;
				}
				list(, $code) = explode(',', $code);
				$main_image = $id.'.'.$ext;
				$path = $file_upload_root."main_image/".$main_image;
				$code = base64_decode($code);			
				file_put_contents( $path, $code);
				$prev_icon=doquery("select main_image from vehicle where id='".$id."'",$dblink);
				if(numrows($prev_icon)>0){
					$sql="Update vehicle set main_image='".$main_image."' where id='".$id."'";
					doquery($sql,$dblink);
				}
				else{
					$sql="INSERT INTO vehicle set main_image='".$main_image."'";
					doquery($sql,$dblink);
				}
				die;
			}
		}
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