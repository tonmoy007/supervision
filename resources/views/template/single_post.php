
<md-card  class="cool-shadow  list-card full" flex layout="column" >
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      
        <div flex class="list-card-details" layout-padding flex ng-click="expand($index,'posts',post,1,category)">
        <img ng-src="<%post.featured_image%>" alt="<%post.title%>" ng-if="post.featured_image" class="md-avatar">
            <span class="md-title"><%post.title%></span>
            <span class="md-sub-title"><%post.sub_title%></span>
            <span class="meta meta__date"><%post.author%></span>
        </div>
        
        <div class="md-secondary list-card-actions" layout-padding>
            
            <md-button class="md-icon-button" ng-click="showEdit(this,'posts',post,$index,category,'post')" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete(this,'this post','post',post.id)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    
    <div class="details expandable"  ng-class="{'expand':post.expand}">
    
        <div class="data-container">
        <md-divider></md-divider>
            <div class="row">
                <div class="col-md-12">
                    <span class="col-md-12 title"> <h3 class="meta__info" layout-padding><%post.title%></h3></span>
                    <div class="col-md-12">
                        <div class=" meta meta--preview " ng-bind-html="post.content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</md-card>