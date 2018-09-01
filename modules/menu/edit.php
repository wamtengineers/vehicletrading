<?php
if(!defined("APP_START")) die("No Direct Access");
?>
<div class="page-header">
	<h1 class="title">Edit Menu</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Menus</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="menu_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form action="menu_manage.php?tab=edit" method="post" enctype="multipart/form-data" name="frmAdd"  class="form-horizontal form-horizontal-left">
	<input type="hidden" name="id" value="<?php echo $id;?>">
    <?php
      	$i=0;
	?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="admin_type_id">Admin Type <span class="manadatory">*</span> </label>
            </div>
            <div class="col-sm-10">
                <select name="admin_type_ids[]" title="Choose Option" multiple="multiple" class="select_multiple">
                    <option value="0">Select Admin Type</option>
                    <?php
                    $res=doquery("Select * from admin_type order by title",$dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                        ?>
                        <option value="<?php echo $rec["id"]?>"<?php echo in_array($rec["id"], $admin_type_ids)?"selected":"";?>><?php echo unslash($rec["title"]); ?></option>
                     <?php			
                        }			
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
  	<div class="form-group">
    	<div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="title">Title <span class="manadatory">*</span></label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Title" value="<?php echo $title; ?>" name="title" id="title" class="form-control" >
            </div>
        </div>
  	</div>
  	<div class="form-group">
    	<div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="url">Target URL</label>
            </div>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $url; ?>" name="url" id="url" class="form-control" title="Enter URL Page">
            </div>
        </div>
  	</div>
  	<div class="form-group">
    	<div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="parent_id">Parent</label>
            </div>
            <div class="col-sm-10">
                <select name="parent_id" title="ParentID">
                    <option value="0">No Parent</option>
                    <?php
                    $res=doquery("select a.*, b.title as parent from menu a left join menu b on a.parent_id=b.id where 1 $extra order by b.sortorder, a.sortorder, depth ASC",$dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>" <?php echo($parent_id==$rec["id"])?"selected":"";?>><?php echo str_repeat("- ", $rec["depth"]).unslash($rec["title"]);?></option>
                            <?php			
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
  	</div>
  	<div class="form-group">
    	<div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="small_icon">SubMenu Icon <span class="manadatory">*</span></label>
            </div>
            <div class="col-sm-10">
                <select name="small_icon" id="small_icon" style="font-family:FontAwesome, Arial">
                    <?php
                    foreach(get_fontawesome_icons() as $ficon){
                        ?>
                        <option value="<?php echo $ficon[0]?>"<?php if($small_icon==$ficon[0]) echo ' selected="selected"';?>><?php echo "&#x".$ficon[1]." - ".$ficon[0]?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
  	</div>
    <div class="form-group">
    	<div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="icon">Main Menu Icon <span class="manadatory">*</span></label>
            </div>
            <div class="col-sm-10">
                <input type="file" name="icon" id="icon" class="form-control" title="icon for Main Menu">
                <br /><a href="<?php echo $file_upload_root?>menu/<?php echo $icon; ?>" target="_blank"><img src="<?php echo $file_upload_root?>menu/<?php echo $icon; ?>"  alt="icon" title="<?php echo $title;?>" /></a>
            </div>
        </div>
  	</div>
    <div class="form-group">
    	<div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="password">Sort Order</label>
            </div>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $sortorder; ?>" name="sortorder" id="sortorder" class="form-control" title="Enter URL Page">
            </div>
        </div>
  	</div>
  	<div class="form-group">
    	<div class="row">
        	<div class="col-sm-2 control-label">
            	<label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="UPDATE" class="btn btn-default btn-l" name="menu_edit" title="Update Record" />
            </div>
        </div>
  	</div>
</form>