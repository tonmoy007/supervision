<md-content class="gray" layout-align="center center" layout="row">
    <div flex layout="row" layout-align="center center">
        
        <md-card flex="100"   flex-sm="80" flex-md="50" flex-lg="40">
           
        <div class="card-header cool-shadow rgba-black-strong white-text" layout-padding>
           <i class="fa fa-sign-in"></i> Login 
           <md-progress-circular ng-if="loginChecking" class="md-warn md-hue-3 pull-right" md-diameter="40"></md-progress-circular>
        </div>

         <div class="card-block" layout-padding>
         <div class="alert alert-danger" ng-show="error!=null" ng-init="error=null">
             <% error %>
             <a href="" ng-click="error=null" class="pull-right red-text"> <i class="fa fa-times"></i></a>
         </div>
         <form class="" name="loginForm" ng-submit="login(user)">
            <md-form>
                <label for="">User Email</label>
                <input type="text" ng-model="user.email"  >
            </md-form>
           <div flex layout="row" layout-align="start">
            <div flex="auto">
            <md-form >
                <label for="">User Password</label>
                <input type="<%password_type%>" ng-model="user.password"  >
                
            </md-form>
            </div>
            <div layout="column" layout-align="center center" flex="nogrow" >
                <md-button ng-click="toggleShow()"  class="md-secondary md-icon-button" aria-label="show password button"><md-icon md-svg-src="/img/accessories/show.svg"></md-icon></md-button>
            </div>
           </div>

            <div layout="row" layout-align="center center" layout-padding>
                <md-button class="rgba-black-strong white-text" aria-label="login button" type="submit">Login</md-button>
            </div>
            </form>
        </div>   
        </md-card>
    </div>
</md-content>