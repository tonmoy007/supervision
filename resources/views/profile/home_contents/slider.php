<div class="inner-page">
    
    <div class="inner-page-content" >
  
        <gallery class="image-gallery" >
          <md-card ng-repeat="(key, image) in slider"  class="col-md-3 gallery-card">
              <div ng-include data-src="'getView/template.single_slider'" >
                  
              </div>
          </md-card>
        </gallery>
    </div>
</div>