angular.module('gogojp', ['ngRoute', 'ui.router', 'ngRestUrls']).
config(['$provide', '$httpProvider', '$routeProvider', '$stateProvider', '$urlRouterProvider', '$resturls', function ($provide, $httpProvider, $routeProvider, $stateProvider, $urlRouterProvider, $resturls) {
    $routeProvider
    .when('/recommend', { template: '', controller: function () { } })
    .when('/product/:sort?/:pageIndex?', { template: '', controller: function () { } })
    .when('/order', { template: '', controller: function () { } })
    .when('/addproduct', { template: '', controller: function () { } })
    .when('/editproduct/:prodcutid', { template: '', controller: function () { } })
    .when('/customerservice', { template: '', controller: function () { } })
    .when('/oitem/:order_no?/:order_time?', { template: '', controller: function () { } })
    .when('/order/:pageIndex?', { template: '', controller: function () { } })
    .when('/customerservice/list/:pageIndex?', { template: '', controller: function () { } })
    .when('/customerservice/chat/:customerId?', { template: '', controller: function () { } })
    .when('/customerservice/histories/:customerId?', { template: '', controller: function () { } })
    .otherwise({ redirectTo: '/home' });
    $stateProvider
         .state("main", { url: "", templateUrl: 'partials/menu.html', controller: MenuCtrl })
         .state('main.home', { url: '/home', templateUrl: 'partials/home.html', controller: DataStatisticsCtrl })
         .state('main.recommend', { url: '/recommend*path', templateUrl: 'partials/recommend.html', controller: function () { } })
         .state('main.product', { url: '/product*path', templateUrl: 'partials/product.html', controller: ProductMainCtrl })
         .state('main.addproduct', { url: '/addproduct*path', templateUrl: 'partials/product/add-product.html', controller: function () { } })
         .state('main.editproduct', { url: '/editproduct*path', templateUrl: 'partials/product/edit.html', controller: function () { } })
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

function MainCtrl($scope, $routeParams, $http, $location, $filter, $resturls) {
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
    	timestamp = timestamp+"";
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
}

//菜单初始化化下拉
function MenuCtrl($scope) {
    $(".sidebar .treeview").tree();
}
