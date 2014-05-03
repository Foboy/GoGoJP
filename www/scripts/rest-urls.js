/*
**  Create by foboy.cray
**  2014/03/25
*/
(function (window, angular, undefined) {
    'use strict';
    angular.module('ngRestUrls', ['ng']).
      config(['$provide', function ($provide) {
          var resturls = {};
          resturls.base = "http://localhost:8080/GoGoJP/index.php";
         // resturls.base="http://118.122.112.187:3333/GoGoJP/index.php";
          resturls.add = function (name, url) {
              resturls[name] = resturls.base + "?url=" + url;
          };
          resturls.addpage = function (name, url) {
              resturls[name] = resturls.base + url;
          };
          // 主模块
          resturls.add("GetCurrentUser", "Home/Index/getCurrentUser");
          resturls.add("Login", "Home/Index/login");//登录
          resturls.add("LoginOut", "Home/Index/loginOut");//退出登录
          $provide.constant('$resturls', resturls);

      } ]);
})(window, window.angular);