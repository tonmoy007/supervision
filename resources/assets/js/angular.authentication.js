'use strict';

angular.module('Authentication',[])
  
.factory('AuthenticationService',
    function (Base64, $http, $cookieStore, $rootScope, $timeout) {
        var service = {};
 
        service.Login = function (username, password, callback,scope) {
 
            /* Dummy authentication for testing, uses $timeout to simulate api call
             ----------------------------------------------*/
            // $timeout(function(){
            //     var response = { success: username === 'test' && password === 'test' };
            //     if(!response.success) {
            //         response.message = 'Username or password is incorrect';
            //     }
            //     callback(response);
            // }, 1000);
 
 
            /* Use this for real authentication
             ----------------------------------------------*/
             // console.log(username);
            var parameters={ email: username, password: password };
            $http(
                {
                    url:'api/login',
                    method:'post',
                    data:parameters 
             })
                
               .then(function (response) {
                console.log(response)
               
                callback(response);
            },function(response){
                scope.loginChecking=false;
                // SiteEssentials.responsCheck(response);
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
    function ($scope, $rootScope, $location, AuthenticationService,$window) {
        // reset login status
        AuthenticationService.ClearCredentials();
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
                    $location.path('#/');
                } else {
                    $scope.error = response.data.message;
                    $scope.loginChecking = false;

                }
            },$scope);
        };
        

    });