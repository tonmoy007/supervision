
<div class="form" flex layout-align="center center" layout="row">
   
    <form name="reportForm" ng-submit="submitAnswer(reportForm,form,'no_class')" ng-cloak>
        <md-input-container ng-repeat="(key, qa) in form.questions track by $index" class="col-md-6 m-u-1" ng-include="'getView/template.input-template'" ng-cloak>
          

        </md-input-container>
       <md-input-container class="form_submit "  ng-show="reportForm.$dirty">
         <md-button class="md-raised bottom-fix" type="submit"><md-icon  md-svg-src="img/accessories/save-file-button.svg"></md-icon> save</md-button>
       </md-input-container>
        
    </form>
</div>