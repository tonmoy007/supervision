<div class="model-container white">

<div class="dissmiss-button">
    <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
</div>
       <div class="content white">
        <div class="form-container">
        <div flex layout="row">
        <h4 flex>Add New School</h4>

        
        </div>
            <form class="super-form" name="addNewForm" ng-submit="submitForm(addNewForm,newschool,'school','schools',newschool.type)">
                <md-input-container class="md-block">
                    <label>Name</label><input type="text" ng-model="newschool.name" name="title" value="" required>
                    <div ng-messages="addNewForm.title.$error" role="alert">
                        <div ng-message="required">
                          name is required
                        </div>
                      </div>
                </md-input-container>
                <md-input-container class="md-block">
                    <label>Email</label><input type="email" ng-model="newschool.email" name="email" required>
                    <div ng-messages="addNewForm.email.$error" role="alert">
                        <div ng-message="required">
                          Email is required
                        </div>
                        <div ng-message="email">
                          Invalid email address
                        </div>
                      </div>
                </md-input-container>
                

                <md-input-container class="md-block" >
                    <label>Category</label>
                    <md-select ng-model=" newschool.category" required name="category">
                <md-option ng-value="category" ng-repeat="category in categories">
                    <%category%>
                  </md-option>

                </md-select>
                <div ng-messages="addNewForm.category.$error" role="alert">
                        <div ng-message="required">
                          Category is required
                        </div>
                      </div>
                </md-input-container >
                <md-input-container class="md-block">
                    <label>Password</label><input type="password" md-minlength="4" md-maxlength="20" ng-model="newschool.password" name="password" required>
                    <div ng-messages="addNewForm.password.$error" role="alert">
                        <div ng-message="required">
                          password is required
                        </div>
                        <div ng-message="md-minlength">
                          password must be atleast 4 character long
                        </div>
                        <div ng-message="md-maxlength">
                          keep the password less then 20 character
                        </div>
                      </div>
                </md-input-container>
                <md-input-container class="md-block" >
                    <label>Confirm Password</label><input type="password" equal-to="newschool.password" ng-model="newschool.confirmPassword" name="confirm" required>
                    <div ng-messages="addNewForm.confirm.$error">
                        <div ng-message="required">
                            You need to confirm your password
                        </div>
                        <div ng-message="equalTo">
                            Password doesn't match
                        </div>
                    </div>
                </md-input-container>
                <md-input-container>
                    <md-button type="submit" ng-disabled="addNewForm.$invalid" class="md-raised">Submit</md-button>
                </md-input-container>
            </form>
        </div>
       </div>
    <div class="progress-container fixed" ng-if="form.addingContent"  data-ng-include data-src="'/getView/template.form-progress'">
          
    </div>
</div>