<div class="model-container white">

<div class="dissmiss-button">
    <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
</div>
       <div class="content white">
        <div class="form-container">
        <div flex layout="row">
        <h4 flex>Add New Class</h4>

        
        </div>
            <form class="super-form" name="editForm" ng-submit="submitEditForm(editForm,data.editContent,'class')">
                <md-input-container class="md-block">
                    <label>Name</label><input type="text" ng-model="data.editContent.name" name="title" value="" required>
                    <div ng-messages="editForm.title.$error" role="alert">
                        <div ng-message="required">
                          name is required
                        </div>
                      </div>
                </md-input-container>
                <md-input-container class="md-block">
                    <label>Total Students</label><input type="number" ng-model="data.editContent.total_students" name="total_students" required>
                    <div ng-messages="editForm.total_students.$error" role="alert">
                        <div ng-message="required">
                          Total Students is required
                        </div>
                        
                      </div>
                </md-input-container>
                
                </md-input-container>
                <md-input-container layout layout-align="center center">
                    <md-button type="submit" ng-disabled="editForm.$invalid" class="md-raised">Submit</md-button>
                </md-input-container>
            </form>
        </div>
       </div>
    <div class="progress-container fixed" ng-if="form.addingContent"  data-ng-include data-src="'/getView/template.form-progress'">
          
    </div>
</div>