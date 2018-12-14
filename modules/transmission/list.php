<?php
if(!defined("APP_START")) die("No Direct Access");
$q="";
$extra='';
$is_search=false;
if(isset($_GET["q"])){
	$q=slash($_GET["q"]);
	$_SESSION["transmission_manage"]["q"]=$q;
}
if(isset($_SESSION["transmission_manage"]["q"]))
	$q=$_SESSION["transmission_manage"]["q"];
else
	$q="";
if(!empty($q)){
	$extra.=" and title like '%".$q."%'";
	$is_search=true;
}
?>
<div class="page-header">
	<h1 class="title">Transmission</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Transmission</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> 
            <a id="topstats" class="btn btn-light" href="#"><i class="fa fa-search"></i></a> 
    	</div> 
    </div> 
</div>
<ul class="topstats clearfix search_filter"<?php if($is_search) echo ' style="display: block"';?>>
    <li class="col-xs-12 col-lg-12 col-sm-12">
    	<div>
        	<form class="form-horizontal" action="" method="get">
                <div class="col-sm-3">
                  <input type="text" title="Enter String" value="<?php echo $q;?>" name="q" id="search" class="form-control" >  
                </div>
                <div class="col-sm-3 text-left">
                    <input type="button" class="btn btn-danger btn-l reset_search" value="Reset" alt="Reset Record" title="Reset Record" />
                    <input type="submit" class="btn btn-default btn-l" value="Search" alt="Search Record" title="Search Record" />
                </div>
            </form>
        </div>
  	</li>
</ul>
<div class="panel-body table-responsive">
	<table class="table table-hover list">
    	<thead>
            <tr>
                <th class="text-center" width="5%">S.No</th>
                <th class="text-center" width="5%"><div class="checkbox checkbox-primary">
                    <input type="checkbox" id="select_all" value="0" title="Select All Records">
                    <label for="select_all"></label></div></th>
                <th width="30%">Title</th>
                <th width="10%" class="text-center">Actions</th>
            </tr>
        </thead>
		<?php 
        $rs=doquery("select * from transmission where 1 $extra order by sortorder", $dblink);
        if(numrows($rs)>0){
            ?>
            <tbody<?php echo !$is_search?' class="manage_sortable"':''?>>
            	<?php
                $sn=1;
                while($r=dofetch($rs)){             
                    ?>
                    <tr data-id="<?php echo $r[ "id" ]?>">
                        <td class="text-center"><?php echo $sn;?></td>
                        <td class="text-center"><div class="checkbox margin-t-0 checkbox-primary">
                            <input type="checkbox" name="id[]" id="<?php echo "rec_".$sn?>"  value="<?php echo $r["id"]?>" title="Select Record" />
                            <label for="<?php echo "rec_".$sn?>"></label></div>
                        </td>
                        <td><input type="text" value="<?php echo unslash($r["title"]); ?>" name="title" class="record_field_sortable"/></td>
                        <td class="text-center">
                            <a href="" class="save_record_sortable"><i class="fa fa-save"></i></a>
                            <a href="transmission_manage.php?id=<?php echo $r['id'];?>&tab=status&s=<?php echo ($r["status"]==0)?1:0;?>" class="change_status_sortable">
                                <?php
                                if($r["status"]==0){
                                    ?>
                                    <img src="images/offstatus.png" alt="Off" title="Set Status On">
                                    <?php
                                }
                                else{
                                    ?>
                                    <img src="images/onstatus.png" alt="On" title="Set Status Off">
                                    <?php
                                }
                                ?>
                            </a>
                            <a onclick="" class="delete_record_sortable" href="transmission_manage.php?id=<?php echo $r['id'];?>&amp;tab=delete"><img title="Delete Record" alt="Delete" src="images/delete.png"></a>
                        </td>
                    </tr>
                    <?php 
                    $sn++;
                }
                ?>
         	</tbody> 
            </tfoot> 
                <tr>
                    <td colspan="4" class="actions">
                        <select name="bulk_action" class="" id="bulk_action" title="Choose Action">
                            <option value="null">Bulk Action</option>
                            <option value="delete">Delete</option>
                            <option value="statuson">Set Status On</option>
                            <option value="statusof">Set Status Off</option>
                        </select>
                        <input type="button" name="apply" value="Apply" id="apply_bulk_action" class="btn btn-light" title="Apply Action"  />
                        <input type="button" value="Add New Record" id="add_new_record_sortable" class="btn btn-dark btn-info" title="Add New Record"  />
                    </td>
                </tr>
           	</tfoot> 
            <?php	
     	}
		else{	
			?>
            <tbody <?php echo !$is_search?' class="manage_sortable"':''?>></tbody>
			<tr>
				<td colspan="2"  class="no-record">No Result Found</td>
                <td colspan="2"><input type="button" value="Add New Record" id="add_new_record_sortable" class="btn btn-dark btn-info" title="Add New Record"  /></td>
			</tr>
			<?php
		}
        ?>
     </table>
</div>