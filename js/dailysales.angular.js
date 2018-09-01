angular.module('dailysales', ['ngAnimate', 'angularMoment']).controller('dailysalesController', 
	function ($scope, $http, $interval, $filter) {
		$scope.dt = '';
		$scope.curr_dt = '';
		$scope.products = []
		$scope.records = [];
		$scope.current_record_id = 0;
		$scope.customers = [];
		$scope.suppliers = [];
		$scope.expenses = [];
		$scope.transactions = [];
		$scope.customer_payments = [];
		$scope.supplier_payments = [];
		$scope.errors = [];
		$scope.messages = [];
		$scope.processing = false;
		$scope.new_expense = {
			"details": "",
			"amount": "",
			"account_id": "",
			"expense_category_id": ""
		};
		$scope.new_transaction = {
			"account_id": "",
			"reference_id": "",
			"amount": "",
			"details": ""
		};
		$scope.new_supplier_payment = {
			"supplier_id": "",
			"amount": "",
			"account_id": "",
			"details": ""
		};
		$scope.new_customer_payment = {
			"customer_id": "",
			"amount": "",
			"account_id": "",
			"details": ""
		};
		$scope.accounts = [];
		$scope.expense_categories = [];
		$scope.get_records = function() {
			$scope.get_products();
			$scope.get_employees();
			$scope.get_customers();
			$scope.get_suppliers();
			$scope.get_expense();
			$scope.get_customer_payment();
			$scope.get_supplier_payment();
			$scope.get_accounts();
			$scope.get_expense_category();
			$scope.get_transaction();
		}
		$scope.get_products = function(){
			$scope.wctAJAX( { action: 'get_products', dt: $scope.dt }, function( response ){
				$scope.products = response;
			});
		}
		$scope.updateDate = function(){
			if( $scope.dt != $(".angular-datetimepicker").val() ){
				$scope.dt = $(".angular-datetimepicker").val();
				$scope.$apply();
				$scope.wctAJAX( {action: 'set_dt', dt: $scope.dt}, function( response ){});
				$scope.get_products();
				$scope.get_employees();
				$scope.refresh_records();
			}
		}
		$scope.refresh_records = function() {
			$scope.get_expense();
			$scope.get_customer_payment();
			$scope.get_transaction();
		}
		$scope.get_employees = function(){
			$scope.processing = true;
			$scope.wctAJAX( { action: 'get_employees', dt: $scope.dt }, function( response ){
				$scope.records = response;
				$scope.processing = false;
				$scope.current_record_id = -1;
			});
		}
		$scope.get_customers = function(){
			$scope.wctAJAX( {action: 'get_customers'}, function( response ){
				$scope.customers = response;
			});
		}
		$scope.get_suppliers = function(){
			$scope.wctAJAX( {action: 'get_suppliers'}, function( response ){
				$scope.suppliers = response;
			});
		}
		$scope.get_expense = function(){
			$scope.wctAJAX( {action: 'get_expense', dt: $scope.dt}, function( response ){
				$scope.expenses = response;
			});
		}
		$scope.get_customer_payment = function(){
			$scope.wctAJAX( {action: 'get_customer_payment', dt: $scope.dt}, function( response ){
				$scope.customer_payments = response;
			});
		}
		$scope.get_supplier_payment = function(){
			$scope.wctAJAX( {action: 'get_supplier_payment', dt: $scope.dt}, function( response ){
				$scope.supplier_payments = response;
			});
		}
		$scope.get_accounts = function(){
			$scope.wctAJAX( {action: 'get_accounts'}, function( response ){
				$scope.accounts = response;
			});
		}
		$scope.get_expense_category = function(){
			$scope.wctAJAX( {action: 'get_expense_category'}, function( response ){
				$scope.expense_categories = response;
			});
		}
		$scope.get_transaction = function(){
			$scope.wctAJAX( {action: 'get_transaction', dt: $scope.dt}, function( response ){
				$scope.transactions = response;
			});
		}
		$scope.current_record = function( id ){
			$scope.current_record_id = id;
		}		
		$scope.wctAJAX = function( wctData, wctCallback ) {
			wctRequest = {
				method: 'POST',
				url: 'daily_sales_manage.php',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				transformRequest: function(obj) {
					var str = [];
					str.push( "tab=ajax" );
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
		$scope.wctAJAX( {action: 'get_dt'}, function( response ){
			$scope.dt = JSON.parse( response );
			$scope.get_records();
		});
		$scope.errors = [];
		$scope.save_dailysales = function( position ){
			var valid = true;
			$scope.errors = [];
			for( var i = 0; i < $scope.records.length; i++ ) {
				$scope.errors.push( new Array() );
				if( typeof position == 'undefined' || position == i )  {
					console.log($scope.records[ i ]);
					if( $scope.records[ i ].daily_sale.cash_given === "" ) {
						$scope.errors[ i ].push( "Enter cash given" );
					}
					if( $scope.records[ i ].daily_sale.expense === "" ) {
						$scope.errors[ i ].push( "Enter Expense" );
					}
					for( var j = 0; j < $scope.records[ i ].daily_sale.products.length; j++ ) {
						if( $scope.records[ i ].daily_sale.products[ j ].stock_taken_out === "" ) {
							$scope.errors[ i ].push( "Enter Stock out of "+$scope.products[ j ].title );
						}
						if( $scope.records[ i ].daily_sale.products[ j ].stock_return === "" ) {
							$scope.errors[ i ].push( "Enter Stock returned of "+$scope.products[ j ].title );
						}
						if( $scope.records[ i ].daily_sale.products[ j ].wholesale_sale === "" ) {
							$scope.errors[ i ].push( "Enter Wholesale of "+$scope.products[ j ].title );
						}
						if( $scope.records[ i ].daily_sale.products[ j ].retail_sale === "" ) {
							$scope.errors[ i ].push( "Enter Retail of "+$scope.products[ j ].title );
						}
						if( $scope.records[ i ].daily_sale.products[ j ].wholesale_rate_with_tax === "" ) {
							$scope.errors[ i ].push( "Enter WS Price of "+$scope.products[ j ].title );
						}
						if( $scope.records[ i ].daily_sale.products[ j ].retail_rate_with_tax === "" ) {
							$scope.errors[ i ].push( "Enter RT Price of "+$scope.products[ j ].title );
						}
						if( $scope.records[ i ].daily_sale.products[ j ].scheme === "" ) {
							$scope.errors[ i ].push( "Enter Scheme of "+$scope.products[ j ].title );
						}
					}
					if( $scope.errors[ i ].length > 0 ) {
						valid = false;
					}
				}
			}
			if( valid ) {
				$scope.errors = [];
				$scope.messages = [];
				$scope.processing = true;
				var data = {action: 'save_dailysales', records: JSON.stringify( $scope.records ) };
				if( done ) {
					data.done = 1;
				}
				$scope.wctAJAX( data, function( response ){
					$scope.processing = false;
					if( response.status == 1 ) {
						$scope.errors = [];
						$scope.messages = response.messages;
						$scope.get_products();
						$scope.get_employees();
						$scope.refresh_records();
						//window.location.reload();					
					}
					else{
						$scope.errors = response.errors;
						$scope.messages = [];					
					}
				});
			}
		}	
		$scope.add_expense = function(){
			if( $scope.processing == false ) {
				if( $scope.new_expense.expense_category_id == "" || $scope.new_expense.amount <= 0 ){
					alert("Enter Expense Category and Amount.");
				}
				else{
					$scope.processing = true;
					$scope.wctAJAX( {action: 'add_expense', expense: JSON.stringify($scope.new_expense)}, function( response ){
						$scope.processing = false;
						if( response.status == 1 ) {
							$scope.new_expense = {
								"details": "",
								"amount": "",
								"account_id": "",
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
		$scope.expense_total = function() {
			total = 0;
			for( i = 0; i < $scope.expenses.length; i++ ) {
				total += parseFloat($scope.expenses[ i ].amount);
			}
			return total;
		}
		$scope.add_customer_payment = function(){
			if( $scope.processing == false ) {
				if( $scope.new_customer_payment.customer_id == "" || $scope.new_customer_payment.amount <= 0 ){
					alert("Enter Customer and Amount.");
				}
				else{
					$scope.processing = true;
					$scope.wctAJAX( {action: 'add_customer_payment', customer_payment: JSON.stringify($scope.new_customer_payment)}, function( response ){
						$scope.processing = false;
						if( response.status == 1 ) {
							$scope.new_customer_payment = {
								"customer_id": "",
								"amount": "",
								"account_id": "",
								"details": ""
							};
							$scope.customer_payments.unshift(response.customer_payment);
						}
						else{
							alert(response.message);
						}
					});	
				}
			}
		}
		$scope.customer_payment_total = function() {
			total = 0;
			for( i = 0; i < $scope.customer_payments.length; i++ ) {
				total += parseFloat($scope.customer_payments[ i ].amount);
			}
			return total;
		}
		$scope.add_supplier_payment = function(){
			if( $scope.processing == false ) {
				if( $scope.new_supplier_payment.supplier_id == "" || $scope.new_supplier_payment.amount <= 0 ){
					alert("Enter Supplier and Amount.");
				}
				else{
					$scope.processing = true;
					$scope.wctAJAX( {action: 'add_supplier_payment', supplier_payment: JSON.stringify($scope.new_supplier_payment)}, function( response ){
						$scope.processing = false;
						if( response.status == 1 ) {
							$scope.new_supplier_payment = {
								"supplier_id": "",
								"amount": "",
								"account_id": "",
								"details": ""
							};
							$scope.supplier_payments.unshift(response.supplier_payment);
						}
						else{
							alert(response.message);
						}
					});	
				}
			}
		}
		$scope.supplier_payment_total = function() {
			total = 0;
			for( i = 0; i < $scope.supplier_payments.length; i++ ) {
				total += parseFloat($scope.supplier_payments[ i ].amount);
			}
			return total;
		}
		$scope.add_transaction = function(){
			if( $scope.processing == false ) {
				$scope.new_transaction.amount=parseFloat($scope.new_transaction.amount);
				if( $scope.new_transaction.account_id == "" ||  $scope.new_transaction.amount<= 0 ){
					alert("Select Accounts and Amount.");
				}
				else{
					$scope.processing = true;
					$scope.wctAJAX( {action: 'add_transaction', transaction: JSON.stringify($scope.new_transaction)}, function( response ){
						$scope.processing = false;
						if( response.status == 1 ) {
							$scope.new_transaction = {
								"account_id": "",
								"reference_id": "",
								"amount": "",
								"details": ""
								
							};
							$scope.transactions.unshift(response.transaction);
						}
						else{
							alert(response.message);
						}
					});	
				}
			}
		}
		$scope.transaction_total = function() {
			total = 0;
			for( i = 0; i < $scope.transactions.length; i++ ) {
				total += parseFloat($scope.transactions[ i ].amount);
			}
			return total;
		}
		
		$scope.product_total = function( parameter, position, parent_position ){
			if( typeof position === 'undefined' ) {
				total = 0;
				for( var i = 0;  i < $scope.products.length; i++ ) {
					total += $scope.product_total( parameter, i );
				}
				return total;
			}
			else{
				if( typeof parent_position === 'undefined' ) {
					total = 0;
					for( var i = 0;  i < $scope.records.length; i++ ) {
						total += $scope.product_total( parameter, position, i );
					}
					return total;
				}
				else {
					switch( parameter ) {
						case 'wholesale_amount':
							total = 0;
							for( var i = 0;  i < $scope.records[ parent_position ].customers.length; i++ ) {
								if( $scope.records[ parent_position ].customers[ i ].pricing == '1' ) {
									total += ( parseFloat( $scope.records[ parent_position ].customers[ i ].products[ position ].quantity ) - parseFloat( $scope.records[ parent_position ].customers[ i ].products[ position ].scheme ) ) * parseFloat( $scope.records[ parent_position ].customers[ i ].products[ position ].rate_wt );
								}
							}
							return total;
						break;
						case 'retail_amount':
							total = 0;
							for( var i = 0;  i < $scope.records[ parent_position ].customers.length; i++ ) {
								if( $scope.records[ parent_position ].customers[ i ].pricing == '0' ) {
									total += ( parseFloat( $scope.records[ parent_position ].customers[ i ].products[ position ].quantity ) - parseFloat( $scope.records[ parent_position ].customers[ i ].products[ position ].scheme ) ) * parseFloat( $scope.records[ parent_position ].customers[ i ].products[ position ].rate_wt );
								}
							}
							return total;
						break;
						default:
							if( $scope.records[ parent_position ].daily_sale.products[ position ][ parameter ] == '' ) {
								return 0;
							}
							return parseFloat( $scope.records[ parent_position ].daily_sale.products[ position ][ parameter ] );
						break;
					}
					return 0;
				}
			}
		}
		$scope.shop_total = function( field ){
			total = 0;
			for( var i = 0; i < $scope.products.length; i++ ){
				total += $scope.products[ i ][field];
			}
			return total;
		}
		$scope.update_sale = function( position ) {
			var customer_wholesale = [];
			var customer_retail = [];
			var customer_scheme = [];
			var customer_daily_wholesale = -1;
			var customer_daily_retail = -1;
			for( var i = 0;  i < $scope.records[ position ].daily_sale.products.length; i++ ) {
				customer_retail[ i ] = 0;
				customer_wholesale[ i ] = 0;
				customer_scheme[ i ] = 0;
			}
			for( var i = 0;  i < $scope.records[ position ].customers.length; i++ ) {
				for( var j = 0;  j < $scope.records[ position ].customers[ i ].products.length; j++ ) {
					if( $scope.records[ position ].customers[ i ].is_daily_sale == '0' ) {
						if( $scope.records[ position ].customers[ i ].pricing == '0' ) {
							customer_retail[ j ] += parseFloat( $scope.records[ position ].customers[ i ].products[ j ].quantity );
						}
						else {
							customer_wholesale[ j ] += parseFloat( $scope.records[ position ].customers[ i ].products[ j ].quantity );
						}
						customer_scheme[ j ] += parseFloat( $scope.records[ position ].customers[ i ].products[ j ].scheme );
					}
				}
				if( $scope.records[ position ].customers[ i ].is_daily_sale == '1' ) {
					if( $scope.records[ position ].customers[ i ].pricing == '0' ) {
						customer_daily_retail = i;
					}
					else {
						customer_daily_wholesale = i;
					}
				}
			}
			for( var i = 0;  i < $scope.records[ position ].daily_sale.products.length; i++ ) {
				$scope.records[ position ].daily_sale.products[ i ].retail_sale = parseFloat($scope.records[ position ].daily_sale.products[ i ].stock_taken_out)-parseFloat($scope.records[ position ].daily_sale.products[ i ].stock_return) - parseFloat($scope.records[ position ].daily_sale.products[ i ].wholesale_sale)-parseFloat( $scope.records[ position ].daily_sale.products[ i ].scheme );
				var daily_wholesale = parseFloat( $scope.records[ position ].daily_sale.products[ i ].wholesale_sale ) - parseFloat( customer_wholesale[ i ] );
				var daily_retail = parseFloat( $scope.records[ position ].daily_sale.products[ i ].retail_sale ) - parseFloat( customer_retail[ i ] ) + parseFloat( $scope.records[ position ].daily_sale.products[ i ].scheme ) - parseFloat( customer_scheme[ i ] );
				$scope.records[ position ].customers[ customer_daily_retail ].products[ i ].quantity = daily_retail;
				$scope.records[ position ].customers[ customer_daily_retail ].products[ i ].scheme = parseFloat( $scope.records[ position ].daily_sale.products[ i ].scheme ) - parseFloat( customer_scheme[ i ] );
				$scope.records[ position ].customers[ customer_daily_retail ].products[ i ].rate = parseFloat( $scope.records[ position ].daily_sale.products[ i ].retail_rate );
				$scope.records[ position ].customers[ customer_daily_retail ].products[ i ].rate_wt = parseFloat( $scope.records[ position ].daily_sale.products[ i ].retail_rate_with_tax );
				$scope.records[ position ].customers[ customer_daily_wholesale ].products[ i ].quantity = daily_wholesale;
				$scope.records[ position ].customers[ customer_daily_wholesale ].products[ i ].rate = parseFloat( $scope.records[ position ].daily_sale.products[ i ].wholesale_rate );
				$scope.records[ position ].customers[ customer_daily_wholesale ].products[ i ].rate_wt = parseFloat( $scope.records[ position ].daily_sale.products[ i ].wholesale_rate_with_tax );
			}
			for( var i = 0;  i < $scope.records[ position ].customers.length; i++ ) {
				var total_sales = 0;
				for( var j = 0;  j < $scope.records[ position ].customers[ i ].products.length; j++ ) {
					total_sales += ( parseFloat( $scope.records[ position ].customers[ i ].products[ j ].quantity ) - parseFloat( $scope.records[ position ].customers[ i ].products[ j ].scheme ) ) * parseFloat( $scope.records[ position ].customers[ i ].products[ j ].rate_wt )
				}
				$scope.records[ position ].customers[ i ].total_sales = Math.round( total_sales );
				if( $scope.records[ position ].customers[ i ].is_daily_sale == '1' ) {
					$scope.records[ position ].customers[ i ].payment = Math.round( total_sales );
				}
			}
			$scope.update_dues( position );
		}
		$scope.update_dues = function( index ){
			$scope.records[ index ].daily_sale.dues_on_employee = $scope.total_payment( index ) - parseFloat( $scope.records[ index ].daily_sale.cash_given ) - parseFloat( $scope.records[ index ].daily_sale.expense );
		}
		$scope.total_balance = function( position ) {
			if( typeof position === 'undefined' ){
				var total = 0;
				for( var i =0; i < $scope.records.length; i++ ) {
					total += $scope.total_balance( i );
				}
				return total;
			}
			else {
				var total = 0;
				for( var i = 0;  i < $scope.records[ position ].customers.length; i++ ) {
					total += $scope.records[ position ].customers[ i ].balance;
				}
				for( var i = 0;  i < $scope.records[ position ].customer_accounts.length; i++ ) {
					total += $scope.records[ position ].customer_accounts[ i ].balance;
				}
				return total;
			}
		}
		
		$scope.total_sales = function( index ) {
			if( typeof $scope.records[ index ] === 'undefined' ){
				var total = 0;
				for( var i =0; i < $scope.records.length; i++ ) {
					total += $scope.total_sales( i );
				}
				return total;
			}
			else {
				var total = 0;
				var wh_amount = 0;
				var rt_amount = 0;
				for( var i =0; i < $scope.records[ index ].daily_sale.products.length; i++ ) {
					wh_amount += $scope.product_total( 'wholesale_amount', i, index );
					rt_amount += $scope.product_total( 'retail_amount', i, index );
				}
				total = wh_amount + rt_amount;
				return Math.round( total );
			}
		}
		$scope.total_payment = function( index ) {
			if( typeof $scope.records[ index ] === 'undefined' ){
				var total = 0;
				for( var i =0; i < $scope.records.length; i++ ) {
					total += $scope.total_payment( i );
				}
				return total;
			}
			else {
				var total = 0;
				for( var i = 0;  i < $scope.records[ index ].customers.length; i++ ) {
					total += parseFloat( $scope.records[ index ].customers[ i ].payment );
				}
				total += $scope.total_account_payment( index )-$scope.total_account_sale( index );
				return total;
			}
		}
		$scope.total_fuel_expense = function() {
			var total = 0;
			for( var i =0; i < $scope.records.length; i++ ) {
				total += parseFloat( $scope.records[ i ].daily_sale.expense );
			}
			return total;
		}
		$scope.total_cash_given = function() {
			var total = 0;
			for( var i =0; i < $scope.records.length; i++ ) {
				total += parseFloat( $scope.records[ i ].daily_sale.cash_given );
			}
			return total;
		}
		$scope.total_dues_on_employees = function() {
			var total = 0;
			for( var i =0; i < $scope.records.length; i++ ) {
				total += parseFloat( $scope.records[ i ].daily_sale.dues_on_employee );
			}
			return total;
		}
		$scope.total_account_sale = function( index ) {
			if( typeof $scope.records[ index ] === 'undefined' ){
				var total = 0;
				for( var i =0; i < $scope.records.length; i++ ) {
					total += $scope.total_account_sale( i );
				}
				return total;
			}
			else {
				var total = 0;
				for( var i =0; i < $scope.records[ index ].customer_accounts.length; i++ ) {
					total += parseFloat( $scope.records[ index ].customer_accounts[ i ].total_sales );
				}
				return total;
			}
		}
		$scope.total_account_payment = function( index ) {
			if( typeof $scope.records[ index ] === 'undefined' ){
				var total = 0;
				for( var i =0; i < $scope.records.length; i++ ) {
					total += $scope.total_account_payment( i );
				}
				return total;
			}
			else {
				var total = 0;
				for( var i =0; i < $scope.records[ index ].customer_accounts.length; i++ ) {
					total += parseFloat( $scope.records[ index ].customer_accounts[ i ].payment );
				}
				return total;
			}
		}
		$scope.add_account = function( pos ){
			var title = prompt("Please enter your name", "");
			if (title != null && title != "") {
				$scope.wctAJAX( {action: 'add_account', title: title, employee_id: $scope.records[ pos ].id}, function( response ){
					if( response.status == 1 ) {
						$scope.records[ pos ].customer_accounts.unshift(response.account);
					}
					else{
						alert(response.error);
					}
				});	
			}
		}
		$scope.print_page = function(){
			window.print();
		}
	}
)