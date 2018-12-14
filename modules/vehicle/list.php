<?php
if(!defined("APP_START")) die("No Direct Access");
$q="";
$extra='';
$is_search=false;
if( $_SESSION[ "current_branch_id" ] != 0 ) {
	$extra=" and a.id = b.vehicle_id and branch_id='".$_SESSION[ "current_branch_id" ]."'";
}
if(isset($_GET["q"])){
	$q=slash($_GET["q"]);
	$_SESSION["vehicle_manage"]["q"]=$q;
}
if(isset($_SESSION["vehicle_manage"]["q"]))
	$q=$_SESSION["vehicle_manage"]["q"];
else
	$q="";
if(!empty($q)){
	$extra.=" and title like '%".$q."%'";
	$is_search=true;
}
if(isset($_GET["make_id"])){
	$make_id=slash($_GET["make_id"]);
	$_SESSION["vehicle_manage"]["make_id"]=$make_id;
}
if(isset($_SESSION["vehicle_manage"]["make_id"]))
	$make_id=$_SESSION["vehicle_manage"]["make_id"];
else
	$make_id="";
if($make_id!=""){
	$extra.=" and make_id='".$make_id."'";
	$is_search=true;
}
if(isset($_GET["model_id"])){
	$model_id=slash($_GET["model_id"]);
	$_SESSION["vehicle_manage"]["model_id"]=$model_id;
}
if(isset($_SESSION["vehicle_manage"]["model_id"]))
	$model_id=$_SESSION["vehicle_manage"]["model_id"];
else
	$model_id="";
if($model_id!=""){
	$extra.=" and model_id='".$model_id."'";
	$is_search=true;
}
?>
<div class="page-header">
	<h1 class="title">Vehicle</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Vehicle</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> 
        	<a href="vehicle_manage.php?tab=addedit" class="btn btn-light editproject">Add New Vehicle</a> 
            <a id="topstats" class="btn btn-light" href="#"><i class="fa fa-search"></i></a> 
    	</div> 
    </div> 
</div>
<ul class="topstats clearfix search_filter"<?php if($is_search) echo ' style="display: block"';?>>
    <li class="col-xs-12 col-lg-12 col-sm-12">
    	<div>
        	<form class="form-horizontal" action="" method="get">
            	<div class="col-sm-3">
                  <select name="make_id" id="make_id" class="custom_select">
                        <option value=""<?php echo ($make_id=="")? " selected":"";?>>Select Make</option>
                        <?php
                            $res=doquery("select * from make order by sortorder",$dblink);
                            if(numrows($res)>=0){
                                while($rec=dofetch($res)){
                                ?>
                                <option value="<?php echo $rec["id"]?>" <?php echo($make_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"])?></option>
                            	<?php
                                }
                            }	
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                  <select name="model_id" id="model_id" class="custom_select">
                        <option value=""<?php echo ($model_id=="")? " selected":"";?>>Select Model</option>
                        <?php
                            $res=doquery("select * from model order by sortorder",$dblink);
                            if(numrows($res)>=0){
                                while($rec=dofetch($res)){
                                ?>
                                <option value="<?php echo $rec["id"]?>" <?php echo($model_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"])?></option>
                            	<?php
                                }
                            }	
                        ?>
                    </select>
                </div>
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
                <th width="15%">Title</th>
                <th width="10%">Make</th>
                <th width="10%">Model</th>
                <th width="10%">Stock No</th>
                <th width="10%">Chassis No</th>
                <th width="10%">FOB Price</th>
                <th width="5%" class="text-center">Status</th>
                <th width="5%" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql="select a.* from vehicle a inner join vehicle_2_branch b on a.id = b.vehicle_id where 1 $extra order by id";
            $rs=show_page($rows, $pageNum, $sql);
            if(numrows($rs)>0){
                $sn=1;
                while($r=dofetch($rs)){             
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $sn;?></td>
                        <td class="text-center"><div class="checkbox margin-t-0 checkbox-primary">
                            <input type="checkbox" name="id[]" id="<?php echo "rec_".$sn?>"  value="<?php echo $r["id"]?>" title="Select Record" />
                            <label for="<?php echo "rec_".$sn?>"></label></div>
                        </td>
                        <td><?php echo unslash($r["title"]); ?></td>
                        <td><?php echo get_field( unslash($r["make_id"]), "make", "title" ); ?></td>
                        <td><?php echo get_field( unslash($r["model_id"]), "model", "title" ); ?></td>
                        <td><?php echo unslash($r["stock_no"]); ?></td>
                        <td><?php echo unslash($r["chassis_no"]); ?></td>
                        <td><?php echo curr_format($r["fob_price"]); ?></td>
                        <td class="text-center">
                            <a href="vehicle_manage.php?id=<?php echo $r['id'];?>&tab=status&s=<?php echo ($r["status"]==0)?1:0;?>">
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
                        </td>
                        <td class="text-center">
                            	<a href="vehicle_manage.php?tab=addedit&id=<?php echo $r['id'];?>"><img title="Edit Record" alt="Edit" src="images/edit.png"></a>&nbsp;&nbsp;
                            	<a onclick="return confirm('Are you sure you want to delete')" href="vehicle_manage.php?id=<?php echo $r['id'];?>&amp;tab=delete"><img title="Delete Record" alt="Delete" src="images/delete.png"></a>
                        </td>
                    </tr>  
                    <?php 
                    $sn++;
                }
                ?>
                <tr>
                    <td colspan="6" class="actions">
                        <select name="bulk_action" class="" id="bulk_action" title="Choose Action">
                            <option value="null">Bulk Action</option>
                            <option value="delete">Delete</option>
                            <option value="statuson">Set Status On</option>
                            <option value="statusof">Set Status Off</option>
                        </select>
                        <input type="button" name="apply" value="Apply" id="apply_bulk_action" class="btn btn-light" title="Apply Action"  />
                    </td>
                    <td colspan="4" class="paging" title="Paging" align="right"><?php echo pages_list($rows, "vehicle", $sql, $pageNum)?></td>
                </tr>
                <?php	
            }
            else{	
                ?>
                <tr>
                    <td colspan="10"  class="no-record">No Result Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
     </table>
</div>