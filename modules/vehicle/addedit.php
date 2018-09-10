<?php
if(!defined("APP_START")) die("No Direct Access");
if( isset( $_GET[ "id" ] ) ) {
	$id = slash( $_GET[ "id" ] );
}
else {
	$id = 0;
}
?>
<style>
.popup-content .page-header{
	display:none !important;
}
.popup-content .form-group .col-sm-2{
	display: block;
	float: none;
	text-align: left;
	width: 100%;
}
.popup-content .form-group .col-sm-10{
	width: 100%;
	float: none;
}
.popup-content .content{
	padding-left: 15px;
	padding-right: 15px;
}
.popup-content .col-sm-offset-2{
	margin-left:0;
}
</style>
<div ng-app="vehicle" ng-controller="vehicleController" id="vehicleController">
    <div style="display:none">{{vehicle_id=<?php echo $id?>}}</div>
    <div class="page-header">
        <h1 class="title">{{get_action()}} Vehicle</h1>
        <ol class="breadcrumb">
            <li class="active">Manage Vehicle</li>
        </ol>
        <div class="right">
            <div class="btn-group" role="group" aria-label="..."> <a href="vehicle_manage.php" class="btn btn-light editproject">Back to List</a> </div>
        </div>
    </div>
	<?php
        $i=0;
    ?>
    <div class="">
    	<div class="col-md-6">    	
            <div class="form-group vehicle-form">
                <div class="panel-body table-responsive">
                    <table class="table table-hover list">
                        <tr class="bg-info">
                            <th colspan="4">Vehicle Details</th>
                        </tr>
                        <tr>
                            <td width="25%">
                                <label class="form-label" for="title">Title </label>
                                <input type="text" title="Enter Title" ng-model="vehicle.title" class="form-control" />
                            </td>
                            <td width="25%">
                                <label class="form-label" for="stock_no">Stock No. </label>
                                <input type="text" title="Enter Stock No." ng-model="vehicle.stock_no" class="form-control" />
                            </td>
                            <td width="25%">
                                <label class="form-label" for="chassis_no">Chassis No. </label>
                                <input type="text" title="Enter Chassis No" ng-model="vehicle.chassis_no" class="form-control" />
                            </td>
                            <td width="25%">
                                <label class="form-label" for="year">Year </label>
                                <input type="text" title="Enter Year" ng-model="vehicle.year" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-label" for="make_id">Make </label>
                                <select title="Choose Option" ng-model="vehicle.make_id">
                                    <option value="">Select Make</option>
                                    <option ng-repeat="make in makes" value="{{ make.id }}">{{ make.title }}</option>
                                </select>
                            </td>
                            <td>
                                <label class="form-label" for="model_id">Model </label>
                                <select name="model_id" title="Choose Option" ng-model="vehicle.model_id">
                                    <option value="">Select Model</option>
                                    <option ng-repeat="model in models" value="{{ model.id }}">{{ model.title }}</option>
                                </select>
                            </td>
                            <td>
                                <label class="form-label" for="color_interior">Color Interior </label>
                                <input type="text" title="Enter Color Interior" ng-model="vehicle.color_interior" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="color_exterior">Color Exterior </label>
                                <input type="text" title="Enter Color Exterior" ng-model="vehicle.color_exterior" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-label" for="fuel_tank">Fuel Tank </label>
                                <select name="fuel_tank" title="Choose Option" ng-model="vehicle.fuel_tank">
                                    <option value="0">Select Fuel Tank</option>
                                    <option value="1">CNG</option>
                                    <option value="2">Diesel</option>
                                    <option value="3">Gasoline/Petrol</option>
                                    <option value="4">LP Gas</option>
                                    <option value="5">Hybrid</option>
                                </select>
                            </td>
                            <td>
                                <label class="form-label" for="transmission">Transmission </label>
                                <select name="transmission" title="Choose Option" ng-model="vehicle.transmission">
                                    <option value="0">Select Transmission</option>
                                    <option value="1">Automatic</option>
                                    <option value="2">Manual</option>
                                </select>
                            </td>
                            <td>
                                <label class="form-label" for="body_type_id">Body Type </label>
                                <select title="Choose Option" ng-model="vehicle.body_type_id">
                                    <option value="">Select Body Type</option>
                                    <option ng-repeat="body_type in body_types" value="{{ body_type.id }}">{{ body_type.title }}</option>
                                </select>
                            </td>
                            <td>
                                <label class="form-label" for="engine_cc">Engine CC </label>
                                <input type="text" title="Enter Engine CC" ng-model="vehicle.engine_cc" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-label" for="month">Month </label>
                                <select name="month" title="Choose Option" ng-model="vehicle.month">
                                    <option value="">Select Month</option>
                                    <option value="0">January</option>
                                    <option value="1">February</option>
                                    <option value="2">March</option>
                                    <option value="3">April</option>
                                    <option value="4">May</option>
                                    <option value="5">June</option>
                                    <option value="6">July</option>
                                    <option value="7">August</option>
                                    <option value="8">September</option>
                                    <option value="9">October</option>
                                    <option value="10">November</option>
                                    <option value="11">December</option>
                                </select>
                            </td>
                            <td>
                                <label class="form-label" for="mileage">Mileage </label>
                                <input type="text" title="Enter Mileage" ng-model="vehicle.mileage" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="grade">Grade </label>
                                <input type="text" title="Enter Grade" ng-model="vehicle.grade" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="condition_type">Condition </label>
                                <select name="condition_type" title="Choose Option" ng-model="vehicle.condition_type">
                                    <option value="">Select Condition</option>
                                    <option value="0">Good</option>
                                    <option value="1">Very Good</option>
                                    <option value="2">Excellent</option>
                                    <option value="3">Running Condition</option>
                                    <option value="4">Not Moveable</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-label" for="engine_no">Engine No </label>
                                <input type="text" title="Enter Engine No" ng-model="vehicle.engine_no" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="doors">Doors </label>
                                <input type="text" title="Enter Doors" ng-model="vehicle.doors" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="seating">Seating </label>
                                <input type="text" title="Enter Seating" ng-model="vehicle.seating" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="drive">Drive </label>
                                <select name="drive" title="Choose Option" ng-model="vehicle.drive">
                                    <option value="">Select Drive</option>
                                    <option value="0">Left Hande</option>
                                    <option value="1">Right Hand</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-label" for="drive_type">Drive Type </label>
                                <select name="drive_type" title="Choose Option" ng-model="vehicle.drive_type">
                                    <option value="">Select Drive Type</option>
                                    <option value="0">2WD</option>
                                    <option value="1">4WD</option>
                                </select>
                            </td>
                            <td>
                                <label class="form-label" for="options">Options </label>
                                <input type="text" title="Enter Options" ng-model="vehicle.options" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="status">Status </label>
                                <select ng-model="vehicle.status">
                                    <option value="1">Available</option>
                                    <option value="2">Hold </option>
                                    <option value="0">Sold Out </option>
                                </select>
                            </td>
                            <td>
                            	<label class="form-label" for="fob_price">Main Image </label>
                                <input type="file" name="" />
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<label class="form-label" for="fob_price">Auction Image </label>
                                <input type="file" name="" />
                            </td>
                        	<td>
                                <label class="form-label" for="fob_price">Fob Price </label>
                                <input type="text" title="Enter Fob Price" ng-model="vehicle.fob_price" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="discount_price">Discount Price </label>
                                <input type="text" title="Enter Discount Price" ng-model="vehicle.discount_price" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="cnf_price">CNF Price </label>
                                <input type="text" title="Enter CNF Price" ng-model="vehicle.cnf_price"  class="form-control" />
                            </td>
                        </tr>
                        <tr class="bg-info">
                        	<td colspan="4">
                            	<h4 class="form-label">Equipments </h4>
                                <div class="clearfix">
                                    <div class="col-md-3" ng-repeat="equipment in equipments">
                                        <div class="checkbox checkbox-primary">
                                            <input type="checkbox" name="vehicle.equipments.equipment_id[]" id="{{equipment.title}}" value="" ng-model="vehicle.equipments.equipment_id">
                                            <label for="{{equipment.title}}">{{ equipment.title }}</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<label class="form-label" for="">S-Charge </label>
                                <input type="text" title="Enter" ng-model="vehicle.s_charge" class="form-control" />
                            </td>
                        	<td>
                                <label class="form-label" for="">Gov Tax </label>
                                <input type="text" title="Enter" ng-model="vehicle.gov_tax" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="">Expanses </label>
                                <input type="text" title="Enter" ng-model="vehicle.expanses" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="">Freight </label>
                                <input type="text" title="Enter" ng-model="vehicle.freight"  class="form-control" />
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<label class="form-label" for="">Yard Charges </label>
                                <input type="text" title="Enter" ng-model="vehicle.yard_charge" class="form-control" />
                            </td>
                        	<td>
                                <label class="form-label" for="">Insha Charge </label>
                                <input type="text" title="Enter" ng-model="vehicle.insha_charge" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="">Total Price </label>
                                <input type="text" title="Enter" ng-model="vehicle.total_price" class="form-control" />
                            </td>
                            <td>
                                <label class="form-label" for="">Total Without %R </label>
                                <input type="text" title="Enter" ng-model="vehicle.total_price_np"  class="form-control" />
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="4">
                        		<button type="submit" ng-disabled="processing" class="btn btn-default btn-l" ng-click="save_vehicle()" title="Submit Record"><i class="fa fa-spin fa-gear" ng-show="processing"></i> SUBMIT</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
    	</div>
        <div class="col-md-6">
            <div class="form-group vehicle-form">
                <div class="panel-body table-responsive">
                	<table class="table table-hover list">
                    	<tr class="bg-info">
                        	<th colspan="3">Auction Details</th>
                            <th colspan="2">
                            	<select ng-model="vehicle.auction_id">
                                    <option value="">Select Auction</option>
                                    <option ng-repeat="auction in auction" value="{{ auction.id }}">{{ auction.title }}</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                        	<td width="20%">
                            	<label class="form-label" for="">Lot Number </label>
                                <input type="text" title="Enter Lot Number" class="form-control" />
                            </td>
                            <td width="20%">
                            	<label class="form-label" for="">Auction Name </label>
                                <input type="text" title="Enter Lot Number" value="" class="form-control" />
                            </td>
                            <td width="20%">
                            	<label class="form-label" for="">Auction Date </label>
                                <input type="text" title="Enter Lot Number" value="" class="form-control" />
                            </td>
                            <td width="20%">
                            	<label class="form-label" for="">Buy By </label>
                                <input type="text" title="Enter Lot Number" value="" class="form-control" />
                            </td>
                            <td width="20%">
                            	<label class="form-label" for="">Buying Price </label>
                                <input type="text" title="Enter Lot Number" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                            	<label class="form-label" for="">Recycle Fees </label>
                                <input type="text" title="Enter Lot Number" class="form-control" />
                            </td>
                            <td width="20%">
                            	<label class="form-label" for="">Auction Fees </label>
                                <input type="text" title="Enter Lot Number" class="form-control" />
                            </td>
                            <td width="20%">
                            	<label class="form-label" for="">Other Fees </label>
                                <input type="text" title="Enter Lot Number" class="form-control" />
                            </td>
                            <td width="20%">
                            	<label class="form-label" for="">Total Auction </label>
                                <input type="text" title="Enter Lot Number" class="form-control" />
                            </td>
                            <td width="20%">
                            	<label class="form-label" for="">Without % - R </label>
                                <input type="text" title="Enter Lot Number" class="form-control" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group vehicle-form">
           		<div class="panel-body table-responsive">
                    <table class="table table-hover list">
                        <tr class="bg-info">
                            <th colspan="6">Rixo Details</th>
                        </tr>
                         <tr>
                            <th width="20%">Rixo Name</th>
                            <th width="15%">Date</th>
                            <th width="15%" class="text-right">Rixo Price</th>
                            <th width="15%" class="text-right">Phone</th>
                            <th width="20%">Comments</th>
                            <th class="text-center" width="5%">Actions</th>
                        </tr>
                        <tr ng-repeat="rixo in vehicle_rixo">
                            <td>{{ rixo.title }}</td>
                            <td>{{ rixo.rixo_date }}</td>
                            <td class="text-right">{{ rixo.price }}</td>
                            <td class="text-right">{{ rixo.phone }}</td>
                            <td>{{ rixo.comments }}</td>
                            <td class="text-center"><a ng-click="edit_vehicle_rixo( $index )" class="icons edit"><i class="fa fa-pencil"></i></a> <a ng-click="delete_vehicle_rixo( $index )" class="icons delete"><i class="fa fa-close"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" title="Enter Rixo Name" placeholder="Rixo Name" ng-model="new_vehicle_rixo.title" class="form-control" />
                            </td>
                            <td>
                                <input type="text" placeholder="Date" ng-model="new_vehicle_rixo.rixo_date" data-controllerid="vehicleController" class="form-control date-picker2 angular-datetimepicker" />
                            </td>
                            <td>
                                <input type="text" title="Enter Rixo Price" ng-model="new_vehicle_rixo.price" placeholder="Rixo Price" class="form-control" />
                            </td>
                            <td>
                                <input type="text" title="Enter Phone" placeholder="Phone" ng-model="new_vehicle_rixo.phone" class="form-control" />
                            </td>
                            <td>
                                <textarea title="Enter Comments" placeholder="Comments" ng-model="new_vehicle_rixo.comments" class="form-control"></textarea>
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label class="form-label" for="">Payment Account </label>
                                <select name="category" title="Choose Option">
                                    <option value="">Select Paper</option>
                                </select>
                            </td>
                            <td colspan="2">
                                <label class="form-label" for="">Payment Amount </label>
                                <input type="text" title="Enter Lot Number" value="" class="form-control" />
                            </td>
                            <td>
                                <button type="submit" class="btn btn-default btn-l" ng-click="add_vehicle_rixo()" title="Submit Record"> SAVE</button>
                            </td>
                        </tr>
                     </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group vehicle-form clearfix">
            	<div class="panel-body table-responsive">
                	<table class="table table-hover list">
                    	<tr class="bg-info">
                        	<th colspan="6">Export Details</th>
                        </tr>
                        <tr>
                        	<td width="16.6%">
                            	<label class="form-label" for="" ng-model="vehicle.doc_paper">Paper </label>
                                <select title="Choose Option">
                                    <option value="">Select Paper</option>
                                    <option value="0">Received</option>
                                    <option value="1">Wait</option>
                                </select>
                            </td>
                            <td width="16.6%">
                            	<label class="form-label" for="">Container No </label>
                                <input type="text" title="Enter Container No" ng-model="vehicle.container_no" class="form-control" />
                            </td>
                            <td width="15.4%">
                            	<label class="form-label" for="">B/L No: </label>
                                <input type="text" title="Enter B/L No" ng-model="vehicle.bl_no" class="form-control" />
                            </td>
                            <td width="16.6%">
                            	<label class="form-label" for="">B/L Date </label>
                                <input type="text" ng-model="vehicle.bl_date" data-controllerid="vehicleController" class="form-control date-picker2 angular-datetimepicker" />
                            </td>
                            <td width="16.6%">
                            	<label class="form-label" for="">Export </label>
                                <input type="text" title="Enter Export" ng-model="vehicle.export" class="form-control" />
                            </td>
                            <td width="17%">
                            	<label class="form-label" for="">Consignee Name </label>
                                <input type="text" title="Enter Consignee Name" ng-model="vehicle.consignee_name" class="form-control" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group vehicle-form">
            	<div class="panel-body table-responsive">
                	<table class="table table-hover list">
                    	<tr class="bg-info">
                        	<th colspan="6">Expense</th>
                        </tr>
                        <tr>
                            <th width="13%">Time</th>
                            <th width="22%">Expense Category</th>
                            <th width="25%">Details</th>
                            <th width="15%" class="text-right">Amount</th>
                            <th width="20%">Paid By</th>
                            <th class="text-center" width="5%">Actions</th>
                        </tr>
                        <tr ng-repeat="expense in expenses">
                            <td>{{ expense.datetime_added }}</td>
                            <td>{{ get_expense_category( expense.expense_category_id ) }}</td>
                            <td>{{ expense.details }}</td>
                            <td class="text-right">{{ expense.amount|currency:'Rs. ':0 }}</td>
                            <td>{{ get_account( expense.account_id ) }}</td>
                            <td class="text-center"><a ng-click="edit_expense( $index )" class="icons edit"><i class="fa fa-pencil"></i></a> <a ng-click="delete_expense( $index )" class="icons delete"><i class="fa fa-close"></i></a></td>
                        </tr>
                        <tr>
                        	<td colspan="2">
                                <select title="Choose Option" ng-model="new_expense.expense_category_id">
                                    <option value="">Select Expense Category</option>
                                    <option ng-repeat="category in expense_categories" value="{{ category.id }}">{{ category.title }}</option>
                                </select>
                            </td>
                            <td>
                                <textarea title="Enter Details" placeholder="Details" ng-model="new_expense.details" class="form-control"></textarea>
                            </td>
                            <td>
                                <input type="text" title="Enter Amount" placeholder="Amount" ng-model="new_expense.amount" class="form-control" />
                                <select ng-model="new_expense.currency_id">
                                    <option value="">Currency</option>
                                    <option ng-repeat="currency in currency_symbol" value="{{ currency.id }}">{{ currency.title }} - {{ currency.symbol }}</option>
                                </select>
                            </td>
                            <td colspan="2">
                                <select title="Choose Option" ng-model="new_expense.account_id">
                                	<option value="">Select Account</option>
                                    <option ng-repeat="account in accounts" value="{{ account.id }}">{{ account.title }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <button type="submit" class="btn btn-default btn-l" ng-click="add_expense()" title="Submit Record"> SAVE</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group vehicle-form">
            	<div class="panel-body table-responsive">
                	<table class="table table-hover list">
                    	<tr class="bg-info">
                        	<th colspan="3">Sold</th>
                        </tr>
                        <tr>
                        	<td width="50%">
                            	<label class="form-label" for="">Sold To </label>
                                <select name="category" title="Choose Option">
                                    <option value="">Select</option>
                                </select>
                            </td>
                            
                            <td width="20%">
                            	<label class="form-label" for="">Amount </label>
                                <input type="text" title="Enter Amount" value="" class="form-control" />
                            </td>
                            <td style="vertical-align:bottom">
                                <button type="submit" ng-disabled="processing" class="btn btn-default btn-l" ng-click="save_vehicle()" title="Submit Record"><i class="fa fa-spin fa-gear" ng-show="processing"></i> SAVE</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-10">
                    <div class="alert alert-danger" ng-show="errors.length > 0">
                        <p ng-repeat="error in errors">{{error}}</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>