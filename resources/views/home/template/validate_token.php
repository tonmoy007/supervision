<form  class="" name="validatingForm" ng-submit="validate(user.token)" accept-charset="utf-8" >
    <md-input-container class=" md-block">
        <label>Enter the pin code sent in your email address</label>
        <input type="text" name="" ng-model="user.token">
    </md-input-container>
     <div flex class="text-center p-x-1">
         <md-button class="rgba-black-strong white-text m-l-1" aria-label="login button" type="submit">Submit</md-button>
     </div>
    <div flex class="text-center">
        <a href="" class="theme-link" ng-click="askToken(user.email)">resend</a>
    </div>
</form>
            