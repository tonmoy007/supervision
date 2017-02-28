

<md-card  class="cool-shadow  list-card full" flex layout="column">
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex ng-click="expand($index,'attendance')" layout="row">
            <span class="md-title" flex><%getDate(item.present_date)|date%></span>
            <span flex>Total: <%item.total_students%></span>
            <span flex>Present: <%item.present_students%></span>
            <span flex>Absent: <%item.absent_students%></span>
        </div>
        
          
    </div>
    
    <div class="details expandable"  ng-class="{'expand':item.expand}">
        <div class="data-container" layout-padding>
        
           
                <div flex layout="row" layout-align="center center">
                    
                <div class="col-md-12">
                    <ul class="list-group">
                      <li class="p-a-1" ng-repeat="class in item.classes" flex layout="row">
                      <span class="strong" flex>Class : <%class.class_name%></span> 
                      <span flex><%getDate(class.present_date)|date%></span> 
                      <span flex>total: <%class.total_students%></span> 
                      <span flex>present: <%class.present_students%></span>
                      <span flex>absent: <%class.absent_students%></span>
                      
                      </li>
                      
                    </ul>
                   
                </div>
                </div>
        
        </div>
    </div>
    
</md-card>