/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("angular.module('ticker', [])\r\n    .controller('tickerCtrl',function($scope, $timeout, $interval) {\r\n        $scope.boxes = [\r\n            {title: 'Box 1'},\r\n            {title: 'Box 2'},\r\n            {title: 'Box 3'},\r\n            {title: 'Box 4'},\r\n            {title: 'Box 5'},\r\n            {title: 'Box 6'},\r\n            {title: 'Box 7'},\r\n            {title: 'Box 8'},\r\n            {title: 'Box 9'},\r\n            {title: 'Box 10'}\r\n        ];\r\n        $scope.moving = false;\r\n\r\n        $scope.moveLeft = function() {\r\n            $scope.moving = true;\r\n            $timeout($scope.switchFirst, 1000);\r\n        };\r\n        $scope.switchFirst = function() {\r\n            $scope.boxes.push($scope.boxes.shift());\r\n            $scope.moving = false;\r\n            $scope.$apply();\r\n        };\r\n\r\n        $interval($scope.moveLeft, 2000);\r\n\r\n    });//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FuZ3VsYXIudGlja2VyLmpzP2I2ZjkiXSwic291cmNlc0NvbnRlbnQiOlsiYW5ndWxhci5tb2R1bGUoJ3RpY2tlcicsIFtdKVxyXG4gICAgLmNvbnRyb2xsZXIoJ3RpY2tlckN0cmwnLGZ1bmN0aW9uKCRzY29wZSwgJHRpbWVvdXQsICRpbnRlcnZhbCkge1xyXG4gICAgICAgICRzY29wZS5ib3hlcyA9IFtcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDEnfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDInfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDMnfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDQnfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDUnfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDYnfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDcnfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDgnfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDknfSxcclxuICAgICAgICAgICAge3RpdGxlOiAnQm94IDEwJ31cclxuICAgICAgICBdO1xyXG4gICAgICAgICRzY29wZS5tb3ZpbmcgPSBmYWxzZTtcclxuXHJcbiAgICAgICAgJHNjb3BlLm1vdmVMZWZ0ID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICRzY29wZS5tb3ZpbmcgPSB0cnVlO1xyXG4gICAgICAgICAgICAkdGltZW91dCgkc2NvcGUuc3dpdGNoRmlyc3QsIDEwMDApO1xyXG4gICAgICAgIH07XHJcbiAgICAgICAgJHNjb3BlLnN3aXRjaEZpcnN0ID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICRzY29wZS5ib3hlcy5wdXNoKCRzY29wZS5ib3hlcy5zaGlmdCgpKTtcclxuICAgICAgICAgICAgJHNjb3BlLm1vdmluZyA9IGZhbHNlO1xyXG4gICAgICAgICAgICAkc2NvcGUuJGFwcGx5KCk7XHJcbiAgICAgICAgfTtcclxuXHJcbiAgICAgICAgJGludGVydmFsKCRzY29wZS5tb3ZlTGVmdCwgMjAwMCk7XHJcblxyXG4gICAgfSk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvYW5ndWxhci50aWNrZXIuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=");

