<table class="table table-responsive table-bordered table-striped">
    <thead>
        <tr >
            <th ng-repeat="data in item.form.questions track by $index"> <%data.question%></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td ng-repeat="data in item.form.questions"><span ng-if="data.question.type!='input'&&data.question.type!='textarea'"><%answer.answer%></span><span ng-if="data.question.type=='input'||data.question.type=='textarea'"><%answer.answer_value%></span></td>
        </tr>
    </tbody>
</table>