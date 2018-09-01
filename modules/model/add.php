<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["model_manage"]["add"])){
	extract($_SESSION["model_manage"]["add"]);	
}
else{
	$make_id="";
	$title="";
	$sortorder="";
}
?>
<div class="page-header">
	<h1 class="title">Add New Model</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Model</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="model_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form class="form-horizontal form-horizontal-left" role="form" action="model_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd">
    <?php
        $i=0;
    ?>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="make_id">Make </label>
            </div>
            <div class="col-sm-10">
                <select name="make_id" title="Choose Option">
                    <option value="0">Select Make</option>
                    <?php
                    $res=doquery("select * from make where status=1 order by sortorder", $dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                        ?>
                        <option value="<?php echo $rec["id"]?>"<?php echo($make_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"]); ?></option>
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
            	<label class="form-label" for="title">Title </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Title" value="<?php echo $title; ?>" name="title" id="title" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="sortorder">Sortorder </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Sortorder" value="<?php echo $sortorder; ?>" name="sortorder" id="sortorder" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="SUBMIT" class="btn btn-default btn-l" name="model_add" title="Submit Record" />
            </div>
        </div>
  	</div>  
</form>