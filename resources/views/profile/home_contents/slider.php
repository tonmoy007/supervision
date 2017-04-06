<div class="inner-page">
    
    <div class="inner-page-content" >
  
        <gallery class="image-gallery"  ng-cloak>
          <md-card ng-repeat="(key, image) in slider"  class="col-md-3 gallery-card">
              <div ng-include data-src="'getView/template.single_slider'" >
                  
              </div>
          </md-card>
          <div ng-include ng-show="!slider.length" data-src="'/getView/template.not_found'" ng-init="not_found='slider'" class="col-md-12 gallery-card text-center">
              
          </div>
        </gallery>
    </div>
</div>