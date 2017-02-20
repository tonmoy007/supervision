'use strict';

angular.module('super-controllers',[])


.controller('menuCtrl',function($scope,$http,$location,$state,SiteEssentials,superServices){

    $scope.logout=function(){
        
        superServices.logout();
    }
})
.controller('sidebarCtrl',function($scope,SiteEssentials,superServices,Posts){
    $scope.sidebarLoading=true;


})
.controller('employeeCtrl',function($scope,SiteEssentials,superServices,Employees){
    $scope.employees=Employees;
    console.log(Employees);

})
.controller('singleEmployeeCtrl',function(Employees,Employee,$scope,$rootScope,superServices){


})
.controller('HomePostCtrl',function($scope,Post,SiteEssentials,$rootScope){
    $scope.post=Post;
    $rootScope.site.title=$scope.post!=null?$scope.post.type:$rootScope.site.title;
    
    $scope.getDate=function(date){
        return SiteEssentials.getDate(date);
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

.controller('schoolCtrl',function($scope,SiteEssentials,superServices,
    $rootScope,ShowSimpleToast,Schools,Menu,$state){
    $scope.schools=[];
    var i=-1;
    $rootScope.nav.item=Menu.find(function(item){
        i++;
        return item.name==$state.current.name
     });
    $rootScope.nav.profile_index=i;
    
    if(Schools){

        $scope.schools=Schools
        console.log(Schools);
    }
    $scope.expand=function(index){

        SiteEssentials.expand($scope.schools,index,'expand');
    }
    $scope.editSchool=function(){
        
    }
    $scope.delete=function(ev,item_name,url,id){
        superServices.deleteContent(ev,item_name,url,id);
    }
    $scope.submitForm=function(form,data,url,name,key){

        superServices.addNewContent(data,url,name,key,$scope);
    }
    $scope.showEdit=function(ev,name,data,data_index,key,category_path){
        console.log(data)
        superServices.showModelEdit(ev,$scope,name,data_index,key);
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
            
            if(data){
                ShowSimpleToast.show(data.message);
            }
        });
    }
  
    
    
})
.controller('addNewCtrl',function($scope,$mdDialog,$rootScope,superServices){
     
     
    $scope.setFiles=function($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event){
        console.log($files)
       console.log($scope.newGallery.images);
       console.log($scope.newGallery.featured_image);

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
     $scope.search=function(query){
        $scope.$parent.actions.search_query=query;
        console.log(query);
    }
})
.controller('contentCtrl',function($state,$scope,$rootScope,HomeContents,Contents,SiteEssentials,superServices,ShowSimpleToast){
    
    $scope.home_contents=HomeContents;
    var states=$rootScope.nav.state;
    var index=states.length-1;
    $scope[states[index]]=Contents;
    var i=-1;
    
    $rootScope.nav.item=HomeContents.find(function(content){
        i++;
        return content.name==$state.current.name;
    })
    $rootScope.nav.profile_index=i;

    $scope.search=function(query){
        $scope.$parent.actions.search_query=query;
        console.log(query);
    }
    $scope.expand=function(index,content,data,double,key){
        console.log(key);
        SiteEssentials.expand($scope[content],index,'expand',double,key);
        // console.log($scope[content]);
    }
    $scope.delete=function(ev,item_name,url,id){
        superServices.deleteContent(ev,item_name,url,id);
    }
    
    $scope.showEdit=function(ev,name,data,data_index,key,category_path){

        if(!$scope.categories)
            superServices.loadCategory($scope,category_path+'/category');
       
        if(name=='links'||name=='employees'){
            superServices.showLinkEdit($scope,name,data_index,key);
        }else{
            superServices.showModelEdit(ev,$scope,name,data_index,key);
        }
    }
    $scope.getDate=function(date){
        return SiteEssentials.getDate(date);
    }
    $scope.submitEditForm=function(form,data,link){
        if(!form.$invalid)
        superServices.submitEditForm($scope,data,link);
    }
})


.controller('editModelCtrl',function($scope,$rootScope,$mdDialog,superServices,SiteEssentials){
    $scope.data=[];

    $scope.data.editContent=$rootScope.data.editContent;
    console.log($scope);

    var category_path='post';

     if(!$scope.categories&&$rootScope.nav.state[1]!='schools')
            superServices.loadCategory($scope,category_path+'/category');

    $scope.hide=function(){
        $mdDialog.hide();
    }
    $scope.submitEditForm=function(form,data,link){
        if(!form.$invalid){
            superServices.submitEditForm($scope,data,link,true);
        }
    }
    $scope.loadCategory=function(link){
        return superServices.loadCategory($scope,link);
    }
    $scope.getDate=function(date){
        return SiteEssentials.getDate(date);
    }
    
})

