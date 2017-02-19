angular.module('super-factory',['ngMaterial','ngAnimate'])

.factory('ShowSimpleToast',function($mdToast,$mdDialog){
    var toast=[];
    toast.show=function(text){

           $mdToast.show(
                  $mdToast.simple()
                    .textContent(text)             
                    .action('Close')
                    .highlightAction(true)
                    .highlightClass('md-accent')
                    .position("top right")
                    .hideDelay(5000)
                ).then(function(response){
                  $mdToast.hide();
                });
    }
    
    toast.showAlert = function(ev,title,description,arealabel) {
    // Appending dialog to document.body to cover sidenav in docs app
    // Modal dialogs should fully cover application
    // to prevent interaction outside of dialog
      title = typeof title !== 'undefined' ? title : 'Alert';
      description = typeof description !== 'undefined' ? description : 'Some Error Occured';
      arealabel = typeof arealabel !== 'undefined' ? arealabel : 'Error';
      
      $mdDialog.show(
        $mdDialog.alert()
          .parent(angular.element(document.querySelector('#popupContainer')))
          .clickOutsideToClose(true)
          .title(title)
          .textContent(description)
          .ariaLabel(arealabel)
          .ok('Ok')
          .targetEvent(ev)
      );
      

  };
  toast.showCustomPrerender=function($scope,ev,title,subtitle,template,content_id,template_id){
        
        var tmplate_id=(!template_id)?'display_content':template_id;
        var content_id=(!content_id)?'#pre_dialog':content_id;
        var templat_div=angular.element(document.getElementById(template_id));
        
        
        templat_div.html(template);
        $scope.dialog=[];
        $scope.dialog.title=title;
        $scope.dialog.sub_title=subtitle;
        $scope.hide=function(){
          $mdDialog.hide();
        }
        $mdDialog.show({
            contentElement: content_id,
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose: true,
          }).then(function(response){
            
          });
      }
    toast.showConfirm=function(ev,title,text_content,ok_text,cancel_text,success,failed){
           title=typeof title !=undefined?title:'Are your confirm about this operation ??';
           text_content=typeof text_content!=undefined?text_content:'';
           var ariaLabel='Confirmation';
           ok_text=typeof ok_text!=undefined?ok_text:'Ok';
           cancel_text=typeof cancel_text!=undefined?cancel_text:'Cancel';

       var confirm = $mdDialog.confirm()
          .title(title)
          .textContent(text_content)
          .ariaLabel(ariaLabel)
          .targetEvent(ev)
          .ok(ok_text)
          .cancel(cancel_text);
        
        $mdDialog.show(confirm).then(
          success,failed)


    }
      
    return toast;
    
})
.service('superServices',  function($http,$rootScope,$q,SiteEssentials,
  AuthenticationService,$location,$state,Upload,$mdDialog,ShowSimpleToast){
  var methods=[];
  
  this.logout=function(){
    $rootScope.logging_out=true;
    $http.get('api/logout').then(function(response){
      if(response.data.success){
        AuthenticationService.ClearCredentials();
        $location.path('/');
        $state.reload('home');
        ShowSimpleToast.show(response.data.message);
      }else{
        ShowSimpleToast.show(response.data.message);
      }
    },function(response){
      SiteEssentials.responsCheck(response);
    })
  }

this.loadCategory=function($scope,link){

    var differ=$q.defer();

    if(!$scope.categories){
      $scope.categoryLoading=true
      $http.get('api/'+link).then(function(response){
          console.log(response);
          if(response.data.success){
              $scope.categories=response.data.categories;
              $scope.categoryLoading=false;
              differ.resolve();

          }else{
              differ.reject();
          }

      },function(response){
        differ.reject();
        SiteEssentials.responsCheck(response);
      });
      return differ.promise;    
    }else{
      return false;
    }
  

};

this.getSchools=function(){
  
  $rootScope.loadingData=true;
  
  return $http.get('api/school').then(function(response){
          // console.log(response);
          $rootScope.loadingData=false;
            if(response.data.success){
              return response.data.schools;
            }else{
              ShowSimpleToast.show(response.data.message);
              return null;
            }
          },function(response){
          
          $rootScope.loadingData=false;
          SiteEssentials.responsCheck(response);
        });

    };

this.getContent=function(link,title){
  
  $rootScope.loadingData=true;
  
  return $http.get('api/'+link).then(function(response){
          console.log(response);
          $rootScope.loadingData=false;
            if(response.data.success){
              return response.data[title];
            }else{
              ShowSimpleToast.show(response.data.message);
              return null;
            }
          },function(response){
          
          $rootScope.loadingData=false;
          SiteEssentials.responsCheck(response);
        });

    };
this.addNewContent=function(data,url,name,key,$scope){
    console.log(data);
   var cancel=false;
    $scope.form=[];
    $scope.form.addingContent=true;
    
    var upload=Upload.upload({
        url:'api/'+url,
        method:'POST',
        '_method':'PUT',
        data:data
      });
    $scope.cancelsubmit=function(){
      cancel=true;
      upload.abort();
    }
    upload.then(function(response){

      console.log(response);
      
      $scope.form.addingContent=false;
      data.message=response.data.message;
      data.id=response.data.id;
      data.featured_image=(name=='posts'||name=='employees')?response.data.featured_image:'';
    
        $state.reload($state.current.name);
        $mdDialog.hide(data,name,key);
      

    },function(response){
      $scope.form.addingContent=false;
      if(!cancel)
        SiteEssentials.responsCheck(response);
      if (response.status > 0)
                $scope.form.error = response.status + ': ' + response.data;
    },function(evt){
      $scope.form.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    });
   
}

this.deleteContent=function(ev,item_name,url,id){

  var message='Are you sure you want to delete this '+item_name+' ?';
  var text_content='';
 
  
   var success=function(){
     $http.delete('api/'+url+'/'+id).then(function(response){
          console.log(response);
          ShowSimpleToast.show(response.data.message);
          $state.reload($state.current.name);
      },function(response){
          SiteEssentials.responsCheck(response);
      })
  }
   var failed=function(){
    return false;
   }
   ShowSimpleToast.showConfirm(ev,message,'','Yes','No',success,failed);
}


})


