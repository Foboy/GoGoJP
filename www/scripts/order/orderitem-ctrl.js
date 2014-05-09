function OrderItemCtrl($scope, $http, $location, $routeParams, $resturls,
		$rootScope) {
	$scope.order_no = $routeParams.order_no;
	$scope.order_time = $routeParams.order_time;

	//orderinfo
	$scope.user_account="";
	$scope.order_freight=0;
	$scope.order=[];
	
	$scope.getOrder = function() {
		$http.post($resturls["getOrder"], {
			order_no : $scope.order_no
		}).success(function(result) {
			if (result.Error == 0) {
				//console.log(result.Data);
				$scope.order = result.Data;
			} else {
			}
		});
	}
	$scope.searchOrderItem = function() {
		$http.post($resturls["searchOrderItem"], {
			order_no : $scope.order_no
		}).success(function(result) {
			if (result.Error == 0) {
				//console.log(result.Data);
				$scope.orderItems = result.Data;

			} else {
				$scope.orderItems = [];
			}
		});
	}
	$scope.updateOrderStatus = function() {
		$http.post($resturls["updateOrderStatus"], {
			order_no : $scope.order_no
		}).success(function(result) {
			if (result.Error == 0) {
				//console.log(result.Data);
				

			} else {
			
			}
		});
	}
	$scope.updateLogisticsStatus = function() {
		$http.post($resturls["updateLogisticsStatus"], {
			order_no : $scope.order_no
		}).success(function(result) {
			if (result.Error == 0) {
				//console.log(result.Data);
			

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
	$scope.ChangePaymentIdToName=function(id)
	{
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
