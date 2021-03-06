<?php
if(!defined("APP_START")) die("No Direct Access");
if( count( $_POST ) > 0 ) {
	$response = array();
	extract( $_POST );
	if( isset( $action ) ) {
	switch($action){
		case 'get_datetime':
			$response = datetime_convert( date( "Y-m-d H:i:s" ) );
		break;
		case "get_accounts":
			$rs = doquery( "select * from account where status=1 order by id", $dblink );
			$accounts = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$accounts[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $accounts;
		break;
		case "get_branches":
			$rs = doquery( "select * from branch where status=1 order by id", $dblink );
			$branches = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$branches[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $branches;
		break;
		case "get_make":
			$rs = doquery( "select * from make where status=1 order by sortorder", $dblink );
			$makes = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$makes[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $makes;
		break;
		case "get_model":
			$rs = doquery( "select * from model where status=1 order by sortorder", $dblink );
			$models = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$models[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $models;
		break;
		case "get_body_type":
			$rs = doquery( "select * from body_type where status=1 order by sortorder", $dblink );
			$body_types = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$body_types[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $body_types;
		break;
		case "get_equipments":
			$rs = doquery( "select * from equipment where status=1 order by sortorder", $dblink );
			$equipments = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$equipments[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $equipments;
		break;
		case "get_auction":
			$rs = doquery( "select * from auction where status=1 order by id", $dblink );
			$auction = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$auction[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $auction;
		break;
		case "get_fuel_tank":
			$rs = doquery( "select * from fuel_tank where status=1 order by sortorder", $dblink );
			$fuel_tank = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$fuel_tank[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $fuel_tank;
		break;
		case "get_transmission":
			$rs = doquery( "select * from transmission where status=1 order by sortorder", $dblink );
			$transmission = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$transmission[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $transmission;
		break;
		case "get_condition":
			$rs = doquery( "select * from `condition` where status=1 order by sortorder", $dblink );
			$conditions = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$conditions[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ])
					);
				}
			}
			$response = $conditions;
		break;
		case "get_vehicle_rixo":
			$rs = doquery( "select * from rixo where status = 1 and branch_id='".$_SESSION["current_branch_id"]."' order by date desc, id desc", $dblink );
			$vehicle_rixo = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$vehicle_rixo[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ]),
						"rixo_date" => date_convert($r[ "date" ]),
						"price" => $r[ "price" ],
						"phone" => unslash( $r[ "phone" ] ),
						"comments" =>  $r[ "comments" ]
					);
				}
			}
			$response = $vehicle_rixo;
		break;
		case "get_vehicle":
			$id = slash( $_POST[ "id" ] );
			$rs = doquery( "select * from vehicle where id='".$id."'", $dblink );
			if( numrows( $rs ) > 0 ) {
				$r = dofetch( $rs );
				$vehicle = array(
					"id" => $r[ "id" ],
					"title" => $r[ "title" ],
					"make_id" => $r[ "make_id" ],
					"model_id" => $r[ "model_id" ],
					"year" => $r[ "year" ],
					"stock_no" => $r[ "stock_no" ],
					"chassis_no" => $r[ "chassis_no" ],
					"month" => $r[ "month" ],
					"mileage" => $r[ "mileage" ],
					"grade" => $r[ "grade" ],
					"condition_id" => $r[ "condition_id" ],
					"body_type_id" => $r[ "body_type_id" ],
					"fuel_tank_id" => $r[ "fuel_tank_id" ],
					"transmission_id" => $r[ "transmission_id" ],
					"engine_no" => $r[ "engine_no" ],
					"engine_cc" => $r[ "engine_cc" ],
					"doors" => $r[ "doors" ],
					"seating" => $r[ "seating" ],
					"drive" => $r[ "drive" ],
					"drive_type" => $r[ "drive_type" ],
					"color_interior" => $r[ "color_interior" ],
					"color_exterior" => $r[ "color_exterior" ],
					"options" => $r[ "options" ],
					"fob_price" => $r[ "fob_price" ],
					"discount_price" => $r[ "discount_price" ],
					"cnf_price" => $r[ "cnf_price" ],
					"auction_id" => $r[ "auction_id" ],
					"lot_number" => $r[ "lot_number" ],
					"auction_date" => date_convert($r[ "auction_date" ]),
					"buy_by" => $r[ "buy_by" ],
					"buying_price" => $r[ "buying_price" ],
					"recycle_fees" => $r[ "recycle_fees" ],
					"auction_fees" => $r[ "auction_fees" ],
					"other_fees" => $r[ "other_fees" ],
					"total_auction" => $r[ "total_auction" ],
					"total_with_tax" => $r[ "total_with_tax" ],
					"doc_paper" => $r[ "doc_paper" ],
					"container_no" => $r[ "container_no" ],
					"bl_no" => $r[ "bl_no" ],
					"bl_date" => date_convert($r[ "bl_date" ]),
					"export" => $r[ "export" ],
					"s_charge" => $r[ "s_charge" ],
					"gov_tax" => $r[ "gov_tax" ],
					"expanses" => $r[ "expanses" ],
					"freight" => $r[ "freight" ],
					"yard_charge" => $r[ "yard_charge" ],
					"insha_charge" => $r[ "insha_charge" ],
					"total_price" => $r[ "total_price" ],
					"total_price_np" => $r[ "total_price_np" ],
					"consignee_name" => $r[ "consignee_name" ],
					"status" => $r[ "status" ],
				);
				$equipments = array();
				$rs1 = doquery( "select * from vehicle_2_equipment where vehicle_id='".$id."'", $dblink );
				if( numrows( $rs1 ) > 0 ) {
					while( $r1 = dofetch( $rs1 ) ) {
						$equipments[] = $r1[ "equipment_id" ];
					}
				}
				$vehicle[ "equipments" ] = $equipments;
				$branches = array();
				$rs1 = doquery( "select * from vehicle_2_branch where vehicle_id='".$id."' and branch_id = '".$_SESSION[ "current_branch_id" ]."'", $dblink );
				if( numrows( $rs1 ) > 0 ) {
					while( $r1 = dofetch( $rs1 ) ) {
						$branches[] = $r1[ "branch_id" ];
					}
				}
				$vehicle[ "branches" ] = $branches;
			}
			$response = $vehicle;
		break;
		
		case "save_vehicle":
			$err = array();
			$vehicle = json_decode( $_POST[ "vehicle" ] );
			if( empty( $vehicle->model_id ) ) {
				$err[] = "Fields with * are mandatory";
				
			}
			if( count( $err ) == 0 ) {
				if( !empty( $vehicle->id ) ) {
					doquery( "update vehicle set `title`='".slash($vehicle->title)."', `make_id`='".slash($vehicle->make_id)."', `model_id`='".slash($vehicle->model_id)."', `year`='".slash($vehicle->year)."', `stock_no`='".slash($vehicle->stock_no)."', `chassis_no`='".slash($vehicle->chassis_no)."', `month`='".slash($vehicle->month)."', `mileage`='".slash($vehicle->mileage)."', `grade`='".slash($vehicle->grade)."', `condition_id`='".slash($vehicle->condition_id)."', `body_type_id`='".slash($vehicle->body_type_id)."', `fuel_tank_id`='".slash($vehicle->fuel_tank_id)."', `transmission_id`='".slash($vehicle->transmission_id)."', `engine_no`='".slash($vehicle->engine_no)."', `engine_cc`='".slash($vehicle->engine_cc)."', `doors`='".slash($vehicle->doors)."', `seating`='".slash($vehicle->seating)."', `drive`='".slash($vehicle->drive)."', `drive_type`='".slash($vehicle->drive_type)."', `color_interior`='".slash($vehicle->color_interior)."', `color_exterior`='".slash($vehicle->color_exterior)."', `options`='".slash($vehicle->options)."', `fob_price`='".slash($vehicle->fob_price)."', `discount_price`='".slash($vehicle->discount_price)."', `cnf_price`='".slash($vehicle->cnf_price)."', `auction_id`='".slash($vehicle->auction_id)."', `lot_number`='".slash($vehicle->lot_number)."', `auction_date`='".slash(date_dbconvert($vehicle->auction_date))."', `buy_by`='".slash($vehicle->buy_by)."', `buying_price`='".slash($vehicle->buying_price)."', `recycle_fees`='".slash($vehicle->recycle_fees)."', `auction_fees`='".slash($vehicle->auction_fees)."', `other_fees`='".slash($vehicle->other_fees)."', `total_auction`='".slash($vehicle->total_auction)."', `total_with_tax`='".slash($vehicle->total_with_tax)."', `doc_paper`='".slash($vehicle->doc_paper)."', `container_no`='".slash($vehicle->container_no)."', `bl_no`='".slash($vehicle->bl_no)."', `bl_date`='".slash(date_dbconvert($vehicle->bl_date))."', `export`='".slash($vehicle->export)."', `consignee_name`='".slash($vehicle->consignee_name)."', `s_charge`='".slash($vehicle->s_charge)."', `gov_tax`='".slash($vehicle->gov_tax)."', `expanses`='".slash($vehicle->expanses)."', `freight`='".slash($vehicle->freight)."', `yard_charge`='".slash($vehicle->yard_charge)."', `insha_charge`='".slash($vehicle->insha_charge)."', `total_price`='".slash($vehicle->total_price)."', `total_price_np`='".slash($vehicle->total_price_np)."', `status`='".slash($vehicle->status)."' where id='".$vehicle->id."'", $dblink );
					$vehicle_id = $vehicle->id;
					doquery( "delete from vehicle_2_branch where vehicle_id = '".$vehicle_id."' and branch_id = '".$_SESSION[ "current_branch_id" ]."'", $dblink );
					foreach( $vehicle->branches as $branch ) {	
						doquery( "insert into vehicle_2_branch ( vehicle_id, branch_id ) values( '".$vehicle_id."', '".$branch."' )", $dblink );
					}
				}
				else {
					doquery( "insert into vehicle (title, make_id, model_id, year, stock_no, chassis_no, month, mileage, grade, condition_id, body_type_id, fuel_tank_id, transmission_id, engine_no, engine_cc, doors, seating, drive, drive_type, color_interior, color_exterior, options, fob_price, discount_price, cnf_price, auction_id, lot_number, auction_date, buy_by, buying_price, recycle_fees, auction_fees, other_fees, total_auction, total_with_tax, doc_paper, container_no, bl_no, bl_date, export, consignee_name, s_charge, gov_tax, expanses, freight, yard_charge, insha_charge, total_price, total_price_np, status, added_by) VALUES ( '".slash($vehicle->title)."', '".slash($vehicle->make_id)."', '".slash($vehicle->model_id)."', '".slash($vehicle->year)."', '".slash($vehicle->stock_no)."', '".slash($vehicle->chassis_no)."', '".slash($vehicle->month)."', '".slash($vehicle->mileage)."', '".slash($vehicle->grade)."', '".slash($vehicle->condition_id)."', '".slash($vehicle->body_type_id)."', '".slash($vehicle->fuel_tank_id)."', '".slash($vehicle->transmission_id)."', '".slash($vehicle->engine_no)."', '".slash($vehicle->engine_cc)."', '".slash($vehicle->doors)."', '".slash($vehicle->seating)."', '".slash($vehicle->drive)."', '".slash($vehicle->drive_type)."', '".slash($vehicle->color_interior)."', '".slash($vehicle->color_exterior)."', '".slash($vehicle->options)."', '".slash($vehicle->fob_price)."', '".slash($vehicle->discount_price)."', '".slash($vehicle->cnf_price)."', '".slash($vehicle->auction_id)."', '".slash($vehicle->lot_number)."', '".slash(date_dbconvert($vehicle->auction_date))."', '".slash($vehicle->buy_by)."', '".slash($vehicle->buying_price)."', '".slash($vehicle->recycle_fees)."', '".slash($vehicle->auction_fees)."', '".slash($vehicle->other_fees)."', '".slash($vehicle->total_auction)."', '".slash($vehicle->total_with_tax)."', '".slash($vehicle->doc_paper)."', '".slash($vehicle->container_no)."', '".slash($vehicle->bl_no)."', '".slash(date_dbconvert($vehicle->bl_date))."', '".slash($vehicle->export)."', '".slash($vehicle->consignee_name)."', '".slash($vehicle->s_charge)."', '".slash($vehicle->gov_tax)."', '".slash($vehicle->expanses)."', '".slash($vehicle->freight)."', '".slash($vehicle->yard_charge)."', '".slash($vehicle->insha_charge)."', '".slash($vehicle->total_price)."', '".slash($vehicle->total_price_np)."', '".slash($vehicle->status)."', '".$_SESSION[ "logged_in_admin" ][ "id" ]."')", $dblink );
					$vehicle_id = inserted_id();
					doquery( "insert into vehicle_2_branch ( vehicle_id, branch_id ) values( '".$vehicle_id."', '".$_SESSION[ "current_branch_id" ]."' )", $dblink );
				}
				$equipment_ids = array();
				//doquery( "delete from vehicle_2_equipment where vehicle_id = '".$vehicle_id."'", $dblink );
				
					doquery( "insert into vehicle_2_equipment ( vehicle_id, equipment_id ) values( '".$vehicle_id."', '".$equipment."' )", $dblink );
				
				$response = array(
					"status" => 1,
					"id" => $vehicle_id
				);
			}
			else {
				$response = array(
					"status" => 0,
					"error" => $err
				);
			}
		break;
		case "get_currency":
			$rs = doquery( "select * from currency where status=1 order by id", $dblink );
			$currency_symbol = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$currency_symbol[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ]),
						"symbol" => unslash($r[ "symbol" ])
					);
				}
			}
			$response = $currency_symbol;
		break;
		case "get_expense_category":
			$rs = doquery( "select * from expense_category where status=1 order by title", $dblink );
			$expense_categories = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$expense_categories[] = array(
						"id" => $r[ "id" ],
						"title" => unslash($r[ "title" ]),
					);
				}
			}
			$response = $expense_categories;
		break;
		case "get_expense":
			$rs = doquery( "select * from expense where status = 1 and branch_id='".$_SESSION[ "current_branch_id" ]."' order by datetime_added desc, id desc", $dblink );
			$expense = array();
			if( numrows( $rs ) > 0 ) {
				while( $r = dofetch( $rs ) ) {
					$expense[] = array(
						"id" => $r[ "id" ],
						"account_id" => $r[ "account_id" ],
						"expense_category_id" => $r[ "expense_category_id" ],
						"datetime_added" => date("h:i A", strtotime($r[ "datetime_added" ])),
						"amount" => $r[ "amount" ],
						"details" => unslash( $r[ "details" ] ),
						"currency_id" => $r[ "currency_id" ]
					);
				}
			}
			$response = $expense;
		break;
		case "add_expense":
			$expense = json_decode( $expense );
			if( !empty( $expense->expense_category_id ) && !empty( $expense->account_id ) && !empty( $expense->amount ) ) {
				if( !empty( $expense->id ) ) {
					doquery("update expense set expense_category_id = '".slash($expense->expense_category_id)."', account_id='".slash($expense->account_id)."', amount = '".slash($expense->amount)."', details = '".slash($expense->details)."', currency_id='".slash($expense->currency_id)."' where id = '".$expense->id."'", $dblink);
				}
				else{
					doquery("insert into expense(branch_id, datetime_added, expense_category_id, details, amount, account_id, currency_id, added_by) values('".$_SESSION["current_branch_id"]."', NOW(), '".slash($expense->expense_category_id)."', '".slash($expense->details)."', '".slash($expense->amount)."', '".slash($expense->account_id)."', '".slash($expense->currency_id)."', '".$_SESSION["logged_in_admin"]["id"]."')", $dblink);
					$id = inserted_id();
					$r = dofetch(doquery("select * from expense where id ='".$id."' and branch_id='".$_SESSION["current_branch_id"]."'", $dblink));
					$expense = array(
						"id" => $r[ "id" ],
						"datetime_added" => date("h:i A", strtotime($r[ "datetime_added" ])),
						"expense_category_id" => unslash($r["expense_category_id"]),
						"details" => unslash($r[ "details" ]),
						"amount" => unslash($r[ "amount" ]),
						"account_id" => $r["account_id"],
						"currency_id" => $r["currency_id"],
					);
				}
				$response = array(
					"status" => 1,
					"expense" => $expense
				);
			}
			else{
				$response = array(
					"status" => 0,
					"message" => "Enter Category, Account and Amount"
				);
			}				
		break;
		case "delete_expense":
			doquery( "delete from expense where id = '".$_POST[ "id" ]."'", $dblink );
		break;
		case "add_vehicle_rixo":
			$vehicle_rixo = json_decode( $vehicle_rixo );
			if( !empty( $vehicle_rixo->title ) && !empty( $vehicle_rixo->price ) ) {
				
				if( !empty( $vehicle_rixo->id ) ) {
					doquery("update rixo set title = '".slash($vehicle_rixo->title)."', phone='".slash($vehicle_rixo->phone)."', date = '".slash(date_dbconvert($vehicle_rixo->rixo_date))."', price = '".slash($vehicle_rixo->price)."', comments = '".slash($vehicle_rixo->comments)."' where id = '".$vehicle_rixo->id."'", $dblink);
				}
				else{
					doquery("insert into rixo(branch_id, title, phone, date, price, comments) values('".$_SESSION["current_branch_id"]."', '".slash($vehicle_rixo->title)."', '".slash($vehicle_rixo->phone)."', '".slash(date_dbconvert($vehicle_rixo->rixo_date))."', '".slash($vehicle_rixo->price)."', '".slash($vehicle_rixo->comments)."')", $dblink);
					$id = inserted_id();
					$r = dofetch(doquery("select * from rixo where id ='".$id."' and branch_id='".$_SESSION["current_branch_id"]."'", $dblink));
					$vehicle_rixo = array(
						"id" => $r[ "id" ],
						"rixo_date" => date_convert($r[ "date" ]),
						"phone" => unslash($r["phone"]),
						"price" => unslash($r[ "price" ]),
						"comments" => unslash($r[ "comments" ]),
					);
				}
				$response = array(
					"status" => 1,
					"vehicle_rixo" => $vehicle_rixo
				);
			}
			else{
				$response = array(
					"status" => 0,
					"message" => "Enter Title and Price"
				);
			}				
		break;
		case "delete_vehicle_rixo":
			doquery( "delete from rixo where id = '".$_POST[ "id" ]."'", $dblink );
		break;
	}
	}
	echo json_encode( $response );
	die;
}