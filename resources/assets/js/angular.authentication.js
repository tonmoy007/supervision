'use strict';

angular.module('Authentication',[])
  
.factory('AuthenticationService',
    function (Base64, $http, $cookieStore, $rootScope, $timeout,SiteEssentials) {
        var service = {};
 
        service.Login = function (username, password, callback,scope) {
 
          
            var parameters={ email: username, password: password };
        $http({
                url:'api/login',
                method:'POST',
                data:parameters 
            }).then(function (response) {
                console.log(response);
               
                callback(response);
            },function(response){
                scope.error=response.data.message;
                console.log(response);
                scope.loginChecking=false;
                SiteEssentials.responsCheck(response);
            });
 
        };
  
        service.SetCredentials = function (username, password,user_data) {
            var authdata = Base64.encode(username + ':' + password);
            
            $rootScope.globals = {};
            $rootScope.globals.currentUser=user_data;

            $rootScope.globals.currentUser['username']=username;
            $rootScope.globals.currentUser['authdata']=authdata;
             $http.defaults.headers.common.Authorization = 'Bearer ' + user_data.token;
            // $http.defaults.headers.common['Authorization'] = 'Basic ' + authdata; // jshint ignore:line
            $cookieStore.put('globals', $rootScope.globals);
        };
  
        service.ClearCredentials = function () {
            $rootScope.globals = {};
            $cookieStore.remove('globals');
            $http.defaults.headers.common.Authorization = 'Bearer ';
        };
  
        return service;
    })
  
.factory('Base64', function () {
    /* jshint ignore:start */
  
    var keyStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
  
    return {
        encode: function (input) {
            var output = "";
            var chr1, chr2, chr3 = "";
            var enc1, enc2, enc3, enc4 = "";
            var i = 0;
  
            do {
                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);
  
                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;
  
                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }
  
                output = output +
                    keyStr.charAt(enc1) +
                    keyStr.charAt(enc2) +
                    keyStr.charAt(enc3) +
                    keyStr.charAt(enc4);
                chr1 = chr2 = chr3 = "";
                enc1 = enc2 = enc3 = enc4 = "";
            } while (i < input.length);
  
            return output;
        },
  
        decode: function (input) {
            var output = "";
            var chr1, chr2, chr3 = "";
            var enc1, enc2, enc3, enc4 = "";
            var i = 0;
  
            // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
            var base64test = /[^A-Za-z0-9\+\/\=]/g;
            if (base64test.exec(input)) {
                window.alert("There were invalid base64 characters in the input text.\n" +
                    "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
                    "Expect errors in decoding.");
            }
            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
  
            do {
                enc1 = keyStr.indexOf(input.charAt(i++));
                enc2 = keyStr.indexOf(input.charAt(i++));
                enc3 = keyStr.indexOf(input.charAt(i++));
                enc4 = keyStr.indexOf(input.charAt(i++));
  
                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;
  
                output = output + String.fromCharCode(chr1);
  
                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }
  
                chr1 = chr2 = chr3 = "";
                enc1 = enc2 = enc3 = enc4 = "";
  
            } while (i < input.length);
  
            return output;
        }
    };
  
    /* jshint ignore:end */
}).controller('LoginController',
    function ($scope, $rootScope, $location, AuthenticationService,$window,$mdDialog,
        ShowSimpleToast,$http,SiteEssentials,$state) {
        // reset login status
        AuthenticationService.ClearCredentials();
        var state=$state.current.name;
        if(state=='login.validate'){
            $scope.validating=true;
            $scope.reseting_password=false;
        }else if(state=='login.reset_password'){
            $scope.reseting_password=true;
            $scope.validating=false;
        }else{
            $scope.reseting_password=false;
            $scope.validating=false;
        }
        $rootScope.loggedin=false;
        $rootScope.body='login_body';
        $rootScope.page_title=' School | login';
        $scope.password_type='password';
        
        $scope.toggleShow=function(){
            if($scope.password_type=='password'){
                $scope.password_type='text';
            }else{
                $scope.password_type='password';
            }
        }
        $scope.login = function () {
            $scope.loginChecking = true;

            AuthenticationService.Login($scope.user.email, $scope.user.password, 
                function(response) {
                // console.log(response);
                if(response.data.success) {
                    
                    $scope.loginChecking = false;
                    
                    $scope.user=response.data.user_info;
                    AuthenticationService.SetCredentials($scope.user.email,
                    $scope.user.password,$scope.user);

                    console.log($rootScope.globals);
                    $location.path('/profile');
                } else {
                    $scope.error = response.data.message;
                    $scope.loginChecking = false;

                }
            },$scope);
        };
        $scope.cancel_forget=function(response){
            $scope.reseting_password=false;
            $scope.$parent.reseting_password=false;
            $scope.$parent.validating=false;
            $scope.validating=false;
        }
        $scope.askToken=function(email){
            var data={};
            data.email=email;
            var next='login.validate';
            $scope.loginChecking=true;
            $scope.$parent.loginChecking=true;
            $http({url:'api/password/forget',data:data,method:'POST'}).then(function(response){
                $scope.loginChecking = false;
            $scope.$parent.loginChecking=false;

                console.log(response);
                if(response.data.success){
                    if($state.current.name!=next)$state.go('login.validate');
                    else $state.reload('login.validate');
                    $scope.validating=true;
                    ShowSimpleToast.show(response.data.message);
                }else{
                    ShowSimpleToast.show(response.data.message);
                }
            },function(response){
                 $scope.loginChecking = false;
            $scope.$parent.loginChecking=false;

                 SiteEssentials.responsCheck(response);
                 $scope.cancel_forget();
            })
        }
        $scope.forget_password=function(ev){
            if(!$scope.user)$scope.user=[];
             var confirm = $mdDialog.prompt()
                  .title('Enter your email address')
                  .textContent('An email with a token  will be sent to your email address if you are registered with us.')
                  .placeholder('Email')
                  .ariaLabel('email')
                  .initialValue($scope.user.email)
                  .targetEvent(ev)
                  .ok('Send email')
                  .cancel('Cancel');

                $mdDialog.show(confirm).then(function(result) {
                  $scope.user.email=result;
                  console.log($scope.user.email);
                  $scope.askToken($scope.user.email);
                }, function() {
                  $scope.status = false;
                });
        }

        $scope.validate=function(pin){
            var data={};
            data.token=pin;
            var next='login.reset_password';
            $scope.$parent.loginChecking=true;
            $http({url:'api/password/validate',data:data,method:'POST'}).then(function(response){
                console.log(response)
                $scope.$parent.loginChecking=false;
                if(response.data.success){
                    $scope.validating=false;
                    $scope.reseting_password=true;
                    if($state.current.name==next)$state.reload(next);
                    else $state.go(next);
                    
                    $scope.user.id=response.data.id;
                    ShowSimpleToast.show(response.data.message);
                }else{
                    ShowSimpleToast.show(response.data.message);
                }
            })
        }
        $scope.changePassword=function(password,id){
            var data={};
            data.user_id=id;
            data.password=password;
            $scope.$parent.loginChecking=true;
            $http({url:'api/password/reset',data:data,method:'POST'}).then(function(response){
                console.log(response);
                $scope.$parent.loginChecking=false;
               $scope.cancel_forget();
               $state.go('login');
               ShowSimpleToast.show(response.data.message);
            })
        }


    });