<div class="inner-page">
    
    
    <div style="display: none">
        <div id="addNewGallery" >
        <md-dialog layout-padding class="pre-render" >
            
            <add-new-content class="add-new " url="'api/gallery'" title="'Add Gallery Content'" list-content="gallery" ng-class="{'show':add_new}"></add-new-content>
        </md-dialog>
        </div>
    </div>
    
    <div class="inner-page-content" >
    
        <md-list>
            
            <md-list-item class="animate-repeat" ng-repeat="employee in employees track by $index" ng-include data-src="'/getView/template.single_employee'"></md-list-item>

            <md-list-item ng-if="employees.length==0" class="animate-if" data-ng-include data-src="'/getView/template.not_found'" ng-init="not_found='results'"></md-list-item>
        </md-list>
    </div>
</div>