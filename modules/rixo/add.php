<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["rixo_manage"]["add"])){
	extract($_SESSION["rixo_manage"]["add"]);	
}
else{
	$comments=""; 
	$title=""; 	
	$phone=""; 
	$date=date("d/m/Y");
	$price="";
	$sortorder="";
}
?>
<div class="page-header">
	<h1 class="title">Add New Rixo</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Rixo</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="rixo_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form class="form-horizontal form-horizontal-left" role="form" action="rixo_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd">
    <?php
        $i=0;
    ?>
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
            	<label class="form-label" for="phone">Phone </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Phone" value="<?php echo $phone; ?>" name="phone" id="phone" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	 <div class="col-sm-2 control-label">
            	<label class="form-label" for="date">Date </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Date" value="<?php echo $date; ?>" name="date" id="date" class="form-control date-picker" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="price">Price </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Price" value="<?php echo $price; ?>" name="price" id="price" class="form-control" />
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
            	<label class="form-label" for="comments">Comments </label>
            </div>
            <div class="col-sm-10">
                <textarea title="Enter Comments" name="comments" id="comments" class="form-control"><?php echo $comments; ?></textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="SUBMIT" class="btn btn-default btn-l" name="rixo_add" title="Submit Record" />
            </div>
        </div>
  	</div>  
</form>