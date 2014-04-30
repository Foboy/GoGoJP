function UserMainCtrl($scope, $http, $location, $routeParams, $resturls) {
    $scope.UserLogin = function (User) {
        if ($scope.LoginForm.$valid) {
            $scope.showerror = false;
            $http.post($resturls["Login"], { user_name: User.user_name, password: User.password }).success(function (result) {
                console.log(result);
            }).error(function (data, status, headers, config) {
                alert(result.ErrorMessage);
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



