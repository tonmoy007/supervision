<div class="inner-page">
    
    
  
    
    <div class="inner-page-content" ng-show="!add_new">
    
        <md-list>
            
            <md-list-item class="animate-repeat" ng-repeat="notice in notices|filter:actions.search_query as results track by $index" ng-include data-src="'/getView/profile.notice.single_notice'" ></md-list-item>

            <md-list-item ng-if="!results.length" class="animate-if" data-ng-include data-src="'/getView/template.not_found'" ng-init="not_found='results'"></md-list-item>
        </md-list>
    </div>
</div>