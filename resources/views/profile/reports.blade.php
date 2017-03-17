

    
        
       
<div class="md-content p-t-1">
      <div class="row m-x-0" ng-show="state.current.name=='profile.reports'"  layout-align="start center">
        <md-list  class="col-md-6 md-2-line " ng-repeat="item in report_menu">
            <md-list-item class=" text-left cool-shadow bg-light-gray" ng-click="openReport(item)">
                <img flex="nogrow" class="md-avatar no-radius" src="/img/accessories/reports.svg" alt="author01" />
               <div class="menu_label " flex>
                    <label class="meta__label m-b-0"><%item.title%></label>
               </div>
            </md-list-item>
        </md-list>
    </div>
    <ui-view></ui-view>
</div>