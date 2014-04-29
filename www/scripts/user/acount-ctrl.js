function AcountCtrl($scope, $http, $location, $routeParams, $resturls) {
    var $parent = $scope.$parent;
    $scope.sorts = $routeParams.sorts;
    if (!$scope.sorts) {
        $scope.sorts = "clerk";
    }
    //账户列表
    $scope.loadUserAccountSortList = function (pageIndex) {
        var pageSize = 1;
        if (pageIndex == 0) pageIndex = 1;
        
        $http.post($resturls["LoadUserAccountList"], { name: '', pageindex: pageIndex - 1, pagesize: pageSize, user_type: 5 }).success(function (result) {
            if (result.Error == 0) {
                $scope.clerks = result.Data;
                $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#permissions/' + $scope.sorts + '/{0}');
            } else {
                $scope.clerks = [];
                $parent.pages = utilities.paging(0, pageIndex, pageSize);
            }
        });
    }
    //账户列表数据出初始化
    $scope.loadUserAccountSortList($routeParams.pageIndex || 1);
    //弹出添加或编辑用户账号窗口
    $scope.ShowAddUserAccountModal = function (data, usertype) {
        console.log(data);
        if (data) {
            $scope.UserAccount = data;
        } else {
            $scope.UserAccount = { user_id: 0, Type: usertype };
        }
        $("#AddUsermodal").modal("show");

    }
    //弹出修改用户账号密码窗口
    $scope.ShowRestUserAccountPwdModal = function (data) {
        $scope.UserInfo = data;
        $("#RestPwdModal").modal("show");
    }
    //启用禁用用户 1 启用 0禁用
    $scope.UpdateUserState = function (data) {
        data.State = data.State == 1 ? 2 : 1;
        $http.post($resturls["UpdateUserState"], { user_id: data.ID, state: data.State }).success(function (result) {
            if (result.Error == 0) {
                alert(result.ErrorMessage);
                $scope.loadUserAccountSortList($routeParams.pageIndex || 1);
            }
            else {
                alert(result.ErrorMessage);
                $scope.loadUserAccountSortList($routeParams.pageIndex || 1);
            }
        });
    }
}

function AddUserAccountCtrl($scope, $http, $location, $routeParams, $resturls) {
    //添加账户
    $scope.AddUserAccount = function (data) {
        if ($scope.AddUserAccountForm.$valid) {
            $scope.showerror = false;
            $http.post($resturls["AddUserAccount"], { user_type: 5, user_name: data.Name, user_account: data.Account, user_password_new: data.Password, user_password_repeat: data.Password }).success(function (result) {
                if (result.Error == 0) {
                    alert("success");
                    $scope.loadUserAccountSortList($routeParams.pageIndex || 1);
                    $("#AddUsermodal").modal("hide");
                } else {
                    alert(result.ErrorMessage);
                    $scope.showerror = true;
                }
            });
        } else {
            $scope.showerror = true;
        }
    }
    //编辑用户账号
    $scope.EditUserAccount = function (data) {
        if ($scope.AddUserAccountForm.$valid) {
            $scope.showerror = false;
            $http.post($resturls["UpdateUserAccount"], { user_type: 5, user_name: data.Name, user_account: data.Account, user_password_new: data.Password, user_password_repeat: data.Password }).success(function (result) {
                if (result.Error == 0) {
                    alert("success");
                    $scope.loadUserAccountSortList($routeParams.pageIndex || 1);
                    $("#AddUsermodal").modal("hide");
                } else {
                    alert(result.ErrorMessage);
                    $scope.showerror = true;
                }
            });
        } else {
            $scope.showerror = true;
        }
    }
};
//修改密码
function RestPasswordCtrl($scope, $http, $location, $routeParams, $resturls) {
    $scope.RestPassword = function (data) {
        console.log(data);
        if ($scope.RestPasswordForm.$valid) {
            $scope.showerror = false;
            $http.post($resturls["RestPassword"], { user_id: data.ID, user_password_new: data.NewPassword, user_password_repeat: data.NewPassword }).success(function (result) {
                if (result.Error == 0) {
                    alert("success"); 
                    $("#RestPwdModal").modal("hide");
                } else {
                    alert("e");
                    $scope.showerror = true;
                }
            });
        } else {
            $scope.showerror = true;
        }
    }
};