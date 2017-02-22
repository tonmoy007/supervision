
<div class="single-gallery gallery-cards">
  <div class="carousel-container slider-container">
  <div flex="none" layout="row" layout-align="center center" class="image-gallery">
                                <md-progress-circular ng-if="!gallery" class="md-primary" md-diameter="20"></md-progress-circular>
                            
         <div class="col-md-3 gallery-card" ng-repeat="image in gallery track by $index">
           
         
            <div class="gallery-image " >
                <div class="gallery-image-container ">

                    <figure class="figure" preload src-image="<%image.file%>" type="image" type="<%image.type%>">
                    <div class="image__overlay" ng-click="openGallery($index)">
                      <md-icon  ng-click="delete(this,'this image from slider','slider',image.id)" class="image__overlay__icon" md-svg-src="/img/accessories/show.svg" aria-label="Close dialog"></md-icon>
                    </div>
                       <img src="" alt="" class="img-responsive">
                      <loader class="progress-loader" ></loader>
                    </figure>
                          
                    
                </div>
            </div>
        </div>
     </div>
     <div class="ng-overlay" ng-show="opened">
      </div>
            <div class="ng-gallery-content" unselectable="on" ng-show="opened" ng-swipe-left="nextImage()" ng-swipe-right="prevImage()">
             <div class="uil-ring-css" ng-show="loading"><div></div></div>
            <!-- <a href="{{ img }}" target="_blank" ng-show="true" class="download-image"><i class="fa fa-download"></i></a> -->
              <a class="close-popup" ng-click="closeGallery()"><i class="fa fa-close"></i></a>
              <a class="nav-left" ng-click="prevImage()"><i class="fa fa-angle-left"></i></a>
              <img ondragstart="return false;" draggable="false" ng-src="<% img %>" ng-click="nextImage()" ng-show="!loading" class="effect" />
              <a class="nav-right" ng-click="nextImage()"><i class="fa fa-angle-right"></i></a>
              <span class="info-text">{{ index + 1 }}<%imageType%>/<% gallery.length %> - <% description %></span>
              <div class="ng-thumbnails-wrapper">
                <div class="ng-thumbnails slide-left">
                  <div ng-repeat="(key,i) in gallery">
                    <img ng-src="{{i.file}}" ng-class="{'active': index === $index}" ng-click="changeImage($index)" />
                  </div>
                </div>
              </div>
            </div>
</div>
</div>