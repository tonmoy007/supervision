<div class="model-container">
  <div class="dissmiss-button">
      <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
  </div>
  <div class="content white">

      <div class="form-container gallery" ng-init="newSlider=[]" >
      <div flex layout="row">
         <h4 flex>Add Slider Images</h4>

      
      </div>
          <form class="super-form" name="addNewForm" ng-submit="submitForm(addNewForm,newSlider,'slider','slider',newSlider.type)">
               <md-input-container class="file-container">
                  <div class="ImageUpload" >
                              <span class="md-button md-raised file-upload-btn" type="button"><strong ng-if="!newSlider.images.length" >Upload images to slider</strong> <strong ng-if="newSlider.images.length" >Change Images</strong><br>
                                <i class="fa fa-image text-green2"></i>
                              </span>
                              <input type="file" aria-label="add New Images" ngf-drag ngf-change="setFiles($files, $file, $newFiles, $duplicateFiles, $invalidFiles, $event)" ngf-select ng-model="newSlider.images" name="images"    
                                  ngf-pattern="'.png,.jpg,video/*,!.jog'" ngf-max-size="10MB" 
                                 ngf-model-invalid="errorFile" ngf-multiple="true">
                    </div>

                          <i ng-show="addNewForm.images.$error.maxSize"></i>
                          <div class="file-img-container"  ng-show="addNewForm.images.$valid" ng-repeat="(key,img) in newSlider.images track by $index">
                         
                              <img ng-show="addNewForm.images.$valid" class=" cool-shadow cool-border md-avater  file-image" ngf-no-object-url="true" ngf-src="img" > <md-icon  ng-click="cancelImg(newSlider.images,key)" ng-show="newSlider.images[key]" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/dissmiss.svg" aria-label="Close dialog"></md-icon>
                          </div>
                    <div ng-messages="addNewForm.images.$error" role="alert">
                      <div ng-message="maxSize">
                        File too large 
                              <%errorFile.size / 1000000|number:1%>MB: max 10M
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