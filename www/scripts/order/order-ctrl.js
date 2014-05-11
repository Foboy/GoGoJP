function OrderCtrl($scope, $http, $location, $routeParams, $resturls,
		$rootScope) {

	var $parent = $scope.$parent;
	$scope.orderlistinfo = $rootScope.orderlistinfo;
	if (!$scope.orderlistinfo)
		$scope.orderlistinfo = [];

	 $scope.orderlistinfo.daterange = "";
	 if(!$scope.orderlistinfo)
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
				}
			}, function(start, end) {
				
				$scope.stime = start / 1000;
				$scope.etime = end / 1000;
			});
	$scope.SearchOrderList = function(pageIndex) {
		if (!$scope.orderlistinfo)
			$scope.orderlistinfo = [];
	    var pageSize = 10;
        if (pageIndex == 0) pageIndex = 1;
   
        var stime="";
        var etime="";
  
        stime = $scope.timestamptostr($scope.stime);
		etime = $scope.timestamptostr($scope.etime+24*3600);
    
        
		$http.post($resturls["LoadOrder"], {
			stime : $scope.timestamptostr($scope.stime),
			etime : $scope.timestamptostr($scope.etime+24*3600),
			keyname : $scope.orderlistinfo.skey,
			order_status : $scope.status_id,
			pageindex : pageIndex-1,
			pagesize : 10
		}).success(
				function(result) {
					if (result.Error == 0) {
						//console.log(pageIndex);
						$scope.orderList = result.Data;
		                $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#order'  + '/{0}');
		            	
		                
		                $rootScope.orderlistinfo = $scope.orderlistinfo;
		            	//console.log($rootScope.orderlistinfo);
					} else {
						$scope.orderList = [];
					       $parent.pages = utilities.paging(0, pageIndex, pageSize);					}
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
		$scope.SearchOrderList($routeParams.pageIndex || 1);

}
