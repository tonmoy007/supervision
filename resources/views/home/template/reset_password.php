<form  class="" name="validatingForm" ng-submit="changePassword(user.password,user.id)" accept-charset="utf-8" >
<%user.id%>
    <md-input-container class="md-block">
        <label>New Password</label><input type="password" md-minlength="4" md-maxlength="20" ng-model="user.password" name="password" required>
        <div ng-messages="validatingForm.password.$error" role="alert">
            <div ng-message="required">
              password is required
            </div>
            <div ng-message="md-minlength">
              password must be atleast 4 character long
            </div>
            <div ng-message="md-maxlength">
              keep the password less then 20 character
            </div>
          </div>
    </md-input-container>
    <md-input-container class="md-block" >
        <label>Confirm Password</label><input type="password" equal-to="user.password" ng-model="user.confirmPassword" name="confirm" required>
        <div ng-messages="validatingForm.confirm.$error">
            <div ng-message="required">
                You need to confirm your password
            </div>
            <div ng-message="equalTo">
                Password doesn't match
            </div>
            <%validatingForm.confirm%>
        </div>
    </md-input-container>
   <div flex class="text-center p-x-1">
         <md-button class="rgba-black-strong white-text m-l-1" aria-label="login button" type="submit">Submit</md-button>
     </div>
    <div flex>
        <a href="" class="theme-link" ng-click="askToken(user.email)">resend</a>
    </div>
</form>