.factory('SiteEssentials',function(ShowSimpleToast){

  var methods={};

  methods.responsCheck=function(response){
    if(response.status==-1){
        ShowSimpleToast.showAlert(this,'Timeout!!','Net Error Connection Timout');
      }else if(response.status==500){
        ShowSimpleToast.showAlert(this,response.statusText,'Sorry there might be an internal server problem please try again later');
      }
  }
  methods.goTop=function(index){
    if(index==undefined||index==null){
      index=0
    }
    $('body,html').animate({scrollTop:index},"slow");
  }
  
  methods.cloneJSON=function(old){
    var newJSON={};
    angular.forEach(old,function(value,key){
     
        newJSON[key]=value;
      
    });
    return newJSON;
  }
  methods.getDateFormate=function(date){
    var date=new Date(date);
    var month=date.getMonth()+1;
    var day=date.getDate();
    var year=date.getFullYear();
    if(month<=9){
      month='0'+month;
    }
    return year+'-'+month+'-'+day;
  }
  methods.getDate=function(date){
    if(date!=null){
      return new Date(date);
    }else{
      return new Date
    }
  }
 
 methods.expand=function(data,index,name,double,keys){
      
      angular.forEach(data, function(value, key){

        if(typeof double!=undefined &&double==1 && typeof keys != undefined){
          angular.forEach(value, function(val, k){
            if(k==index&&key==keys){
              val[name]=!val[name];
            }else{
              value[name]=false;
            }
          });
        }else{
           if(key==index){
                value[name]=!value[name];
            }else{
                value[name]=false;
            }
        }
           
        });
 }
  return methods;

})
