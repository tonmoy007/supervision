 <div class="inner-page">
    
    
    <div class="inner-page-content" >
    
        <md-list>
            
            <div ng-repeat="(type,employee_types) in employees" ng-cloak>
            <div class="col-md-12">
                <h3 class="rgba-black-strong white-text "  layout-padding><%type%></h3>
            </div>
            <md-list-item class="animate-repeat" ng-repeat="employee in employee_types track by $index" ng-include data-src="'/getView/template.single_employee'"></md-list-item>
                
            </div>

            <md-list-item ng-if="employees.length==0" class="animate-if" data-ng-include data-src="'/getView/template.not_found'" ng-init="not_found='results'"></md-list-item>
        </md-list>
    </div>
</div>