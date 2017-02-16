<div class=" white">

    <div class="form-container">
    <div flex layout="row">
    <h4 flex><%title%></h4>

    <div class="dissmiss-button">
        <md-button class="md-icon-button" aria-label="dissmiss" ng-click="hide()"><md-icon md-svg-src="/img/accessories/dissmiss.svg"></md-icon></md-button>
    </div>
    </div>
        <form class="super-form" name="addNewForm">
            <md-input-container class="md-block">
                <label>Name</label><input type="text" ng-model="newschool.name" name="" value="" required>
            </md-input-container>
            <md-input-container class="md-block">
                <label>Email</label><input type="email" ng-model="newschool.email" required>
            </md-input-container>
            <md-input-container class="md-block" >
                <label>Type</label>
                <md-select ng-model=" newschool.type" required>
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
            </md-input-container >
            <md-input-container class="md-block">
                <label>Password</label><input type="password" ng-model="newschool.password" required>
            </md-input-container>
            <md-input-container class="md-block" >
                <label>Confirm Password</label><input type="password" ng-model="newschool.confirmPassword" required>
            </md-input-container>
            <md-input-container>
                <md-button type="submit" ng-disabled="addNewForm.$invalid" class="md-raised">Submit</md-button>
            </md-input-container>
        </form>
    </div>
</div>