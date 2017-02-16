<div flex layout-gt-sm="row" layout="column">
    <div flex="100"  class="p-x-1">
        
    <div layout="row" layout-align="start center" ng-show="nav.current_state_secendary" class="page-nav">
        <span flex="nogrow">
            <md-button class="md-icon-button" aria-label="back button" ui-sref="<%nav.current_state%>"><md-icon md-svg-src="/img/accessories/back.svg" ></md-icon></md-button>
        </span>
        <span class="page-title"  ><%nav.item.title%></span>

        <div lauout="row" flex ng-include data-src="nav.item.action_template"  layout-align="end center" onload="createactions()">
            
        </div>
        
    </div>
    <div flex layout="row" layout-align="end center" class="top-loader" ng-show="loadingData" >
        <md-icon md-svg-src="/img/accessories/loader.svg"></md-icon>
    </div>
    <md-content class="md-block dashbord_content" >
        <section flex class="grid" id="grid" ng-class="{'animate-out':nav.current_state_secendary,'animate-in':!nav.current_state_secendary}">
            <div class="grid-container" flex-gt-sm="25" ng-repeat="item in menu track by $index">
               <md-card class="grid__item" ng-class="{'grid__item--animate':item.loading}" id="grid<%$index%>"  ng-click="open(item,$index)">
                    <h2 class="title title--preview"><%item.title%></h2>
                    <div class="loader"></div>
                   
                </md-card> 
            </div>
            
        </section>

        <section class="contents" id="content"  ng-class="{'content--show':nav.current_state_secendary}">
            <div class="scroll-wrap">
                <article class="content__item" id="content_item" ng-class="{'content__item--show':nav.current_state_secendary}">
                    <ui-view></ui-view>
                </article>
            </div>
        </section>
    </md-content>
    </div>
    

</div>