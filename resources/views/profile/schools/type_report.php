<table class="table table-responsive table-bordered table-striped">
    <thead>
        <tr>
        <th>বিষয়</th>
            <th ng-repeat="data in item.form.types[0].questions track by $index">
               <%data.question%>
            </th>
        </tr>

    </thead>
    <tbody>
        <tr ng-repeat="data in item.form.types">
            <td><%data.type%></td>
            <td ng-repeat="q in data.questions">
                <span ng-if="data.question.type!='input'&&data.question.type!='textarea'"><%answer.answer%></span><span ng-if="data.question.type=='input'||data.question.type=='textarea'"><%answer.answer_value%></span>
            </td>
        </tr>
        
    </tbody>
</table>