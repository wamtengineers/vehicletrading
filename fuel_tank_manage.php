<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'fuel_tank_manage.php';
include("include/admin_type_access.php");
$tab_array=array("list", "add", "edit", "status", "delete", "bulk_action");
if(isset($_REQUEST["tab"]) && in_array($_REQUEST["tab"], $tab_array)){
	$tab=$_REQUEST["tab"];
}
else{
	$tab="list";
}

switch($tab){
	case 'add':
		$sortorder=dofetch(doquery("select count(id) from fuel_tank",$dblink));
		$sortorder=$sortorder[0]+1;
		doquery( "insert into fuel_tank(title, sortorder) values('', '".$sortorder."')", $dblink );
		$id = inserted_id();
			?>
			<tr data-id="<?php echo $id?>">
                <td class="text-center"><?php echo $sortorder;?></td>
                <td class="text-center"><div class="checkbox margin-t-0 checkbox-primary">
                    <input type="checkbox" name="id[]" id="<?php echo "rec_".$sortorder?>"  value="<?php echo $id?>" title="Select Record" />
                    <label for="<?php echo "rec_".$sortorder?>"></label></div>
                </td>
                <td><input type="text" value="" name="title" class="record_field_sortable"/></td>
                <td class="text-center">
                    <a href="" class="save_record_sortable"><i class="fa fa-save"></i></a>
                    <a href="fuel_tank_manage.php?id=<?php echo $id;?>&tab=status&s=0" class="change_status_sortable">
                        <img src="images/offstatus.png" alt="Off" title="Set Status On">
                    </a>
                    <a onclick="" class="delete_record_sortable" href="fuel_tank_manage.php?id=<?php echo $id;?>&amp;tab=delete"><img title="Delete Record" alt="Delete" src="images/delete.png"></a>
                </td>
            </tr>
		<?php
		die;
	break;
	case 'edit':
		extract( $_POST );
		doquery( "update fuel_tank set title = '".$title."' where id = '".$id."' ", $dblink );
		die;
	break;
	case 'delete':
		if(isset($_GET["id"]) && !empty($_GET["id"])){
			doquery("delete from fuel_tank where id='".slash($_GET["id"])."'",$dblink);
			die;
		}
		die;
	break;
	case 'status':
		if(isset($_GET["id"]) && !empty($_GET["id"])){
			doquery("update fuel_tank set status='".slash($_GET["s"])."' where id='".slash($_GET["id"])."'",$dblink);
			echo 'fuel_tank_manage.php?id='.slash($_GET["id"]).'&tab=status&s=';
			if( $_GET[ "s" ] == 0 ) {
				echo '1##<img src="images/offstatus.png" alt="Off" title="Set Status On">';
			}
			else{
				echo '0##<img src="images/onstatus.png" alt="On" title="Set Status Off">';
			}
			die;
		}
	break;
	case 'bulk_action':
		include("modules/fuel_tank/bulkactions.php");
	break;
}
?>
<?php include("include/header.php");?>
	<div class="container-widget row">
    	<div class="col-md-12">
		  <?php
            switch($tab){
                case 'list':
                    include("modules/fuel_tank/list.php");
                break;
            }
          ?>
    	</div>
  	</div>
</div>
<?php include("include/footer.php");?>