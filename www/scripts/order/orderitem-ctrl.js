function OrderItemCtrl($scope, $http, $location, $routeParams, $resturls,
		$rootScope) {
	$scope.order_no = $routeParams.order_no;
	$scope.order_time = $routeParams.order_time;

	// orderinfo
	$scope.user_account = "";
	$scope.order_freight = 0;
	$scope.order = [];
	$scope.order_status=0;
	$scope.logistics_status=0;

	//初始化状态
	$scope.InitStatus=function()
	{
		console.log($scope.order_status);
		console.log($scope.logistics_status);
		for ( var i = 1; i <= 4; i++) {
			if (i == $scope.order_status) {
			
				$('#OrderStatus' + $scope.order_status).attr('class','btn btn-success disabled');
			} else {
				$('#OrderStatus' + i).attr('class','btn btn-info');
			}
		}
		for ( var i = 1; i <= 6; i++) {
			if (i == $scope.logistics_status) {
				$('#LogisticsStatus' + $scope.logistics_status).attr('class',
						'btn btn-success disabled');
			} else {
				$('#LogisticsStatus' + i).attr('class',
						'btn btn-info');
			}
		}
	}
	$scope.getOrder = function() {
		$http.post($resturls["getOrder"], {
			order_no : $scope.order_no
		}).success(function(result) {
			if (result.Error == 0) {
				// console.log(result.Data);
				$scope.order = result.Data;
				$scope.order_status=$scope.order.order_status;
				$scope.logistics_status=$scope.order.logistics_status;
				$scope.InitStatus();
			} else {
			}
		});
	}
	$scope.searchOrderItem = function() {
		$http.post($resturls["searchOrderItem"], {
			order_no : $scope.order_no
		}).success(function(result) {
			if (result.Error == 0) {
				// console.log(result.Data);
				$scope.orderItems = result.Data;

			} else {
				$scope.orderItems = [];
			}
		});
	}
	$scope.updateOrderStatus = function(id) {
		$http.post($resturls["updateOrderStatus"], {
			order_no : $scope.order_no,
			order_status : id
		}).success(
				function(result) {
					if (result.Error == 0) {
						$scope.order_status=id;
						
						// console.log(result.Data);
						for ( var i = 1; i <= 4; i++) {
							if (i == id) {
							
								$('#OrderStatus' + id).attr('class','btn btn-success disabled');
							} else {
								$('#OrderStatus' + i).attr('class','btn btn-info');
							}
						}

					} else {

					}
				});
	}
	$scope.updateLogisticsStatus = function(id) {
		$http.post($resturls["updateLogisticsStatus"], {
			order_no : $scope.order_no,
			logistics_status : id
		}).success(
				function(result) {
					if (result.Error == 0) {
						// console.log(result.Data);
						$scope.logistics_status=id;
						for ( var i = 1; i <= 6; i++) {
							if (i == id) {
								$('#LogisticsStatus' + id).attr('class',
										'btn btn-success disabled');
							} else {
								$('#LogisticsStatus' + i).attr('class',
										'btn btn-info');
							}
						}

					} else {

					}
				});
	}
	$scope.ChangeOrderStatusIDtoName = function(id) {
		var name = "未知";
		switch (id * 1) {
		case 1:
			name = "未付款";
			break;
		case 2:
			name = "已付款";
			break;
		case 3:
			name = "缺货，已退货";
			break;
		case 4:
			name = "交易结束";
			break;
		}
		return name;
	}
	$scope.ChangeLogisticsStatusIDtoName = function(id) {
		var name = "未知";
		switch (id * 1) {
		case 1:
			name = "未发货";
			break;
		case 2:
			name = "国外代购中";
			break;
		case 3:
			name = "国外物流运转中";
			break;
		case 4:
			name = "已到达国内";
			break;
		case 5:
			name = "国内物流运转中";
			break;
		case 6:
			name = "已签收";
			break;
		}
		return name;
	}
	$scope.ChangePaymentIdToName = function(id) {
		var name = "未知";
		switch (id * 1) {
		case 1:
			name = "支付宝";
			break;

		}
		return name;
	}

	$scope.getOrder();
	$scope.searchOrderItem();
	
	
	
}
