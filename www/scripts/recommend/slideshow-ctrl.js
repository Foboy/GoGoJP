//幻灯片
function SlideShowMainCtrl($scope, $http, $location, $routeParams, $resturls) {
    var $parent = $scope.$parent;
    $scope.LoadSlideShow = function (pageIndex) {
        var pageSize = 10;
        if (pageIndex == 0) pageIndex = 1;
        var AlbumKey = '';
        if ($scope.AlbumKey) {
            AlbumKey = $scope.AlbumKey
        }
        $http.post($resturls["LoadSlideShow"], { pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
            if (result.Error == 0) {
                $scope.SlideShows = result.Data;
                $parent.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#recommend' + '/{0}');
            } else {
                $scope.SlideShow = [];
                $parent.pages = utilities.paging(0, pageIndex, pageSize);
            }
        });
    }
    $scope.LoadSlideShow($routeParams.pageIndex || 1);

}