'use strict';

angular.module('simpleAngularTicker', []).
directive('verticalTicker', function ($interval, $timeout) {
    return {

        restrict: 'A',
        scope: true,
        compile: function () {

            return function (scope, element, attributes) {

                var timing,
                    timingEffect,
                    timingEffectDivideBy = 4,
                    isHovered = false,
                    innerTime,
                    start;

                if (attributes.timing) {
                    timing = attributes.timing;
                    timingEffect = timing / timingEffectDivideBy;
                } else {
                    timing = 5000;
                    timingEffect = timing / timingEffectDivideBy / timingEffectDivideBy * 2;
                }

                scope.$watch(element, function () {

                    var list = element,
                        items = element.find('li'),
                        itemFirst;


                    if (items.length) {
                        list.addClass('active');

                        start = $interval(function () {

                            /*cancel the callback function for fade-out and makes the ticker steady.*/
                            if (isHovered) {
                                $timeout.cancel(innerTime);
                                return;
                            }

                            items = list.children('li');
                            itemFirst = angular.element(items[0]);

                            itemFirst.addClass('fade-out minus-margin-top');

                            $timeout(function () {
                                itemFirst.removeClass('minus-margin-top');
                                list.append(itemFirst);

                                innerTime = $timeout(function () {
                                    items.removeClass('fade-out');
                                }, timingEffect);

                            }, timingEffect);

                        }, timing);

                    } else {
                        console.warn('no items assigned to ticker! Ensure you have correctly assigned items to your ng-repeat.');
                    }

                });

                element.on('$destroy', function () {
                    $interval.cancel(start, 0);
                });

                /* 
                 *author - mayo
                 *checking for mouse enter the ticker region
                 */
                element.on('mouseenter', function () {
                    isHovered = true;
                });

                /* 
                 *author - mayo
                 *checking for mouse exit the ticker region
                 */
                element.on('mouseleave', function () {
                    isHovered = false;
                });

            };
        }

    };
});
angular.module('ticker', [])
    .controller('tickerCtrl',function($scope, $timeout, $interval) {
        $scope.boxes = [
            {title: 'Box 1'},
            {title: 'Box 2'},
            {title: 'Box 3'},
            {title: 'Box 4'},
            {title: 'Box 5'},
            {title: 'Box 6'},
            {title: 'Box 7'},
            {title: 'Box 8'},
            {title: 'Box 9'},
            {title: 'Box 10'}
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

        $interval($scope.moveLeft, 2000);

    });
var components=angular.module('components',['ticker','simpleAngularTicker'])
.directive('menu',function($interval){
    return{
        templateUrl:'getView/home.menu',
        link:function(scope,elem,attr){
            scope.drop=[];
            scope.interval=2000;
            scope.cover=[
            {src:'/img/background/1.jpg',active:true},
            {src:'/img/background/2.jpg',active:false},
            {src:'/img/background/3.jpg',active:false},
            {src:'/img/background/4.jpg',active:false},
            {src:'/img/background/5.jpg',active:false},
            {src:'/img/background/6.jpg',active:false},
            {src:'/img/background/7.jpg',active:false},
            ]
            for(i=0;i<6;i++){
                scope.drop[i]=false;
            }
            scope.index=0;
            total=scope.cover.length;
            $interval(function(){
                index=scope.index;
                if(index==total-1){
                    scope.index=0;
                }else{
                    scope.index++;
                }

                scope.cover[index].active=true;
                if(index==0){
                    scope.cover[total-1].active=false;
                }else{
                    scope.cover[index-1].active=false;
                }
            },scope.interval);

            scope.setVisible=function(index){
                scope.drop[index]=!scope.drop[index];
                angular.forEach(scope.drop,function(value,key){

                    if(key!=index){
                        scope.drop[key]=false;
                    }
                })
            }
            $('body').click(function(event){
                if(event.target.className!='dropdown-toggle'){
                      angular.forEach(scope.drop,function(value,key){

                      
                            scope.drop[key]=false;
                       
                    })  
                }
                
            })
        }
    }
}).directive('sidebar',function(){
    return{
        replace:true,
        templateUrl:'getView/home.side-bar',
        link:function(scope){

        }
    }
}).directive('boxTicker',function(){
    return{
        templateUrl:'getView/home.ticker'
    }

}).directive('newsTicker',function(){
    return{
        templateUrl:'getView/home.news-ticker',
        link:function(scope){
            scope.myTickerItems = [
                   {
                     title: 'খবর 1',
                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (ডিসেম্বর ০৫, ২০১৫ | শনিবার)',
                     class:'bq-primary'
                   },
                   {
                     title: 'খবর 2',
                     copy: 'ঈদ উৎসব-২০১৫ এর অনুষ্ঠান/প্রতিযোগিতা সূচি (২৬ সেপ্টেম্বর ২০১৫ খ্রিঃ)',
                     class:'bq-warning'
                   },
                   {
                     title: 'খবর 3',
                     copy: 'উপজেলা উন্নয়ন মেলা ২০১৫ এর অনুষ্ঠান সূচি (২৭-২৯ সেপ্টেম্বর,২০১৫ খ্রিঃ)',
                     class:'bq-success'
                   },
                   {
                     title: 'খবর ৪',
                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (সেপ্টেম্বর০৩,২০১৫|বৃহস্পতিবার)',
                     class:'bq-danger'
                   },
                   {
                     title: 'খবর ৫',
                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (আগষ্ট ১৩, ২০১৫ বৃহস্পতিবার, আগষ্ট ১৪,...',
                     class:'bq-primary'
                   },
                   {
                     title: 'খবর ৬',
                     copy: 'জাতীয় তথ্য বাতায়ন',
                     class:'bq-warning'
                   },
                   {
                     title: 'খবর ৭',
                     copy: 'জাতীয় ই-তথ্যকোষ',
                     class:'bq-success'
                   }
                ];
        }
    }


}).directive('backToTop',function($window,scrollMe){
    return{
        templateUrl:'getView/back-to-top',
        link:function(scope,elem){
            elem.fadeOut();

            scope.goTop=function(){
                scrollMe.goTop();
            }

            angular.element($window).bind('scroll', function(event) {
                /* Act on the event */
                menu=angular.element($('menu')).height();
                offset=this.pageYOffset;
                // console.log(menu)
                maxheight=$(window).height();
                if(offset>menu){
                    elem.fadeIn();
                    scope.$apply();
                }else{
                    elem.fadeOut();
                }
                // console.log(maxheight);
            });
        }
    }
}).directive('footer',function(){
    return{
        templateUrl:'getView/home.foot'
    }
})

components.factory('scrollMe',function(){
    func={};
    func.goTop=function(){
        angular.element('body,html').animate({ scrollTop: 0 }, "slow");
    }
    return func;
})
var app=angular.module('mainHome',['components','ngMaterial','ngRoute','ngMessages','ngAnimate']);


app.config(function($routeProvider){
    $routeProvider.when('/',{
        templateUrl:'getView/home.homepage',
        controller:'home'
    })
})

app.controller('home',  function($scope){
    
});
//# sourceMappingURL=all.js.map
