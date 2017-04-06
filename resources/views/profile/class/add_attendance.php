<div class="model-container white">

<div class="dissmiss-button">
    <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
</div>
       <div class="content white">
        <div class="form-container">
        <div flex layout="row">
        <h4 flex>Add Today's attendance</h4>
        
        
        </div>
            <form class="super-form" name="addNewForm" ng-submit="submitAttendance(addNewForm,attendance)">
                <div flex>
                  <table class="table center-table table-responsive text-center table-bordered">
                    <thead>
                      <tr>
                        <th>Class Name</th>
                        <th>Total Student</th>
                        <th>Present Student</th>
                        <th>Absent Student</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="(key, class) in attendance">
                        <td class="text-left" ng-init="class.class_id=class.id"><%class.name%></td>
                        <td><%class.total_students%></td>
                        <td>
                          <md-input-container class="md-block md-no-float m-u-0">
                            <input type="number" name="present_students<%$index%>" max="<%class.total_students%>" ng-model="class.present_students" aria-label="Present Student" min="0" required>
                            <div ng-messages="addNewForm['present_students'+$index].$error" role="alert">
                              <div ng-message="max">
                                Present Students can't be more then total students
                              </div>
                              <div ng-message="required">
                                if none please set 0 
                              </div>
                              <div ng-message="min">
                                This input can't be negetive
                              </div>
                              
                            </div>
                          </md-input-container>
                          
                        </td>
                        <td>
                          <%class.total_students-class.present_students%>
                        </td>

                      </tr>
                    </tbody>
                  </table>
                </div>
                <md-input-container class="md-block text-center">
                    <md-button type="submit" ng-disabled="addNewForm.$invalid" class="md-raised">Submit</md-button>
                </md-input-container>
            </form>
        </div>
       </div>
    <div class="progress-container fixed" ng-if="form.addingContent"  data-ng-include data-src="'/getView/template.form-progress'">
          
    </div>
</div>