function ServiceMainCtrl($scope, $http, $location, $routeParams, $resturls, $novcomet) {

    $scope.loadMessageList = function (pageIndex, pageSize, customerid, searchkey, begintime, endtime, callback) {
        if (pageIndex == 0) pageIndex = 1;
        console.log(searchkey);
        $http.post($resturls["MessageList"], { customerid: customerid, begintime: begintime || '', endtime: endtime || '', searchkey: searchkey || '', pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
            if (result.Error == 0) {
                if (angular.isArray(result.Data)) {
                    $scope.msglist = result.Data.reverse();
                }
                callback(result);
            } else {
                $scope.msglist = [];
                $scope.pages = utilities.paging(0, pageIndex, pageSize);
            }
            
        });
    }
    $novcomet.subscribe('customercomet', function (data) {
        console.log(data);
    }).run();

    $scope.loadChatCustomer = function (customerid)
    {
        $http.post($resturls["GetChatCustomer"], { customerid: customerid }).success(function (result) {
            if (result.Error == 0) {
                $scope.chat_customer = result.Data[0];
            } else {

            }
        });
    }

}
function ServiceListCtrl($scope, $http, $location, $routeParams, $resturls, $novcomet) {
    $parent = $scope.$parent;
    var create_time1, create_time2;

    create_time1 = $parent.list_begin_time || '';
    create_time2 = $parent.list_end_time || '';
    $scope.chatlistdaterange = $parent.list_date_range || '';
    $scope.chatlistsearchkey = $parent.list_search_key || '';

    $('#reservation').daterangepicker(
        {
            showDropdowns: true,
            format: 'YYYY/MM/DD',
            ranges: {
                '今天': [moment(), moment()],
                '昨天': [moment().subtract('days', 1),
                        moment().subtract('days', 1)],
                '最近7天': [moment().subtract('days', 6), moment()],
                '最近30天': [moment().subtract('days', 29), moment()],
                '这个月': [moment().startOf('month'),
                        moment().endOf('month')],
                '上个月': [moment().subtract('month', 1).startOf('month'),
                        moment().subtract('month', 1).endOf('month')]
            }
        }, function (start, end) {
            console.log(start);
            console.log(end);
            create_time1 = start / 1000;
            create_time2 = end / 1000;
        });

    $scope.loadChatList = function (pageIndex) {
        var pageSize = 16;
        if (pageIndex == 0) pageIndex = 1;
        if ($scope.chathistorydaterange == '') {
            create_time1 = '';
            create_time2 = '';
        }
        $http.post($resturls["ChatList"], { begintime: create_time1 || '', endtime: create_time2 || '', searchkey: $scope.chatlistsearchkey || '', pageIndex: pageIndex - 1, pageSize: pageSize }).success(function (result) {
            if (result.Error == 0) {
                $scope.chatlist = result.Data;
                $scope.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#customerservice/list/{0}');
            } else {
                $scope.chatlist = [];
                $scope.pages = utilities.paging(0, pageIndex, pageSize);
            }
        });
    }
    $scope.searchChat = function () {
        $parent.list_begin_time = create_time1;
        $parent.list_end_time = create_time2;
        $parent.list_date_range = $scope.chatlistdaterange;
        $parent.list_search_key = $scope.chatlistsearchkey;
        $scope.loadChatList(0);
    }
    $scope.loadChatList($routeParams.pageIndex || 0);

    $scope.checkChatCustomer = function () {
        $parent.chat_customer = this.chat;
        return true;
    };
}
function ServiceChatCtrl($scope, $rootScope, $http, $location, $routeParams, $resturls, $timeout, $novcomet) {
    $parent = $scope.$parent;
    var pageSize = 16;

    $('#service-chat-box').slimScrollAngular({
        height: '400px'
    });
    $scope.chat_customerid = $routeParams.customerId;

    $parent.loadMessageList(0, pageSize, $scope.chat_customerid, '', '', '', function () {
        $scope.scrollToBottom();
    });

    $scope.sendMsg = function () {
        $http.post($resturls["AdvisoryReply"], { customerid: $scope.chat_customerid, content: $scope.replyMessage || '', }).success(function (result) {
            if (result.Error == 0) {
                $parent.msglist = $parent.msglist || [];
                $parent.msglist.push(result.Data);
                $scope.scrollToBottom();
                $scope.replyMessage = '';
            } else {
                
            }
            
        });
    };

    $scope.scrollToBottom = function () {
        setTimeout(function () {
            $('#service-chat-box').slimScrollAngular({ height: '400px', scrollTo: 10000 });
        }, 500);  
    }

    $parent.loadChatCustomer($scope.chat_customerid);

    $novcomet.subscribe('customercomet', function (data) {
        console.log(data);
        if (data.d)
        {
            var customers = (data.d['customercomet'] || '').split(";");
            for (var i = 0; i < customers.length; i++)
            {
                var id = $.trim(customers[i]);
                console.log(id);
                if (id && id.length) {
                    console.log($scope.chat_customerid);
                    if (id == $scope.chat_customerid) {
                        console.log("update chat message list");
                        $parent.loadMessageList(0, pageSize, $scope.chat_customerid, '', '', '', function () {
                            console.log("update chat message list success");
                            $scope.scrollToBottom();
                        });
                    }
                    else {
                        $.scojs_message('您有新的消息', $.scojs_message.TYPE_OK);
                    }
                }
            }
        }
    });
}

