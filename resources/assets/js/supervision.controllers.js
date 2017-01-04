'use strict';
angular.module('super-controllers',['Authentication'])
.controller('menuCtrl',function($scope,$http,$location,$state,AuthenticationService){
    $scope.logout=function(){
        console.log('logout');
        $http.get('api/logout').then(function(response){
            console.log(response);
            if(response.data.success){
                $location.path('/');
                $state.reload('home');
            }
        },function(response){
            console.log(response);
            AuthenticationService.ClearCredentials();
        });
    }
})

