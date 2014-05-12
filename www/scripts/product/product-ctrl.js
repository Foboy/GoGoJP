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
    }
    $scope.AddProduct = function () {
        window.location.href = '#/addproduct';
    }

}
function PorductModalCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    //添加主分类
    $scope.AddMainCategory = function (data) {
        if ($scope.AddMainCategoryForm.$valid) {
            $http.post($resturls["AddCategory"], { cat_name: data.Name, parent_id: 0, status: data.Status, level: data.level }).success(function (result) {
                $("#maincatmodal").modal('hide');
                if (result.Error == 0) {
                    $scope.LoadProductCategoryList(1);
                    $.scojs_message('新增成功', $.scojs_message.TYPE_OK);
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
    //添加子分类
    $scope.AddSubCategory = function (data) {
        if ($scope.AddSubCategoryForm.$valid) {
            $http.post($resturls["AddCategory"], { cat_name: data.Name, parent_id: data.ParentId, status: data.Status, level: data.level }).success(function (result) {
                $("#subcatmodal").modal('hide');
                if (result.Error == 0) {
                    $scope.LoadProductCategoryList(1);
                    $.scojs_message('新增成功', $.scojs_message.TYPE_OK);
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
    //编辑分类
    $scope.EidtCategory = function (data) {
        if ($scope.EditCategoryForm.$valid) {
            $http.post($resturls["EditCategory"], { catid: data.catid, cat_name: data.cat_name, status: data.status }).success(function (result) {
                $("#editcatmodal").modal('hide');
                if (result.Error == 0) {
                    $scope.LoadProductCategoryList(1);
                    $.scojs_message('编辑成功', $.scojs_message.TYPE_OK);
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
function ProductCategoryCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    //商品类别
    $scope.LoadProductCategoryList = function (pageIndex) {
        var $parent = $scope.$parent;
        var pageSize = 15;
        if (pageIndex == 0) pageIndex = 1;
        $http.post($resturls["LoadProdcutCategory"], { pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
            if (result.Error == 0) {
                $scope.ProdcutCategorys = result.Data;
                $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#category/' + '{0}');
            } else {
                $scope.gogoclients = [];
                $parent.ProdcutCategorys = utilities.paging(0, pageIndex, pageSize);
            }
        });
    }
    //弹出添加主分类模态框
    $scope.ShowAddMainCategoryMoadl = function () {
        $("#maincatmodal").modal('show');
        $scope.MainCategory = { Name: '', Status: 1, level: 0 };
    }
    //弹出添加子类模态框
    $scope.ShowAddSubCategoryModal = function (data) {
        $("#subcatmodal").modal('show');
        $scope.ParentCategoryName = data.cat_name;
        $scope.SubCategory = { Name: '', Status: 1, ParentId: data.catid, level: data.level };
    }
    //弹出编辑类别模态框
    $scope.ShowEditCategoryModal = function (data) {
        $("#editcatmodal").modal('show');
        $scope.Categroy = data;
    }
    $scope.LoadProductCategoryList($routeParams.pageIndex || 1);
    $scope.CatNameFormat = function (data) {
        var str = '';
        if (data != null) {
            str = '|-';
            for (var i = 1; i < data.level; i++) {
                str = str + '|-';
            }
            str = str + data.cat_name;
        }
        return str;
    }
}

function AddProductCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.OpenWindow = function (url, name, iWidth, iHeight) {
        var url = 'partials/product/product-preview.html';  //转向网页的地址;
        var name;                           //网页名称，可为空;
        var iWidth = '200';                         //弹出窗口的宽度;
        var iHeight = '200';                      //弹出窗口的高度;
        var iTop = (window.screen.availHeight - 30 - iHeight) / 2;       //获得窗口的垂直位置;
        var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;           //获得窗口的水平位置;
        window.open(url, name, 'height=' + iHeight + ',,innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
    }

}

