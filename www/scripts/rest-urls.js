/*
**  Create by foboy.cray
**  2014/03/25
*/
(function (window, angular, undefined) {
    'use strict';
    angular.module('ngRestUrls', ['ng']).
      config(['$provide', function ($provide) {
          var resturls = {};
          resturls.base = "/index.php";
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

          // 产品模块（产品，产品合辑，产品分类）
          resturls.add("LoadProdcut", "Home/Product/searchProductByCondition");//根据筛选条件分页查询商品列表
          resturls.add("LoadProdcutAlbum", "Home/Album/searchAlbumByCondition");//根据筛选条件分页插叙商品专辑列表
          resturls.add("LoadProdcutCategory", "Home/ProductCategory/searchProductCategory");//分页查询分类列表(包括上下级关系)
          resturls.add("LoadMainCategory", "Home/ProductCategory/searchMainCategory");/* 获取主分类列表信息 */
          resturls.add("LoadSubCategory", "Home/ProductCategory/searchSubcategory");//根据主类id获取子分类
          resturls.add("AddCategory", "Home/ProductCategory/addProductCategory");//添加分类
          resturls.add("EditCategory", "Home/ProductCategory/updateProductCategory");//编辑分类
          
          // 订单模块
          resturls.add("LoadOrder", "Home/Order/searchOrder");//查询订单
          
          $provide.constant('$resturls', resturls);

      } ]);
})(window, window.angular);