/***/ },
/* 1 */
/***/ function(module, exports) {

eval("var components=angular.module('components',['ticker','simpleAngularTicker'])\r\n.directive('menu',function($interval){\r\n    return{\r\n        templateUrl:'getView/home.menu',\r\n        link:function(scope,elem,attr){\r\n            scope.drop=[];\r\n            scope.interval=2000;\r\n            scope.cover=[\r\n            {src:'/img/background/1.jpg',active:true},\r\n            {src:'/img/background/2.jpg',active:false},\r\n            {src:'/img/background/3.jpg',active:false},\r\n            {src:'/img/background/4.jpg',active:false},\r\n            {src:'/img/background/5.jpg',active:false},\r\n            {src:'/img/background/6.jpg',active:false},\r\n            {src:'/img/background/7.jpg',active:false} ]\r\n            for(i=0;i<6;i++){\r\n                scope.drop[i]=false;\r\n            }\r\n            scope.index=0;\r\n            total=scope.cover.length;\r\n            $interval(function(){\r\n                index=scope.index;\r\n                if(index==total-1){\r\n                    scope.index=0;\r\n                }else{\r\n                    scope.index++;\r\n                }\r\n\r\n                scope.cover[index].active=true;\r\n                if(index==0){\r\n                    scope.cover[total-1].active=false;\r\n                }else{\r\n                    scope.cover[index-1].active=false;\r\n                }\r\n            },scope.interval);\r\n\r\n            scope.setVisible=function(index){\r\n                scope.drop[index]=!scope.drop[index];\r\n                angular.forEach(scope.drop,function(value,key){\r\n\r\n                    if(key!=index){\r\n                        scope.drop[key]=false;\r\n                    }\r\n                })\r\n            }\r\n            $('body').click(function(event){\r\n                if(event.target.className!='dropdown-toggle'){\r\n                      angular.forEach(scope.drop,function(value,key){\r\n\r\n                      \r\n                            scope.drop[key]=false;\r\n                       \r\n                    })  \r\n                }\r\n                \r\n            })\r\n        }\r\n    }\r\n}).directive('sidebar',function(){\r\n    return{\r\n        replace:true,\r\n        templateUrl:'getView/home.side-bar',\r\n        link:function(scope){\r\n\r\n        }\r\n    }\r\n}).directive('boxTicker',function(){\r\n    return{\r\n        templateUrl:'getView/home.ticker'\r\n    }\r\n\r\n}).directive('newsTicker',function(){\r\n    return{\r\n        templateUrl:'getView/home.news-ticker',\r\n        link:function(scope){\r\n            scope.myTickerItems = [\r\n                   {\r\n                     title: 'খবর 1',\r\n                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (ডিসেম্বর ০৫, ২০১৫ | শনিবার)',\r\n                     class:'bq-primary'\r\n                   },\r\n                   {\r\n                     title: 'খবর 2',\r\n                     copy: 'ঈদ উৎসব-২০১৫ এর অনুষ্ঠান/প্রতিযোগিতা সূচি (২৬ সেপ্টেম্বর ২০১৫ খ্রিঃ)',\r\n                     class:'bq-warning'\r\n                   },\r\n                   {\r\n                     title: 'খবর 3',\r\n                     copy: 'উপজেলা উন্নয়ন মেলা ২০১৫ এর অনুষ্ঠান সূচি (২৭-২৯ সেপ্টেম্বর,২০১৫ খ্রিঃ)',\r\n                     class:'bq-success'\r\n                   },\r\n                   {\r\n                     title: 'খবর ৪',\r\n                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (সেপ্টেম্বর০৩,২০১৫|বৃহস্পতিবার)',\r\n                     class:'bq-danger'\r\n                   },\r\n                   {\r\n                     title: 'খবর ৫',\r\n                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (আগষ্ট ১৩, ২০১৫ বৃহস্পতিবার, আগষ্ট ১৪,...',\r\n                     class:'bq-primary'\r\n                   },\r\n                   {\r\n                     title: 'খবর ৬',\r\n                     copy: 'জাতীয় তথ্য বাতায়ন',\r\n                     class:'bq-warning'\r\n                   },\r\n                   {\r\n                     title: 'খবর ৭',\r\n                     copy: 'জাতীয় ই-তথ্যকোষ',\r\n                     class:'bq-success'\r\n                   }\r\n                ];\r\n        }\r\n    }\r\n\r\n\r\n}).directive('backToTop',function($window,scrollMe){\r\n    return{\r\n        templateUrl:'getView/back-to-top',\r\n        link:function(scope,elem){\r\n            elem.fadeOut();\r\n\r\n            scope.goTop=function(){\r\n                scrollMe.goTop();\r\n            }\r\n\r\n            angular.element($window).bind('scroll', function(event) {\r\n                /* Act on the event */\r\n                menu=angular.element($('menu')).height();\r\n                offset=this.pageYOffset;\r\n                // console.log(menu)\r\n                maxheight=$(window).height();\r\n                if(offset>menu){\r\n                    elem.fadeIn();\r\n                    scope.$apply();\r\n                }else{\r\n                    elem.fadeOut();\r\n                }\r\n                // console.log(maxheight);\r\n            });\r\n        }\r\n    }\r\n}).directive('footer',function(){\r\n    return{\r\n        templateUrl:'getView/home.foot'\r\n    }\r\n})\r\n\r\ncomponents.factory('scrollMe',function(){\r\n    func={};\r\n    func.goTop=function(){\r\n        angular.element('body,html').animate({ scrollTop: 0 }, \"slow\");\r\n    }\r\n    return func;\r\n})//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2hvbWUuY29tcG9uZW50cy5qcz9hYjRjIl0sInNvdXJjZXNDb250ZW50IjpbInZhciBjb21wb25lbnRzPWFuZ3VsYXIubW9kdWxlKCdjb21wb25lbnRzJyxbJ3RpY2tlcicsJ3NpbXBsZUFuZ3VsYXJUaWNrZXInXSlcclxuLmRpcmVjdGl2ZSgnbWVudScsZnVuY3Rpb24oJGludGVydmFsKXtcclxuICAgIHJldHVybntcclxuICAgICAgICB0ZW1wbGF0ZVVybDonZ2V0Vmlldy9ob21lLm1lbnUnLFxyXG4gICAgICAgIGxpbms6ZnVuY3Rpb24oc2NvcGUsZWxlbSxhdHRyKXtcclxuICAgICAgICAgICAgc2NvcGUuZHJvcD1bXTtcclxuICAgICAgICAgICAgc2NvcGUuaW50ZXJ2YWw9MjAwMDtcclxuICAgICAgICAgICAgc2NvcGUuY292ZXI9W1xyXG4gICAgICAgICAgICB7c3JjOicvaW1nL2JhY2tncm91bmQvMS5qcGcnLGFjdGl2ZTp0cnVlfSxcclxuICAgICAgICAgICAge3NyYzonL2ltZy9iYWNrZ3JvdW5kLzIuanBnJyxhY3RpdmU6ZmFsc2V9LFxyXG4gICAgICAgICAgICB7c3JjOicvaW1nL2JhY2tncm91bmQvMy5qcGcnLGFjdGl2ZTpmYWxzZX0sXHJcbiAgICAgICAgICAgIHtzcmM6Jy9pbWcvYmFja2dyb3VuZC80LmpwZycsYWN0aXZlOmZhbHNlfSxcclxuICAgICAgICAgICAge3NyYzonL2ltZy9iYWNrZ3JvdW5kLzUuanBnJyxhY3RpdmU6ZmFsc2V9LFxyXG4gICAgICAgICAgICB7c3JjOicvaW1nL2JhY2tncm91bmQvNi5qcGcnLGFjdGl2ZTpmYWxzZX0sXHJcbiAgICAgICAgICAgIHtzcmM6Jy9pbWcvYmFja2dyb3VuZC83LmpwZycsYWN0aXZlOmZhbHNlfSxcclxuICAgICAgICAgICAgXVxyXG4gICAgICAgICAgICBmb3IoaT0wO2k8NjtpKyspe1xyXG4gICAgICAgICAgICAgICAgc2NvcGUuZHJvcFtpXT1mYWxzZTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBzY29wZS5pbmRleD0wO1xyXG4gICAgICAgICAgICB0b3RhbD1zY29wZS5jb3Zlci5sZW5ndGg7XHJcbiAgICAgICAgICAgICRpbnRlcnZhbChmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgaW5kZXg9c2NvcGUuaW5kZXg7XHJcbiAgICAgICAgICAgICAgICBpZihpbmRleD09dG90YWwtMSl7XHJcbiAgICAgICAgICAgICAgICAgICAgc2NvcGUuaW5kZXg9MDtcclxuICAgICAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgICAgIHNjb3BlLmluZGV4Kys7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgc2NvcGUuY292ZXJbaW5kZXhdLmFjdGl2ZT10cnVlO1xyXG4gICAgICAgICAgICAgICAgaWYoaW5kZXg9PTApe1xyXG4gICAgICAgICAgICAgICAgICAgIHNjb3BlLmNvdmVyW3RvdGFsLTFdLmFjdGl2ZT1mYWxzZTtcclxuICAgICAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgICAgIHNjb3BlLmNvdmVyW2luZGV4LTFdLmFjdGl2ZT1mYWxzZTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxzY29wZS5pbnRlcnZhbCk7XHJcblxyXG4gICAgICAgICAgICBzY29wZS5zZXRWaXNpYmxlPWZ1bmN0aW9uKGluZGV4KXtcclxuICAgICAgICAgICAgICAgIHNjb3BlLmRyb3BbaW5kZXhdPSFzY29wZS5kcm9wW2luZGV4XTtcclxuICAgICAgICAgICAgICAgIGFuZ3VsYXIuZm9yRWFjaChzY29wZS5kcm9wLGZ1bmN0aW9uKHZhbHVlLGtleSl7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIGlmKGtleSE9aW5kZXgpe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBzY29wZS5kcm9wW2tleV09ZmFsc2U7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAkKCdib2R5JykuY2xpY2soZnVuY3Rpb24oZXZlbnQpe1xyXG4gICAgICAgICAgICAgICAgaWYoZXZlbnQudGFyZ2V0LmNsYXNzTmFtZSE9J2Ryb3Bkb3duLXRvZ2dsZScpe1xyXG4gICAgICAgICAgICAgICAgICAgICAgYW5ndWxhci5mb3JFYWNoKHNjb3BlLmRyb3AsZnVuY3Rpb24odmFsdWUsa2V5KXtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHNjb3BlLmRyb3Bba2V5XT1mYWxzZTtcclxuICAgICAgICAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgICAgICB9KSAgXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgfSlcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0pLmRpcmVjdGl2ZSgnc2lkZWJhcicsZnVuY3Rpb24oKXtcclxuICAgIHJldHVybntcclxuICAgICAgICByZXBsYWNlOnRydWUsXHJcbiAgICAgICAgdGVtcGxhdGVVcmw6J2dldFZpZXcvaG9tZS5zaWRlLWJhcicsXHJcbiAgICAgICAgbGluazpmdW5jdGlvbihzY29wZSl7XHJcblxyXG4gICAgICAgIH1cclxuICAgIH1cclxufSkuZGlyZWN0aXZlKCdib3hUaWNrZXInLGZ1bmN0aW9uKCl7XHJcbiAgICByZXR1cm57XHJcbiAgICAgICAgdGVtcGxhdGVVcmw6J2dldFZpZXcvaG9tZS50aWNrZXInXHJcbiAgICB9XHJcblxyXG59KS5kaXJlY3RpdmUoJ25ld3NUaWNrZXInLGZ1bmN0aW9uKCl7XHJcbiAgICByZXR1cm57XHJcbiAgICAgICAgdGVtcGxhdGVVcmw6J2dldFZpZXcvaG9tZS5uZXdzLXRpY2tlcicsXHJcbiAgICAgICAgbGluazpmdW5jdGlvbihzY29wZSl7XHJcbiAgICAgICAgICAgIHNjb3BlLm15VGlja2VySXRlbXMgPSBbXHJcbiAgICAgICAgICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICAgICAgIHRpdGxlOiAn4KaW4Kas4KawIDEnLFxyXG4gICAgICAgICAgICAgICAgICAgICBjb3B5OiAn4KahLiDgpq7gprngp4Dgpongpqbgp43gpqbgp4Dgpqgg4KaW4Ka+4KaoIOCmhuCmsuCmruCml+CngOCmsCDgprjgp43gpq/gpr7gprDgp4fgprAg4KaV4Kaa4KeB4Kef4Ka+IOCmuOCmq+CmsCDgprjgp4Lgpprgp4AgKOCmoeCmv+CmuOCnh+CmruCnjeCmrOCmsCDgp6bgp6ssIOCnqOCnpuCnp+CnqyB8IOCmtuCmqOCmv+CmrOCmvuCmsCknLFxyXG4gICAgICAgICAgICAgICAgICAgICBjbGFzczonYnEtcHJpbWFyeSdcclxuICAgICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICAgICAgIHRpdGxlOiAn4KaW4Kas4KawIDInLFxyXG4gICAgICAgICAgICAgICAgICAgICBjb3B5OiAn4KaI4KamIOCmieCnjuCmuOCmrC3gp6jgp6bgp6fgp6sg4KaP4KawIOCmheCmqOCngeCmt+CnjeCmoOCmvuCmqC/gpqrgp43gprDgpqTgpr/gpq/gp4vgppfgpr/gpqTgpr4g4Ka44KeC4Kaa4Ka/ICjgp6jgp6wg4Ka44KeH4Kaq4KeN4Kaf4KeH4Kau4KeN4Kas4KawIOCnqOCnpuCnp+CnqyDgppbgp43gprDgpr/gpoMpJyxcclxuICAgICAgICAgICAgICAgICAgICAgY2xhc3M6J2JxLXdhcm5pbmcnXHJcbiAgICAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICAgICB0aXRsZTogJ+CmluCmrOCmsCAzJyxcclxuICAgICAgICAgICAgICAgICAgICAgY29weTogJ+CmieCmquCmnOCnh+CmsuCmviDgpongpqjgp43gpqjgp5/gpqgg4Kau4KeH4Kay4Ka+IOCnqOCnpuCnp+CnqyDgpo/gprAg4KaF4Kao4KeB4Ka34KeN4Kag4Ka+4KaoIOCmuOCnguCmmuCmvyAo4Keo4KetLeCnqOCnryDgprjgp4fgpqrgp43gpp/gp4fgpq7gp43gpqzgprAs4Keo4Kem4Ken4KerIOCmluCnjeCmsOCmv+CmgyknLFxyXG4gICAgICAgICAgICAgICAgICAgICBjbGFzczonYnEtc3VjY2VzcydcclxuICAgICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICAgICAgIHRpdGxlOiAn4KaW4Kas4KawIOCnqicsXHJcbiAgICAgICAgICAgICAgICAgICAgIGNvcHk6ICfgpqEuIOCmruCmueCngOCmieCmpuCnjeCmpuCngOCmqCDgppbgpr7gpqgg4KaG4Kay4Kau4KaX4KeA4KawIOCmuOCnjeCmr+CmvuCmsOCnh+CmsCDgppXgpprgp4Hgp5/gpr4g4Ka44Kar4KawIOCmuOCnguCmmuCngCAo4Ka44KeH4Kaq4KeN4Kaf4KeH4Kau4KeN4Kas4Kaw4Kem4KepLOCnqOCnpuCnp+Cnq3zgpqzgp4Pgprngprjgp43gpqrgpqTgpr/gpqzgpr7gprApJyxcclxuICAgICAgICAgICAgICAgICAgICAgY2xhc3M6J2JxLWRhbmdlcidcclxuICAgICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICAgICAgIHRpdGxlOiAn4KaW4Kas4KawIOCnqycsXHJcbiAgICAgICAgICAgICAgICAgICAgIGNvcHk6ICfgpqEuIOCmruCmueCngOCmieCmpuCnjeCmpuCngOCmqCDgppbgpr7gpqgg4KaG4Kay4Kau4KaX4KeA4KawIOCmuOCnjeCmr+CmvuCmsOCnh+CmsCDgppXgpprgp4Hgpq/gprzgpr4g4Ka44Kar4KawIOCmuOCnguCmmuCngCAo4KaG4KaX4Ka34KeN4KafIOCnp+CnqSwg4Keo4Kem4Ken4KerIOCmrOCng+CmueCmuOCnjeCmquCmpOCmv+CmrOCmvuCmsCwg4KaG4KaX4Ka34KeN4KafIOCnp+CnqiwuLi4nLFxyXG4gICAgICAgICAgICAgICAgICAgICBjbGFzczonYnEtcHJpbWFyeSdcclxuICAgICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICAgICAgIHRpdGxlOiAn4KaW4Kas4KawIOCnrCcsXHJcbiAgICAgICAgICAgICAgICAgICAgIGNvcHk6ICfgppzgpr7gpqTgp4Dgp58g4Kak4Kal4KeN4KavIOCmrOCmvuCmpOCmvuCnn+CmqCcsXHJcbiAgICAgICAgICAgICAgICAgICAgIGNsYXNzOidicS13YXJuaW5nJ1xyXG4gICAgICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgICAgICAgdGl0bGU6ICfgppbgpqzgprAg4KetJyxcclxuICAgICAgICAgICAgICAgICAgICAgY29weTogJ+CmnOCmvuCmpOCngOCnnyDgpoct4Kak4Kal4KeN4Kav4KaV4KeL4Ka3JyxcclxuICAgICAgICAgICAgICAgICAgICAgY2xhc3M6J2JxLXN1Y2Nlc3MnXHJcbiAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICBdO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcblxyXG59KS5kaXJlY3RpdmUoJ2JhY2tUb1RvcCcsZnVuY3Rpb24oJHdpbmRvdyxzY3JvbGxNZSl7XHJcbiAgICByZXR1cm57XHJcbiAgICAgICAgdGVtcGxhdGVVcmw6J2dldFZpZXcvYmFjay10by10b3AnLFxyXG4gICAgICAgIGxpbms6ZnVuY3Rpb24oc2NvcGUsZWxlbSl7XHJcbiAgICAgICAgICAgIGVsZW0uZmFkZU91dCgpO1xyXG5cclxuICAgICAgICAgICAgc2NvcGUuZ29Ub3A9ZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgIHNjcm9sbE1lLmdvVG9wKCk7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIGFuZ3VsYXIuZWxlbWVudCgkd2luZG93KS5iaW5kKCdzY3JvbGwnLCBmdW5jdGlvbihldmVudCkge1xyXG4gICAgICAgICAgICAgICAgLyogQWN0IG9uIHRoZSBldmVudCAqL1xyXG4gICAgICAgICAgICAgICAgbWVudT1hbmd1bGFyLmVsZW1lbnQoJCgnbWVudScpKS5oZWlnaHQoKTtcclxuICAgICAgICAgICAgICAgIG9mZnNldD10aGlzLnBhZ2VZT2Zmc2V0O1xyXG4gICAgICAgICAgICAgICAgLy8gY29uc29sZS5sb2cobWVudSlcclxuICAgICAgICAgICAgICAgIG1heGhlaWdodD0kKHdpbmRvdykuaGVpZ2h0KCk7XHJcbiAgICAgICAgICAgICAgICBpZihvZmZzZXQ+bWVudSl7XHJcbiAgICAgICAgICAgICAgICAgICAgZWxlbS5mYWRlSW4oKTtcclxuICAgICAgICAgICAgICAgICAgICBzY29wZS4kYXBwbHkoKTtcclxuICAgICAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgICAgIGVsZW0uZmFkZU91dCgpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLy8gY29uc29sZS5sb2cobWF4aGVpZ2h0KTtcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59KS5kaXJlY3RpdmUoJ2Zvb3RlcicsZnVuY3Rpb24oKXtcclxuICAgIHJldHVybntcclxuICAgICAgICB0ZW1wbGF0ZVVybDonZ2V0Vmlldy9ob21lLmZvb3QnXHJcbiAgICB9XHJcbn0pXHJcblxyXG5jb21wb25lbnRzLmZhY3RvcnkoJ3Njcm9sbE1lJyxmdW5jdGlvbigpe1xyXG4gICAgZnVuYz17fTtcclxuICAgIGZ1bmMuZ29Ub3A9ZnVuY3Rpb24oKXtcclxuICAgICAgICBhbmd1bGFyLmVsZW1lbnQoJ2JvZHksaHRtbCcpLmFuaW1hdGUoeyBzY3JvbGxUb3A6IDAgfSwgXCJzbG93XCIpO1xyXG4gICAgfVxyXG4gICAgcmV0dXJuIGZ1bmM7XHJcbn0pXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvaG9tZS5jb21wb25lbnRzLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ },
/* 2 */
/***/ function(module, exports) {

eval("var app=angular.module('mainHome',['components','ngMaterial','ngRoute','ngMessages','ngAnimate']);\r\n\r\n\r\napp.config(function($routeProvider){\r\n    $routeProvider.when('/',{\r\n        templateUrl:'getView/home.homepage',\r\n        controller:'home'\r\n    })\r\n})\r\n\r\napp.controller('home',  function($scope){\r\n    \r\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2hvbWUuanM/NTcyNiJdLCJzb3VyY2VzQ29udGVudCI6WyJ2YXIgYXBwPWFuZ3VsYXIubW9kdWxlKCdtYWluSG9tZScsWydjb21wb25lbnRzJywnbmdNYXRlcmlhbCcsJ25nUm91dGUnLCduZ01lc3NhZ2VzJywnbmdBbmltYXRlJ10pO1xyXG5cclxuXHJcbmFwcC5jb25maWcoZnVuY3Rpb24oJHJvdXRlUHJvdmlkZXIpe1xyXG4gICAgJHJvdXRlUHJvdmlkZXIud2hlbignLycse1xyXG4gICAgICAgIHRlbXBsYXRlVXJsOidnZXRWaWV3L2hvbWUuaG9tZXBhZ2UnLFxyXG4gICAgICAgIGNvbnRyb2xsZXI6J2hvbWUnXHJcbiAgICB9KVxyXG59KVxyXG5cclxuYXBwLmNvbnRyb2xsZXIoJ2hvbWUnLCAgZnVuY3Rpb24oJHNjb3BlKXtcclxuICAgIFxyXG59KTtcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9ob21lLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ },
/* 3 */
/***/ function(module, exports) {

"use strict";
eval("'use strict';\r\n\r\nangular.module('simpleAngularTicker', []).\r\ndirective('verticalTicker', function ($interval, $timeout) {\r\n    return {\r\n\r\n        restrict: 'A',\r\n        scope: true,\r\n        compile: function () {\r\n\r\n            return function (scope, element, attributes) {\r\n\r\n                var timing,\r\n                    timingEffect,\r\n                    timingEffectDivideBy = 4,\r\n                    isHovered = false,\r\n                    innerTime,\r\n                    start;\r\n\r\n                if (attributes.timing) {\r\n                    timing = attributes.timing;\r\n                    timingEffect = timing / timingEffectDivideBy;\r\n                } else {\r\n                    timing = 5000;\r\n                    timingEffect = timing / timingEffectDivideBy / timingEffectDivideBy * 2;\r\n                }\r\n\r\n                scope.$watch(element, function () {\r\n\r\n                    var list = element,\r\n                        items = element.find('li'),\r\n                        itemFirst;\r\n\r\n\r\n                    if (items.length) {\r\n                        list.addClass('active');\r\n\r\n                        start = $interval(function () {\r\n\r\n                            /*cancel the callback function for fade-out and makes the ticker steady.*/\r\n                            if (isHovered) {\r\n                                $timeout.cancel(innerTime);\r\n                                return;\r\n                            }\r\n\r\n                            items = list.children('li');\r\n                            itemFirst = angular.element(items[0]);\r\n\r\n                            itemFirst.addClass('fade-out minus-margin-top');\r\n\r\n                            $timeout(function () {\r\n                                itemFirst.removeClass('minus-margin-top');\r\n                                list.append(itemFirst);\r\n\r\n                                innerTime = $timeout(function () {\r\n                                    items.removeClass('fade-out');\r\n                                }, timingEffect);\r\n\r\n                            }, timingEffect);\r\n\r\n                        }, timing);\r\n\r\n                    } else {\r\n                        console.warn('no items assigned to ticker! Ensure you have correctly assigned items to your ng-repeat.');\r\n                    }\r\n\r\n                });\r\n\r\n                element.on('$destroy', function () {\r\n                    $interval.cancel(start, 0);\r\n                });\r\n\r\n                /* \r\n                 *author - mayo\r\n                 *checking for mouse enter the ticker region\r\n                 */\r\n                element.on('mouseenter', function () {\r\n                    isHovered = true;\r\n                });\r\n\r\n                /* \r\n                 *author - mayo\r\n                 *checking for mouse exit the ticker region\r\n                 */\r\n                element.on('mouseleave', function () {\r\n                    isHovered = false;\r\n                });\r\n\r\n            };\r\n        }\r\n\r\n    };\r\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3RpY2tlci5taW4uanM/ZDMxNiJdLCJzb3VyY2VzQ29udGVudCI6WyIndXNlIHN0cmljdCc7XHJcblxyXG5hbmd1bGFyLm1vZHVsZSgnc2ltcGxlQW5ndWxhclRpY2tlcicsIFtdKS5cclxuZGlyZWN0aXZlKCd2ZXJ0aWNhbFRpY2tlcicsIGZ1bmN0aW9uICgkaW50ZXJ2YWwsICR0aW1lb3V0KSB7XHJcbiAgICByZXR1cm4ge1xyXG5cclxuICAgICAgICByZXN0cmljdDogJ0EnLFxyXG4gICAgICAgIHNjb3BlOiB0cnVlLFxyXG4gICAgICAgIGNvbXBpbGU6IGZ1bmN0aW9uICgpIHtcclxuXHJcbiAgICAgICAgICAgIHJldHVybiBmdW5jdGlvbiAoc2NvcGUsIGVsZW1lbnQsIGF0dHJpYnV0ZXMpIHtcclxuXHJcbiAgICAgICAgICAgICAgICB2YXIgdGltaW5nLFxyXG4gICAgICAgICAgICAgICAgICAgIHRpbWluZ0VmZmVjdCxcclxuICAgICAgICAgICAgICAgICAgICB0aW1pbmdFZmZlY3REaXZpZGVCeSA9IDQsXHJcbiAgICAgICAgICAgICAgICAgICAgaXNIb3ZlcmVkID0gZmFsc2UsXHJcbiAgICAgICAgICAgICAgICAgICAgaW5uZXJUaW1lLFxyXG4gICAgICAgICAgICAgICAgICAgIHN0YXJ0O1xyXG5cclxuICAgICAgICAgICAgICAgIGlmIChhdHRyaWJ1dGVzLnRpbWluZykge1xyXG4gICAgICAgICAgICAgICAgICAgIHRpbWluZyA9IGF0dHJpYnV0ZXMudGltaW5nO1xyXG4gICAgICAgICAgICAgICAgICAgIHRpbWluZ0VmZmVjdCA9IHRpbWluZyAvIHRpbWluZ0VmZmVjdERpdmlkZUJ5O1xyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICB0aW1pbmcgPSA1MDAwO1xyXG4gICAgICAgICAgICAgICAgICAgIHRpbWluZ0VmZmVjdCA9IHRpbWluZyAvIHRpbWluZ0VmZmVjdERpdmlkZUJ5IC8gdGltaW5nRWZmZWN0RGl2aWRlQnkgKiAyO1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIHNjb3BlLiR3YXRjaChlbGVtZW50LCBmdW5jdGlvbiAoKSB7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIHZhciBsaXN0ID0gZWxlbWVudCxcclxuICAgICAgICAgICAgICAgICAgICAgICAgaXRlbXMgPSBlbGVtZW50LmZpbmQoJ2xpJyksXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGl0ZW1GaXJzdDtcclxuXHJcblxyXG4gICAgICAgICAgICAgICAgICAgIGlmIChpdGVtcy5sZW5ndGgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbGlzdC5hZGRDbGFzcygnYWN0aXZlJyk7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICBzdGFydCA9ICRpbnRlcnZhbChmdW5jdGlvbiAoKSB7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgLypjYW5jZWwgdGhlIGNhbGxiYWNrIGZ1bmN0aW9uIGZvciBmYWRlLW91dCBhbmQgbWFrZXMgdGhlIHRpY2tlciBzdGVhZHkuKi9cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmIChpc0hvdmVyZWQpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGltZW91dC5jYW5jZWwoaW5uZXJUaW1lKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICByZXR1cm47XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaXRlbXMgPSBsaXN0LmNoaWxkcmVuKCdsaScpO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaXRlbUZpcnN0ID0gYW5ndWxhci5lbGVtZW50KGl0ZW1zWzBdKTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpdGVtRmlyc3QuYWRkQ2xhc3MoJ2ZhZGUtb3V0IG1pbnVzLW1hcmdpbi10b3AnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGltZW91dChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaXRlbUZpcnN0LnJlbW92ZUNsYXNzKCdtaW51cy1tYXJnaW4tdG9wJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbGlzdC5hcHBlbmQoaXRlbUZpcnN0KTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaW5uZXJUaW1lID0gJHRpbWVvdXQoZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpdGVtcy5yZW1vdmVDbGFzcygnZmFkZS1vdXQnKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9LCB0aW1pbmdFZmZlY3QpO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0sIHRpbWluZ0VmZmVjdCk7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9LCB0aW1pbmcpO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb25zb2xlLndhcm4oJ25vIGl0ZW1zIGFzc2lnbmVkIHRvIHRpY2tlciEgRW5zdXJlIHlvdSBoYXZlIGNvcnJlY3RseSBhc3NpZ25lZCBpdGVtcyB0byB5b3VyIG5nLXJlcGVhdC4nKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAgICAgZWxlbWVudC5vbignJGRlc3Ryb3knLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgJGludGVydmFsLmNhbmNlbChzdGFydCwgMCk7XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgICAgICAvKiBcclxuICAgICAgICAgICAgICAgICAqYXV0aG9yIC0gbWF5b1xyXG4gICAgICAgICAgICAgICAgICpjaGVja2luZyBmb3IgbW91c2UgZW50ZXIgdGhlIHRpY2tlciByZWdpb25cclxuICAgICAgICAgICAgICAgICAqL1xyXG4gICAgICAgICAgICAgICAgZWxlbWVudC5vbignbW91c2VlbnRlcicsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgICAgICBpc0hvdmVyZWQgPSB0cnVlO1xyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAgICAgLyogXHJcbiAgICAgICAgICAgICAgICAgKmF1dGhvciAtIG1heW9cclxuICAgICAgICAgICAgICAgICAqY2hlY2tpbmcgZm9yIG1vdXNlIGV4aXQgdGhlIHRpY2tlciByZWdpb25cclxuICAgICAgICAgICAgICAgICAqL1xyXG4gICAgICAgICAgICAgICAgZWxlbWVudC5vbignbW91c2VsZWF2ZScsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgICAgICBpc0hvdmVyZWQgPSBmYWxzZTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgfTtcclxuICAgICAgICB9XHJcblxyXG4gICAgfTtcclxufSk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvdGlja2VyLm1pbi5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Ozs7O0FBS0E7QUFDQTtBQUNBO0FBQ0E7Ozs7O0FBS0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

__webpack_require__(3);
__webpack_require__(0);
__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }
/******/ ]);