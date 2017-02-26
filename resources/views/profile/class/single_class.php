

<md-card  class="cool-shadow  list-card full" flex layout="column">
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex >
            <span class="md-title"><%class.name%></span>
            <span class="md-subtitle"><span>Total student</span> <span class="badge"><%class.total_students%></span></span>
        </div>
        
        <div class="md-secondary list-card-actions" layout-padding>
            
            <md-button class="md-icon-button" ng-click="showEdit(this,'classes',class,$index)" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete(this,class.name,'class',class.id)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    
    
    
</md-card>