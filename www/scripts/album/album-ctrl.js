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
            if($scope.Products[i].checked)
            {
                productids =productids+ $scope.Products[i].productid+',';
            }
        }
        if ($scope.AddAlbumForm.$valid) {
            $scope.showerror = false;
            $http.post($resturls["AddAlbum"], { album_name: data.album_name, album_cover: $("#imagezone").attr("src"), album_description: data.album_description, productids: productids }).success(function (result) {
                if (result.Error == 0) {
                    $.scojs_message('新增成功', $.scojs_message.TYPE_OK);
                    setTimeout(function () {
                        window.location.reload();
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
    //前端是否显示合辑
    $scope.IsShow = function () {

    }
    $scope.UpLoadImage();
    $scope.FuzzySearchPrduct();
}
//编辑合辑
function EditAlbumCtrl($scope, $http, $location, $routeParams, $resturls, $rootScope) {
    $scope.GetAlbum = function () {
        $http.post($resturls["GetSlideShow"], { picid: $routeParams.picid }).success(function (result) {
            if (result.Error == 0) {
                $scope.Picture = result.Data;
                $("#imagezone").attr("src", $scope.Picture.small_pic);
                $http.post($resturls["GetProdcutAlbum"], { album_id: $scope.Picture.album_id }).success(function (result) {
                    if (result.Error == 0 && result.Data != null) {
                        $scope.AlubmName = result.Data.album_name;
                    } else {
                        $scope.AlubmName = "";
                    }
                });

            } else {
                $scope.Picture = {};
            }
        });
    }
}
