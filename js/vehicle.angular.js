angular.module('vehicle', ['ngAnimate', 'angularMoment', 'ui.bootstrap', 'angularjs-datetime-picker','localytics.directives']).controller('vehicleController',
	function ($scope, $http, $interval, $filter) {
		$scope.errors = [];
		$scope.accounts = [];
		$scope.models = [];
		$scope.makes = [];
		$scope.equipments = [];
		$scope.body_types = [];
		$scope.expense_categories = [];
		$scope.expenses = [];
		$scope.currency_symbol = [];
		$scope.vehicle_rixo = [];
		$scope.auction = [];
		angular.copy($scope.accounts);
		$scope.processing = false;
		$scope.vehicle_id = 0;
		$scope.petty_cash = {};
		$scope.vehicle = {
			id: 0,
			title: '',
			make_id: '',
			model_id: '',
			year: '',
			stock_no: '',
			chassis_no: '',
			month: '',
			mileage: '',
			grade: '',
			condition_type: '',
			body_type_id: '',
			fuel_tank: '',
			transmission: '',
			engine_no: '',
			engine_cc: '',
			doors: '',
			seating: '',
			drive: '',
			drive_type: '',
			color_interior: '',
			color_exterior: '',
			options: '',
			fob_price: 0,
			discount_price: 0,
			cnf_price: 0,
			doc_paper: '',
			container_no: '',
			bl_no: '',
			bl_date: '',
			export: '',
			consignee_name: '',
			s_charge: '',
			gov_tax: '',
			expanses: '',
			freight: '',
			yard_charge: '',
			insha_charge: '',
			total_price: '',
			total_price_np: '',
			status: 1,
		};
		$scope.new_expense = {
			"details": "",
			"amount": "",
			"account_id": "",
			"currency_id": "",
			"expense_category_id": ""
		};
		$scope.new_vehicle_rixo = {
			"title": "",
			"price": "",
			"phone": "",
			"rixo_date": "",
			"comments": "",
			"vehicle_id": ""
		};
		$scope.updateDate = function(){
			$scope.vehicle.datetime_added = $(".angular-datetimepicker").val();
			$scope.$apply();
		}
		angular.element(document).ready(function () {
			$scope.wctAJAX( {action: 'get_accounts'}, function( response ){
				$scope.accounts = response;
				for( i = 0; i < $scope.accounts.length; i++ ) {
					if( $scope.accounts[ i ].is_petty_cash == 1 ) {
						$scope.petty_cash = $scope.accounts[ i ];
					}
				
				}
				
			});
			$scope.wctAJAX( {action: 'get_model'}, function( response ){
				$scope.models = response;
			});
			$scope.wctAJAX( {action: 'get_make'}, function( response ){
				$scope.makes = response;
			});
			$scope.wctAJAX( {action: 'get_body_type'}, function( response ){
				$scope.body_types = response;
			});
			$scope.wctAJAX( {action: 'get_equipments'}, function( response ){
				$scope.equipments = response;
			});
			$scope.wctAJAX( {action: 'get_currency'}, function( response ){
				$scope.currency_symbol = response;
			});
			$scope.wctAJAX( {action: 'get_expense_category'}, function( response ){
				$scope.expense_categories = response;
			});
			$scope.wctAJAX( {action: 'get_expense'}, function( response ){
				$scope.expenses = response;
			});
			$scope.wctAJAX( {action: 'get_vehicle_rixo'}, function( response ){
				$scope.vehicle_rixo = response;
			});
			$scope.wctAJAX( {action: 'get_auction'}, function( response ){
				$scope.auction = response;
			});
			if( $scope.vehicle_id > 0 ) {
				$scope.wctAJAX( {action: 'get_vehicle', id: $scope.vehicle_id}, function( response ){
					$scope.vehicle = response;
				});
			}
			else {
				$scope.wctAJAX( {action: 'get_datetime'}, function( response ){
					$scope.vehicle.datetime_added = JSON.parse( response );
				});
			}
		});
		$scope.get_action = function(){
			if( $scope.vehicle_id > 0 ) {
				return 'Edit';
			}
			else {
				return 'Add New';
			}
		}
		
		$scope.wctAJAX = function( wctData, wctCallback ) {
			wctData.tab = 'addedit';
			wctRequest = {
				method: 'POST',
				url: 'vehicle_manage.php',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				transformRequest: function(obj) {
					var str = [];
					for(var p in obj){
						str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
					}
					return str.join("&");
				},
				data: wctData
			}
			$http(wctRequest).then(function(wctResponse){
				wctCallback(wctResponse.data);
			}, function () {
				console.log("Error in fetching data");
			});
		}
		$scope.save_vehicle = function () {
			$scope.errors = [];
			if( $scope.processing == false ){
				$scope.processing = true;
				data = {action: 'save_vehicle', vehicle: JSON.stringify( $scope.vehicle )};
                console.log(data);
				$scope.wctAJAX( data, function( response ){
					$scope.processing = false;
					if( response.status == 1 ) {
						window.location.href='vehicle_manage.php?tab=addedit&id='+response.id;
					}
					else{
						$scope.errors = response.error;
					}
				});
			}
		}
		$scope.get_expense_category = function( id ) {
			var r = $filter('filter')( $scope.expense_categories, {id: id}, true);
			if( r.length > 0 ) {
				return r[0].title;
			}
		}
		$scope.get_account = function( id ) {
			var r = $filter('filter')( $scope.accounts, {id: id}, true);
			if( r.length > 0 ) {
				return r[0].title;
			}
		}
		$scope.add_expense = function(){
			if( $scope.processing == false ) {
				if( $scope.new_expense.expense_category_id == "" || $scope.new_expense.account_id == "" || $scope.new_expense.amount <= 0 ){
					alert("Enter Expense Category, Account and Amount.");
				}
				else{
					$scope.processing = true;
					$scope.wctAJAX( {action: 'add_expense', expense: JSON.stringify($scope.new_expense)}, function( response ){
						$scope.processing = false;
						if( response.status == 1 ) {
							$scope.new_expense = {
								"details": "",
								"amount": 0,
								"account_id": "",
								"currency_id": "",
								"expense_category_id": ""
							};
							$scope.expenses.unshift(response.expense);
						}
						else{
							alert(response.message);
						}
					});	
				}
			}
		}
		$scope.edit_expense = function( $index ){
			$scope.new_expense = $scope.expenses[ $index ];
			
		}
		$scope.delete_expense = function( $index ){
			if( confirm( "Confirm Delete?" ) ){
				$scope.wctAJAX( {action: 'delete_expense', id: $scope.expenses[$index].id }, function(){});
				$scope.expenses.splice( $index, 1 );
			}
		}
		$scope.add_vehicle_rixo = function(){
			if( $scope.processing == false ) {
				if( $scope.new_vehicle_rixo.title == "" || $scope.new_vehicle_rixo.price <= 0 ){
					alert("Enter Title and Price.");
				}
				else{
					$scope.processing = true;
					$scope.wctAJAX( {action: 'add_vehicle_rixo', vehicle_rixo: JSON.stringify($scope.new_vehicle_rixo)}, function( response ){
						$scope.processing = false;
						if( response.status == 1 ) {
							$scope.new_vehicle_rixo = {
								"title": "",
								"price": 0,
								"phone": "",
								"rixo_date": "",
								"comments": ""
							};
							$scope.vehicle_rixo.unshift(response.vehicle_rixo);
						}
						else{
							alert(response.message);
						}
					});	
				}
			}
		}
		$scope.edit_vehicle_rixo = function( $index ){
			$scope.new_vehicle_rixo = $scope.vehicle_rixo[ $index ];
			
		}
		$scope.delete_vehicle_rixo = function( $index ){
			if( confirm( "Confirm Delete?" ) ){
				$scope.wctAJAX( {action: 'delete_vehicle_rixo', id: $scope.vehicle_rixo[$index].id }, function(){});
				$scope.vehicle_rixo.splice( $index, 1 );
			}
		}
	}
);