function ServiceHistoriesCtrl($scope, $rootScope, $http, $location, $routeParams, $resturls, $timeout, $novcomet) {

    $parent = $scope.$parent;
    var create_time1, create_time2;

    create_time1 = $parent.history_begin_time || '';
    create_time2 = $parent.history_end_time || '';
    $scope.chathistorydaterange = $parent.history_date_range || '';
    $scope.chathistorysearchkey = $parent.history_search_key || '';

    $('#service-chat-box').slimScrollAngular({
        height: '400px'
    });
    $('#reservation').daterangepicker(
        {
            opens:'left',
            showDropdowns: true,
            format: 'YYYY/MM/DD',
            ranges: {
                '今天': [moment(), moment()],
                '昨天': [moment().subtract('days', 1),
                        moment().subtract('days', 1)],
                '最近7天': [moment().subtract('days', 6), moment()],
                '最近30天': [moment().subtract('days', 29), moment()],
                '这个月': [moment().startOf('month'),
                        moment().endOf('month')],
                '上个月': [moment().subtract('month', 1).startOf('month'),
                        moment().subtract('month', 1).endOf('month')]
            },
            startDate: moment().subtract('days', 29),
            endDate: moment()
        }, function (start, end) {
            create_time1 = start / 1000;
            create_time2 = end / 1000;
        });
    $scope.chat_customerid = $routeParams.customerId;

    $scope.loadHistoryList = function (pageIndex) {
        var pageSize = 16;
        if (pageIndex == 0) pageIndex = 1;
        if ($scope.chathistorydaterange == '')
        {
            create_time1 = '';
            create_time2 = '';
        }
        $parent.loadMessageList(pageIndex, pageSize, $scope.chat_customerid, $scope.chathistorysearchkey || '', create_time1 || '', create_time2 || '', function (result) {
            console.log(result)
            $scope.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#customerservice/histories/' + $scope.chat_customerid + '/{0}');
            $scope.scrollToBottom();
        });
    }
    $scope.searchHistory = function () {
        $parent.history_begin_time = create_time1;
        $parent.history_end_time = create_time2;
        $parent.history_date_range = $scope.chathistorydaterange;
        $parent.history_search_key = $scope.chathistorysearchkey;
        $scope.loadHistoryList(0);
    }
    $scope.loadHistoryList($routeParams.pageIndex || 0);



    $scope.scrollToBottom = function () {
        setTimeout(function () {
            $('#service-chat-box').slimScrollAngular({ height: '400px', scrollTo: 10000 });
        }, 200);
    }

    $novcomet.subscribe('customercomet', function (data) {
        console.log(data);
        if (data.d) {
            $.scojs_message('您有新的消息', $.scojs_message.TYPE_OK);
        }
    });
}
