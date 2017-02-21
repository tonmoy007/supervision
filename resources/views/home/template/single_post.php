<div  flex layout="column" layout-gt-sm="row">
    <div flex="100" class="post__container" flex-gt-sm="70" >
        <md-content class="md-block "  >
         
            <div class="padded white cool-border"  flex layout="column" ng-if="post!=null">
                <h1 class="rgba-black-strong white-text" layout-padding><%post.title%> <small class="md-caption white-text"><%post.sub_title%></small></h1>
               <div class="meta meta--preview">
                    <span class="meta__date"><i class="fa fa-calendar-o"></i> <%getDate(post.created_at)|date%></span>
                    <span class="meta__reading-time"><i class="fa fa-user"></i> <%post.user_name%></span>
                </div>
                <span class="space1"></span>
                
            <md-card-title flex layout-padding layout="row" layout-align="start center">
                <md-card-title-media flex-gt-sm="40" flex="100" layout="row" layout-align="center">
                    <div class="md-media-sm card-media" preload src-image="<%post.featured_image%>">
                        <img  class="img-fluid" alt="">
                        <loader class="progress-loader" ></loader>
                    </div>
                </md-card-title-media>
                <md-card-title-text flex="grow">
                    <div ng-bind-html="post.content" layout-padding>
                       
                    </div>
                </md-card-title-text>
            </md-card-title>

                
           
            </div>

            <div class="padded cool-border" flex ng-if="post==null" ng-include data-src="'getView/template.not_found'" ng-init="not_found='Posts, post might be deleted'">
                
            </div>

               
                
        </md-content>


    </div>

    <div flex="100" flex-gt-sm="30">
        <sidebar></sidebar>
    </div>
</div>