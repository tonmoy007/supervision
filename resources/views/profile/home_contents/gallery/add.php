<div class="model-container">
  <div class="dissmiss-button">
      <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
  </div>
  <div class="content white">

      <div class="form-container gallery" ng-init="newGallery=[]" >
      <div flex layout="row">
         <h4 flex>Add Gallery Contents</h4>

      
      </div>
          <form class="super-form" name="addNewForm" ng-submit="submitForm(addNewForm,newGallery,'gallery','gallery',newGallery.type)">
               <md-input-container class="file-container text-center md-block" >
                  <div class="ImageUpload" >
                              <span class="md-button md-raised file-upload-btn" type="button"><strong ng-if="!newGallery.images.length" >Upload images / videos to gallery</strong> <strong ng-if="newGallery.images.length" >Change Files</strong><br>
                                <i class="fa fa-image text-green2"></i>
                              </span>
                              <input type="file" aria-label="add New Images" ngf-drag ngf-change="setFiles($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event)" ngf-select ng-model="newGallery.images" name="images"    
                                  ngf-pattern="'.png,.jpg,video/*,!.jog'" ngf-max-size="512MB" 
                                 ngf-model-invalid="errorFile" ngf-multiple="true">
                    </div>

                          <i ng-show="addNewForm.images.$error.maxSize"></i>
                          <div class="file-img-container cool-border"  ng-show="addNewForm.images.$valid" ng-repeat="(key,img) in newGallery.images track by $index">
                         
                              <img ng-show="addNewForm.images.$valid" class="  md-avater  file-image" ngf-no-object-url="true" ngf-src="img" > 
                              <video autobuffer autoloop loop controls class="" ngf-src="img">
                              </video>
                              <md-icon  ng-click="cancelImg(newGallery.images,key)" ng-show="newGallery.images[key]" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/dissmiss.svg" aria-label="Close dialog"></md-icon>
                          </div>
                    <div ng-messages="addNewForm.images.$error" role="alert">
                      <div ng-message="maxSize">
                        File too large 
                              <%errorFile.size / 1000000|number:1%>MB: max 512M
                      </div>
                    </div>
                   
              </md-input-container>
            

              <md-input-container class="md-block text-center" layout="row" layout-align="center center">
                  <md-button type="submit" ng-disabled="addNewForm.$invalid" class="md-raised">Submit</md-button>
              </md-input-container>
          </form>
          <div class="alert alert-error" ng-if="form.error">
            <%form.error%>
          </div>
          
          
      </div>

  </div>

  <div class="progress-container fixed" ng-if="form.addingContent"  data-ng-include data-src="'/getView/template.form-progress'">
      
  </div>
</div>