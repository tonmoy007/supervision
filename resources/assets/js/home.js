var app=angular.module('mainHome',['components','ui.router','ngSanitize','ngFileUpload','angularTrix',
    'ngCookies','ngMessages','super-controllers','Authentication','super-factory']);



app.config(function($stateProvider,$interpolateProvider,$urlRouterProvider){
    var home_state=[{
        name:'home',
        title:'Home',
        templateUrl:'getView/home.homepage',
        controller:'homeCtrl',
        url:'/'
    },
    {
        controller:function($scope){
            console.log($scope);
        },
        title:'Contact',
        name:'contact',
        templateUrl:'getView/home.contact',
        url:'/contact'
    },
    {
        name:'login',
        title:'Login',
        controller:'LoginController',
        url:'/login',
        templateUrl:'getView/home.login'
    },
    {
        name:'profile',
        controller:'profileCtrl',
        url:'/profile',
        title:'profile',
        templateUrl:'getView/profile.dashboard',
        resolve:{
            Menu:function(){
                var menu=[
                {'name':'home','title':'Home','icon':'img/avatar.png','action_template':''},
                {'name':'profile.reports','title':'Reports','icon':'img/avatar.png','action_template':''},
                {'name':'profile.notice','title':'Notice','icon':'img/avatar.png','action_template':''},
                {'name':'profile.schools','title':'Schools','icon':'img/avatar.png',
                'action_template':'getView/template.actions.school'},
                {'name':'profile.settings','title':'Settings','icon':'img/avatar.png','action_template':''},
                {'name':'profile.home_contents','title':'Home Contents','icon':'img/avatar.png',
                'action_template':'getView/template.actions.home_contents'}
                ]
                return menu;
            }
        }
    },
    {
        name:'profile.reports',
        title:'Reports',
        controller:'innerContentCtrl',
        url:'/reports',
        templateUrl:'getView/profile.reports'
    },
    {
        name:'profile.notice',
        title:'Notice',
        controller:'innerContentCtrl',
        url:'/notice',
        templateUrl:'getView/profile.notice'
    },
    {
        name:'profile.schools',
        title:'Schools',
        controller:'schoolCtrl',
        url:'/schools',
        templateUrl:'getView/profile.schools',
        resolve:{
            Schools:function(superServices){
                return superServices.getSchools();
            }
        }
    },
    {
        name:'profile.settings',
        title:'Settings',
        controller:'innerContentCtrl',
        url:'/settings',
        templateUrl:'getView/profile.settings'
    },
    {
        name:'profile.home_contents',
        controller:'webContentsCtrl',
        title:'Home Contents',
        url:'/home_contents',
        templateUrl:'getView/profile.home_contents',
        resolve:{
            HomeContents:function(){
                var contents=[
                {name:'profile.home_contents.posts',
                'action_template':'getView/template.actions.home_contents',title:'Posts',icon:'/img/avatar.png'},
                {name:'profile.home_contents.links',
                'action_template':'getView/template.actions.home_contents',title:'Links',icon:'/img/avatar.png'},
                {name:'profile.home_contents.slider',
                'action_template':'getView/template.actions.home_contents',title:'Slider',icon:'/img/avatar.png'},
                {name:'profile.home_contents.gallery',
                'action_template':'getView/template.actions.home_contents',title:'Gallery',icon:'/img/avatar.png'},
                {name:'profile.home_contents.employees',
                'action_template':'getView/template.actions.home_contents',title:'Employees',icon:'/img/avatar.png'}
                ];
                return contents;
            }
        }
    },
    {
        name:'profile.home_contents.posts',
        controller:'contentCtrl',
        url:'/posts',
        title:'Posts',
        templateUrl:'getView/profile.home_contents.posts',
        resolve:{
            Contents:function(superServices){
                return superServices.getContent('post','posts');
            }
        }
    },
    {
        name:'profile.home_contents.links',
        controller:'contentCtrl',
        url:'/links',
        title:'Important Links',
        templateUrl:'getView/profile.home_contents.links',
        resolve:{
            Contents:function(superServices){
                return superServices.getContent('link','links');
            }
        }
    },
    {
        name:'profile.home_contents.slider',
        controller:'contentCtrl',
        title:'Slider',
        url:'/slider',
        templateUrl:'getView/profile.home_contents.slider',
        resolve:{
            Contents:function(superServices){
                return superServices.getContent('slider','sliders');
            }
        }
    },,
    {
        name:'profile.home_contents.gallery',
        controller:'contentCtrl',
        title:'Gallery',
        url:'/gallery',
        templateUrl:'getView/profile.home_contents.gallery',
        resolve:{
            Contents:function(superServices){
                return superServices.getContent('gallery','gallaries');
            }
        }
    },
    {
        name:'profile.home_contents.employees',
        controller:'contentCtrl',
        title:'Employees',
        url:'/employees',
        templateUrl:'getView/profile.home_contents.employees',
        resolve:{
            Contents:function(superServices){
                return superServices.getContent('employee','employees');
            }
        }
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

app.run(function($rootScope,$http,$cookieStore,$location,$stateParams,SiteEssentials,$state){
   // keep user logged in after page refresh
       
        $rootScope.globals = $cookieStore.get('globals') || {};
        
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Bearer ' + $rootScope.globals.currentUser.token; // jshint ignore:line
        }
        
        $rootScope.nav={};
        // console.log($rootScope);
        
        $rootScope.$on('$stateChangeStart', function (event, toState) {
            
                // console.log(toState);
                var state=toState.name.split('.');
                $rootScope.nav.state=state;
                $rootScope.nav.current_state=state[0];
                $rootScope.nav.current_state_secendary=typeof state[1]!=undefined?state[1]:null;
                $rootScope.nav.item=[];
                $rootScope.nav.title=toState.title;
                SiteEssentials.goTop();

                if(state.length>1&&state[0]=='profile'){
                    angular.element(document.getElementById('body')).addClass('no_scroll');
                }else{
                    angular.element(document.getElementById('body')).removeClass('no_scroll');
                }
                $rootScope.nav.state=state;
                $rootScope.nav.current_state=state[0];
                $rootScope.nav.current_state_secendary=typeof state[1]!=undefined?state[1]:null;
                $rootScope.nav.item=[];
                
                // console.log($rootScope.nav)
            
        });
        
        $rootScope.$on('$locationChangeStart', function (event, next, current){

            var page=$location.path().split('/');
            
            
            if(!$rootScope.globals.currentUser){
                $rootScope.login_page=true;
                $rootScope.body='login_body';
                $rootScope.isLoggedin=false;
                if(page[1]=='profile'){
                    $location.path('/login');
                }


            }else{
                if(page[1]=='login')
                   {
                    logout= confirm('Are you sure ?? will be logged out..');
                     if(!logout)$location.path('/')
                   }

                $rootScope.login_page=false;
                $rootScope.isLoggedin=true;
                $rootScope.body="home_body"
            }
        });
  
})