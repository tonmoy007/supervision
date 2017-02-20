<form class="super-form" name="editForm" ng-submit="submitEditForm(editForm,data.editContent,'employee')" >
            <div flex layout="column" layout-gt-sm="row">
              
              <md-input-container class="md-block" flex>
                  <label>Name</label><input type="text" ng-model="data.editContent.name" name="name" value="" required>
                  <div ng-messages="editForm.name.$error" role="alert">
                        <div ng-message="required">
                          Name is required
                        </div>
                      </div>
              </md-input-container>
              
              <md-input-container class="md-block" flex>
                  <label>Type</label>
                  <md-select ng-model=" data.editContent.designation" required  name="category">
                    <md-option ng-value="category.category" ng-repeat="category in categories"><%category.category%></md-option>

                  </md-select>
                  <div ng-messages="editForm.cetegory.$error" role="alert">
                        <div ng-message="required">
                          You need to select an employee type
                        </div>
                  </div>
              </md-input-container>
              <md-input-container class="md-block" flex>
                <label>Designation </label>
                <input type="text" ng-model="data.editContent.rank" name="rank" required>
                <div ng-messages="editForm.rank.$error" role="alert">
                      <div ng-message="required">
                        Designation is required
                      </div>
                      
                </div>
              </md-input-container>
            </div>
              
             <div flex layout="column" layout-gt-sm="row">
               <md-input-container class="file-container md-block" flex>
                    <div class="ImageUpload " >
                                <span class="md-button md-raised file-upload-btn" type="button"><strong ng-if="!data.editContent.featured_image" >Change image</strong> <strong ng-if="data.editContent.featured_image" >Change Image</strong><br>
                                  <i class="fa fa-image text-theme"></i>
                                </span>
                                <input type="file" ngf-drop aria-label="add New Images" ngf-change="setFiles($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event)" ngf-select ng-model="data.editContent.featured_image" name="featured_image"    
                                   accept="'image/*'" ngf-max-size="4MB" 
                                   ngf-model-invalid="errorFile" ngf-multiple="false">
                      </div>

                            <i ng-show="data.editContent.featured_image.$error.maxSize">File too large 
                                <%errorFile.size / 1000000|number:1%>MB: max 4M</i>
                            <div class="file-img-container cool-shadow"  ng-show="editForm.featured_image.$valid&&data.editContent.featured_image">
                           
                                <img ng-show="editForm.featured_image.$valid" class=" cool-shadow cool-border md-avater  file-image" ngf-no-object-url="true" ngf-src="data.editContent.featured_image" > <md-icon  ng-click="data.editContent.featured_image=''" ng-show="data.editContent.featured_image" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/dissmiss.svg" aria-label="Close dialog"></md-icon>
                            </div>
                      
                </md-input-container>

              <md-input-container class="md-block text-center " flex="nogrow" layout="row" layout-align="center center">
                  <md-button type="submit" ng-disabled="editForm.$invalid" class="md-raised">Submit</md-button>
              </md-input-container>
             </div>
             <div class="progress-container fixed" ng-if="form.updatingContent"  data-ng-include data-src="'/getView/template.form-progress'">
                
            </div>
          </form>