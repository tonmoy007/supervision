<div flex  layout-padding layout="column">

<div ng-include="'getView/profile.schools.general_info_form'">
    
</div>

    <div class="form_view" ng-repeat="item in questions.form track by $index">
        <div class="form_view_header">
            <%getNumber($index+2)%> | <%item.form.title.value%>
        </div>
        <div class="form_view_body">
            <div ng-include="'getView/profile.schools.general_report'" ng-if="item.form.questions">
                
            </div>
            <div ng-include="'getView/profile.schools.type_report'" ng-if="item.form.types" >
                
            </div>
            <div ng-include="'getView/profile.schools.class_report'" ng-if="item.form.classes" >
            
            </div>
        </div>
    </div>
</div>