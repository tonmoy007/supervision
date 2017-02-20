<div class="model-container">
  <div class="dissmiss-button">
      <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
  </div>
  <div class="content white">

      <div class="form-container links" ng-init="newEmployee=[]" >
      <div flex layout="row">
         <h4 flex>Add New Employees</h4>

      
      </div>
          <form class="super-form" name="addNewForm" ng-submit="submitForm(addNewForm,newEmployee,'employee','employees',newEmployee.type)">
              <md-input-container class="md-block">
                  <label>Name</label><input type="text" ng-model="newEmployee.name" name="name" value="" required>
                  <div ng-messages="addNewForm.name.$error" role="alert">
                        <div ng-message="required">
                          Name is required
                        </div>
                      </div>
              </md-input-container>
              
              <md-input-container class="md-block" >
                  <label>Type</label>
                  <md-select ng-model=" newEmployee.designation" required md-on-open="loadCategory('employee/category')" name="category">
                    <md-option ng-value="category.category" ng-repeat="category in categories"><%category.category%></md-option>

                  </md-select>
                  <div ng-messages="addNewForm.cetegory.$error" role="alert">
                        <div ng-message="required">
                          You need to select an employee type
                        </div>
                  </div>
              </md-input-container>
              <md-input-container class="md-block">
                <label>Designation </label>
                <input type="text" ng-model="newEmployee.rank" name="rank" required>
                <div ng-messages="addNewForm.rank.$error" role="alert">
                      <div ng-message="required">
                        Designation is required
                      </div>
                      
                </div>
              </md-input-container>
              
             <md-input-container class="file-container md-block">
                    <div class="ImageUpload " >
                                <span class="md-button md-raised file-upload-btn" type="button"><strong ng-if="!newEmployee.featured_image" >Add a feature image</strong> <strong ng-if="newEmployee.featured_image" >Change Image</strong><br>
                                  <i class="fa fa-image text-theme"></i>
                                </span>
                                <input type="file" ngf-drop aria-label="add New Images" ngf-change="setFiles($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event)" ngf-select ng-model="newEmployee.featured_image" name="featured_image"    
                                   accept="'image/*'" ngf-max-size="4MB" 
                                   ngf-model-invalid="errorFile" ngf-multiple="false">
                      </div>

                            <i ng-show="newEmployee.featured_image.$error.maxSize">File too large 
                                <%errorFile.size / 1000000|number:1%>MB: max 4M</i>
                            <div class="file-img-container cool-shadow"  ng-show="addNewForm.featured_image.$valid&&newEmployee.featured_image">
                           
                                <img ng-show="addNewForm.featured_image.$valid" class=" cool-shadow cool-border md-avater  file-image" ngf-no-object-url="true" ngf-src="newEmployee.featured_image" > <md-icon  ng-click="newEmployee.featured_image=''" ng-show="newEmployee.featured_image" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/dissmiss.svg" aria-label="Close dialog"></md-icon>
                            </div>
                      
                </md-input-container>

              <md-input-container class="md-block text-center" layout="row" layout-align="center center">
                  <md-button type="submit" ng-disabled="addNewForm.$invalid" class="md-raised">Submit</md-button>
              </md-input-container>
          </form>
          <div class="alert alert-danger" ng-if="form.error">
            <%form.error%>
          </div>
          
          
      </div>

  </div>

  <div class="progress-container fixed" ng-if="form.addingContent"  data-ng-include data-src="'/getView/template.form-progress'">
      
  </div>
</div>