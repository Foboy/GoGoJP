//数据统计scope
function DataStatisticsCtrl($scope, $http, $location, $routeParams, $resturls) {
    
	$scope.order_count=0;
	$scope.total_price=0;
	$scope.unpay_order=0;
	$scope.today_orders=0;
    $scope.searchIndexOrderInfo = function () {
		$http.post($resturls["searchIndexOrderInfo"], {
		}).success(function(result) {
			if (result.Error == 0) {
				$scope.order_count=result.Data[0].order_count;
				$scope.total_price=result.Data[0].total_price;
				$scope.unpay_order=result.Data[0].unpay_order;
				$scope.today_orders=result.Data[0].today_orders;
			} else {
			}
		});
    }
    

    //初始化调用
    $scope.searchIndexOrderInfo();
}