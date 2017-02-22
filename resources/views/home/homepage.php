<div flex layout-gt-sm="row" layout="column" >
    <div flex="100" flex-gt-sm="70" class="p-l-1 p-t-1">
        
    <!-- <box-ticker></box-ticker> -->

    <md-content class="md-block " ng-if="globals.current_state.current.name=='home'" >
        <div class="padded white cool-border m-b-1" ng-if="$index<3"  flex layout="column" ng-repeat="content in homePage track by $index">
            <h3 class="rgba-black-strong white-text" layout-padding><%content.title%></h3>
            <span class="space1"></span>
            <p class="text-justify" layout-padding ng-bind-html="content.content">
               
            </p>
        </div>
        
    </md-content>
    <ui-view></ui-view>
    </div>
    <div flex="100" flex-gt-sm="30">
        <sidebar ng-if="globals.current_state.current.name=='home'"></sidebar>
    </div>

</div>