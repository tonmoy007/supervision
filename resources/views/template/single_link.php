
<md-card  class="cool-shadow  list-card full" flex layout="column" >
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex ng-click="expand($index,'links',link,1,category)">
            <span class="md-title"><%link.name%></span>
            <span class="md-caption md-caption"><%link.url%></span>
        </div>
        
        <div class="md-secondary list-card-actions" layout-padding>
            
            <md-button class="md-icon-button" ng-click="showEdit(this,'links',link,$index,category,'link')" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete(this,'this link','link',link.id)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    
    <div class="details expandable"  ng-class="{'expand':link.edit_expand||link.expand}">

        <div class="data-container">
        <md-divider></md-divider>
            <div class="row">
               <div class="col-md-12" ng-include data-src="'getView/profile.home_contents.links.edit'">
                   
               </div>
            </div>
        </div>
    </div>
    
</md-card>