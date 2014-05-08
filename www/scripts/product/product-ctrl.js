function ProductMainCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.Choose_MainCategory = $rootScope.R_Choose_MainCategory;
    $scope.Choose_SubCategory = $rootScope.R_Choose_SubCategory;
    $scope.secondshow = $rootScope.R_secondshow;
    $scope.LoadMainCategory = function () {
        $http.post($resturls["LoadMainCategory"], {}).success(function (result) {
            if (result.Error == 0) {
                $scope.MainCategorys = result.Data;
            } else {
                $scope.MainCategorys = [];
            }
        });
    }
    var $parent = $scope.$parent;
    $scope.sort = $routeParams.sort;
    if (!$scope.sort) {
        $scope.sort = "product";
    } else {
        $rootScope.R_secondshow = false;
    }
    if ($scope.sort == "product") {
        $scope.LoadMainCategory();
    }
    //商品，商品专辑，商品类别
    $scope.LoadProductSortList = function (pageIndex) {
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
                $http.post($resturls["LoadProdcutAlbum"], { start_time: '', end_time: '', album_name: '', pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
                    if (result.Error == 0) {
                        $scope.Albums = result.Data;
                        $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#product/' + $scope.sort + '/{0}');
                    } else {
                        $scope.Albums = [];
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
    //获取一级分类
    
    $scope.LoadProductSortList($routeParams.pageIndex || 1, $routeParams.parameters || '');

    $scope.ChooseMainCategory = function (MainCategory) {
        $http.post($resturls["LoadSubCategory"], { catid: MainCategory.catid }).success(function (result) {
            if (result.Error == 0) {
                $scope.SubCategorys = result.Data;
                $scope.Choose_MainCategory = MainCategory;
                $rootScope.R_Choose_MainCategory = MainCategory;
                if ($scope.SubCategorys == null) {
                    $scope.secondshow = false;
                    $rootScope.R_secondshow = false;
                } else {
                    $scope.secondshow = true;
                    $rootScope.R_secondshow = true;
                }
            } else {
                $scope.SubCategorys = [];
                $scope.secondshow = false;
                $rootScope.R_secondshow = false;
            }
        });
    }
    $scope.ChooseSubCategory = function (SubCategory) {
        $scope.Choose_SubCategory = SubCategory;
        $rootScope.R_Choose_SubCategory = SubCategory;
    }
    $scope.SearchClientSortList = function (condtion) {
        $scope.loadClientSortList(1, condtion);
        $rootScope.searchText = $scope.text;
    }
   
}