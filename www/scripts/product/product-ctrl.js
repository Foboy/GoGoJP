function ProductMainCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    //$scope.text = $rootScope.searchText;
    var $parent = $scope.$parent;
    $scope.sort = $routeParams.sort;
    if (!$scope.sort) {
        $scope.sort = "product";
    }
    if (!$scope.parameters) {
        $scope.parameters = decodeURIComponent($routeParams.parameters || "");
    }
    //客户
    $scope.LoadProductSortList = function (pageIndex, parameters) {
        var pageSize = 1;
        if (pageIndex == 0) pageIndex = 1;
        switch ($scope.sort) {
            case 'product':
                $http.post($resturls["LoadProdcut"], { catid: 0, product_name: '', product_num: '', pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
                    if (result.Error == 0) {
                        $scope.Prodcuts = result.Data;
                        $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#product/' + $scope.sort + '/{0}');
                    } else {
                        $scope.Prodcuts = [];
                        $parent.pages = utilities.paging(0, pageIndex, pageSize);
                    }
                });
                break;
            case 'album':
                $http.post($resturls["LoadProdcutAlbum"], { rank_id: 0, name: parameters, phone: parameters, sex: 0, type: 3, pageindex: pageIndex - 1, pagesize: pageSize }).success(function (result) {
                    if (result.Error == 0) {
                        $scope.gogoclients = result.Data;
                        $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#client/' + $scope.sorts + '/{0}' + '/{1}', encodeURIComponent(parameters));
                    } else {
                        $scope.gogoclients = [];
                        $parent.pages = utilities.paging(0, pageIndex, pageSize);
                    }
                });
                break;
            case 'category':
                //分类列表
                $http.post($resturls["LoadProdcutCategory"], { pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
                    if (result.Error == 0) {
                        $scope.ProdcutCategorys = result.Data;
                        $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#product/' + $scope.sort + '/{0}');
                    } else {
                        $scope.gogoclients = [];
                        $parent.ProdcutCategorys = utilities.paging(0, pageIndex, pageSize);
                    }
                });
                break;
        }
    }
    $scope.LoadProductSortList($routeParams.pageIndex || 1, $routeParams.parameters || '');
    $scope.SearchClientSortList = function (condtion) {
        $scope.loadClientSortList(1, condtion);
        $rootScope.searchText = $scope.text;
    }
   
}