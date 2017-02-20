var app=angular.module('mainHome',['components','ui.router','ngSanitize','ngFileUpload','angularTrix',
    'ngCookies','ngMessages','super-controllers','Authentication','super-factory']);



app.config(function($stateProvider,$interpolateProvider,$urlRouterProvider,$mdIconProvider){
    
    var home_state=[{
        name:'home',
        title:'Home',
        templateUrl:'getView/home.homepage',
        controller:'homeCtrl',
        url:'/',
        resolve:{
            
        }
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
        name:'posts',
        title:'Posts',
        controller:'HomePostCtrl',
        url:'/posts/:id',
        templateUrl:'getView/home.template.single_post',
        resolve:{
            Post:function($stateParams,superServices){
                
                return superServices.getContent('post','posts',$stateParams.id);
            }
        }
    },
    {
        name:'employees',
        title:'Employees',
        controller:'employeeCtrl',
        url:'/employees/:type',
        templateUrl:'getView/home.template.employees',
        resolve:{
            Employees:function($stateParams,superServices){
                return superServices.getContent('employee/category','employees',$stateParams.type);
            }
        }
    },
    {
        name:'employees.single',
        title:'Single Employee',
        url:'/:id',
        templateUrl:'getView/home.template.single_employee',
        resolve:{
            Employee:function(Employees,$routeParams){
                return Employees.find(function(employee){
                    return employee.id==$routeParams.id;
                })
            }
        }
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
            Menu:function(superServices){
                
                return superServices.getMenu('profile');
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
            HomeContents:function(superServices){
               
                return superServices.getMenu('home_contents');
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

app.controller('homeCtrl',  function($scope,$http,$location,$state,superServices){
    // console.log($scope);
    $scope.home=true;
    console.log(superServices.getMenu('profile'));
    console.log(superServices.getMenu('home_contents'));
    

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
            
               SiteEssentials.goTop();
                // console.log(toState);
                var state=toState.name.split('.');
                $rootScope.data=[];
                $rootScope.site=[];
                $rootScope.nav.state=state;
                $rootScope.nav.current_state=state[0];
                $rootScope.nav.current_state_secendary=typeof state[1]!=undefined?state[1]:null;
                $rootScope.nav.item=[];
                $rootScope.globals.current_state=$state;
                $rootScope.nav.title=toState.title;
                $rootScope.globals.title_bar=toState.title;
                
                
                if(state.length>1&&state[0]=='profile'){
                    angular.element(document.getElementById('body')).addClass('no_scroll');
                }else{
                    angular.element(document.getElementById('body')).removeClass('no_scroll');
                }

               switch (toState.name) {
                    case 'home':
                        $rootScope.site.title='একাডেমিক সুপারভিশন';break;
                    case 'contact':
                        $rootScope.site.title='যোগাযোগ';break;
                    default:
                        $rootScope.site.title= 'একাডেমিক সুপারভিশন';
               }
                
                // console.log($rootScope.nav)
            
        });
        
        $rootScope.$on('$locationChangeStart', function (event, next, current){

            var page=$location.path().split('/');
            console.log(next);
            
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
                    logout= confirm('Are you sure ? you will be logged out from this session...');
                     if(!logout)$location.path('/')
                   }

                $rootScope.login_page=false;
                $rootScope.isLoggedin=true;
                $rootScope.body="home_body"
            }
        });
  
})