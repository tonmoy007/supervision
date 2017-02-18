<div class="content white">

    <div class="form-container" ng-init="newPost=[];newpost.content=''" >
    <div flex layout="row">
    <h4 flex>Add New Post</h4>

    <div class="dissmiss-button">
        <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
    </div>
    </div>
        <form class="super-form" name="addNewForm">
            <md-input-container class="md-block">
                <label>Title</label><input type="text" ng-model="newPost.title" name="" value="" required>
                <div ng-messages="addNewForm.title.$error" role="alert">
                      <div ng-message="required">
                        Title is required
                      </div>
                    </div>
            </md-input-container>
            <md-input-container class="md-block">
                <label>Subtitle</label><input type="text" ng-model="newPost.subtitle" >
            </md-input-container>
            <md-input-container class="md-block" >
                <label>Type</label>
                <md-select ng-model=" newPost.category" required>
                  <md-option value="স্কুল">
                    স্কুল
                  </md-option>
                 <md-option value="কলেজ">
                    কলেজ
                  </md-option>
                 <md-option value="মাদ্রাসা">
                    মাদ্রাসা
                  </md-option>

                </md-select>
                <div ng-messages="addNewForm.category.$error" role="alert">
                      <div ng-message="required">
                        You need to select a post type 
                      </div>
                    </div>
            </md-input-container>
            <md-input-container class="file-container">
                  <div class="ImageUpload " >
                              <span class="md-button md-raised file-upload-btn" type="button"><strong ng-if="!newPost.feature_image" >Add a feature image</strong> <strong ng-if="newPost.feature_image" >Change Image</strong><br>
                                <i class="fa fa-image text-theme"></i>
                              </span>
                              <input type="file" aria-label="add New Images" ngf-change="setFiles($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event)" ngf-select ng-model="newPost.feature_image" name="feature_image"    
                                 accept="'image/*'" ngf-max-size="4MB" 
                                 ngf-model-invalid="errorFile" ngf-multiple="false">
                    </div>

                          <i ng-show="newPost.feature_image.$error.maxSize">File too large 
                              {{errorFile.size / 1000000|number:1}}MB: max 4M</i>
                          <div class="file-img-container cool-shadow"  ng-show="addNewForm.feature_image.$valid">
                         
                              <img ng-show="addNewForm.feature_image.$valid" class=" cool-shadow cool-border md-avater  file-image" ngf-no-object-url="true" ngf-src="newPost.feature_image" > <md-icon  ng-click="newPost.feature_image=''" ng-show="newPost.feature_image" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/dissmiss.svg" aria-label="Close dialog"></md-icon>
                          </div>
                    <div ng-messages="addNewForm.feature_image.$error" role="alert">
                      <div ng-message="required">
                        
                      </div>
                    </div>
              </md-input-container>

           <md-input-container class="md-block">
            <trix-editor angular-trix ng-model="newPost.content" class="rich-text"></trix-editor>
           </md-input-container>

            <md-input-container>
                <md-button type="submit" ng-disabled="addNewForm.$invalid" class="md-raised">Submit</md-button>
            </md-input-container>
        </form>
    </div>
</div>