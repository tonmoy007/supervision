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
        <tr ng-repeat="d in item.form.types" ng-if="d.questions.length==item.form.types[0].questions.length&&d.type||d.name">

            <td><%d.type%><%d.name%></td>

            <td ng-repeat="q in d.questions">
                
            <span ng-if="q.type!='input'&&q.type!='textarea'||q.type!='datepicker'||q.type!='email'"><%q.answer.option%></span>
            <span ng-if="q.type=='input'||q.type=='textarea'||q.type=='datepicker'||q.type=='email'"><%q.answer.option_value%></span>
            </td>
        </tr>
    </tbody>
    
</table>
<div ng-repeat="d in item.form.types" ng-if="d.questions.length!=item.form.types[0].questions.length">
        
            <h5><%d.type%></h5>
    <table class="table table-responsive table-bordered table-striped">
        <thead>
            <tr>
                <th ng-repeat="ques in d.questions"><%ques.question%></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td ng-repeat="ques in d.questions">
                    <span ng-if="ques.type!='input'&&ques.type!='textarea'||ques.type!='datepicker'||ques.type!='email'"><%ques.answer.option%></span>
            <span ng-if="ques.type=='input'||ques.type=='textarea'||ques.type=='datepicker'||ques.type=='email'"><%ques.answer.option_value%></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
