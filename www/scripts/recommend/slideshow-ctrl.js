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
    $scope.DeleteSlideShow = function (picid) {
        $http.post($resturls["DeleteSlideShow"], { picId: picid }).success(function (result) {
            if (result.Error == 0) {
                $.scojs_message('删除成功', $.scojs_message.TYPE_OK);
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }
            else {
                $scope.showerror = true;
                $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
            }
        })
    }
    $scope.IsTop = function (data) {
        $http.post($resturls["IsTopSlideShow"], { picId: data.picid, title: data.pic_title, bigPic: data.big_pic, smallPic: data.small_pic, albumId: data.album_id, isTop: data.istop }).success(function (result) {
            if (result.Error == 0) {
                $.scojs_message('操作成功', $.scojs_message.TYPE_OK);
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }
            else {
                $scope.showerror = true;
                $.scojs_message('服务器忙，请稍后重试', $.scojs_message.TYPE_ERROR);
            }
        })
    }
}

function AddSlideShowCtrl($scope, $http, $location, $routeParams, $resturls) {
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
                console.log(result);
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
    $scope.AddSlideShow = function (data) {
        if ($scope.AddSlideShowForm.$valid) {
            $scope.showerror = false;
            var albumId = 0;
            if ($scope.ChooseAlbum != undefined) {
                albumId = $scope.ChooseAlbum.album_id;
            }
            $http.post($resturls["AddSlideShow"], { title: data.title, bigPic: data.bigPic, smallPic: data.smallPic, albumId: albumId }).success(function (result) {
                if (result.Error == 0) {
                    $.scojs_message('新增成功', $.scojs_message.TYPE_OK);
                    setTimeout(function () {
                        window.location.href = "#/recommend"
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
    $scope.FuzzySearchAlbum = function () {
        $http.post($resturls["LoadProdcutAlbum"], { pageIndex: 0, pageSize: 100 }).success(function (result) {
            if (result.Error == 0) {
                $scope.ProdcutAlbums = result.Data;
            } else {
                $scope.ProdcutAlbums = [];
            }
        });
    };
    $scope.BindAlbum = function (data) {
        $scope.ChooseAlbum = data;
    }
    $scope.UpLoadImage();
    $scope.FuzzySearchAlbum();
}


function EditSlideShowCtrl($scope, $http, $location, $routeParams, $resturls) {
    $scope.GetSlideShow = function () {
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
    };
    $scope.FuzzySearchAlbum = function () {
        $http.post($resturls["LoadProdcutAlbum"], { pageIndex: 0, pageSize: 100 }).success(function (result) {
            if (result.Error == 0) {
                $scope.ProdcutAlbums = result.Data;
            } else {
                $scope.ProdcutAlbums = [];
            }
        });
    };
    $scope.BindAlbum = function (data) {
        $scope.ChooseAlbum = data;
    }
    $scope.UpdateSlideShow = function (data) {
        if ($scope.UpdateSlideShowForm.$valid) {
            $scope.showerror = false;
            var albumId = data.album_id;
            if ($scope.ChooseAlbum != undefined) {
                albumId = $scope.ChooseAlbum.album_id;
            }
            $http.post($resturls["UpdateSlideShow"], { picId: data.picid, title: data.pic_title, bigPic: data.bigPic, smallPic: data.small_pic, albumId: albumId }).success(function (result) {
                if (result.Error == 0) {
                    $.scojs_message('编辑成功', $.scojs_message.TYPE_OK);
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
    $scope.UpLoadImage();
    $scope.GetSlideShow();
    $scope.FuzzySearchAlbum();
}