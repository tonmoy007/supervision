<table class="table table-responsive table-bordered table-striped">
    <thead>
    
        <tr>
            <th>শ্রেনী</th>
            <th ng-repeat="data in item.form.classes['0'].questions"><%data.question%></th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="data in item.form.classes" >

            <td><%data.name%></td>
            <td ng-repeat="(key, value) in data.questions" >
                
            <span ng-if="value.type!='input'&&value.type!='textarea'||value.type!='datepicker'||value.type!='email'"><%value.answer.option%></span>
            <span ng-if="value.type=='input'||value.type=='textarea'||value.type=='datepicker'||value.type=='email'"><%value.answer.option_value%></span>
            </td>
        </tr>
    </tbody>
</table>

<div  ng-if="item.form.classes[0].inner">
<h5><%item.form.classes[0].inner.title%></h5>
    <table class="table table-responsive table-bordered table-striped">
        <thead>
            <tr>
                <th>শ্রেনী</th>
                <th ng-repeat="cls in item.form.classes[0].inner.questions"><%cls.question%></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="class in item.form.classes">
                <td>
                    <%class.name%>
                </td>
                <td ng-repeat="ques in class.inner.questions">
                     <span ng-if="ques.type!='input'&&ques.type!='textarea'||ques.type!='datepicker'||ques.type!='email'"><%ques.answer.option%></span>
            <span ng-if="ques.type=='input'||ques.type=='textarea'||ques.type=='datepicker'||ques.type=='email'"><%ques.answer.option_value%></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>