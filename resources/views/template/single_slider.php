
<md-card  class="cool-shadow cool-border list-card full" flex layout="column" >
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex>
            <span><%slide.url%></span>
        </div>
        
        <div class="md-secondary list-card-actions" layout-padding>
            
            <md-button class="md-icon-button" ng-click="expand($index,'slider',slide)" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete('slide',$index,this)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    <md-divider></md-divider>
    <div class="details expandable"  ng-class="{'expand':slide.expand}">
        <div class="data-container">
            <div class="row">
                slide
            </div>
        </div>
    </div>
    
</md-card>