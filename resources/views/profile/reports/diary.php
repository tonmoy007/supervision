
<div class="form" flex layout-align="center center" layout="row" ng-cloak>
   
    <form name="reportForm" ng-submit="submitAnswer(reportForm,form,'type')" class="full-width">
        <div ng-repeat="type in form.types track by $index" flex  class="" >
        
          
         
            
        <md-input-container ng-repeat="(key, qa) in type.questions track by $index" class="col-md-6 m-u-1 md-block" >
            <strong><%$index+1%>)</strong> &nbsp; <span class="md-body-2 "><span class="" ng-if="type.type"> <%type.type%> এরূপ</span> <%qa.question%></span>
             <hr class="m-u-1">
             <md-radio-group class=" md-block" ng-model="qa.answer.id" ng-click="changed=true" ng-if="qa.type=='radio'">

                <md-radio-button ng-value="option.id" class="md-primary inline p-r-1" ng-repeat="option in qa.options"><%option.option%></md-radio-button>

              </md-radio-group>
            <textarea name="" md-maxlength="300" rows="2" ng-model="qa.answer.option_value" ng-click="changed=true"  aria-label="<%qa.question%>" ng-if="qa.type=='textarea'"></textarea>
              <input type="text" ng-model="qa.answer.option_value" ng-click="changed=true"  aria-label="<%qa.question%>" ng-if="qa.type=='input'">
              <md-select ng-if="qa.type=='select'" ng-model="qa.answer.id" aria-label="<%qa.question%>" ng-click="changed=true">
                  
                  <md-option ng-repeat="option in qa.options" ng-value="option.id"><%option.option%></md-option>
              </md-select>

          </md-input-container>
            
         
        </div>
        <md-input-container class="form_submit "  ng-show="reportForm.$dirty">
           <md-button class="md-raised bottom-fix" type="submit"><md-icon  md-svg-src="img/accessories/save-file-button.svg"></md-icon> save</md-button>
         </md-input-container>
          
    </form>
</div>