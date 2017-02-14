var app=angular.module('mainHome',['components','ui.router',
    'ngCookies','ngMessages','super-controllers','Authentication','super-factory']);



app.config(function($stateProvider,$interpolateProvider,$urlRouterProvider){
    var home_state=[{
        name:'home',
        templateUrl:'getView/home.homepage',
        controller:'homeCtrl',
        url:'/'
    },
    {
        controller:function($scope){
            console.log($scope);
        },
        name:'contact',
        templateUrl:'getView/home.contact',
        url:'/contact'
    },
    {
        name:'login',
        controller:'LoginController',
        url:'/login',
        templateUrl:'getView/home.login'
    },
    {
        name:'profile',
        controller:'profileCtrl',
        url:'/profile',
        templateUrl:'getView/profile.dashboard',
        resolve:{
            Menu:function(){
                var menu=[
                {'name':'profile','title':'Home','icon':'img/avatar.png','template':''},
                {'name':'profile.reports','title':'Reports','icon':'img/avatar.png','template':''},
                {'name':'profile.notice','title':'Notice','icon':'img/avatar.png','template':''},
                {'name':'profile.schools','title':'Schools','icon':'img/avatar.png','template':''},
                {'name':'profile.settings','title':'Settings','icon':'img/avatar.png','template':''},
                {'name':'profile.home_contents','title':'Home Contents','icon':'img/avatar.png','template':''}
                ]
                return menu;
            }
        }
    },
    {
        name:'profile.reports',
        controller:'innerContentCtrl',
        url:'/reports',
        templateUrl:'getView/profile.reports'
    },
    {
        name:'profile.notice',
        controller:'innerContentCtrl',
        url:'/notice',
        templateUrl:'getView/profile.notice'
    },
    {
        name:'profile.schools',
        controller:'innerContentCtrl',
        url:'/schools',
        templateUrl:'getView/profile.schools'
    },
    {
        name:'profile.settings',
        controller:'innerContentCtrl',
        url:'/settings',
        templateUrl:'getView/profile.settings'
    },
    {
        name:'profile.home_contents',
        controller:'innerContentCtrl',
        url:'/home_contents',
        templateUrl:'getView/profile.home_contents'
    }
    ]

    $urlRouterProvider.otherwise('/');
    angular.forEach(home_state,function(value,key){
        $stateProvider.state(value);
    })
    
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.controller('homeCtrl',  function($scope,$http,$location,$state){
    // console.log($scope);
    $scope.home=true;
    
});

app.run(function($rootScope,$http,$cookieStore,$location,$stateParams,SiteEssentials){
   // keep user logged in after page refresh
        var page=$location.path().split('/');
        $rootScope.globals = $cookieStore.get('globals') || {};
        
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Basic ' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
        }
        
        $rootScope.nav={};
        // console.log($rootScope);
        
        $rootScope.$on('$stateChangeStart', function (event, toState) {
            
                // console.log(toState);
                var state=toState.name.split('.');
                $rootScope.nav.state=state;
                $rootScope.nav.current_state=state[0];
                $rootScope.nav.current_state_secendary=typeof state[1]!=undefined?state[1]:null;
                SiteEssentials.goTop();
                if(state.length>1&&state[0]=='profile'){
                    angular.element(document.getElementById('body')).addClass('no_scroll');
                }else{
                    angular.element(document.getElementById('body')).removeClass('no_scroll');
                }
                
                
                // console.log($rootScope.nav)
            
        });
        
        $rootScope.$on('$locationChangeStart', function (event, next, current){
            
            next=next.split('/')
            console.log(next);
            if(!$rootScope.globals.currentUser){
                $rootScope.login_page=true;
                $rootScope.body='login_body';
                $rootScope.isLoggedin=false;


            }else{
                $rootScope.login_page=false;
                $rootScope.isLoggedin=true;
                $rootScope.body="home_body"
            }
        });
  
})