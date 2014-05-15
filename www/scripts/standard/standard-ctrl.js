//商品规格参数
function ProductStandardCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    var $parent = $scope.$parent;
    $scope.LoadStandardAboutSizeList = function (pageIndex) {
        var pageSize = 1;
        if (pageIndex == 0) pageIndex = 1;
        $http.post($resturls['searchCategoryByStandardId'], { standard_id: 1, pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
            if (result.Error == 0) {
                if (angular.isArray(result.Data)) {
                    for (var i = 0; i < result.Data.length; i++) {
                        $scope.ShowParamters(result.Data[i]);
                    }
                }
                $scope.SizeCategorys = result.Data;
                $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#standard/' + $scope.sort + '/{0}');
            } else {
                $scope.SizeCategorys = [];
                $parent.pages = utilities.paging(0, pageIndex, pageSize);
            }
        });
    }
    $scope.ShowParamters = function (data) {
        data.DisableParamters = '';
        data.IsableParamters = '';
        $http.post($resturls['searchParamterBySidAndCatid'], { standard_id: standard_id, category_id: data.catid }).success(function (result) {
            if (result.Error == 0) {
                if (result.Data) {
                    for (var i = 0; i < result.Data.length; i++) {
                        if (result.Data[i].parameter_status == 1) {
                            data.IsableParamters += result.Data[i].parameter_name + '　';
                        } else {
                            data.DisableParamters += result.Data[i].parameter_name + '　';
                        }
                    }
                }
            } else {
                data.DisableParamters = '';
                data.IsableParamters = '';
            }
        });
    }
    $scope.LoadStandardAboutColorList = function () {
        $scope.DisableColorParamtersFormat = '';
        $scope.IsableColorParamtersFormat = '';
        $http.post($resturls['searchParamterBySid'], { standard_id: standard_id }).success(function (result) {
            if (result.Error == 0) {
                $scope.ColorParamters=result.Data;
                if (angular.isArray(result.Data)) {
                    for (var i = 0; i < result.Data.length; i++) {
                        if (result.Data[i].parameter_status == 1) {
                            $scope.IsableColorParamtersFormat += result.Data[i].parameter_name + '　';
                        } else {
                            $scope.DisableColorParamtersFormat += result.Data[i].parameter_name + '　';
                        }
                    }
                } else {
                    $scope.DisableColorParamtersFormat = '';
                    $scope.IsableColorParamtersFormat = '';
                }
            } else {
                $scope.ColorParamters = [];
            }
        });
    }
    $scope.GetParamters = function (data) {
        $http.post($resturls['searchParamterBySidAndCatid'], { standard_id: data.standard_id, category_id: data.catid }).success(function (result) {
            if (result.Error == 0) {
                $scope.Paramters = result.Data;
                if (result.Data) {
                    for (var i = 0; i < result.Data.length; i++) {
                        Paramters = result.Data[i];
                    }
                }
            } else {
                $scope.Paramters = [];
            }
        });
    }
    var standard_id = 0;
    $scope.sort = $routeParams.sort;
    if (!$scope.sort) {
        $scope.sort = "size";
        standard_id = 1;
    }
    switch ($scope.sort) {
        case 'size':
            standard_id = 1;
            $scope.LoadStandardAboutSizeList($routeParams.pageIndex || 1);
            break;
        case 'color':
            standard_id = 2;
            $scope.LoadStandardAboutColorList();
            break;
    }
    //添加尺寸参数模态框
    $scope.AddSizeStandardModal = function () {
        $("#addsizemodal").modal('show');
        //获取主类
        $http.post($resturls["LoadMainCategory"], {}).success(function (result) {
            if (result.Error == 0) {
                $scope.MainCategorys = result.Data;
            } else {
                $scope.MainCategorys = [];
            }
        });
    }
}
function AddProductStandardCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.ParameterMarks = [];
    $scope.show = function (data) {
        console.log(data);
    }
    //添加规格参数标签（并未保存到数据库）
    $scope.AddStandardParameterMark = function (ParamerterName) {
        $scope.ParameterMarks.push({ name: ParamerterName, id: Math.random() });
    }
    $scope.DeleteStandardParameterMark = function (ParameterMark) {
        var marks = [];
        for (var i = 0; i < $scope.ParameterMarks.length; i++)
        {
            if (ParameterMark.id != $scope.ParameterMarks[i].id)
            {
                marks.push($scope.ParameterMarks[i]);
            }
        }
        $scope.ParameterMarks = marks;
    }
    $scope.AddSizeStandard = function (data) {

    }
    $scope.AddColorStandard = function (data) {
    }

}