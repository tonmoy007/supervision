<div class="inner">
    
    <div flex layout="row" layout-align="center center">
    <div flex="nogrow">
        <md-button class="md-raised" ng-click="cancelsubmit()">Cancel</md-button>
    </div>
    <loader class="form-loader" flex="auto"></loader> 
    <div flex="nogrow" layout-align="center center">
      <span class="strong form-progress-counter" ng-if="form.progress"><% form.progress%> %</span>
    </div>
    </div> 
</div>