

<md-card  class="cool-shadow  list-card full" flex layout="column">
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex ng-click="expand($index)">
            <span class="md-title"><%school.user.name%></span>
            <span><%school.management%></span>

        </div>
        
        <div class="md-secondary list-card-actions" layout-padding>
            <a  ui-sref="profile.schools.report({id:school.user.id})" class="md-button md-raised">Report</a>
            <md-button class="md-icon-button" ng-click="showEdit(this,'schools',school,$index,null,null)" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete(this,school.name,'school',school.id)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    
    <div class="details expandable"  ng-class="{'expand':school.expand}">
        <div class="data-container" layout-padding>
        
           
                <div flex layout="row" layout-align="center center">
                    
                <div class="col-md-6">
                    <ul class="list-group">
                      <li class="list-group-item"><span class="strong">Email :</span> <%school.user.email%></li>
                      <li class="list-group-item"><span class="strong">EIIN number :</span> <%school.eiin_number%></li>
                      <li class="list-group-item"><span class="strong">Zilla :</span> <%school.zilla%></li>
                      <li class="list-group-item"><span class="strong">UpoZilla :</span> <%school.upozilla%></li>
                      <li class="list-group-item"><span class="strong">Phone :</span>  <%school.phone%></li>
                      <li class="list-group-item"><span class="strong">Category :</span> <%school.category%></li>
                      <li class="list-group-item"><span class="strong">Management :</span> <%school.management%></li>
                    </ul>
                   
                </div>
                </div>

                <div flex>
                  
                </div>
        
        </div>
    </div>
    
</md-card>