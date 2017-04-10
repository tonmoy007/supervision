<md-content class="gray" layout-align="center center" layout="row" ng-show="coverLoaded">
    <div flex layout="row" layout-align="center center">
        
        <md-card flex="100"   flex-sm="80" flex-md="50" flex-gt-md="40">
           
        <div class="card-header cool-shadow rgba-black-strong white-text" layout-padding>
           <i class="fa fa-sign-in"></i> <span ng-if="!validating&&!reseting_password">Login</span>
            <span ng-if="validating">Validaing email address</span>
             <span ng-if="reseting_password">Reset password</span>
           <md-progress-circular ng-if="loginChecking" class="md-accent pull-right" md-diameter="25"></md-progress-circular>
        </div>

         <div class="card-block" layout-padding>
         <div class="alert alert-danger" ng-show="error!=null" ng-init="error=null">
             <% error %>
             <a href="" ng-click="error=null" class="pull-right red-text"> <i class="fa fa-times"></i></a>
         </div>
         <form class="" name="loginForm" ng-submit="login(user)" ng-show="!validating&&!reseting_password">
            <md-input-container class="md-block">
                <label for="">User Email</label>
                <input type="text" ng-model="user.email"  >
            </md-input-container>
           <div flex layout="row" layout-align="start">
            <div flex="auto">
            <md-input-container  class="md-block">
                <label for="">User Password</label>
                <input type="<%password_type%>" ng-model="user.password"  >
                
            </md-input-container>
            </div>
            <div layout="column" layout-align="center center" flex="nogrow" >
                <md-button ng-click="toggleShow()"  class="md-secondary md-icon-button" aria-label="show password button"><md-icon md-svg-src="/img/accessories/show.svg"></md-icon></md-button>
            </div>
           </div>
            <div flex>
                <a href="" class="theme-link" ng-click="forget_password()">forget password?</a>
            </div>
            <div layout="row" layout-align="center center" class="p-x-1">
                <md-button class="rgba-black-strong white-text" aria-label="login button" type="submit">Login</md-button>
            </div>
            </form>
            <ui-view></ui-view>
        </div>   
        </md-card>
    </div>
</md-content>