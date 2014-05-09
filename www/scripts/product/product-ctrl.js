function ProductMainCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.Choose_MainCategory = $rootScope.R_Choose_MainCategory;
    $scope.Choose_SubCategory = $rootScope.R_Choose_SubCategory;
    $scope.ProductKey = $rootScope.R_ProductKey;
    $scope.secondshow = $rootScope.R_secondshow;
    $scope.AlbumKey = $rootScope.R_AlbumKey;

    //获取一级分类
    $scope.LoadMainCategory = function () {
        $http.post($resturls["LoadMainCategory"], {}).success(function (result) {
            if (result.Error == 0) {
                $scope.MainCategorys = result.Data;
            } else {
                $scope.MainCategorys = [];
            }
        });
    }
    //获取二级分类
    $scope.LoadSubCategory = function (ParentCategory) {
        $http.post($resturls["LoadSubCategory"], { catid: ParentCategory.catid }).success(function (result) {
            if (result.Error == 0) {
                $scope.SubCategorys = result.Data;
            } else {
                $scope.SubCategorys = [];
            }
        });
    }
    //商品列表
    $scope.LoadProductList = function (pageIndex) {
        var pageSize = 1;
        if (pageIndex == 0) pageIndex = 1;
        var catid = 0;
        if ($scope.Choose_MainCategory) {
            catid = $scope.Choose_MainCategory.catid;
        }
        if ($scope.Choose_SubCategory) {
            catid = $scope.Choose_SubCategory.catid;
        }
        var ProductKey = '';
        if ($scope.ProductKey) {
            ProductKey = $scope.ProductKey
        }
        $http.post($resturls["LoadProdcut"], { catid: catid, keyname: ProductKey, pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
            if (result.Error == 0) {
                $scope.Prodcuts = result.Data;
                $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#product/' + $scope.sort + '/{0}');
            } else {
                $scope.Prodcuts = [];
                $parent.pages = utilities.paging(0, pageIndex, pageSize);
            }
        });
    }
    //商品专辑
    $scope.LoadAlbumList = function (pageIndex) {
        $("#albumtime").val($rootScope.R_choosetime);
        $("#albumtime").daterangepicker({
            showDropdowns: true,
            format: 'YYYY/MM/DD',
            ranges: {
                '今天/昨天': [moment().subtract('days', 1), moment()],
                '最近7天': [moment().subtract('days', 6), moment()],
                '最近30天': [moment().subtract('days', 29), moment()]
            },
            startDate: moment().subtract('days', 1),
            endDate: moment()
        },
           function (start, end) {
               $rootScope.R_choosetime = $("#albumtime").val();
               $rootScope.R_Choose_Album_StartTime = start / 1000;
               $rootScope.R_Choose_Album_EndTime = end / 1000;
           });
        var pageSize = 1;
        if (pageIndex == 0) pageIndex = 1;
        var AlbumKey = '';
        if ($scope.AlbumKey) {
            AlbumKey = $scope.AlbumKey
        }
        $http.post($resturls["LoadProdcutAlbum"], { start_time: '' || $rootScope.R_Choose_Album_StartTime, end_time: '' || $rootScope.R_Choose_Album_EndTime, album_name: AlbumKey, pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
            if (result.Error == 0) {
                $scope.Albums = result.Data;
                $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#product/' + $scope.sort + '/{0}');
            } else {
                $scope.Albums = [];
                $parent.pages = utilities.paging(0, pageIndex, pageSize);
            }
        });

    }
    //商品类别
    $scope.LoadProductCategoryList = function (pageIndex) {
        var pageSize = 1;
        if (pageIndex == 0) pageIndex = 1;
        $http.post($resturls["LoadProdcutCategory"], { pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
            if (result.Error == 0) {
                $scope.ProdcutCategorys = result.Data;
                $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#product/' + $scope.sort + '/{0}');
            } else {
                $scope.gogoclients = [];
                $parent.ProdcutCategorys = utilities.paging(0, pageIndex, pageSize);
            }
        });
    }
    //选择父类别
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
    //选择子类别
    $scope.ChooseSubCategory = function (SubCategory) {
        $scope.Choose_SubCategory = SubCategory;
        $rootScope.R_Choose_SubCategory = SubCategory;
    }
    //根据筛选条件模糊查询商品
    $scope.SearchProductList = function () {
        $scope.LoadProductList(1);
    }
    //根据筛选条件模糊查询商品合辑
    $scope.SearchAlbumList = function () {
        $rootScope.R_AlbumKey = $scope.AlbumKey;
        $scope.LoadAlbumList(1);
    }
    //弹出添加主分类模态框
    $scope.ShowAddMainCategoryMoadl = function () {
        $("#maincatmodal").modal('show');
        $scope.MainCategory = { Name: '', Status: 1 };
    }
    var $parent = $scope.$parent;
    $scope.sort = $routeParams.sort;
    if (!$scope.sort) {
        $scope.sort = "product";
    }
    switch ($scope.sort) {
        case 'product':
            $scope.LoadProductList($routeParams.pageIndex || 1);
            $scope.LoadMainCategory();
            if ($scope.Choose_MainCategory) {
                $scope.LoadSubCategory($scope.Choose_MainCategory);
            }
            break;
        case 'album':
            $scope.LoadAlbumList($routeParams.pageIndex || 1);
            break;
        case 'category':
            //分类列表
            $scope.LoadProductCategoryList($routeParams.pageIndex || 1);
            break;
    }
}
function PorductModalCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.AddMainCategory = function (data) {
        if ($scope.AddMainCategoryForm.$valid) {
            $http.post($resturls["AddOwnCustomer"], { name: data.Name, sex: data.Sex, phone: data.Phone, birthday: data.TimeStamp, remark: data.Remark }).success(function (result) {
                $("#addcustomermodal").modal('hide');
                if (result.Error == 0) {
                    $.scojs_message('新增成功', $.scojs_message.TYPE_OK);
                    $scope.loadClientSortList($routeParams.pageIndex || 1, $routeParams.parameters || '');
                    if (choselevel.ID != 0) {
                        $http.post($resturls["SetCustomerRank"], { rank_id: choselevel.ID, from_type: result.from_type, customer_id: result.ID }).success(function (result) {
                            console.log(result);
                        });
                    }
                }
                else {
                    $scope.showerror = true;
                    $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
                }
            })
        } else {

            $scope.showerror = true;
        }
    }
}
