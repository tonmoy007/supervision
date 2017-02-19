
<md-card  class="cool-shadow  list-card full" flex layout="column" >
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex ng-click="expand($index,employee.name,employee,1,type)">
          <img ng-src="<%employee.image%>" alt="<%employee.name%>" ng-if="employee.image" class="md-avatar">
            <span class="md-title"><%employee.name%></span>
            <span class="md-subtitle"><%employee.designation%></span>
            <span class="md-chip"><%employee.type%></span>
        </div>
        
        <div class="md-secondary list-card-actions" layout-padding>
            
            <md-button class="md-icon-button" ng-click="showEdit(employee,$index,this)" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete(this,'link','employee',employee.id)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    <div class="details expandable"  ng-class="{'expand':employee.expand}">
        <div class="data-container">
            <div class="row">
                <div class="col-md-12">
                    <div layout-padding>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</md-card>