angular.module('gogojp', ['ngRoute', 'ui.router', 'ngRestUrls', 'ngNovComet']).
config(['$provide', '$httpProvider', '$routeProvider', '$stateProvider', '$urlRouterProvider', '$resturls', function ($provide, $httpProvider, $routeProvider, $stateProvider, $urlRouterProvider, $resturls) {
    $routeProvider
    .when('/recommend/:pageIndex?', { template: '', controller: function () { } })
    .when('/product/:sort?/:pageIndex?', { template: '', controller: function () { } })
    .when('/order', { template: '', controller: function () { } })
    .when('/addproduct', { template: '', controller: function () { } })
    .when('/editproduct/:productid', { template: '', controller: function () { } })
    .when('/category/:pageIndex?', { template: '', controller: function () { } })
    .when('/tags/:pageIndex?', { template: '', controller: function () { } })
    .when('/standard/:sort?/:pageIndex?', { template: '', controller: function () { } })
    .when('/addslideshow', { template: '', controller: function () { } })
    .when('/editslideshow/:picid', { template: '', controller: function () { } })
    .when('/addalbum', { template: '', controller: function () { } })
    .when('/editalbum/:album_id', { template: '', controller: function () { } })
    .when('/customerservice', { template: '', controller: function () { } })
    .when('/oitem/:order_no?/:order_time?', { template: '', controller: function () { } })
    .when('/order/:pageIndex?', { template: '', controller: function () { } })
    .when('/customerservice/list/:pageIndex?', { template: '', controller: function () { } })
    .when('/customerservice/chat/:customerId?', { template: '', controller: function () { } })
    .when('/customerservice/histories/:customerId?/:pageIndex?', { template: '', controller: function () { } })
    .otherwise({ redirectTo: '/home' });
    $stateProvider
    .state("main", { url: "", templateUrl: 'partials/menu.html', controller: MenuCtrl })
    .state('main.home', { url: '/home', templateUrl: 'partials/home.html', controller: DataStatisticsCtrl })
    .state('main.recommend', { url: '/recommend*path', templateUrl: 'partials/recommend.html', controller: SlideShowMainCtrl })
    .state('main.addslideshow', { url: '/addslideshow*path', templateUrl: 'partials/recommend/add-slideshow.html', controller: AddSlideShowCtrl })
    .state('main.editslideshow', { url: '/editslideshow*path', templateUrl: 'partials/recommend/edit-slideshow.html', controller: EditSlideShowCtrl })
    .state('main.product', { url: '/product*path', templateUrl: 'partials/product.html', controller: ProductMainCtrl })
    .state('main.category', { url: '/category*path', templateUrl: 'partials/productcategory.html', controller: ProductCategoryCtrl })
    .state('main.tags', { url: '/tags*path', templateUrl: 'partials/producttags.html', controller: ProductTagsCtrl })
    .state('main.productstandard', { url: '/standard*path', templateUrl: 'partials/productstandard.html', controller: ProductStandardCtrl })
    .state('main.addproduct', { url: '/addproduct*path', templateUrl: 'partials/product/add-product.html', controller: AddProductCtrl })
    .state('main.editproduct', { url: '/editproduct*path', templateUrl: 'partials/product/edit-product.html', controller: EditProductCtrl })
    .state('main.addalbum', { url: '/addalbum*path', templateUrl: 'partials/album/add-album.html', controller: AddAlbumCtrl })
    .state('main.editalbum', { url: '/editalbum*path', templateUrl: 'partials/album/edit-album.html', controller: EditAlbumCtrl })
    .state('main.order', { url: '/order*path', templateUrl: 'partials/order.html', controller: OrderCtrl })
    .state('main.orderitem', { url: '/oitem*path', templateUrl: 'partials/orderitem.html', controller: OrderItemCtrl })
    .state('main.customerservice', { url: '/customerservice', templateUrl: 'partials/customerservice.html', controller: ServiceMainCtrl })
    .state('main.customerservice.list', { url: "/list*path", templateUrl: 'partials/service/list.html', controller: ServiceListCtrl })
    .state('main.customerservice.chat', { url: "/chat*path", templateUrl: 'partials/service/chat.html', controller: ServiceChatCtrl })
    .state('main.customerservice.histories', { url: "/histories*path", templateUrl: 'partials/service/histories.html', controller: ServiceHistoriesCtrl });




    $httpProvider.interceptors.push(function () {
        return {
            'response': function (response) {
                if (response && typeof response.data === 'object') {
                    if (response.data.Error == 11) {
                        $.scojs_message('非法访问', $.scojs_message.TYPE_ERROR);
                        setTimeout(function () { window.location.href = 'login.html'; }, 1500);
                    }
                }
                return response || $q.when(response);
            }
        };
    });
}])
    .value('$anchorScroll', angular.noop)
    .run(
      ['$rootScope', '$state', '$stateParams',
      function ($rootScope, $state, $stateParams) {
          $rootScope.$state = $state;
          $rootScope.$stateParams = $stateParams;
      }]);;

