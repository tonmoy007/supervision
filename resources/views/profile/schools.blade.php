<div class="inner-page">
    
    
    <div style="display: none">
        <div id="addNewSchool" >
    <md-dialog layout-padding class="pre-render" >
        
        <add-new-content class="add-new " url="'api/schools/add'" title="'Add New School'" list-content="schools" ng-class="{'show':add_new}"></add-new-content>
    </md-dialog>
    </div>
    </div>
    
    <div class="inner-page-content" ng-show="!add_new">
    
        <md-list>
            
            <md-list-item class="animate-repeat" ng-repeat="school in schools|filter:actions.search_query as results track by $index" ng-include data-src="'/getView/template.single_school'" ></md-list-item>

            <md-list-item ng-if="!results.length" class="animate-if" data-ng-include data-src="'/getView/template.not_found'" ng-init="not_found='results'"></md-list-item>
        </md-list>
    </div>
</div>