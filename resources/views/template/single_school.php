

<md-card  class="cool-shadow cool-border list-card full" flex layout="column">
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex ng-click="expand($index)">
            <span class="title"><%school.name%></span>
            <span><%school.management%></span>
        </div>
        
        <div class="md-secondary list-card-actions" layout-padding>
            
            <md-button class="md-icon-button" ng-click="showEdit(school,$index,this)" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete('school',$index,this)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    
    <div class="details expandable"  ng-class="{'expand':school.expand}">
        <div class="data-container">
        <md-divider></md-divider>
            <div class="row">
                <div class="col-md-6 title"> 
                    <h3 class="rgba-black-strong white-text" ><%school.name%></h3>
                </div>
                <div class="col-md-6">
                    <span class="col-md-12"><%school.email%></span>
                    <span class="col-md-12"><%school.eiin_number%></span>
                    <span class="col-md-12"><%school.zilla%></span>
                    <span class="col-md-12"><%school.phone%></span>
                    <span class="col-md-12"><%school.upozilla%></span>
                    <span class="col-md-12"><%school.category%></span>
                    <span class="col-md-12"><%school.management%></span> 
                </div>
            </div>
        </div>
    </div>
    
</md-card>