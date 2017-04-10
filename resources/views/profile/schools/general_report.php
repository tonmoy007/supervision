<table class="table table-responsive table-bordered table-striped">
    <thead>
        <tr >
            <th ng-repeat="data in item.form.questions track by $index"> <%data.question%></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td ng-repeat="data in item.form.questions">

            <span ng-if="data.type!='input'&&data.type!='textarea'||data.type!='datepicker'||data.type!='email'"><%data.answer.option%></span>
            <span ng-if="data.type=='input'||data.type=='textarea'||data.type=='datepicker'||data.type=='email'"><%data.answer.option_value%></span>
            </td>
        </tr>
    </tbody>
</table>