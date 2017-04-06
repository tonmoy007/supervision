
<div class="form" flex layout-align="center center" layout="row">
   
    <form name="reportForm" ng-submit="submitAnswer(reportForm,form,'no_class')" >
        <md-input-container ng-repeat="(key, qa) in form.questions track by $index" class="col-md-6 m-u-1" >
          <strong><%$index+1%>)</strong> &nbsp; <span class="md-body-2 "><%qa.question%></span>
           <hr class="m-u-1">
           <md-radio-group class=" md-block" ng-model="qa.answer.id" ng-click="changed=true" ng-if="qa.type=='radio'">

              <md-radio-button ng-value="option.id" class="md-primary inline p-r-1" ng-repeat="option in qa.options"><%option.option%></md-radio-button>

            </md-radio-group>
            <textarea name="" md-maxlength="300" ng-model="qa.answer.option_value" ng-click="changed=true"  aria-label="<%qa.question%>" ng-if="qa.type=='textarea'" rows="2"></textarea>
            <input type="text" ng-model="qa.answer.option_value" ng-click="changed=true"  aria-label="<%qa.question%>" ng-if="qa.type=='input'">
            <md-select ng-if="qa.type=='select'" ng-model="qa.answer.id" aria-label="<%qa.question%>" ng-click="changed=true">
                
                <md-option ng-repeat="option in qa.options" ng-value="option.id"><%option.option%></md-option>
            </md-select>

        </md-input-container>
       <md-input-container class="form_submit "  ng-show="reportForm.$dirty">
         <md-button class="md-raised bottom-fix" type="submit"><md-icon  md-svg-src="img/accessories/save-file-button.svg"></md-icon> save</md-button>
       </md-input-container>
        
    </form>
</div>