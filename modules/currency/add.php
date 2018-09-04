<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["currency_manage"]["add"])){
	extract($_SESSION["currency_manage"]["add"]);	
}
else{
	$title="";
	$symbol="";
	$branch_id="";
}
?>
<div class="page-header">
	<h1 class="title">Add New Currency</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Currency</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="currency_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form class="form-horizontal form-horizontal-left" role="form" action="currency_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd">
    <?php
        $i=0;
    ?>
    <?php
    	$i=0;
  	?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="branch_id">Branch </label>
            </div>
            <div class="col-sm-10">
                <select name="branch_id" title="Choose Option">
                    <option value="0">Select Branch</option>
                    <?php
                    $res=doquery("Select * from branch order by title",$dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                        ?>
                        <option value="<?php echo $rec["id"]?>"<?php echo($branch_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"]); ?></option>
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
            	<label class="form-label" for="symbol">Symbol </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Symbol" value="<?php echo $symbol; ?>" name="symbol" id="symbol" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="SUBMIT" class="btn btn-default btn-l" name="currency_add" title="Submit Record" />
            </div>
        </div>
  	</div>  
</form>