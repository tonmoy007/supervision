
<div class="form" flex layout-align="center center" layout="row" ng-cloak>
   
    <form name="reportForm" ng-submit="submitAnswer(reportForm,form,'type')" >
        <div ng-repeat="type in form.types track by $index" flex  class="" layout="column" ng-cloak >
        
          <h4 class="p-a-1 bg-light-gray fadeIn"> <%type.type%></h4>
         
            <div flex >
              <md-input-container ng-repeat="(key, qa) in type.questions track by $index" class="col-md-3 m-u-1 md-block" ng-include="'getView/template.input-template'" ng-cloak >
              </md-input-container>

            </div>
         
        </div>
        <md-input-container class="form_submit "  ng-show="reportForm.$dirty">
           <md-button class="md-raised bottom-fix" type="submit"><md-icon  md-svg-src="img/accessories/save-file-button.svg"></md-icon> save</md-button>
         </md-input-container>
          
    </form>
</div>