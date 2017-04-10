

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
  AuthenticationService,$location,$state,Upload,$mdDialog,ShowSimpleToast,$interval){
  this.classes=null;
  var methods=[];
  
  this.logout=function(){
    $rootScope.logging_out=true;
    $http.get('api/logout').then(function(response){
      if(response.data.success){
        AuthenticationService.ClearCredentials();
        if($state.current.name!='home'){
          $state.go('home');
        }else{
          $state.reload('home');
        }
        ShowSimpleToast.show(response.data.message);
      }else{
       
        AuthenticationService.ClearCredentials();
        if($state.current.name!='home'){
          $state.go('home');
        }else{
          $state.reload('home');
        }
        ShowSimpleToast.show(response.data.message);
      }
    },function(response){
      SiteEssentials.responsCheck(response);
    })
  }
this.getMenu=function(type){
  var menu=[];
  menu['profile']=[
            {'name':'home','title':'Home','icon':'/img/accessories/home.svg','action_template':'',role:'all'},
            {'name':'profile.reports','title':'Reports','icon':'/img/accessories/reports.svg',
            'action_template':'getView/profile.reports.actions',role:'all'},
            {'name':'profile.notice','title':'Notice','icon':'/img/accessories/notice.svg',
            'action_template':'getView/profile.notice.action_template',role:'all'},
            {'name':'profile.schools','title':'Schools','icon':'/img/accessories/schools.svg',
            'action_template':'getView/template.actions.school',role:'admin'},
            {'name':'profile.settings','title':'Settings','icon':'img/accessories/settings.svg','action_template':'',role:'all'},
            {'name':'profile.home_contents','title':'Home Contents','icon':'/img/accessories/home_contents.svg',
            'action_template':'getView/template.actions.home_contents',role:'admin'},
            {name:'profile.class',title:'Class',icon:'img/accessories/class.svg',
            action_template:'getView/profile.class.action_template',role:'general_user'}
            ];
  menu['home_contents']=[
            {name:'profile.home_contents.posts',
            'action_template':'getView/template.actions.home_contents',title:'Posts',icon:'/img/accessories/posts.svg'},
            {name:'profile.home_contents.links',
            'action_template':'getView/template.actions.home_contents',title:'Links',icon:'/img/accessories/links.svg'},
            {name:'profile.home_contents.slider',
            'action_template':'getView/template.actions.home_contents',title:'Slider',icon:'/img/accessories/slider.svg'},
            {name:'profile.home_contents.gallery',
            'action_template':'getView/template.actions.home_contents',title:'Gallery',icon:'/img/accessories/gallery.svg'},
            {name:'profile.home_contents.employees',
            'action_template':'getView/template.actions.home_contents',title:'Employees',
            icon:'/img/accessories/employees.svg'}
            ];
    
      return menu[type]
    
    
}
this.loadHomepageContent=function($scope,content){

  $rootScope.site[content+'Loading']=true;
  $scope.sliders=[];
  $http.get('api/homepage').then(function(response){
    $rootScope.site[content+'Loading']=false;
      if(response.data.success){
        if(content!='all'){
          
          if(content=='menu'){
            $scope.sliders['navigation']=SiteEssentials.generateMenu(response.data.menue);
            $scope.sliders['sliders']=response.data.sliders;
            
          }else{
            $scope[content]=response.data[content];
          }
        }else{
          $scope.homepageContents=response.data;
        }
      }
  },function(response){
    $rootScope.site[content+'Loading']=false;
    SiteEssentials.responsCheck(response);
  })

}
this.loadHomeMenu=function(scope,success,failed){
    $http.get('api/menu').then(success,failed);
}
this.loadSideBar=function(scope,success,failed){
  $http.get('api/sidebar').then(success,failed);
}
this.loadCategory=function($scope,link){

    var differ=$q.defer();

    if(!$scope.categories){
      $scope.categoryLoading=true
      $http.get('api/'+link).then(function(response){
          // console.log(response);
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

this.getContent=function(link,title,id){
  
  $rootScope.loadingData=true;
  var url='api/'+link;
  if(typeof id!=undefined&&id!=null){
    url+='/'+id;
  }
  // console.log(url);
  return $http.get(url).then(function(response){
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

  var message='Are you sure you want to delete '+item_name+' ?';
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

  this.showLinkEdit=function($scope,name,$index,data_key){
    $rootScope.data=[];

    $rootScope.data.editContent=$scope[name][data_key][$index];

    angular.forEach($scope[name], function(value, key){

      angular.forEach(value,function(val,k){
        if(key==data_key&&k==$index){
          val.edit_expand=!val.edit_expand;
          val.edit_template='/getView/'+$state.current.name+'.edit';
        }else{
          val.edit_expand=false;
          val.edit_template='';
        }
      })

      
    });
  }
  this.showModelEdit=function(ev,$scope,name,index,key){
    
    $rootScope.data=[];

    $rootScope.data.editContent=key!=null?$scope[name][key][index]:$scope[name][index];
    
    $mdDialog.show({
          templateUrl: 'getView/'+$state.current.name+'.edit',
          parent: angular.element(document.body),
          targetEvent: ev,
          controller:'editModelCtrl',
          clickOutsideToClose: false,
          fullscreen:true
        }).then(function(data){
            $rootScope.data=[];
            if(data){
                ShowSimpleToast.show(data.message);
            }
        });
  }
 
  this.submitEditForm=function($scope,data,link,dialog){
    
    $scope.form=[];
    
    $scope.form.updatingContent=true;
    console.log(data);
    var cancel=false;
    var form_data=SiteEssentials.processFormInput(data);
     console.log(form_data);
    var upload=$http.put('api/'+link+'/'+data.id, form_data,{'_method':'PUT'})
    
    $scope.cancelsubmit=function(){
      cancel=true;
      upload.abort();
    }


      
    var success=function(response){
        // console.log(response);
        $scope.form.updatingContent=false;
        if(response.data.success){
            if(typeof dialog!=undefined||dialog!=null){
              data.message=response.data.message;
              $mdDialog.hide(data);
            }else{
              ShowSimpleToast.show(response.data.message);

            }
            $state.reload($state.current.name);
        }
      }
   
    var error =function(response){
         $scope.form.updatingContent=false;
         if(!cancel)SiteEssentials.responsCheck(response);
    }
    
    var progress=function(evt){
      $scope.form.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    }
    
    upload.then(success,error,progress);
    
  }

  this.getClasses=function(){
    $rootScope.loadingData=true;
    var role=$rootScope.globals.currentUser.role;
    return $http.get('api/class').then(function(response){
      $rootScope.loadingData=false;
        if(response.data.success){
          return response.data;
        }else{
          ShowSimpleToast.show(response.data.message);
        }
    },function(response){
      SiteEssentials.responsCheck(response);
    });
  }
  this.getAttendance=function(){
    $rootScope.loadingData=true;
    return $http.get('api/attendance').then(function(response){
      $rootScope.loadingData=false;
      if(response.data.success){
        return response.data;
      }else{
        return ShowSimpleToast.show(response.data.message);
      }
    },function(response){
      $rootScope.loadingData=false;
      SiteEssentials.responsCheck(response);
    })
  }
  this.checkNotice=function(response){
    $http.get('api/notice/new').then(function(response){
      // console.log(response);
      if(response.data.success){
        $rootScope.globals.new_notice=response.data;
        if(!$rootScope.notice_found){
          $rootScope.notice_found=true;
          ShowSimpleToast.show(response.data.message);
        }

      }
    },function(response){
      ShowSimpleToast.show('Failed to connect !!');
      $interval.cancel($rootScope.notification);
      console.log($rootScope.notification);
    })
  }

  this.getReportForm=function(param){
    $rootScope.loadingData=true;
    return $http.get('api/questions/'+param.name).then(function(response){
      if(response.data.success){
        console.log(response);
        $rootScope.loadingData=false;
        return response.data;
      }else{
        ShowSimpleToast.show(response.data.message);
      }
    },function(response){
      $rootScope.loadingData=false;
      SiteEssentials.responsCheck(response);
    })
  }
this.getAnswers=function(report,type){
  
  var answers=[];
  if(type=='no_class'){
    angular.forEach(report.questions, function(value, key){
    var ans={};

    if(value.type!='input'&&value.type!='textarea'&&value.type!='datepicker'&&value.type!='email')
      ans.answer_id=value.answer.id;
    else if(value.type=='datepicker')ans.option_value=SiteEssentials.getDateFormate(value.answer.option_value);
    else {ans.option_value=value.answer.option_value;}
      ans.question_id=value.id;
      answers.push(ans);
    });
  }else if(type=='class'){

      angular.forEach(report.classes,function(value,key){
          angular.forEach(value.questions, function(val, k){
            var ans={};

              ans.class_id=value.id;
              ans.question_id=val.id;
              if(val.type!='input'&&val.type!='textarea'&&val.type!='datepicker'&&val.type!='email')
                {ans.answer_id=val.answer.id;}
              else if(val.type=='datepicker')ans.option_value=SiteEssentials.getDateFormate(val.answer.option_value);
              else {ans.option_value=val.answer.option_value;}
              answers.push(ans);
        });
          if(value.inner){
            angular.forEach(value.inner.questions,function(val,k){
              var ans={};
              ans.class_id=value.id;
              ans.question_id=val.id;
              if(val.type!='input'&&val.type!='textarea'&&val.type!='datepicker'&&val.type!='email'){ans.answer_id=val.answer.id;}
              else if(val.type=='datepicker')ans.option_value=SiteEssentials.getDateFormate(val.answer.option_value);
              else {ans.option_value=val.answer.option_value;}
              answers.push(ans);
            })
          }
      })
  }else if(type=='type'||type=='plans'){
   var form;
   if(type=='type'){
    form=report.types
   }else{
    form=report.plans;
   }
    angular.forEach(form,function(value,key){
   
      angular.forEach(value.questions, function(val, k){
        var ans={};
        if(type=='type')ans.type_id=value.id;
        else if(type=='plans')ans.plan_id=value.id;
        ans.question_id=val.id;
        
        if(val.type!='input'&&val.type!='textarea'&&val.type!='datepicker'&&value.type!='email'){ans.answer_id=val.answer.id;}
        else if(val.type=='datepicker')ans.option_value=SiteEssentials.getDateFormate(val.answer.option_value);
        else {ans.option_value=val.answer.option_value;}
        
        answers.push(ans);
      });
    })
  }else if(type=='responsibility'){
    angular.forEach(report, function(value, key){
      ans={}
      // console.log(value);
      ans.serial_no=value.serial_no;
      ans.total_school=value.total_school;
      ans.present_school=value.present_school;
      ans.responsible=value.responsible;
      if(value.is_delete==1)ans.is_delete=1;
      if(!(value.new&&value.is_delete==1))
        answers.push(ans);
    });
  }
  return answers;
}
this.submitAnswer=function(scope,answer){
  $rootScope.loadingData=true;
  $http({url:'api/questions/'+scope.name,method:'POST',data:{answers:answer},dataType:'JSON'}).then(function(response){
    $rootScope.loadingData=false;
    if(response.data.success){
      $state.reload($state.current.name);
    }
    console.log(response);
    ShowSimpleToast.show(response.data.message);
  },function(response){
    $rootScope.loadingData=false;
    SiteEssentials.responsCheck(response);
  })
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
 methods.getNumber=function(number){

        var format=[{'০':'0'},{'0':'০'},{'১':'1'},{'২':'2'},{'৩':'3'},{'৪':'4'},{'৫':'6'},{'৬':'7'},
        {'৭':'7'},{'৮':'8'},{'৯':'9'},{'1':'১'},{'2':'২'},{'3':'৩'},{'4':'৪'},{'5':'৫'},{'6':'৬'},
        {'7':'৭'},{'8':'৮'},{'9':'৯'}];
        
        number =number.toString().split('');

        var data=[];
        var o=[];
        angular.forEach(number, function(value, key){
          
            o=format.find(function(object){
                return object[value]!=undefined;
            });
             
            data[key]=o[value];
        });
        var str='';
        angular.forEach(data, function(value, key){
            // console.log(value);
            str+=value;
        });
        // console.log(str);
        return str;

    }
 methods.generateMenu=function(menu_content){
  var gallery={"গ্যালারী":[{
    name:'ভিডিও গ্যালারী',
    url:'#/gallery/video',
    parent:'গ্যালারী'
  },
  {
    name:'ফটো গ্যালারী',
    url:'#/gallery/image'
  }],'মাধ্যমিক প্রতিষ্ঠান সমূহের তালিকা':[
  {name:'স্কুল',url:'#/institution/স্কুল',parent:'মাধ্যমিক প্রতিষ্ঠান সমূহের তালিকা'},
  {name:'কলেজ',url:'#/institution/কলেজ',parent:'মাধ্যমিক প্রতিষ্ঠান সমূহের তালিকা'},
  {name:'মাদ্রাসা',url:'#/institution/মাদ্রাসা',parent:'মাধ্যমিক প্রতিষ্ঠান সমূহের তালিকা'}
  ]
  }

  var menu=[];
  var tab=[]
  tab[0]={name:'হোম',url:'#/',parent:'হোম',type:'home'}
  var i=1;
  var contact;
    if(menu_content){
      angular.forEach(menu_content, function(value, key){
        
        tab[i]=[];
        if(!value.length){
          tab[i]={parent:key}
        }
        if(key=='যোগাযোগ'&&!contact&&typeof value[0].title!=undefined&&typeof value[0].title!=null){
          contact=contact={name:value[0].title,url:'#/posts/'+value[0].id,parent:key};
            
        }else{
         angular.forEach(value,function(val,k){
         
            if(!val.is_employee){
                tab[i][k]={name:val.title,url:'#/posts/'+val.id,parent:key};
            }else{
              tab[i][k]={name:val.designation,url:'#/employees/'+val.designation,parent:key};
            }

          })
          
          i++ 
        }
        

      });
    }
    angular.forEach(gallery, function(value, key){
      tab[i]=value;
     
      i++;
    });
    tab[i]=contact;

    return tab;
 }
 methods.processFormInput=function(data){
  var form_data={};
    angular.forEach(data, function(value, key){
      
      form_data[key]=value;
      if(key=='mpo_date'){
        form_data[key]=methods.getDateFormate(value);
      }
      
    });
    return form_data;
 }

  return methods;

})
