<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["vehicle_manage"]["add"])){
	extract($_SESSION["vehicle_manage"]["add"]);	
}
else{
	$title="";
	$model_id="";
	$make_id="";
	$year="";
	$stock_no="";
	$chassis_no="";
	$month="";
	$mileage="";
	$grade="";
	$condition_type="";
	$body_type_id="";
	$fuel_tank="";
	$transmission="";
	$engine_no="";
	$engine_cc="";
	$doors="";
	$seating="";
	$drive="";
	$drive_type="";
	$color_interior="";
	$color_exterior="";
	$options="";
	$fob_price="";
	$discount_price="";
	$cnf_price="";
	$status="";
}
?>
<div class="page-header">
	<h1 class="title">Add New Vehicle</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Vehicle</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="vehicle_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form class="form-horizontal form-horizontal-left" role="form" action="vehicle_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd">
    <?php
        $i=0;
    ?>
    <div class="col-md-6">
    	<!--<table class="table table-hover list">
        	<tr>
            	<td width="25%">
                	<label class="form-label" for="title">Title </label>
                    <input type="text" title="Enter Title" value="<?php echo $title; ?>" name="title" id="title" class="form-control" />
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>-->
        <div class="form-group vehicle-form">
            <div class="clearfix">
            	<h3>Vehicle Details</h3>
                <div class="col-md-6 filed-col">
                    <div>
                        <label class="form-label" for="title">Title </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Title" value="<?php echo $title; ?>" name="title" id="title" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="stock_no">Stock No. </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Stock No." value="<?php echo $stock_no; ?>" name="stock_no" id="stock_no" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="chassis_no">Chassis No. </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Chassis No" value="<?php echo $chassis_no; ?>" name="chassis_no" id="chassis_no" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="year">Year </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Year" value="<?php echo $year; ?>" name="year" id="year" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="make_id">Make </label>
                    </div>
                    <div>
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
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="model_id">Model </label>
                    </div>
                    <div>
                        <select name="model_id" title="Choose Option">
                            <option value="0">Select Model</option>
                            <?php
                            $res=doquery("select * from model where status=1 order by sortorder", $dblink);
                            if(numrows($res)>0){
                                while($rec=dofetch($res)){
                                ?>
                                <option value="<?php echo $rec["id"]?>"<?php echo($model_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"]); ?></option>
                                <?php			
                                }			
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="color_interior">Color Interior </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Color Interior" value="<?php echo $color_interior; ?>" name="color_interior" id="color_interior" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="color_exterior">Color Exterior </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Color Exterior" value="<?php echo $color_exterior; ?>" name="color_exterior" id="color_exterior" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="clearfix">
            	<div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="fuel_tank">Fuel Tank </label>
                    </div>
                    <div>
                        <select name="fuel_tank" title="Choose Option">
                            <option value="">Select Fuel Tank</option>
                            <?php
                            foreach ($fuel_type as $key=>$value) {
                                ?>
                                <option value="<?php echo $key?>"<?php echo $key==$fuel_tank?' selected="selected"':""?>><?php echo $value ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="transmission">Transmission </label>
                    </div>
                    <div>
                        <select name="transmission" title="Choose Option">
                            <option value="">Select Transmission</option>
                            <?php
                            foreach ($transmission_type as $key=>$value) {
                                ?>
                                <option value="<?php echo $key?>"<?php echo $key==$transmission?' selected="selected"':""?>><?php echo $value ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="body_type_id">Body Type </label>
                    </div>
                    <div>
                        <select name="body_type_id" title="Choose Option">
                            <option value="0">Select Body Type</option>
                            <?php
                            $res=doquery("select * from body_type where status=1 order by sortorder", $dblink);
                            if(numrows($res)>0){
                                while($rec=dofetch($res)){
                                ?>
                                <option value="<?php echo $rec["id"]?>"<?php echo($body_type_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"]); ?></option>
                                <?php			
                                }			
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="engine_cc">Engine CC </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Engine CC" value="<?php echo $engine_cc; ?>" name="engine_cc" id="engine_cc" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="clearfix">
            	<div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="month">Month. </label>
                    </div>
                    <div>
                        <select name="month" title="Choose Option">
                            <option value="">Select Month</option>
                            <?php
                            foreach ($month_array as $key=>$value) {
                                ?>
                                <option value="<?php echo $key?>"<?php echo $key==$month?' selected="selected"':""?>><?php echo $value ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="mileage">Mileage </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Mileage" value="<?php echo $mileage; ?>" name="mileage" id="mileage" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="grade">Grade </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Grade" value="<?php echo $grade; ?>" name="grade" id="grade" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="condition_type">Condition </label>
                    </div>
                    <div>
                        <select name="condition_type" title="Choose Option">
                            <option value="">Select Condition</option>
                            <?php
                            foreach ($condition as $key=>$value) {
                                ?>
                                <option value="<?php echo $key?>"<?php echo $key==$condition_type?' selected="selected"':""?>><?php echo $value ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            	<div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="engine_no">Engine No </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Engine No" value="<?php echo $engine_no; ?>" name="engine_no" id="engine_no" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="doors">Doors </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Doors" value="<?php echo $doors; ?>" name="doors" id="doors" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="seating">Seating </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Seating" value="<?php echo $seating; ?>" name="seating" id="seating" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="drive">Drive </label>
                    </div>
                    <div>
                        <select name="drive" title="Choose Option">
                            <option value="">Select Drive</option>
                            <?php
                            foreach ($drive_hand as $key=>$value) {
                                ?>
                                <option value="<?php echo $key?>"<?php echo $key==$drive?' selected="selected"':""?>><?php echo $value ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            	<div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="drive_type">Drive Type </label>
                    </div>
                    <div>
                        <select name="drive_type" title="Choose Option">
                            <option value="">Select Drive Type</option>
                            <?php
                            foreach ($drive_types as $key=>$value) {
                                ?>
                                <option value="<?php echo $key?>"<?php echo $key==$drive_type?' selected="selected"':""?>><?php echo $value ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="options">Options </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Options" value="<?php echo $options; ?>" name="options" id="options" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="status">Status </label>
                    </div>
                    <div>
                        <select name="status" id="status">
                            <option value="1"<?php echo ($status=="1")? " selected":"";?>>Available</option>
                            <option value="2"<?php echo ($status=="2")? " selected":"";?>>Hold </option>
                            <option value="0"<?php echo ($status=="0")? " selected":"";?>>Sold Out </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="cnf_price">Equipments </label>
                    </div>
                    <div>
                        <select name="body_type_id" title="Choose Option" class="multiple_select">
                            <option value="0">Select Equipments</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            	<div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="fob_price">Fob Price </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Fob Price" value="<?php echo $fob_price; ?>" name="fob_price" id="fob_price" class="form-control" />
                    </div>
                </div>
            	<div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="discount_price">Discount Price </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Discount Price" value="<?php echo $discount_price; ?>" name="discount_price" id="discount_price" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="cnf_price">CNF Price </label>
                    </div>
                    <div>
                        <input type="text" title="Enter CNF Price" value="<?php echo $cnf_price; ?>" name="cnf_price" id="cnf_price" class="form-control" />
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-md-6">
    	<div class="form-group vehicle-form">
        	<div class="clearfix">
            	<h3>Auction Details</h3>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="">Lot Number </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="">Auction Name </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="">Auction Date </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="">Buy By </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="">Buying Price </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="">Recycle Fees </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 filed-col">
                    <div>
                        <label class="form-label" for="">Auction Fees </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="">Other Fees </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="">Total Auction </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 filed-col">
                    <div>
                        <label class="form-label" for="">Without % - R </label>
                    </div>
                    <div>
                        <input type="text" title="Enter Lot Number" value="" name="" id="" class="form-control" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    	<div class="form-group vehicle-form">
        	<div class="clearfix">
            	<h3>Expense</h3>
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-10">
                <input type="submit" value="SUBMIT" class="btn btn-default btn-l" name="vehicle_add" title="Submit Record" />
            </div>
        </div>
  	</div>
    
</form>