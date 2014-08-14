//添加合辑
function AddAlbumCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.Products = [];
    $scope.ChooseProducts = [];
    $scope.InitEditor = function () {
        $scope.um = UM.createEditor('myEditor');
    }
    //标签
    $scope.LoadTags = function () {
        $http.post($resturls["LoadTags"], { pageIndex: 0, pageSize: 50 }).success(function (result) {
            if (result.Error == 0) {
                $scope.ProductTags = result.Data;
            } else {
                $scope.ProductTags = [];
            }
        });
    }
    $scope.FuzzySearchPrduct = function (ProductKey) {
        $http.post($resturls["LoadProdcut"], { keyname: ProductKey, pageIndex: 0, pageSize: 20 }).success(function (result) {
            if (result.Error == 0) {
                $scope.Products = result.Data;
            } else {
                $scope.Products = [];
            }
        });
    }
    $scope.UpLoadImage = function () {
        $('#file_upload').uploadify({
            'swf': 'js/plugins/uploadify/uploadify.swf',
            'uploader': $resturls['UpLoadImage'],
            'buttonText': '上传',
            'width': 60,
            'height': 40,
            'buttonClass': 'btn btn-success btn-flat',
            'fileSizeLimit': '2048kB',
            'fileTypeExts': '*.jpg;*.gif;*.png',
            'fileTypeDesc': 'Web Image Files (.JPG, .GIF, .PNG)',
            onUploadSuccess: function (fileObj, data, response) {
                var result = $.parseJSON(data);
                if (result.status == 1) {
                    $.scojs_message('上传完成!', $.scojs_message.TYPE_OK);
                    $("#imagezone").attr('src', $.trim(result.data.uploadResult.url));
                } else {
                    $.scojs_message('服务器忙，请稍后重试!', $.scojs_message.TYPE_ERROR);
                }
            },
            onSelectError: function (file, errorCode, errorMsg) {
                switch (errorCode) {
                    case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                        $.scojs_message('上传文件不能超过2MB', $.scojs_message.TYPE_ERROR);
                        break;
                    case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                        $.scojs_message('不能上传空文件', $.scojs_message.TYPE_ERROR);
                        break;
                }
            }
        });
    }
    $scope.toggle = function (product) {
        product.checked = !product.checked;
    }
    $scope.BindProduct = function (Product) {
        var flag = true;
        for (var i = 0; i <$scope.ChooseProducts.length; i++) {
            if ($scope.ChooseProducts[i].product_num == Product.product_num)
            {
                flag = false;
                $.scojs_message('该商品已添加,请选择其他商品', $.scojs_message.TYPE_ERROR);
            }
        }
        if (flag) {
            $scope.ChooseProducts.push(Product);
        }
    }
    $scope.UnBindProduct = function (Product) {
        var array = [];
        for (var i = 0; i < $scope.ChooseProducts.length; i++) {
            if ($scope.ChooseProducts[i].product_num != Product.product_num) {
                array.push($scope.ChooseProducts[i]);
            }
        }
        $scope.ChooseProducts = array;
    }
    $scope.AddAlbum = function (data) {
        if ($scope.AddAlbumForm.$valid) {
            var productids = '';
            for (var i = 0; i < $scope.ChooseProducts.length; i++) {
                productids = productids + $scope.ChooseProducts[i].productid + ',';
            }
            if (productids == "") {
                $.scojs_message('请选择商品', $.scojs_message.TYPE_ERROR);
                return;
            }
            $scope.showerror = false;
            $http.post($resturls["AddAlbum"], { album_name: data.album_name, album_cover: $("#imagezone").attr("src"), album_description: $scope.um.getContent(), productids: productids, tagid: $scope.tagitem.tag_id }).success(function (result) {
                if (result.Error == 0) {
                    $.scojs_message('新增成功', $.scojs_message.TYPE_OK);
                    setTimeout(function () {
                        window.location.href = "#/product/album";
                    }, 2000);
                }
                else {
                    $scope.showerror = true;
                    $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
                }
            })
        } else {
            $scope.showerror = true;
        }
    }
    $scope.UpLoadImage();
    $scope.InitEditor();
    $scope.LoadTags();
}
//编辑合辑
function EditAlbumCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.Products = [];
    $scope.ChooseProducts = [];
    $scope.AlbumProducts = [];
    //标签
    $scope.LoadTags = function () {
        $http.post($resturls["LoadTags"], { pageIndex: 0, pageSize: 50 }).success(function (result) {
            if (result.Error == 0) {
                $scope.ProductTags = result.Data;
            } else {
                $scope.ProductTags = [];
            }
        });
    }
    $scope.FuzzySearchPrduct = function (ProductKey) {
        $http.post($resturls["LoadProdcut"], { keyname: ProductKey, pageIndex: 0, pageSize: 20 }).success(function (result) {
            if (result.Error == 0) {
                $scope.Products = result.Data;
            } else {
                $scope.Products = [];
            }
        });
    }
    $scope.UpLoadImage = function () {
        $('#file_upload').uploadify({
            'swf': 'js/plugins/uploadify/uploadify.swf',
            'uploader': $resturls['UpLoadImage'],
            'buttonText': '上传',
            'width': 60,
            'height': 40,
            'buttonClass': 'btn btn-success btn-flat',
            'fileSizeLimit': '2048kB',
            'fileTypeExts': '*.jpg;*.gif;*.png',
            'fileTypeDesc': 'Web Image Files (.JPG, .GIF, .PNG)',
            onUploadSuccess: function (fileObj, data, response) {
                var result = $.parseJSON(data);
                if (result.status == 1) {
                    $.scojs_message('上传完成!', $.scojs_message.TYPE_OK);
                    $("#imagezone").attr('src', $.trim(result.data.uploadResult.url));
                } else {
                    $.scojs_message('服务器忙，请稍后重试!', $.scojs_message.TYPE_ERROR);
                }
            },
            onSelectError: function (file, errorCode, errorMsg) {
                switch (errorCode) {
                    case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                        $.scojs_message('上传文件不能超过2MB', $.scojs_message.TYPE_ERROR);
                        break;
                    case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                        $.scojs_message('不能上传空文件', $.scojs_message.TYPE_ERROR);
                        break;
                }
            }
        });
    }
    //获取合辑详细
    $scope.GetAlbum = function () {
        $http.post($resturls["GetAlbum"], { album_id: $routeParams.album_id }).success(function (result) {
            if (result.Error == 0) {
                $scope.Album = result.Data;
                $scope.um = UM.createEditor('myEditor');
                $("#imagezone").attr("src", $scope.Album.album_cover);
                $http.post($resturls["LoadTags"], { pageIndex: 0, pageSize: 50 }).success(function (resultTags) {
                    if (resultTags.Error == 0) {
                        $scope.ProductTags = resultTags.Data;
                        for (var i = 0; i < $scope.ProductTags.length; i++) {
                            if ($scope.Album.album_tag_id == $scope.ProductTags[i].tag_id) {
                                $scope.tagitem = $scope.ProductTags[i];
                            }
                        }
                    } else {
                        $scope.ProductTags = [];
                    }
                });
                $scope.um.setContent($scope.Album.album_description);
                $http.post($resturls["LoadProdcut"], { pageIndex: 0, pageSize: 100 }).success(function (presult) {
                    if (presult.Error == 0) {
                        $http.post($resturls["SearchAlbumProductByAlbumId"], { album_id: $scope.Album.album_id }).success(function (aresult) {
                            if (aresult.Error == 0 && aresult.Data != null) {
                                $scope.AlbumProducts = aresult.Data;
                                for (var i = 0; i < presult.Data.length; i++) {
                                    for (var j = 0; j < $scope.AlbumProducts.length; j++) {
                                        if (presult.Data[i].productid == $scope.AlbumProducts[j].product_id) {
                                            $scope.AlbumProducts[j].product_name = presult.Data[i].product_name;
                                            $scope.AlbumProducts[j].product_num = presult.Data[i].product_num;
                                        }
                                    }
                                }
                            } else {
                                $scope.AlbumProducts = [];
                            }
                        });
                    } else {
                        $scope.Products = [];
                    }
                });
            } else {
                $scope.Album = {};
            }
        });
    }
    $scope.toggle = function (product) {
        product.checked = !product.checked;
    }
    $scope.BindProduct = function (Product) {
        var flag = true;
        for (var i = 0; i < $scope.ChooseProducts.length; i++) {
            if ($scope.ChooseProducts[i].product_num == Product.product_num) {
                flag = false;
                $.scojs_message('该商品已添加,请选择其他商品', $.scojs_message.TYPE_ERROR);
            }
        }
        for (var j = 0; j < $scope.AlbumProducts.length; j++) {
            if ($scope.AlbumProducts[j].product_num == Product.product_num) {
                flag = false;
                $.scojs_message('该商品已添加,请选择其他商品', $.scojs_message.TYPE_ERROR);
            }
        }
        if (flag) {
            $scope.ChooseProducts.push(Product);
        }
    }
    $scope.UnBindProduct = function (Product) {
        var array = [];
        for (var i = 0; i < $scope.ChooseProducts.length; i++) {
            if ($scope.ChooseProducts[i].product_num != Product.product_num) {
                array.push($scope.ChooseProducts[i]);
            }
        }
        $scope.ChooseProducts = array;
    }
    $scope.UpdateAlbum = function (data) {
        if ($scope.UpdateAlbumForm.$valid) {
            $scope.showerror = false;
            if ($scope.AlbumProducts.length == 0 && $scope.ChooseProducts.length == 0) {
                $.scojs_message('请选择商品', $.scojs_message.TYPE_ERROR);
                return;
            }
            var productids = '';
            for (var i = 0; i < $scope.ChooseProducts.length; i++) {
                productids = productids + $scope.ChooseProducts[i].productid + ',';
            }
            $http.post($resturls["UpdateAlbum"], { album_id: data.album_id, album_name: data.album_name, album_status: data.album_status, album_cover: $("#imagezone").attr("src"), album_description: $scope.um.getContent(), productids: productids,  tagid: $scope.tagitem.tag_id }).success(function (call) {
                if (call.Error == 0) {
                    $.scojs_message('更新成功', $.scojs_message.TYPE_OK);
                    setTimeout(function () {
                        window.location.href = "#/product/album";;
                    }, 2000);
                }
                else {
                    $scope.showerror = true;
                    $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
                }
            });
        } else {
            $scope.showerror = true;
        }
    }
    //删除合辑相关产品
    $scope.DeleteAlbumProduct = function (data) {
        $http.post($resturls["deleteAlbumProduct"], { album_product_id: data.album_product_id }).success(function (call) {
            if (call.Error == 0) {
                var array = [];
                for (var i = 0; i < $scope.AlbumProducts.length; i++) {
                    if ($scope.AlbumProducts[i].album_product_id != data.album_product_id) {
                        array.push($scope.AlbumProducts[i]);
                    }
                }
                $scope.AlbumProducts = array;
                $.scojs_message('删除成功', $.scojs_message.TYPE_OK);
            }
            else {
                $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
            }
        });
    }
    $scope.LoadTags();
    $scope.GetAlbum();
    $scope.UpLoadImage();
}
