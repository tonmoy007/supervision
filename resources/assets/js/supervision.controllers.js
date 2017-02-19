'use strict';

angular.module('super-controllers',[])


.controller('menuCtrl',function($scope,$http,$location,$state,SiteEssentials,superServices){

    $scope.logout=function(){
        
        superServices.logout();
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
    $scope.goback=function(){
        var states=$rootScope.nav.state;
        var back_state=states[0];

        for(var i=1;i<states.length-1;i++){
            back_state+='.'+states[i];
        }
        if(back_state!=''){
            $state.go(back_state);
        }else{
            $state.go($rootScope.nav.current_state);
        }
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
    
}).controller('actionsCtrl',function($scope,$rootScope,$mdDialog,$state,ShowSimpleToast){
  
    $scope.search=function(query){
        $scope.$parent.actions.search_query=query;
        console.log(query);
    }
    $scope.addNew=function(ev,type){
         $mdDialog.show({
          templateUrl: 'getView/'+$state.current.name+'.add',
          parent: angular.element(document.body),
          targetEvent: ev,
          controller:'addNewCtrl',
          clickOutsideToClose: false,
          fullscreen:true
        }).then(function(data,key,value){
            
            ShowSimpleToast.show(data.message);
        });
    }
  
    
    
})
.controller('addNewCtrl',function($scope,$mdDialog,$rootScope,superServices){
     
     
    $scope.setFiles=function($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event){
        console.log($file);
    }
    $scope.hide=function(){
        $mdDialog.hide();
    }
    $scope.loadCategory=function(link){
         return superServices.loadCategory($scope,link);
    }
    $scope.submitForm=function(form,data,url,name,key){

        superServices.addNewContent(data,url,name,key,$scope);
    }
    $scope.cancelImg=function(images,index){
        images.splice(index,1);
        console.log(images);
    }
})

.controller('webContentsCtrl',function($state,$scope,$rootScope,HomeContents,Menu,SiteEssentials,superServices){
    $scope.home_contents=HomeContents;
    var i=0;
    $rootScope.nav.item=Menu.find(function(item){
        i++;
        return item.name==$state.current.name
     });
    $rootScope.nav.profile_index=i;
     $scope.search=function(query){
        $scope.$parent.actions.search_query=query;
        console.log(query);
    }
})
.controller('contentCtrl',function($state,$scope,$rootScope,HomeContents,Contents,SiteEssentials,superServices,ShowSimpleToast){
    
    $scope.home_contents=HomeContents;
    var states=$rootScope.nav.state;
    $rootScope.profile_index=states.length-1;
    $scope[states[$rootScope.profile_index]]=Contents;
    
    $rootScope.nav.item=HomeContents.find(function(content){
        return content.name==$state.current.name;
    })
    
    $scope.expand=function(index,content,data,double,key){
        console.log(key);
        SiteEssentials.expand($scope[content],index,'expand',double,key);
        // console.log($scope[content]);
    }
})

