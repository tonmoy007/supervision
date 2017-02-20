<div class="model-container">
  <div class="dissmiss-button">
      <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
  </div>
  <div class="content white">

      <div class="form-container posts" >
      <div flex layout="row">
      <h4 flex>Edit Post</h4>

      
      </div>
          <form class="super-form" name="editForm" ng-submit="submitEditForm(editForm,data.editContent,'post')">
              <md-input-container class="md-block">
                  <label>Title</label><input type="text" ng-model="data.editContent.title" name="title" value="" required>
                  <div ng-messages="editForm.title.$error" role="alert">
                        <div ng-message="required">
                          Title is required
                        </div>
                      </div>
              </md-input-container>
              <md-input-container class="md-block">
                  <label>Subtitle</label><input type="text" ng-model="data.editContent.sub_title" >
              </md-input-container>
              <md-input-container class="md-block" >
                  <label>Type</label>
                  <md-select ng-model="data.editContent.type" required  name="category" >
                    <md-option ng-value="category.category" ng-repeat="category in categories"><%category.category%></md-option>

                  </md-select>
                  <div ng-messages="editForm.category.$error" role="alert">
                        <div ng-message="required">
                          You need to select a post type 
                        </div>
                      </div>
              </md-input-container>
              <md-input-container class="file-container md-block">
                    <div class="ImageUpload " >
                                <span class="md-button md-raised file-upload-btn" type="button"><strong ng-if="!data.editContent.featured_image" >Add a feature image</strong> <strong ng-if="data.editContent.featured_image" >Change Image</strong><br>
                                  <i class="fa fa-image text-theme"></i>
                                </span>
                                <input type="file" ngf-drop aria-label="add New Images" ngf-change="setFiles($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event)" ngf-select ng-model="data.editContent.featured_image" name="featured_image"    
                                   accept="'image/*'" ngf-max-size="4MB" 
                                   ngf-model-invalid="errorFile" ngf-multiple="false">
                      </div>

                            <i ng-show="data.editContent.featured_image.$error.maxSize">File too large 
                                {{errorFile.size / 1000000|number:1}}MB: max 4M</i>
                            <div class="file-img-container cool-shadow"  ng-show="editForm.featured_image.$valid&&data.editContent.featured_image">
                           
                                <img ng-show="editForm.featured_image.$valid" class=" cool-shadow cool-border md-avater  file-image" ngf-no-object-url="true" ngf-src="data.editContent.featured_image" > <md-icon  ng-click="data.editContent.featured_image=''" ng-show="data.editContent.featured_image" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/dissmiss.svg" aria-label="Close dialog"></md-icon>
                            </div>
                      
                </md-input-container>
            
             <md-input-container class="md-block">
              <trix-editor angular-trix ng-model="data.editContent.content" class="rich-text" name="content" required></trix-editor>
              <div ng-messages="editForm.content.$error" role="alert">
                        <div ng-message="required">
                          You need must add contents to your post
                        </div>
                      </div>
             </md-input-container>

              <md-input-container class="md-block text-center" >
                  <md-button type="submit" ng-disabled="editForm.$invalid" class="md-raised">Submit</md-button>
              </md-input-container>
          </form>
          <div class="alert alert-error" ng-if="form.error">
            <%form.error%>
          </div>
          
          
      </div>

  </div>

  <div class="progress-container fixed" ng-if="form.updatingContent"  data-ng-include data-src="'/getView/template.form-progress'">
      
  </div>
</div>