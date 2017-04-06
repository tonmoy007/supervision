<div class="inner-page">
    
    
    <div style="display: none">
        <div id="addNewPost" >
    <md-dialog layout-padding class="pre-render" >
        
        <add-new-content class="add-new " url="'api/post'" title="'Add New School'" list-content="posts" ng-class="{'show':add_new}"></add-new-content>
    </md-dialog>
    </div>
    </div>
    
    <div class="inner-page-content" >
    
        <md-list>
            
            <div ng-repeat="(category,post_category) in posts" ng-cloak>
            <div class="col-md-12">
                <h3 class="rgba-black-strong white-text" layout-padding><%category%></h3>
            </div>
                <md-list-item class="animate-repeat" ng-repeat="post in post_category track by $index" ng-include data-src="'/getView/template.single_post'"></md-list-item>
               

            </div>
            <md-list-item ng-if="posts.length==0" class="animate-if" data-ng-include data-src="'/getView/template.not_found'" ng-init="not_found='results'"></md-list-item>
        </md-list>
    </div>
</div>