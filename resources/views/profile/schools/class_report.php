<table class="table table-responsive table-bordered table-striped">
    <thead>
    
        <tr>
            <th>শ্রেনী</th>
            <th ng-repeat="data in item.form.classes['0'].questions"><%data.question%></th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="data in item.form.classes">
            <td><%data.name%></td>
            <td ng-repeat="(key, value) in data.questions"><span ng-if="data.question.type!='input'&&data.question.type!='textarea'"><%answer.answer%></span><span ng-if="data.question.type=='input'||data.question.type=='textarea'"><%answer.answer_value%></span></td>
        </tr>
    </tbody>
</table>