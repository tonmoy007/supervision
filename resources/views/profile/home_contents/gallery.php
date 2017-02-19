<div class="inner-page">
    
    <div class="inner-page-content" >
  
        <gallery class="image-gallery" >
          <md-card ng-repeat="(key, image) in gallery"  class="col-md-3 gallery-card">
              <div ng-include data-src="'getView/template.single_gallery'" >
                  
              </div>
          </md-card>
        </gallery>
    </div>
</div>