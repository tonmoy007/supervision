
<div class="form" flex layout-align="center center" layout="row" ng-cloak>
   
    <form name="reportForm" ng-submit="submitAnswer(reportForm,form,'class')" >
        <div ng-repeat="class in form.classes track by $index" flex  class="" layout="column">
        
          <h4 class="p-a-1 bg-light-gray">Class : <%class.name%></h4>
         
            <div flex >
              <md-input-container ng-repeat="(key, qa) in class.questions track by $index" class="col-md-4 m-u-1 md-block" ng-include="'getView/template.input-template'">
            

          </md-input-container>

            </div>
            <div flex ng-if="class.inner">
              <h4 class="p-a-1 "> <%class.inner.title%></h4>
              <md-divider></md-divider>
              <div flex>
                  <md-input-container ng-repeat="(key, qa) in class.inner.questions track by $index" class="col-md-4 m-u-1 md-block" ng-include="'getView/template.input-template'">
            

          </md-input-container>
              </div>
            </div>
         
        </div>
        <md-input-container class="form_submit "  ng-show="reportForm.$dirty">
           <md-button class="md-raised bottom-fix" type="submit"><md-icon  md-svg-src="img/accessories/save-file-button.svg"></md-icon> save</md-button>
         </md-input-container>
          
    </form>
</div>