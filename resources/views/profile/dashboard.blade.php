

<div flex layout-gt-sm="row" layout="column" ng-show="nav.current_state=='profile'">
    <div flex="100"  class="p-x-0">
        
    <div layout="row" layout-align="start center" ng-show="nav.state.length>1" class="page-nav">
        <span flex="nogrow">
            <md-button class="md-icon-button" aria-label="back button" ng-click="goback()"><md-icon md-svg-src="/img/accessories/back.svg" ></md-icon></md-button>
        </span>
        <span class="page-title" ng-if="nav.title" ><%nav.title%></span>
        
        <div lauout="row" flex ng-include data-src="nav.item.action_template"  layout-align="end center" onload="createactions()">
            
        </div>
        
    </div>
    <div flex layout="row" layout-align="center center" class="top-loader" ng-show="loadingData" >
        <md-icon md-svg-src="/img/accessories/loader.svg"></md-icon>
    </div>

    <md-content class="md-block dashbord_content" >
        <section flex class="grid" id="grid" ng-class="{'animate-out':nav.current_state_secendary,'animate-in':!nav.current_state_secendary}">
            <div class="grid-container" flex-gt-sm="25" layout-align="center center" ng-repeat="item in menu track by $index" ng-if="item.role=='all'||item.role==globals.currentUser.role">
               <md-card class="grid__item" ng-class="{'grid__item--animate':item.loading}" id="grid<%$index%>" layout="column" layout-align="center center" flex  ng-click="open(item,$index)">
                    <div class="grid__item__container">
                        <div class="grid__item__block">
                            <md-icon md-svg-src="<%item.icon%>"></md-icon>
                    <span  class="title title--preview"><%item.title%></span>
                <span class="badge bg-danger sticky cool-shadow" ng-if="item.name=='profile.notice'&&globals.new_notice.new"><%globals.new_notice.notice_count%></span>
                        </div>

                    </div>
                    
                   
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