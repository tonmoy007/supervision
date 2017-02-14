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
      
    return toast;
})
.service('superServices',  function($http,$rootScope,$q){
  var methods=[];
  this.loadBranches=function($scope){
      var differ=$q.defer();
      if(!$scope.branches){
        $scope.branchLoading=true
        $http.get(siteurl+'branch/list.php?token='+$rootScope.globals.currentUser.token).success(function(response){
            
            if(response.success){
                $scope.branches=response.branches;
                $scope.branchLoading=false;
                differ.resolve();

            }else{
                differ.reject();
            }

        });
        return differ.promise;
      }
    }


})


.factory('SiteEssentials',function(ShowSimpleToast){
  var methods={};
  methods.responsCheck=function(response){
    if(response.status==-1){
        ShowSimpleToast.showAlert(this,'Timeout!!','Net Error Connection Timout');
      }
  }
  methods.goTop=function(index){
    if(index==undefined||index==null){
      index=0
    }
    $('body,html').animate({scrollTop:index},"slow");
  }
  methods.show_single=function(items,index,r_item,scope){
    if(index==null)return;
    if(scope){
      scope.single=true;
      scope.single_product=items[index];
    }
    r_item=items[index];


  }
  methods.getDiscount=function(product){
    var price=parseFloat(product.price)*parseFloat(product.amount);
    var discount=(product.discount)?(price*parseInt(product.discount.percentage))/100:0;
    return discount;
  }
  methods.checkBonus=function(products){
    var has_bonus=false;
    angular.forEach(products,function(value,key){
      if(value.bonus){
        // console.log(value.bonus)
        has_bonus=true
      }
    });
    return has_bonus;
  }
  methods.checkDiscount=function(products){
    var has_discount=false;
    angular.forEach(products,function(value,key){
      if(value.discount){
        has_discount=true;
      }
    })
    return has_discount;
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
 methods.setDeliveryStatus=function(order){
  var delivered=1;
  angular.forEach(order.products,function(value){
    value.is_delivered=parseInt(value.is_delivered);
    if(value.is_delivered==0){
      delivered=0;
    }
  })
    order.is_delivered=delivered;
 }
  return methods;

})
