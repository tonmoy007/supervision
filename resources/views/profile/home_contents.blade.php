
<div class="inner-page">
      <div class="inner-page-content" >
        <section flex class="grid" id="grid" ng-class="{'animate-out':nav.state.length==3,'animate-in':nav.state.length!=2}">
            <div class="grid-container" flex-gt-sm="25" ng-repeat="content in home_contents track by $index">
               <md-card class="grid__item" ng-class="{'grid__item--animate':content.loading}" id="innerGrid<%$index%>"  ng-click="open(content,$index)">
                    <h2 class="title title--preview"><%content.title%></h2>
                </md-card> 
            </div>
            
        </section>
        <ui-view></ui-view>
    </div>
</div>
