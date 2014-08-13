//添加合辑
function AddAlbumCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.FuzzySearchPrduct = function () {
        $http.post($resturls["LoadProdcut"], { pageIndex: 0, pageSize: 100 }).success(function (result) {
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
    //添加商品
    $scope.AddAlbum = function (data) {
        var productids = '';
        for (var i = 0; i < $scope.Products.length; i++) {
            if ($scope.Products[i].checked) {
                productids = productids + $scope.Products[i].productid + ',';
            }
        }
        if (productids == "")
        {
            $.scojs_message('请选择商品', $.scojs_message.TYPE_ERROR);
            return;
        }
        if ($scope.AddAlbumForm.$valid) {
            $scope.showerror = false;
            $http.post($resturls["AddAlbum"], { album_name: data.album_name, album_cover: $("#imagezone").attr("src"), album_description: data.album_description, productids: productids }).success(function (result) {
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
    $scope.toggle = function (product) {
        product.checked = !product.checked;
    }
    $scope.UpLoadImage();
    $scope.FuzzySearchPrduct();
}
//编辑合辑
function EditAlbumCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
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
    $scope.GetAlbum = function () {
        $http.post($resturls["GetAlbum"], { album_id: $routeParams.album_id }).success(function (result) {
            if (result.Error == 0) {
                $scope.Album = result.Data;
                $("#imagezone").attr("src", $scope.Album.album_cover);
                $http.post($resturls["LoadProdcut"], { pageIndex: 0, pageSize: 100 }).success(function (presult) {
                    if (presult.Error == 0) {
                        $scope.Products = presult.Data;
                        $http.post($resturls["SearchAlbumProductByAlbumId"], { album_id: $scope.Album.album_id }).success(function (aresult) {
                            if (aresult.Error == 0 && aresult.Data != null) {
                                $scope.AlbumProducts = aresult.Data;
                                for (var i = 0; i < $scope.Products.length; i++) {
                                    $scope.Products[i].checked = false;
                                    for (var j = 0; j < $scope.AlbumProducts.length; j++) {
                                        if ($scope.Products[i].productid == $scope.AlbumProducts[j].product_id) {
                                            $scope.Products[i].checked = true;
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
    $scope.UpdateAlbum = function (data) {
        if ($scope.UpdateAlbumForm.$valid) {
            $scope.showerror = false;
            var albumproduct_ids = "";
            if ($scope.AlbumProducts.length > 0) {
                for (var i = 0; i < $scope.AlbumProducts.length; i++) {
                    albumproduct_ids = albumproduct_ids + $scope.AlbumProducts[i].album_product_id + ',';
                }
            }
            var productids = '';
            for (var i = 0; i < $scope.Products.length; i++) {
                if ($scope.Products[i].checked) {
                    productids = productids + $scope.Products[i].productid + ',';
                }
            }
            $http.post($resturls["UpdateAlbum"], { album_id: data.album_id, album_name: data.album_name,album_status:data.album_status, album_cover: $("#imagezone").attr("src"), album_description: data.album_description, productids: productids, albumproduct_ids: albumproduct_ids }).success(function (call) {
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
    $scope.GetAlbum();
    $scope.UpLoadImage();
}
