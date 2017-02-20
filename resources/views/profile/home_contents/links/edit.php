<div class="model-container">
 
  <div class=" white">

      <div class="form-container links"  >
   
          <form class="super-form" name="editForm" ng-submit="submitEditForm(editForm,data.editContent,'link')">
              <md-input-container class="md-block">
                  <label>Title</label><input type="text" ng-model="data.editContent.name" name="name" value="" required>
                  <div ng-messages="editForm.name.$error" role="alert">
                        <div ng-message="required">
                          Title is required
                        </div>
                      </div>
              </md-input-container>
              
              <md-input-container class="md-block" >
                  <label>Type</label>
                  <md-select ng-model=" data.editContent.type" required  name="category">
                    <md-option ng-value="category.category" ng-repeat="category in categories"><%category.category%></md-option>

                  </md-select>
                  <div ng-messages="editForm.cetegory.$error" role="alert">
                        <div ng-message="required">
                          You need to select a link type 
                        </div>
                  </div>
              </md-input-container>
              <md-input-container class="md-block">
                <label>Url </label>
                <input type="url" ng-model="data.editContent.url" name="url">
                <div class="hint" >please input a valid url starting with http://montorlabs.com</div>
              </md-input-container>
            <div ng-messages="editForm.url.$error" role="alert">
                        <div ng-message="required">
                          url is required
                        </div>
                        <div ng-message="url">
                          invalid url
                        </div>
                  </div>
             

              <md-input-container class="md-block text-center" layout="row" layout-align="center center">
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