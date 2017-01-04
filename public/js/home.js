'use strict';

var app=angular.module('mainHome',['components','ngMaterial','ui.router','ngCookies','ngMessages','ngAnimate']);


app.config(function($stateProvider,$interpolateProvider,$urlRouterProvider){
    var home_state={
        name:'home'
        templateUrl:'getView/home.homepage',
        controller:'homeCtrl',
        url:'/home'
    };
    var contact_state={
        controller:function($scope){
            console.log($scope);
        },
        name:'contact',
        templateUrl:'getView/home.contact',
        url:'/contact'
    };
    var login_state={
        name:'login',
        url:'/login',
        templateUrl:'getView/home.login'
    }

    $urlRouterProvider.otherwise('/home');
    $stateProvider.state(contact_state);
    $stateProvider.state(login_state);
    $stateProvider.state(home_state);
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.controller('homeCtrl',  function($scope){
    $scope.home=true;
});

app.run(function($rootScope,$http,$cookieStore,$location,$stateParams){
   // keep user logged in after page refresh
        var page=$location.path().split('/');
        $rootScope.globals = $cookieStore.get('globals') || {};
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Basic ' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
        }
        $rootScope.nav={};
        console.log($rootScope);
        $rootScope.$on('$stateChangeStart', function (event, toState) {
            
                console.log(toState);
                $rootScope.nav.current_state=toState.name;
                $rootScope.nav.current_state_secendary=toState.name;
                if(toState.name=='inventory.cars' ){
                   $rootScope.nav.current_state='inventory'; 
                }
                if(toState.name=='inventory.total' ){
                   $rootScope.nav.current_state='inventory'; 
                }
                if(toState.name=='inventory.cars.products'){
                    $rootScope.nav.current_state='inventory';
                    $rootScope.nav.current_state_secendary='inventory.cars' 
                }
                
                
                // console.log($rootScope.nav)
            
        });
        
        $rootScope.$on('$locationChangeStart', function (event, next, current){
            console.log(next);
            if(!$rootScope.globals.currentUser){
                $rootScope.login_page=true;
                $rootScope.body='login_body';
                $location.path('/login');


            }else{
                $rootScope.login_page=false;
                $rootScope.body="home_body"
            }
        });
  
})