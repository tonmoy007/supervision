<div class="inner-page" ng-cloak>
    
    
  
    
    <div class="inner-page-content" ng-show="!add_new">
    
        <md-list>
            
            <md-list-item class="animate-repeat" ng-cloak ng-repeat="class in classes|filter:actions.search_query as results track by $index" ng-include data-src="'/getView/profile.class.single_class'" ></md-list-item>

            <md-list-item ng-if="!results.length" class="animate-if" data-ng-include data-src="'/getView/template.not_found'" ng-init="not_found='results'"></md-list-item>
        </md-list>
        <div class="attendance p-u-1">
            <h4 class="md-title p-l-1"><md-icon md-svg-src="/img/accessories/attendance.svg"></md-icon> Attendance</h4>
            <md-divider></md-divider>
             <md-list-item ng-if="!is_attendance_taken" class="animate-if" data-ng-include data-src="'/getView/template.info'" ng-init="message='Todays attendance is not submitted, please submit todays attendance'"></md-list-item>

            <md-list ng-show="attendance.length" ng-repeat="item in attendance track by $index" ng-include data-src="'/getView/profile.class.single_attendance'">
                
            </md-list>
           
        </div>

    </div>
</div>