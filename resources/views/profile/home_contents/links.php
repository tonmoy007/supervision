<div class="inner-page">
    
    
    <div style="display: none">
        <div id="addNewLink" >
        <md-dialog layout-padding class="pre-render" >
            
            <add-new-content class="add-new " url="'api/link'" title="'Add New Link'" list-content="links" ng-class="{'show':add_new}"></add-new-content>
        </md-dialog>
        </div>
    </div>
    
    <div class="inner-page-content" >
    
        <md-list>
            <div ng-repeat="(category,link_category) in links">
            <div class="col-md-12">
                
                <h3 class="rgba-black-strong white-text" layout-padding><%category%></h3>
            </div>
            <md-list-item class="animate-repeat" ng-repeat="link in link_category|filter:search_query as results track by $index" ng-include data-src="'/getView/template.single_link'"></md-list-item>

            </div>
            <md-list-item ng-if="links.length==0" class="animate-if" data-ng-include data-src="'/getView/template.not_found'" ng-init="not_found='results'"></md-list-item>
        </md-list>
    </div>
</div>