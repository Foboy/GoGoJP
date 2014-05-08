function OrderCtrl($scope, $http, $location, $routeParams, $resturls,
		$rootScope) {

	var $parent = $scope.$parent;
	$scope.orderlistinfo = $rootScope.orderlistinfo;
	if (!$scope.orderlistinfo)
		$scope.orderlistinfo = [];

	// $scope.orderlistinfo.daterange = "";
	$scope.orderlistinfo.skey = "";

	$scope.stime = "";
	$scope.etime = "";
	$('#reservation').daterangepicker(
			{
				showDropdowns : true,
				format : 'YYYY/MM/DD',
				ranges : {
					'今天' : [ moment(), moment() ],
					'昨天' : [ moment().subtract('days', 1),
							moment().subtract('days', 1) ],
					'最近7天' : [ moment().subtract('days', 6), moment() ],
					'最近30天' : [ moment().subtract('days', 29), moment() ],
					'这个月' : [ moment().startOf('month'),
							moment().endOf('month') ],
					'上个月' : [ moment().subtract('month', 1).startOf('month'),
							moment().subtract('month', 1).endOf('month') ]
				},
				startDate : moment().subtract('days', 29),
				endDate : moment()
			}, function(start, end) {
				$scope.stime = start / 1000;
				$scope.etime = end / 1000;
			});
	$scope.SearchOrderList = function(pageIndex) {
		if (!$scope.orderlistinfo)
			$scope.orderlistinfo = [];
		if (!pageIndex)
			pageIndex = 0;

		$http.post($resturls["LoadOrder"], {
			stime : $scope.stime,
			etime : $scope.etime,
			keyname : $scope.orderlistinfo.skey,
			order_status : $scope.status_id,
			pageindex : pageIndex,
			pagesize : 10
		}).success(
				function(result) {
					if (result.Error == 0) {
						console.log(result.Data);
						$scope.orderList = result.Data;
						$parent.pages = utilities.paging(result.totalcount,
								pageIndex + 1, 10, '#home/order/' + '{0}');
					} else {
						// $scope.shopBills = [];
						$parent.pages = utilities.paging(0, pageIndex + 1, 10);
					}
				});
	}

	$scope.order_status = "订单状态";
	$scope.status_id = 0;

	// 获取订单状态
	$scope.orderstatus = [ {
		"id" : 0,
		"name" : "所有状态"
	}, {
		"id" : 1,
		"name" : "未付款"
	}, {
		"id" : 2,
		"name" : "已付款"
	}, {
		"id" : 3,
		"name" : "缺货，已退款"
	}, {
		"id" : 4,
		"name" : "交易结束"
	} ];
	$scope.ChooseOrderStatus = function(data) {
		if (data.name == "所有状态") {
			$scope.order_status = "订单状态";
		} else {
			$scope.order_status = data.name;
		}
		$scope.status_id = data.id;
	};
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

	if ($routeParams.pageIndex)
		$scope.SearchOrderList($routeParams.pageIndex - 1);
	else
		$scope.SearchOrderList();
}
