/*
**  Create by foboy.cray
**  2014/03/25
*/
(function (window, angular, undefined) {
    'use strict';
    angular.module('ngRestUrls', ['ng']).
      config(['$provide', function ($provide) {
          var resturls = {};
          resturls.base = "/GoGoJP/index.php";
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

          //客户咨询
          resturls.add("ChatList", "Home/Chat/chatList");//咨询列表
          resturls.add("MessageList", "Home/Chat/messageList");
          resturls.add("AdvisoryReply", "Home/Chat/advisoryReply");
          resturls.add("AdvisoryObserve", "Home/Chat/advisoryObserve"); 
          resturls.add("GetChatCustomer", "Home/Chat/getCustomer");

          // 产品模块（产品，产品合辑，产品分类,产品标签）
          resturls.add("LoadProdcut", "Home/Product/searchProductByCondition");//根据筛选条件分页查询商品列表
          resturls.add("LoadProdcutAlbum", "Home/Album/searchAlbumByCondition");//根据筛选条件分页插叙商品专辑列表
          resturls.add("LoadProdcutCategory", "Home/ProductCategory/searchProductCategory");//分页查询分类列表(包括上下级关系)
          resturls.add("LoadMainCategory", "Home/ProductCategory/searchMainCategory");/* 获取主分类列表信息 */
          resturls.add("LoadSubCategory", "Home/ProductCategory/searchSubcategory");//根据主类id获取子分类
          resturls.add("AddCategory", "Home/ProductCategory/addProductCategory");//添加分类
          resturls.add("EditCategory", "Home/ProductCategory/updateProductCategory");//编辑分类
          resturls.add("AddProduct", "Home/Product/addProduct");//增加商品
          resturls.add("UpLoadImage", "Home/PictureManagement/upLoadImage");//上传图片
          resturls.add("LoadTags", "Home/Tags/searchTags");//分页查询标签
          resturls.add("AddTags", "Home/Tags/addTags");//新增标签
          resturls.add("EditTags", "Home/Tags/updateTags");//编辑标签
          resturls.add("DeleteTags", "Home/Tags/deleteTags");//删除标签

          //推荐位
          resturls.add("AddSlideShow", "Home/PictureManagement/addSlideShow");//新增幻灯片
          resturls.add("EditSlideShow", "Home/PictureManagement/updateSlideShow");//编辑幻灯片
          resturls.add("LoadSlideShow", "Home/PictureManagement/searchSlideShow");//分页查询幻灯片列表
          resturls.add("DeleteSlideShow", "Home/PictureManagement/deleteSlideShow");//删除幻灯片
          resturls.add("IsTopSlideShow", "Home/PictureManagement/isTopSlideShow");//置顶或取消置顶幻灯片



          
          
          // 订单模块
          resturls.add("LoadOrder", "Home/Order/searchOrder");//查询订单
          resturls.add("getOrder", "Home/Order/getOrder");//获取单个订单
          resturls.add("searchOrderItem", "Home/Order/searchOrderItem");//查询订单
          resturls.add("updateOrderStatus", "Home/Order/updateOrderStatus");//修改订单状态
          resturls.add("updateLogisticsStatus", "Home/Order/updateLogisticsStatus");//修改物流状态
          
          $provide.constant('$resturls', resturls);

      } ]);
})(window, window.angular);