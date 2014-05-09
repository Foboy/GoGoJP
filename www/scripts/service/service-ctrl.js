function ServiceMainCtrl($scope, $http, $location, $routeParams, $resturls) {

}
function ServiceListCtrl($scope, $http, $location, $routeParams, $resturls) {
    $scope.msglist = [{ nickname: 'xiaozhang', id: 2 }, { nickname: 'xiaozhang', id: 2 }, { nickname: 'xiaozhang', id: 2 }, { nickname: 'xiaozhang', id: 2 }];

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
            },
            startDate: moment().subtract('days', 29),
            endDate: moment()
        }, function (start, end) {
            create_time1 = start / 1000;
            create_time2 = end / 1000;
        });
}
function ServiceChatCtrl($scope, $rootScope, $http, $location, $routeParams, $resturls, $timeout) {
    console.log('ServiceChatCtrl');
    $scope.aaaa = "dddd";
    $('#service-chat-box').slimScrollAngular({
        height: '400px'
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

    $scope.sendMsg = function () {
        $scope.chatlist.push({ self: true, nickname: '客服', time: '14:23', msg: $scope.replyMessage });
        setTimeout(function () {
            $('#service-chat-box').slimScrollAngular({ height: '400px', scrollTo: 10000 });
        }, 500);
        console.log($scope.chatlist);
    };
    setTimeout(function () {
        $('#service-chat-box').slimScrollAngular({ height: '400px', scrollTo: 10000 });
    }, 500);
}

function ServiceHistoriesCtrl($scope, $rootScope, $http, $location, $routeParams, $resturls, $timeout) {
    $('#service-chat-box').slimScrollAngular({
        height: '400px'
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
