var components=angular.module('components',['ticker','simpleAngularTicker'])
.directive('menu',function($interval,superServices){
    return{
        templateUrl:'getView/home.menu',
        controller:'menuCtrl',
        link:function(scope,elem,attr){


            
    
            scope.drop=[];
            scope.interval=5000;
           
            for(i=0;i<20;i++){
                scope.drop[i]=false;
            }

            superServices.loadHomepageContent(scope,'menu');

            scope.setCover=function(){
                scope.index=0;
                total=scope.cover.length;
                $interval(function(){
                    scope.coverLoaded=true;
                    index=scope.index;
                    if(index==total-1){
                        scope.index=0;
                    }else{
                        scope.index++;
                    }

                    scope.cover[index].active=true;

                    if(index==0){
                        scope.cover[total-1].active=false;
                    }else{
                        scope.cover[index-1].active=false;
                    }
                },scope.interval);
            }

            scope.setVisible=function(index){
                scope.drop[index]=!scope.drop[index];
                
                angular.forEach(scope.drop,function(value,key){

                    if(key!=index){
                        scope.drop[key]=false;
                    }
                });
            };
            scope.$watch('sliders',function(value){
                if(value!=null&&typeof value=='object'&&value.length){
                    
                    console.log(value);
                    scope.cover=value.sliders;
                    scope.home_menu=value.navigation;
                    scope.setCover();
                }
            })
            
            $('body').click(function(event){
                if(event.target.className!='dropdown-toggle'){
                      angular.forEach(scope.drop,function(value,key){

                      
                            scope.drop[key]=false;
                       
                    });  
                }
                
            });
        }
    }
}).directive('sidebar',function(){
    return{
        replace:true,
        templateUrl:'getView/home.side-bar',
        link:function(scope){

        }
    }
}).directive('boxTicker',function(){
    return{
        templateUrl:'getView/home.ticker',
        link:function(scope,elem,attr){
            
        }
    }

}).directive('newsTicker',function(){
    return{
        templateUrl:'getView/home.news-ticker',
        link:function(scope){
            scope.myTickerItems = [
                   {
                     title: 'খবর 1',
                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (ডিসেম্বর ০৫, ২০১৫ | শনিবার)',
                     class:'bq-primary'
                   },
                   {
                     title: 'খবর 2',
                     copy: 'ঈদ উৎসব-২০১৫ এর অনুষ্ঠান/প্রতিযোগিতা সূচি (২৬ সেপ্টেম্বর ২০১৫ খ্রিঃ)',
                     class:'bq-warning'
                   },
                   {
                     title: 'খবর 3',
                     copy: 'উপজেলা উন্নয়ন মেলা ২০১৫ এর অনুষ্ঠান সূচি (২৭-২৯ সেপ্টেম্বর,২০১৫ খ্রিঃ)',
                     class:'bq-success'
                   },
                   {
                     title: 'খবর ৪',
                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (সেপ্টেম্বর০৩,২০১৫|বৃহস্পতিবার)',
                     class:'bq-danger'
                   },
                   {
                     title: 'খবর ৫',
                     copy: 'ড. মহীউদ্দীন খান আলমগীর স্যারের কচুয়া সফর সূচী (আগষ্ট ১৩, ২০১৫ বৃহস্পতিবার, আগষ্ট ১৪,...',
                     class:'bq-primary'
                   },
                   {
                     title: 'খবর ৬',
                     copy: 'জাতীয় তথ্য বাতায়ন',
                     class:'bq-warning'
                   },
                   {
                     title: 'খবর ৭',
                     copy: 'জাতীয় ই-তথ্যকোষ',
                     class:'bq-success'
                   }
                ];
        }
    }


}).directive('backToTop',function($window,scrollMe){
    return{
        templateUrl:'getView/back-to-top',
        link:function(scope,elem){
            elem.fadeOut();

            scope.goTop=function(){
                scrollMe.goTop();
            }

            angular.element($window).bind('scroll', function(event) {
                /* Act on the event */
                menu=angular.element($('menu')).height();
                offset=this.pageYOffset;
                // console.log(menu)
                maxheight=$(window).height();
                if(offset>menu){
                    elem.fadeIn();
                    scope.$apply();
                }else{
                    elem.fadeOut();
                }
                // console.log(maxheight);
            });
        }
    }
}).directive('footer',function(){
    return{
        templateUrl:'getView/home.foot'
    }
}).directive('homePage',function(){
    return{
        templateUrl:'getView/home.homepage'
    }
}).directive('preload',function(){
    return{
        link:function(scope,elem,attr){
            elem.ready(function(){
                var src=attr.srcImage;
                
                var img=new Image();
                img.src=src;
                var type=attr.type;

                $(img).on('load',function(){
                    
                  var  t_src='url("'+this.src+'")';
                  var  m_src=decodeURI(t_src);

               if(type=='background'){
                 
                 elem[0].style.backgroundImage=t_src;
                 attr.src=this.src;
                    
               }else{
                elem.find('img').attr({
                    src: this.src,
                });
               }

                    elem.find('.progress-loader').hide();
                });

                $(img).on('error',function(){
                    if(type=='background'){
                        elem[0].style.backgroundImage='url(https://dummyimage.com/600x400/ddd/1d1d1f&text=no+image+found)';
                        attr.src='https://dummyimage.com/600x400/ddd/1d1d1f&text=no+image+found';
                    }else{
                        elem.find('img').attr({src:'https://dummyimage.com/600x400/ddd/1d1d1f&text=no+image+found'});
                    }
                    elem.find('.progress-loader').hide();
                })
                
               })
        }
    }
}).directive('loader',function(){
    return{
        templateUrl:'getView/template.loader',
        scope:{
            size:'=?',
            color:'=?'
        },
        link:function(scope,elem,attr){
            
        }
    }
}).directive('searchModule',function(){
    return{
        link:function(scope,elem,attr){
            scope.toggleSearch=function(){
                scope.search_expand=!scope.search_expand;
                if(scope.search_expand){
                    elem.focus();
                }else{
                    scope.$parent.actions.search_query='';
                }
            }
        }
    }
}).directive('addNewContent',function($state,$mdDialog){
    return{
        scope:{
            url:'=?',
            title:'=?',
            submitFunction:'=?',
            listContent:'=?'
        },
        link:function(scope,elem,attr){
            scope.hide=function(){
                $mdDialog.hide();
            }

        }
    }
})
.directive('updateContent',function($state,$mdDialog){
    return{
        link:function(scope,elem,attr){

        }
    }
})
.directive('actions',function(){
    return{
        templateUrl:'getView/template.actions.action_all',
        scope:{
            title:'=?',
            type:'='
        },
        controller:'actionsCtrl',
        link:function(scope,elem,attr){

        }
    }
})


 .directive('equalTo',function() {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function(scope, element, attributes, ngModel) {
             
            ngModel.$validators.compareTo = function(modelValue) {
                return modelValue == scope.otherModelValue;
            };
 
            scope.$watch("otherModelValue", function() {
                ngModel.$validate();
            });
        }
    };
});


















components.factory('scrollMe',function(){
    func={};
    func.goTop=function(){
        angular.element('body,html').animate({ scrollTop: 0 }, "slow");
    }
    return func;
})