<div class="page-action" id="actions" ng-controller="actionsCtrl">
   <div class="page-action-container text-right" >
        <div  class="search-form full with-padding" ng-class="{'search-expand':search_expand}">
           <form  class="md-no-momentum"  accept-charset="utf-8">
             <md-input-container md-no-float class="md-block">
              
              <input ng-model="actions.search_query" ng-change="$parent.search(actions.search_query)" search-module type="text" placeholder="Search school">
              <md-icon ng-click="toggleSearch()" md-svg-src="/img/accessories/search-black.svg"></md-icon>
            </md-input-container>
            
            </form>
        </div>
        
        
        <div class="page-action-buttons" ng-if="globals.currentUser.role=='admin'">
          <md-button ng-click="addNew(this,type)" class="md-icon-button" aria-label="add new"><md-icon md-svg-src="/img/accessories/plus-black-symbol.svg" ></md-icon> <md-tooltip>
            Add new Notice
          </md-tooltip></md-button>
        </div>
   </div>
</div>