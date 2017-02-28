<div class="model-container white">

<div class="dissmiss-button">
    <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
</div>

       <div class="content white">
        <div class="form-container">
        <div flex layout="row">
        <h4 flex>Edit School</h4>

        
        </div>
            <form class="super-form" name="editForm" ng-submit="submitEditForm(editForm,data.editContent,'school')">
                <md-input-container class="md-block" ng-init="data.editContent.name=data.editContent.user.name">
                    <label>Name</label><input type="text" ng-model="data.editContent.name" name="title" value="" required>
                    <div ng-messages="editForm.title.$error" role="alert">
                        <div ng-message="required">
                          name is required
                        </div>
                      </div>
                </md-input-container>
                <md-input-container class="md-block" ng-init="data.editContent.email=data.editContent.user.email">
                    <label>Email</label><input type="email" ng-model="data.editContent.email" name="email" required>
                    <div ng-messages="editForm.email.$error" role="alert">
                        <div ng-message="required">
                          Email is required
                        </div>
                        <div ng-message="email">
                          Invalid email address
                        </div>
                      </div>
                </md-input-container>

                <div flex>
                    <md-input-container class="md-block" >
                    <label>Type</label>
                    <md-select ng-model=" data.editContent.type"  name="type">
                <md-option ng-value="type" ng-repeat="type in types">
                    <%type%>
                  </md-option>

                </md-select>
                
                </md-input-container >
                <md-input-container class="md-block" >
                    <label>Category</label>
                    <md-select ng-model=" data.editContent.category" required name="category">
                <md-option ng-value="category" ng-repeat="category in categories">
                    <%category%>
                  </md-option>

                </md-select>
                <div ng-messages="editForm.category.$error" role="alert">
                        <div ng-message="required">
                          Category is required
                        </div>
                      </div>
                </md-input-container >
                    <md-input-container class="md-block" flex>
                        <label>EIIN Number</label><input type="text" ng-model="data.editContent.eiin_number" name="eiin_number" >
                        
                    </md-input-container>
                </div>
               <div flex>
               <md-input-container class="md-block" >
                    <label>Management</label>
                    <md-select ng-model=" data.editContent.management" required name="management">
                <md-option ng-value="item" ng-repeat="item in managements">
                    <%item%>
                  </md-option>

                </md-select>
                </md-input-container>
                   <md-input-container class="md-block" flex>
                    <label>Total Teacher</label><input type="number" ng-model="data.editContent.teacher" name="teacher" >
                    
                </md-input-container>
                <md-input-container class="md-block" flex>
                    <label>Female Teacher</label><input type="number" ng-model="data.editContent.female_teacher" name="female_teacher" >
                    
                </md-input-container>
               </div>
                <div flex>
                    <md-input-container class="md-block" flex>
                    <label>Zila</label><input type="text" ng-model="data.editContent.zilla" name="zilla" >
                    
                </md-input-container>
                <md-input-container class="md-block" flex>
                    <label>Upo Zila</label><input type="text" ng-model="data.editContent.upozilla" name="upozilla" >
                    
                </md-input-container>
                </div>
               <div flex>
                    <md-input-container class="md-block">
                    <label>Mpo Code</label><input type="text" ng-model="data.editContent.mpo_code" name="upozilla" >
                    
                </md-input-container>
                <md-input-container class="md-block" ng-init="data.editContent.mpo_date=getDate(data.editContent.mpo_date)">
                    <label>Mpo Date</label><md-datepicker ng-model="data.editContent.mpo_date"></md-datepicker>
                    
                </md-input-container>
               </div>
                <md-input-container class="md-block text-center">
                    <md-button type="submit" ng-disabled="editForm.$invalid" class="md-raised">Submit</md-button>
                </md-input-container>
            </form>
        </div>
       </div>

    <div class="progress-container fixed" ng-if="form.updatingContent"  data-ng-include data-src="'/getView/template.form-progress'">
          
    </div>
</div>