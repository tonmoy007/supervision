<strong><%$index+1%>)</strong> &nbsp; <span class="md-body-2 "><%qa.question%></span>
   <hr class="m-u-1">
   <md-radio-group class=" md-block" ng-model="qa.answer.id" ng-click="changed=true" ng-if="qa.type=='radio'">

      <md-radio-button ng-value="option.id" class="md-primary inline p-r-1" ng-repeat="option in qa.options"><%option.option%></md-radio-button>

    </md-radio-group>
    <textarea name="" md-maxlength="300" ng-model="qa.answer.option_value" ng-click="changed=true"  aria-label="<%qa.question%>" ng-if="qa.type=='textarea'||qa.type=='text'" rows="2"></textarea>
    <input type="text" ng-model="qa.answer.option_value" ng-click="changed=true"  aria-label="<%qa.question%>" ng-if="qa.type=='input'">
    <input type="email" ng-model="qa.answer.option_value" ng-click="changed=true" aria-label="<%qa.question%>" ng-if="qa.type=='email'" >
    <md-datepicker ng-model="qa.answer.option_value" ng-init="qa.answer.option_value=getDate(qa.answer.option_value)" ng-change="changed=true"  aria-label="date picker"  ng-if="qa.type=='datepicker'"></md-datepicker>
    <md-select ng-if="qa.type=='select'" ng-model="qa.answer.id" aria-label="<%qa.question%>" ng-click="changed=true">
        
        <md-option ng-repeat="option in qa.options" ng-value="option.id"><%option.option%></md-option>
    </md-select>