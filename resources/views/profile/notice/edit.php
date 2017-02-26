<div class="model-container white">

<div class="dissmiss-button">
    <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
</div>
       <div class="content white">
        <div class="form-container">
        <div flex layout="row">
        <h4 flex>Edit Notice</h4>

        
        </div>
            <form class="super-form" name="editForm" ng-submit="submitEditForm(editForm,data.editContent,'notice')">
                <md-input-container class="md-block">
                    <label>Title</label><input type="text" ng-model="data.editContent.title" name="title" value="" required>
                    <div ng-messages="editForm.title.$error" role="alert">
                        <div ng-message="required">
                          title is required
                        </div>
                      </div>
                </md-input-container>
                <md-input-container class="md-block">
                <label>Description</label>
                    <textarea name="description" aria-label="description" ng-model="data.editContent.description" md-minlenght="5" md-maxlenght="300"  required></textarea>
                    <div ng-messages="editForm.description.$error" role="alert">
                        <div ng-message="required">
                          Please add some description about the notice
                        </div>
                        <div ng-message="md-maxlength">
                            description must not be more than 300 character
                        </div>

                        <div ng-message="md-minlength">
                            description must not be less then 5 character
                        </div>
                      </div>
                </md-input-container>
                
                <md-input-container class="file-container md-block text-center">
                    <div class="ImageUpload " >
                                <span class="md-button md-raised file-upload-btn" type="button"><strong ng-if="!data.editContent.notice_file" >Attach file</strong> <strong ng-if="data.editContent.notice_file" >Change file</strong><br>
                                  <i class="fa fa-image text-theme"></i>
                                </span>
                                <input type="file" ngf-drop aria-label="add New Images" ngf-change="setFiles($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event)" ngf-select ng-model="data.editContent.notice_file" name="notice_file"    
                                    ngf-max-size="4MB" 
                                   ngf-model-invalid="errorFile" ngf-multiple="false">
                      </div>

                            <i ng-show="data.editContent.notice_file.$error.maxSize">File too large 
                                {{errorFile.size / 1000000|number:1}}MB: max 4M</i>
                            <div class="file-img-container cool-shadow"  ng-show="editForm.notice_file.$valid&&data.editContent.notice_file">
                           
                                <img ng-show="editForm.notice_file.$valid" class=" cool-shadow cool-border md-avater  file-image" ngf-no-object-url="true" ngf-src="data.editContent.notice_file" > 
                            </div>
                      
                </md-input-container>

                <md-input-container class="text-center md-block">
                    <md-button type="submit" ng-disabled="editForm.$invalid" class="md-raised">Submit</md-button>
                </md-input-container>
            </form>
        </div>
       </div>
    <div class="progress-container fixed" ng-if="form.addingContent"  data-ng-include data-src="'/getView/template.form-progress'">
          
    </div>
</div>