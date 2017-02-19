<div class="model-container">
  <div class="dissmiss-button">
      <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
  </div>
  <div class="content white">

      <div class="form-container links" ng-init="newLink=[]" >
      <div flex layout="row">
         <h4 flex>Add New Link</h4>

      
      </div>
          <form class="super-form" name="addNewForm" ng-submit="submitForm(addNewForm,newLink,'link','links',newLink.type)">
              <md-input-container class="md-block">
                  <label>Title</label><input type="text" ng-model="newLink.name" name="name" value="" required>
                  <div ng-messages="addNewForm.name.$error" role="alert">
                        <div ng-message="required">
                          Title is required
                        </div>
                      </div>
              </md-input-container>
              
              <md-input-container class="md-block" >
                  <label>Type</label>
                  <md-select ng-model=" newLink.type" required md-on-open="loadCategory('link/category')" name="category">
                    <md-option ng-value="category.category" ng-repeat="category in categories"><%category.category%></md-option>

                  </md-select>
                  <div ng-messages="addNewForm.cetegory.$error" role="alert">
                        <div ng-message="required">
                          You need to select a link type 
                        </div>
                  </div>
              </md-input-container>
              <md-input-container class="md-block">
                <label>Url </label>
                <input type="url" ng-model="newLink.url" name="url">
                <div class="hint" >please input a valid url starting with http://montorlabs.com</div>
              </md-input-container>
            <div ng-messages="addNewForm.url.$error" role="alert">
                        <div ng-message="required">
                          url is required
                        </div>
                        <div ng-message="url">
                          invalid url
                        </div>
                  </div>
             

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