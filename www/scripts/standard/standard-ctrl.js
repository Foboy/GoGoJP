//商品规格参数
function ProductStandardCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    var $parent = $scope.$parent;
    $scope.LoadStandardAboutSizeList = function (pageIndex) {
        var pageSize = 20;
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
                $scope.ColorParamters = result.Data;
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
    // 根据规格id和分类id查询参数值
    $scope.SearchParamterBySidAndCatid = function (standard_id, data) {
        $http.post($resturls['searchParamterBySidAndCatid'], { standard_id: standard_id, category_id: data.catid }).success(function (result) {
            if (result.Error == 0) {
                $scope.Parameters = result.Data;
            } else {
                $scope.Parameters = [];
            }
        });
    }
    //根据规格id查询参数值
    $scope.SearchParamterBySid = function (standard_id) {
        $http.post($resturls['searchParamterBySid'], { standard_id: standard_id }).success(function (result) {
            if (result.Error == 0) {
                $scope.Parameters = result.Data;
            } else {
                $scope.Parameters = [];
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
    //添加颜色参数模态框
    $scope.AddColorStandardModal = function () {
        $("#addcolormodal").modal('show');
    }
    //编辑规格参数模态框
    $scope.EditStandardParamterModal = function (data) {
        $scope.kind = standard_id;
        switch (standard_id) {
            case 1:
                $scope.SearchParamterBySidAndCatid(standard_id, data);
                break;
            case 2:
                $scope.SearchParamterBySid(standard_id);
                break;
        }
        $("#editparmodal").modal('show');
    }
}
function AddProductStandardCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.ParameterMarks = [];
    //添加规格参数标签（并未保存到数据库）
    $scope.AddStandardParameterMark = function (ParamerterName) {
        $scope.ParameterMarks.push({ name: ParamerterName, id: Math.random() });
    }
    //删除规格参数标签（并未保存到数据库）
    $scope.DeleteStandardParameterMark = function (ParameterMark) {
        var marks = [];
        for (var i = 0; i < $scope.ParameterMarks.length; i++) {
            if (ParameterMark.id != $scope.ParameterMarks[i].id) {
                marks.push($scope.ParameterMarks[i]);
            }
        }
        $scope.ParameterMarks = marks;
    }
    //添加尺寸分类规格参数
    $scope.AddSizeStandard = function (catitem, parameterArray) {
        var parameter_names = '';
        if ($scope.AddSizeStandardForm.$valid) {
            $scope.showerror = false;
            if (parameterArray.length > 0) {
                if (angular.isArray(parameterArray)) {
                    for (var i = 0; i < parameterArray.length; i++) {
                        parameter_names = parameter_names + parameterArray[i].name + ',';
                    }
                    parameter_names = $scope.trimEnd(parameter_names, ',');
                    $http.post($resturls["AddCatagoryStandardParameters"], { standard_id: 1, category_id: catitem.catid, parameter_names: parameter_names }).success(function (result) {
                        if (result.Error == 0) {
                            $("#addsizemodal").modal('hide');
                            $.scojs_message('新增成功', $.scojs_message.TYPE_OK);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            $scope.showerror = true;
                            $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
                        }
                    });
                }
            } else {
                $.scojs_message('请添加参数', $.scojs_message.TYPE_ERROR);
            }
        }
        else {
            $scope.showerror = true;
        }
    }
    //添加颜色规格参数
    $scope.AddColorStandard = function (parameterArray) {
        var parameter_names = '';
        if (parameterArray.length > 0) {
            if (angular.isArray(parameterArray)) {
                for (var i = 0; i < parameterArray.length; i++) {
                    parameter_names = parameter_names + parameterArray[i].name + ',';
                }
                parameter_names = $scope.trimEnd(parameter_names, ',');
                $http.post($resturls["AddCommonStandardParameters"], { standard_id: 2, parameter_names: parameter_names }).success(function (result) {
                    if (result.Error == 0) {
                        $("#addcolormodal").modal('hide');
                        $.scojs_message('新增成功', $.scojs_message.TYPE_OK);
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {

                        $scope.showerror = true;
                        $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
                    }
                });
            }
        } else {
            $.scojs_message('请添加参数', $.scojs_message.TYPE_ERROR);
        }
    }
    //改变参数禁用启用状态
    $scope.ChangeStandardParameterSatus = function (data) {
        if (data.parameter_status == 1) {
            data.parameter_status = 2
        } else {
            data.parameter_status = 1;
        }
    }
    //批量更新规格参数状态
    $scope.UpdateStandardParameterStatus = function (dataArray, kind) {
        var parameter_ids = '';
        var parameter_statuses = '';
        if (angular.isArray(dataArray)) {
            for (var i = 0; i < dataArray.length; i++) {
                parameter_statuses = parameter_statuses + dataArray[i].parameter_status + ',';
                parameter_ids = parameter_ids + dataArray[i].standard_parameter_id + ',';

            }
            parameter_statuses = $scope.trimEnd(parameter_statuses, ',');
            parameter_ids = $scope.trimEnd(parameter_ids, ',');
            $http.post($resturls["UpdateStandardParameterStatus"], { standard_parameter_ids: parameter_ids, parameter_statuses: parameter_statuses }).success(function (result) {
                if (result.Error == 0) {
                    $("#editparmodal").modal('hide');
                    if (kind == 1) {
                        $scope.LoadStandardAboutSizeList($routeParams.pageIndex || 1);
                    } else {
                        $scope.LoadStandardAboutColorList();
                    }
                    $.scojs_message('编辑成功', $.scojs_message.TYPE_OK);
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                } else {
                    $scope.showerror = true;
                    $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
                }
            });
        }
    }

}