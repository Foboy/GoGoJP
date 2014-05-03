function UserMainCtrl($scope, $http, $location, $routeParams, $resturls) {
    $scope.UserLogin = function () {
        if ($scope.LoginForm.$valid) {
            $scope.showerror = false;
            $http.post($resturls["Login"], { user_name: $scope.User.user_name, password: $scope.User.password }).success(function (result) {
                if (result.Error == 0) {
                    window.location.href = 'index.html';
                }
            }).error(function (data, status, headers, config) {
                $.scojs_message('登录账户或密码错误', $.scojs_message.TYPE_ERROR);
            })
        } else {
            $scope.showerror = true;
        }
    }
    $(document).keyup(function (e) {
        if (e.keyCode == 13) {
            $scope.$apply(function () {
                $scope.UserLogin();
            });
        }
    });
}



