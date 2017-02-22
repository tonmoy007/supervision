
<div class="gallery" ng-if="type=='image'">
    
<ng-gallery images="gallery" type="type"></ng-gallery>
</div>
 <md-progress-circular ng-if="!gallery" class="md-primary" md-diameter="20"></md-progress-circular>
  <div flex="none" layout="row" layout-align="center center" class="image-gallery" ng-if="type=='video'&&videoLoad">
                               
                  
         
         <div class="col-md-3 gallery-card" ng-repeat="vid in video_config track by $index">
           
         
            <div class="gallery-image " >
                <div class="gallery-image-container ">

                    <figure class="figure"  >
                    
                       <div ng-include data-src="'getView/template.videoplayer'">
                           
                       </div>
                    
                    </figure>
                          
                    
                </div>
            </div>
        </div>
     </div>