function MainCtrl($scope, $routeParams, $http, $location, $filter, $resturls, $novcomet) {
    $novcomet.stop();
    $scope.LoginOut = function () {
        $http.post($resturls["LoginOut"], {}).success(function (result) {
            if (result.Error == 0) {
                window.location.href = "login.html";
            } else {
                $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
            }
        })
    };
    $scope.currentuser = null;
    //登录
    $http.post($resturls["GetCurrentUser"], {}).success(function (result) {
        if (result.Error == 0) {
            if (result.Data.length > 0) {
                $scope.currentuser = result.Data[0];
            }
        } else {
            $scope.currentuser = {};
        }
    });
    // unix时间戳转化为 eg:'2014-04-08'
    $scope.timestamptostr = function (timestamp) {
        timestamp = timestamp + "";
        if (timestamp.indexOf('-') == -1) {
            var month = 0;
            var day = 0;
            if (timestamp) {
                var unixTimestamp = new Date(timestamp * 1000);
                month = (unixTimestamp.getMonth() + 1);
                day = unixTimestamp.getDate();
                if (unixTimestamp.getMonth() < 9) {
                    month = "0" + month;
                }
                if (unixTimestamp.getDate() < 9) {
                    day = '0' + day;
                }
                var str = unixTimestamp.getFullYear() + '-' + month + '-' + day;
                return str;
            } else {
                return "";
            }
        } else {
            return timestamp;
        }
    }

    // 时间格式字符串 ey:'2014-04-08'转化为unix时间戳
    $scope.strtotimestamp = function (datestr) {
        var arr = datestr.split("-");
        var timestap = new Date(Date.UTC(arr[0], arr[1] - 1, arr[2])).getTime() / 1000;
        return timestap;
    }
    //删除字符串末尾空格和指定字符
    $scope.trimEnd = function (temp, str) {
        if (!str) { return temp; }
        while (true) {
            if (temp.substr(temp.length - str.length, str.length) != str) {
                break;
            }
            temp = temp.substr(0, temp.length - str.length);
        }
        return temp;
    }
    //转化手机号 ey:13458680566 为 134*****566
    $scope.ModifiedPhoneNum = function (str) {
        if (str) {
            if (str.length == 11) {
                var mphone = str.substr(3, 5);
                var phone = str.replace(mphone, "*****");
                return phone;
            }
            else {
                return str;
            }
        } else {
            return '';
        }
    }
    $scope.RefreshModal = function () {
        window.location.reload();
    }
    $scope.CancelProduct = function () {
        window.location.href = "#/product";
    }
    $scope.CancelAlbum = function () {
        window.location.href = "#/product/album/";
    }
    $scope.CancelSlideShow = function () {
        window.location.href = "#/recommend";
    }
    
}

//菜单初始化化下拉
function MenuCtrl($scope) {
    $(".sidebar .treeview").tree();
}
