function OrderCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {

	 var $parent = $scope.$parent;
	$scope.orderlistinfo=$rootScope.orderlistinfo;
	if(!$scope.orderlistinfo)
		$scope.orderlistinfo=[];

	$scope.orderlistinfo.daterange="";
	$scope.orderlistinfo.skey="";
	
	var create_time1="";
	var create_time2="";
  $scope.SearchOrderList = function (pageIndex) {
  	if(!$scope.orderlistinfo)
  		$scope.orderlistinfo=[];
      if (!pageIndex) 
   	   pageIndex = 0;
      
      $http.post($resturls["ShopBills"], { create_time1:create_time1,create_time2:create_time2,pageindex:pageIndex,pagesize: 10 }).success(function (result) {
          if (result.Error == 0) {
//              $scope.shopBills = result.Data;
//              //$parent.shopBillsActpageIndex = pageIndex;
//              $parent.pages = utilities.paging(result.totalcount, pageIndex+1, 10, '#customer/' + '{0}');
          } else {
              //$scope.shopBills = [];
              $parent.pages = utilities.paging(0, pageIndex+1, 10);
          }
      });
  }
  
  $('#reservation').daterangepicker({
			   showDropdowns:true,
			   format: 'YYYY/MM/DD',
			   ranges: {
                  '今天': [moment(), moment()],
                  '昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
                  '最近7天': [moment().subtract('days', 6), moment()],
                  '最近30天': [moment().subtract('days', 29), moment()],
                  '这个月': [moment().startOf('month'), moment().endOf('month')],
                  '上个月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
              },
              startDate: moment().subtract('days', 29),
              endDate: moment()
		   },
     function(start, end) {
	   create_time1=start/1000;
	   create_time2=end/1000;
  });
 
  
  
  $scope.order_status="订单状态";
  $scope.status_id=0;
  
  //获取订单状态
  $scope.orderstatus=[
                    {"id":1,"name":"未付款"},
                          {"id":2,"name":"已付款"},
                          {"id":3,"name":"缺货，已退款"},
                          {"id":4,"name":"交易结束"}
                          ];
  $scope.ChooseOrderStatus=function(data)
  {
  	$scope.order_status=data.name;
  	$scope.status_id=data.id;
//	$scope.tag_sr_text=data.name;
//	$("#tag_sr").removeClass("hidden");
  	alert($scope.status_id);
  };
  
  
//	if($routeParams.pageIndex)
//		$scope.SearchOrderList($routeParams.pageIndex-1);
//	else
//		$scope.SearchOrderList();
}


