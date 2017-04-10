'use strict';

angular.module('super-controllers',[])


.controller('menuCtrl',function($scope,$http,$location,$state,SiteEssentials,superServices,$rootScope){
    $scope.menu=false;
    
    $scope.logout=function(){
        superServices.logout();
    }
    $scope.$watch('coverLoaded',function(value){
        if(value){
            $rootScope.globals.siteLoaded=true;
            // console.log($rootScope);
        }
    })
})
.controller('sidebarCtrl',function($scope,SiteEssentials,superServices){
    $scope.sidebarLoading=true;
    var success=function(response){
        $scope.sidebarLoading=false;
        if(response.data.success){
            $scope.sidebarLoading=false;
            $scope.sidebar=response.data.sidebar;
            $scope.bani=response.data.sidebar['বানী'];
            $scope.khobor=response.data.sidebar['খবর'];
            console.log($scope)
        }
    }
    var failed=function(response){
        $scope.sidebarLoading=false;
        SiteEssentials.responsCheck(response);
    }
    superServices.loadSideBar($scope,success,failed);

})
.controller('employeeCtrl',function($scope,SiteEssentials,superServices,Employees,$stateParams){
    $scope.employees=Employees;
    $scope.type=$stateParams.type;


})
.controller('galleryCtrl', function($scope,Gallery,$stateParams,superServices,$sce){
    $scope.gallery=Gallery;
    $scope.type=$stateParams.type;
    if($scope.type=='video'){
        $scope.video_config=[];
        angular.forEach($scope.gallery,function(value,key){
            $scope.video_config[key]={
                sources:[{src:$sce.trustAsResourceUrl(value.file),type:'video/mp4'}],
                tracks: [
                    {
                        src: "http://www.videogular.com/assets/subs/pale-blue-dot.vtt",
                        kind: "subtitles",
                        srclang: "en",
                        label: "English",
                        default: ""
                    }
                ]
            }
            
        })
    }
    $scope.videoLoad=true;

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
    $scope.categories=['স্কুল','কলেজ','মাদ্রাসা'];
    $scope.types=['বালক','বালিকা','কো-এডুকেসন'];
    $scope.managements=['সরকারী','বেসরকারী','অন্যান্য'];
    var i=-1;
    $rootScope.nav.item=Menu.find(function(item){
        i++;
        return item.name==$state.current.name
     });
    $rootScope.nav.profile_index=i;
    
    if(Schools){

        $scope.schools=Schools
        // console.log(Schools);
    }

    $scope.go=function(state,param){
        console.log(param)
        $state.go(state,param);
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
        // console.log(query);
    }
    $scope.addNew=function(ev,type){
        if(type==null){
            type='';
        }
         $mdDialog.show({
          templateUrl: 'getView/'+$state.current.name+'.add'+type,
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
.controller('addNewCtrl',function($scope,$mdDialog,$rootScope,superServices,$state){
     
     if($state.current.name=='profile.schools'){

        $scope.categories=['স্কুল','কলেজ','মাদ্রাসা'];
        $scope.types=['বালক','বালিকা','কো-এডুকেসন'];
        $scope.managements=['সরকারী','বেসরকারী','অন্যান্য'];
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
    if($rootScope.school_data!=undefined){
       $scope.attendance=$rootScope.school_data.classes;
    }
   
   console.log($scope.attendance);
   $scope.submitAttendance=function(form,attendance){
    var data=[];
     data['attendance']=attendance;
    var url='attendance';
        superServices.addNewContent(data,url,null,null,$scope);
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


.controller('editModelCtrl',function($scope,$rootScope,$mdDialog,superServices,SiteEssentials,$state){
    $scope.data=[];

    $scope.data.editContent=$rootScope.data.editContent;
    console.log($scope);

    var category_path='post';

     if(!$scope.categories&&$rootScope.nav.state[1]=='home_contents')
            superServices.loadCategory($scope,category_path+'/category');
     if($state.current.name=='profile.schools'){

        $scope.categories=['স্কুল','কলেজ','মাদ্রাসা'];
        $scope.types=['বালক','বালিকা','কো-এডুকেসন'];
        $scope.managements=['সরকারী','বেসরকারী','অন্যান্য'];
     }
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

.controller('classCtrl',function($scope,$rootScope,Classes,Attendance,Menu,$state,superServices,SiteEssentials){
    // console.log(Classes)
    // console.log(Attendance);
    var i=-1;
     $rootScope.nav.item=Menu.find(function(item){
        i++;
        return item.name==$state.current.name
     });

    $rootScope.nav.profile_index=i;
    $rootScope.school_data=[];
    $rootScope.school_data.classes=Classes.classes;
    $rootScope.school_data.attendance=Attendance.attendance;
    $scope.classes=Classes.classes;
    $scope.attendance=Attendance.attendance;
    $scope.classLoaded=true;
    $scope.is_attendance_taken=Classes.isAttendanceTaken;
    $scope.createactions=function(){
        $scope.actions=[];
        $scope.search_query=[];
        console.log($scope.actions)
     }
    $scope.search=function(query){
        $scope.$parent.actions.search_query=query;
        console.log(query);
    }
    $scope.go=function(state,param){
        console.log(param)
        $state.go(state,param);
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
            superServices.showModelEdit(ev,$scope,name,data_index);
    }
    $scope.getDate=function(date){
        return SiteEssentials.getDate(date);
    }
    $scope.submitEditForm=function(form,data,link){
        if(!form.$invalid)
        superServices.submitEditForm($scope,data,link);
    }

})
.controller('noticeCtrl',function($scope,Menu,$state,Notice,$rootScope,superServices,SiteEssentials){
    console.log(Notice);
    $scope.notices=Notice;
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

     
            superServices.showModelEdit(ev,$scope,name,data_index);
       
    }
    $scope.getDate=function(date){
        return SiteEssentials.getDate(date);
    }
    $scope.submitEditForm=function(form,data,link){
        if(!form.$invalid)
        superServices.submitEditForm($scope,data,link);
    }

})

.controller('reportCtrl',function($scope,$rootScope,ReportMenu,superServices,$state){
    console.log(ReportMenu);

    $scope.state=$state;

    $scope.report_menu=ReportMenu;
    $scope.openReport=function(item){
        
        $state.go("profile.reports.form",{'name':item.url});

    }
})
.controller('formCtrl',function($scope,$rootScope,Questions,$state,$stateParams,superServices,SiteEssentials){
    
    $scope.name=$stateParams.name;
    $scope.view='/getView/profile.reports.'+$scope.name;
    $scope.form=Questions.form;
    $scope.in_data={};
    console.log(Questions);
    $rootScope.nav.title=$scope.form.title.value;
    $scope.submitAnswer=function(form,report,type){
        if(form.$invalid)return;
        var answers=superServices.getAnswers(report,type);
        console.log(answers);
        superServices.submitAnswer($scope,answers);

    }
    $scope.getNumber=function(number){
        return SiteEssentials.getNumber(number);
    }
    $scope.getDate=function(date){
        return SiteEssentials.getDate(date);
    }
    $scope.clusterSubmit=function(data,contents){
        data.new=true;
        if(!data.responsible&&!data.total_school&&!data.present_school)return;
        var n_data=SiteEssentials.cloneJSON(data);
        $scope.in_data={};
        contents.push(n_data);
        $scope.changed=true;
        $scope.in_data.serial_no=$scope.getNumber(contents.length+1);
    }
    $scope.delete_cluster=function(item){
        item.is_delete=1;
        $scope.changed=true;
    }
    $scope.edit=function(item){
        item.edit=1;
        $scope.changed=true;
    }


})

.controller('reportViewCtrl', function(Questions,$scope,$rootScope,SiteEssentials,Profile){
    console.log(Questions)
    $scope.questions=Questions;
    // console.log(Profile);
    $rootScope.nav.title=Profile.user.name+' এর রিপোর্ট';
    $scope.profile=Profile;
    
    $scope.getNumber=function(number){
        return SiteEssentials.getNumber(number);
    }
})