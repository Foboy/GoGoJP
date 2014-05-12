function ServiceMainCtrl($scope, $http, $location, $routeParams, $resturls) {

    $scope.loadMessageList = function (pageIndex, customerid, searchkey, begintime, endtime, callback) {
        var pageSize = 1;
        if (pageIndex == 0) pageIndex = 1;
        $http.post($resturls["MessageList"], { customerid:customerid,begintime: begintime || '', endtime: endtime || '', searchkey: searchkey || '', pageIndex: pageIndex - 1, pageSize: 20 }).success(function (result) {
            if (result.Error == 0) {
                $scope.msglist = result.Data;
                $scope.pages = utilities.paging(result.totalcount, pageIndex, pageSize, '#customerservice/list/{0}');
            } else {
                $scope.msglist = [];
                $scope.pages = utilities.paging(0, pageIndex, pageSize);
            }
            callback();
        });
    }

}
function ServiceListCtrl($scope, $http, $location, $routeParams, $resturls) {
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
        var pageSize = 1;
        if (pageIndex == 0) pageIndex = 1;
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
}
function ServiceChatCtrl($scope, $rootScope, $http, $location, $routeParams, $resturls, $timeout) {
    $parent = $scope.$parent;

    $('#service-chat-box').slimScrollAngular({
        height: '400px'
    });
    $scope.chat_customerid = $routeParams.customerId;

    $parent.loadMessageList(0, $scope.chat_customerid, '', '', '', function () {
        $scope.scrollToBottom();
    });

    $scope.sendMsg = function () {
        $http.post($resturls["AdvisoryReply"], { customerid: $scope.chat_customerid, content: $scope.replyMessage || '', }).success(function (result) {
            if (result.Error == 0) {
                $scope.msglist = result.Data;
                $scope.scrollToBottom(); 
            } else {
                $scope.msglist = [];
                $scope.pages = utilities.paging(0, pageIndex, pageSize);
            }
            
        });
    };

    $scope.scrollToBottom = function () {
        setTimeout(function () {
            $('#service-chat-box').slimScrollAngular({ height: '400px', scrollTo: 10000 });
        }, 500);  
    }
 
}

function ServiceHistoriesCtrl($scope, $rootScope, $http, $location, $routeParams, $resturls, $timeout) {
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
    $scope.chatlist = [
    { self: false, nickname: '小张', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: true, nickname: '客服', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: false, nickname: '小张', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: true, nickname: '客服', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: false, nickname: '小张', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: true, nickname: '客服', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: false, nickname: '小张', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: true, nickname: '客服', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: false, nickname: '小张', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: true, nickname: '客服', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: false, nickname: '小张', time: '14:23', msg: '  您好！我有问题想要咨询！' },
    { self: true, nickname: '客服', time: '14:23', msg: '  您好！我有问题想要咨询！' }
    ];
    $scope.pages = utilities.paging(050, 1, 20);
    setTimeout(function () {
        $('#service-chat-box').slimScrollAngular({ height: '400px', scrollTo: 10000 });
    }, 500);
}
