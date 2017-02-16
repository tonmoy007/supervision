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
    $scope.menu=Menu;
    
    $scope.open=function(item,index){
        $rootScope.nav.profile_index=index;
        $rootScope.nav.item=item;
        $rootScope.nav.loading=true;
        $state.go(item.name);
    }
  $scope.createactions=function(){
        $scope.actions=[];
        $scope.actions.search_query='';
        console.log($scope.actions)
    }

})

.controller('innerContentCtrl',function($scope,$http,SiteEssentials,superServices,$rootScope,$state,ShowSimpleToast,Menu){
    // add expanding element/placeholder 
     var i=-1;
     $scope.createactions=function(){
        $scope.actions=[];
        $scope.search_query=[];
        console.log($scope.actions)
     }
     $rootScope.nav.item=Menu.find(function(item){
        i++;
        return item.name==$state.current.name
     });
     $rootScope.nav.profile_index=i;
})

.controller('schoolCtrl',function($scope,SiteEssentials,superServices,$rootScope,ShowSimpleToast,Schools,Menu,$state){
    $scope.schools=[];
    var i=-1;
    $rootScope.nav.item=Menu.find(function(item){
        i++;
        return item.name==$state.current.name
     });
    $rootScope.nav.profile_index=i;
    
    if(Schools){
        $scope.schools=Schools
    }
    $scope.expand=function(index){

        SiteEssentials.expand($scope.schools,index,'expand');
    }
    $scope.editSchool=function(){
        
    }
    
}).controller('actionsCtrl',function($scope,$rootScope,$mdDialog){
    $scope.createactions=function(){
        
    }

    $scope.search=function(query){
        $scope.$parent.actions.search_query=query;
        console.log($scope);
    }
    $scope.addNew=function(ev,type){
         $mdDialog.show({
          contentElement: '#addNew'+type,
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose: true
        });
    }
    $scope.hide=function(){
        $mdDialog.hide();
    }
    
    
})
