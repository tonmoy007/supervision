var app=angular.module('mainHome',['components','ui.router','ngSanitize','ngFileUpload','angularTrix',
    'ngCookies','ngMessages','super-controllers','Authentication','super-factory',
            "com.2fdevs.videogular",
            "com.2fdevs.videogular.plugins.controls"]);



app.config(function($stateProvider,$interpolateProvider,$urlRouterProvider,$mdIconProvider){
    
    var home_state=[{
        name:'home',
        title:'Home',
        templateUrl:'getView/home.homepage',
        controller:'homeCtrl',
        url:'/',
        role:'all',
        resolve:{
            
        }
    },
    {
        controller:function($scope){
            console.log($scope);
        },
        title:'Contact',
        name:'contact',
        role:'all',
        templateUrl:'getView/home.contact',
        url:'/contact'
    },
    {
        name:'gallery',
        title:'Galelry',
        role:'all',
        url:'/gallery/:type',
        templateUrl:'getView/home.template.gallery',
        controller:'galleryCtrl',
        resolve:{
            Gallery:function($stateParams,superServices){
                return superServices.getContent('gallery','gallaries',$stateParams.type);
            }
        }
    },
    {
        name:'posts',
        title:'Posts',
        role:'all',
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
        role:'all',
        url:'/employees/:type',
        templateUrl:'getView/home.template.employees',
        resolve:{
            Employees:function($stateParams,superServices){
                return superServices.getContent('employee/category','employees',$stateParams.type);
            }
        }
    },{
        name:'institution',
        title:'Institution',
        role:'all',
        controller:function($scope,Schools,$state,$stateParams){
            $scope.type=$stateParams.type;
            $scope.schools=Schools;
        },
        url:'/institution/:type',
        templateUrl:'getView/home.template.schools',
        resolve:{
            Schools:function($stateParams,superServices){
                return superServices.getContent('school/category','schools',$stateParams.type);
            }
        }
    },
    {
        name:'login',
        title:'Login',
        controller:'LoginController',
        url:'/login',
        role:'all',
        templateUrl:'getView/home.login'
    },
    {
        name:'login.validate',
        title:'Validate',
        url:'/validate',
        role:'all',
        controller:'LoginController',
        templateUrl:'getView/home.template.validate_token',
    },
    {
        name:'login.reset_password',
        title:'Reset Password',
        url:'/reset_password',
        role:'all',
        controller:'LoginController',
        templateUrl:'getView/home.template.reset_password'
    },
    {
        name:'profile',
        controller:'profileCtrl',
        url:'/profile',
        role:'all',
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
        controller:'reportCtrl',
        url:'/reports',
        role:'all',
        templateUrl:'getView/profile.reports',
        resolve:{
            ReportMenu:function(superServices){
               return superServices.getContent('questions/menu','menu');
            }
        }
    },
    {
        name:'profile.reports.form',
        title:'Reports',
        url:'/:name',
        role:'all',
        controller:'formCtrl',
        templateUrl:'getView/profile.reports.form_view',
        resolve:{
            Questions:function(superServices,$stateParams){
                var form=superServices.getReportForm($stateParams);
                
                return superServices.getReportForm($stateParams);
            }
        }
    },
    {
        name:'profile.notice',
        title:'Notice',
        controller:'noticeCtrl',
        url:'/notice',
        role:'all',
        templateUrl:'getView/profile.notice',
        resolve:{
            Notice:function(superServices){
                return superServices.getContent('notice','notices');
            }
        }
    },
    {
        name:'profile.schools',
        title:'Schools',
        role:'admin',
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
        name:'profile.schools.report',
        title:'School Report',
        role:'all',
        url:'/:id',
        controller:'reportViewCtrl',
        templateUrl:'getView/profile.schools.report',
        resolve:{
            Questions:function(superServices,$stateParams){
                
                var data= superServices.getContent('questions/all','report',$stateParams.id);
                console.log(data);
                return data;
            },
            Profile:function(Schools,$stateParams){
                
                var school=Schools.find(function (school){
                    
                    return school.id==$stateParams.id;
                });
                
                return school;
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
        role:'admin',
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
        role:'admin',
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
        role:'admin',
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
        role:'admin',
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
        role:'admin',
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
        role:'admin',
        templateUrl:'getView/profile.home_contents.employees',
        resolve:{
            Contents:function(superServices){
                return superServices.getContent('employee','employees');
            }
        }
    },
    {
        name:'profile.class',
        controller:'classCtrl',
        title:'Classes',
        url:'/class',
        role:'general_user',
        templateUrl:'getView/profile.class.class',
        resolve:{
            Classes:function(superServices){
                return superServices.getClasses();
            },
            Attendance:function(superServices){
                return superServices.getAttendance();
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
    $scope.information=null;
    $scope.homePage=null
    superServices.loadHomepageContent($scope,'information');
    $scope.$watch('information',function(value){
        if(value){
            $scope.homeLoaded=true;
            $scope.homePage=value;
        }
    })
});

app.run(function($rootScope,$http,$cookieStore,$location,$stateParams
    ,SiteEssentials,$state,$interval,superServices,ShowSimpleToast){
   // keep user logged in after page refresh
       
        $rootScope.globals = $cookieStore.get('globals') || {};
        console.log($stateParams.id);
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Bearer ' + $rootScope.globals.currentUser.token; // jshint ignore:line

        }

        $rootScope.notification=$interval(function(){
                if ($rootScope.globals.currentUser) 
                    superServices.checkNotice();
            },60000);
        
        $rootScope.nav={};
        // console.log($rootScope);
        
        $rootScope.$on('$stateChangeStart', function (event, toState) {
            
               SiteEssentials.goTop();

                console.log($stateParams);
                var state=toState.name.split('.');
                $rootScope.data=[];
                $rootScope.site=[];
                $rootScope.nav.state=state;
                $rootScope.nav.current_state=state[0];
                $rootScope.nav.current_state_secendary=typeof state[1]!=undefined?state[1]:null;
                $rootScope.nav.item=[];
                $rootScope.school_data=[];
                $rootScope.globals.current_state=$state;
                $rootScope.nav.title=toState.title;
                $rootScope.globals.title_bar=toState.title;
                
                if(!$rootScope.globals.currentUser&&state[0]=='profile'){
                    $state.go('home');
                    ShowSimpleToast.show('you must be lost ');
               }else{
                if($rootScope.globals.currentUser){
                    role=$rootScope.globals.currentUser.role;
                    
                    if(toState.role!='all'&&toState.role!=role){
                        $state.go('home');

                    }
                }
               }
                
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
                    case 'gallery':
                        $rootScope.site.title='গ্যালারী';
                    default:
                        $rootScope.site.title= 'একাডেমিক সুপারভিশন';
               }
                
                
            
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