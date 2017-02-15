'use strict';
angular.module('super-controllers',['Authentication'])


.controller('menuCtrl',function($scope,$http,$location,$state,AuthenticationService){
    $scope.logout=function(){
        
        $http.get('api/logout').then(function(response){
            console.log(response);
            if(response.data.success){
                $location.path('/');
                $state.reload('home');
                AuthenticationService.ClearCredentials();
            }else{
                $location.path('/');
                AuthenticationService.ClearCredentials();

                $state.reload('home');
            }
        },function(response){
            console.log(response);
            AuthenticationService.ClearCredentials();
            $location.path('/');
            $state.reload('home');
        });
    }
})

.controller('profileCtrl',function($scope,$rootScope,$http,SiteEssentials,superServices,Menu,$state){
    // console.log($rootScope.nav)
    $scope.menu=Menu
    $scope.open=function(item,index){
        $rootScope.nav.profile_index=index;
        $rootScope.nav.item=item;
        $rootScope.nav.loading=true;
        $state.go(item.name);
    }


})

.controller('innerContentCtrl',function($scope,$http,SiteEssentials,superServices,$rootScope,$state,ShowSimpleToast){
    // add expanding element/placeholder 
     $http.get('api/users').then(function(response){
        console.log(response);
        ShowSimpleToast.show(response.data.message+' total'+ response.data.users.length);
     })

})
