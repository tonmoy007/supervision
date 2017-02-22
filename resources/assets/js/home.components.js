var components=angular.module('components',['ticker','simpleAngularTicker'])
.directive('menu',function($interval,superServices,SiteEssentials,$rootScope){
    return{
        templateUrl:'getView/home.menu',
        controller:'menuCtrl',
        link:function(scope,elem,attr){


            
    
            scope.drop=[];
            scope.interval=5000;
           
            for(i=0;i<10;i++){
                scope.drop[i]=false;
            }

            

            scope.setCover=function(){
                scope.index=0;
                total=scope.cover.length;
                

                $interval(function(){
                    
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

                $rootScope.globals.siteLoaded=true;
                scope.coverLoaded=true;
            }

            scope.setVisible=function(index){
                scope.drop[index]=!scope.drop[index];
                
                angular.forEach(scope.drop,function(value,key){

                    if(key!=index){
                        scope.drop[key]=false;
                    }
                });
            };
            
            var success=function(response){
                if(response.data.success){

                    console.log(response);
                    scope.home_menu=SiteEssentials.generateMenu(response.data.menu);
                    console.log(scope.home_menu);
                    scope.cover=response.data.sliders;
                    scope.cover[0].active=true;
                    scope.setCover();
                }
            }
            var failed=function(response){
                console.log(repsonse);
                SiteEssentials.responsCheck(response);
            }
           
            superServices.loadHomeMenu(scope,success,failed);
           
            $('body').click(function(event){
                
                var classes=event.target.className.split(' ');
                console.log(classes[0]);
                if(classes[0]!='dropdown-toggle'){
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
        controller:'sidebarCtrl',
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
        scope:{
            news:'=?'
        },
        link:function(scope){
            console.log(scope.news);
            scope.myTicker=scope.news;
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
                var type=attr.type;
                if(type!='video')
                {
                    var img=new Image();
                    img.src=src;

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
                    
                
                }else{
                    console.log('video_found');
                    elem.find('source').attr('src', src);
                    elem.find('.progress-loader').hide();
                }

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
})


.directive('ngGallery',function($q,$timeout,SiteEssentials){
        return{
            restrict:'EA',
            templateUrl:'getView/template.gallery',
            scope:{
                'images':'=?',
                'type':'@'
            },
            link:function(scope,elem,attr){
                var keys_codes = {
                    enter: 13,
                    esc: 27,
                    left: 37,
                    right: 39
                };
                
                
                console.log(scope.images);
                scope.gallery=scope.images;
                var $body = $('body');
                var $thumbwrapper = angular.element(elem[0].querySelectorAll('.ng-thumbnails-wrapper'));
                var $thumbnails = angular.element(elem[0].querySelectorAll('.ng-thumbnails'));

                scope.index = 0;
                scope.opened = false;

                scope.thumb_wrapper_width = 0;
                scope.thumbs_width = 0;

                scope.openGallery = function (i) {
                    if (typeof i !== undefined) {
                        scope.index = i;
                        showImage(scope.index);
                    }
                    scope.opened = true;
                    if (scope.hideOverflow) {
                        $('body').css({overflow: 'hidden'});
                    }

                    $timeout(function () {
                        var calculatedWidth = calculateThumbsWidth();
                        scope.thumbs_width = calculatedWidth.width;
                        //Add 1px, otherwise some browsers move the last image into a new line
                        var thumbnailsWidth = calculatedWidth.width + 1;
                        $thumbnails.css({width: thumbnailsWidth + 'px'});
                        $thumbwrapper.css({width: calculatedWidth.visible_width + 'px'});
                        smartScroll(scope.index);
                    });
                };
                var loadImage = function (i) {
                    var deferred = $q.defer();
                    var image = new Image();

                    image.onload = function () {
                        scope.loading = false;
                        if (typeof this.complete === false || this.naturalWidth === 0) {
                            deferred.reject();
                        }
                        deferred.resolve(image);
                    };

                    image.onerror = function () {
                        deferred.reject();
                    };

                    image.src = scope.gallery[i].file;
                    scope.loading = true;
                    console.log(image);

                    return deferred.promise;
                };

                var showImage = function (i) {
                    loadImage(scope.index).then(function (resp) {
                        scope.img = resp.src;
                        smartScroll(scope.index);
                    });
                    scope.description = scope.gallery[i].type+' created at '+SiteEssentials.getDate(scope.gallery[i].created_at) || '';
                };
                scope.showImageDownloadButton = function () {
                    if (scope.gallery[scope.index] == null || scope.gallery[scope.index].downloadSrc == null) return
                    var image = scope.gallery[scope.index];
                    return angular.isDefined(image.downloadSrc) && 0 < image.downloadSrc.length;
                };

                scope.getImageDownloadSrc = function () {
                    if (scope.gallery[scope.index] == null || scope.gallery[scope.index].downloadSrc == null) return
                    return scope.gallery[scope.index].downloadSrc;
                };

                scope.changeImage = function (i) {
                    scope.index = i;
                    showImage(i);
                };

                scope.nextImage = function () {
                    scope.index += 1;
                    if (scope.index === scope.gallery.length) {
                        scope.index = 0;
                    }
                    showImage(scope.index);
                };

                scope.prevImage = function () {
                    scope.index -= 1;
                    if (scope.index < 0) {
                        scope.index = scope.gallery.length - 1;
                    }
                    showImage(scope.index);
                };

                scope.closeGallery = function () {
                    scope.opened = false;
                    if (scope.hideOverflow) {
                        $('body').css({overflow: ''});
                    }
                };
                scope.sortme=function(type){
                    scope.imageType=type;
                    console.log(type);
                }

                $body.bind('keydown', function (event) {
                    if (!scope.opened) {
                        return;
                    }
                    var which = event.which;
                    if (which === keys_codes.esc) {
                        scope.closeGallery();
                    } else if (which === keys_codes.right || which === keys_codes.enter) {
                        scope.nextImage();
                    } else if (which === keys_codes.left) {
                        scope.prevImage();
                    }

                    scope.$apply();
                });

                var calculateThumbsWidth = function () {
                    var width = 0,
                        visible_width = 0;
                    angular.forEach($thumbnails.find('img'), function (thumb) {
                        width += thumb.clientWidth;
                        width += 10; // margin-right
                        visible_width = thumb.clientWidth + 10;
                    });
                    return {
                        width: width,
                        visible_width: visible_width * scope.thumbsNum
                    };
                };

                var smartScroll = function (index) {
                    $timeout(function () {
                        var len = scope.images.length,
                            width = scope.thumbs_width,
                            item_scroll = parseInt(width / len, 10),
                            i = index + 1,
                            s = Math.ceil(len / i);

                        $thumbwrapper[0].scrollLeft = 0;
                        $thumbwrapper[0].scrollLeft = i * item_scroll - (s * item_scroll);
                    }, 100);
                };
                scope.galleryLoaded=true;

            }
        }
    })











components.factory('scrollMe',function(){
    func={};
    func.goTop=function(){
        angular.element('body,html').animate({ scrollTop: 0 }, "slow");
    }
    return func;
})