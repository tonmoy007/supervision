<div class="row">
    <div class="col-md-8">
     
        <ui-view>
            <!-- <home-page ng-if="nav.current_state=='home'"></home-page> -->
        </ui-view>
        
    </div>
    <sidebar ng-show="nav.current_state!='login'"></sidebar>
</div>