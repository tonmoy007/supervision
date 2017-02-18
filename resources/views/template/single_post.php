
<md-card  class="cool-shadow cool-border list-card full" flex layout="column" >
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex ng-click="expand($index,'posts',post,1,category)">
            <span class="md-title"><%post.title%></span>
            <span class="md-sub-title"><%post.subtitle%></span>
            <span class="meta meta__date"><%post.author%></span>
        </div>
        
        <div class="md-secondary list-card-actions" layout-padding>
            
            <md-button class="md-icon-button" ng-click="showEdit(post,$index,this)" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete('post',$index,this)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    
    <div class="details expandable"  ng-class="{'expand':post.expand}">
    <md-divider></md-divider>
        <div class="data-container">
            <div class="row">
                <div class="col-md-12">
                    <span class="col-md-12 title"> <h3 class="meta__info" layout-padding><%post.title%></h3></span>
                    <span class=" meta meta--preview " ng-bind-html="post.content"></span>
                </div>
            </div>
        </div>
    </div>
    
</md-card>