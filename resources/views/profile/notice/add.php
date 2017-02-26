<div class="model-container white">

<div class="dissmiss-button">
    <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
</div>
       <div class="content white">
        <div class="form-container">
        <div flex layout="row">
        <h4 flex>Add New Notice</h4>

        
        </div>
            <form class="super-form" name="addNewForm" ng-submit="submitForm(addNewForm,newNotice,'class','classes',newNotice.type)">
                <md-input-container class="md-block">
                    <label>Title</label><input type="text" ng-model="newNotice.name" name="title" value="" required>
                    <div ng-messages="addNewForm.title.$error" role="alert">
                        <div ng-message="required">
                          title is required
                        </div>
                      </div>
                </md-input-container>
                <md-input-container class="file-container md-block">
                    <div class="ImageUpload " >
                                <span class="md-button md-raised file-upload-btn" type="button"><strong ng-if="!newNotice.notice_file" >Add a file file</strong> <strong ng-if="newNotice.notice_file" >Change file</strong><br>
                                  <i class="fa fa-image text-theme"></i>
                                </span>
                                <input type="file" ngf-drop aria-label="add New Images" ngf-change="setFiles($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event)" ngf-select ng-model="newNotice.notice_file" name="notice_file"    
                                   accept="'image/*'" ngf-max-size="4MB" 
                                   ngf-model-invalid="errorFile" ngf-multiple="false">
                      </div>

                            <i ng-show="newNotice.notice_file.$error.maxSize">File too large 
                                {{errorFile.size / 1000000|number:1}}MB: max 4M</i>
                            <div class="file-img-container cool-shadow"  ng-show="addNewForm.notice_file.$valid&&newNotice.notice_file">
                           
                                <img ng-show="addNewForm.notice_file.$valid" class=" cool-shadow cool-border md-avater  file-image" ngf-no-object-url="true" ngf-src="newNotice.notice_file" > <md-icon  ng-click="newNotice.notice_file=''" ng-show="newNotice.notice_file" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/dissmiss.svg" aria-label="Close dialog"></md-icon>
                            </div>
                      
                </md-input-container>
                <md-input-container class="md-block">
                    <textarea name="description" ng-model="newNotice.description" ng-minlenght="5" ng-maxlenght="300" rows="3" required></textarea>
                    <div ng-messages="addNewForm.description.$error" role="alert">
                        <div ng-message="required">
                          Please add some description about the notice
                        </div>
                        <div ng-message="max">
                            description must not be more than 300 character
                        </div>

                        <div ng-message="max">
                            description must not be less then 5 character
                        </div>
                      </div
                </md-input-container>
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