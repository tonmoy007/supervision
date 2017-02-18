<div class="inner-page">
    
    
    <div style="display: none">
        <div id="addNewSlider" >
        <md-dialog layout-padding class="pre-render" >
            
            <add-new-content class="add-new " url="'api/slider'" title="'Add New Slider'" list-content="slider" ng-class="{'show':add_new}"></add-new-content>
        </md-dialog>
        </div>
    </div>
    
    <div class="inner-page-content" >
    
        <md-list>
            
            <md-list-item class="animate-repeat" ng-repeat="slide in slider track by $index" ng-include data-src="'/getView/template.single_slider'"></md-list-item>

            <md-list-item ng-if="slider.length==0" class="animate-if" data-ng-include data-src="'/getView/template.not_found'" ng-init="not_found='results'"></md-list-item>

        </md-list>
    </div>
</div>