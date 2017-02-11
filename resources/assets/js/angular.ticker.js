angular.module('ticker', [])
    .controller('tickerCtrl',function($scope, $timeout, $interval) {
        $scope.boxes = [
            {title: 'কুমিল্লা জিলা স্কুল',img:'/img/ticker/1.jpg',url:''},
            {title: 'মর্ডান হাই স্কুল',img:'/img/ticker/2.jpg',url:''},
            {title: 'রেসিডেন্সিয়াল স্কুল',img:'/img/ticker/3.jpg',url:''},
            {title: 'পুলিশ লাইন হাই স্কুল',img:'/img/ticker/4.jpg',url:''},
            {title: 'হোচ্চামিয়া হাই স্কুল',img:'/img/ticker/5.jpg',url:''},
            {title: 'সার্ক চাইল্ড কিন্টার গার্তেন',img:'/img/ticker/6.jpg',url:''},
            {title: 'নোটিশ',img:'/img/ticker/7.jpg',url:''},
            {title: 'রিপোর্ট',img:'/img/ticker/8.jpg',url:''},
            {title: 'Box 9',img:'/img/ticker/9.jpg',url:''},
            {title: 'Box 10',img:'/img/ticker/10.jpg',url:''}
        ];
        $scope.moving = false;

        $scope.moveLeft = function() {
            $scope.moving = true;
            $timeout($scope.switchFirst, 1000);
        };
        $scope.switchFirst = function() {
            $scope.boxes.push($scope.boxes.shift());
            $scope.moving = false;
            $scope.$apply();
        };

        $interval($scope.moveLeft, 5000);

    });