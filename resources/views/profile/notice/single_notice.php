

<md-card  class="cool-shadow  list-card full" flex layout="column">
    <div class="list-card-contents" flex layout="column" layout-gt-sm="row">
      <span class="file_icon p-x-2" flex="nogrow" layout="row" layout-align="center center">
          <md-icon md-svg-src="/img/accessories/notice.svg"></md-icon>
        </span>
        
        <div flex class="list-card-details" layout-padding flex ng-click="expand($index)" layout="column">
            <span class="md-title"><%notice.title%></span>
            <span><%notice.description%></span>
            <span class="md-caption">last modified <%getDate(notice.updated_at)|date%></span>
        </div>
        <span class="file_icon p-x-2" flex="nogrow" layout="row" layout-align="center center">
          <md-button class="md-icon-button" aria-label="download" ng-click="download(notice.notice_file)"><md-icon md-svg-src="/img/accessories/folder.svg"></md-icon></md-button>
        </span>

        <div class="md-secondary list-card-actions" layout-padding ng-if="globals.currentUser.role=='admin'" layout="row" layout-align="center center">
            
            <md-button class="md-icon-button" ng-click="showEdit(this,'notices',notice,$index,null,null)" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
            <md-button class="md-icon-button" ng-click="delete(this,notice.title,'notice',notice.id)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
        </div>
          
    </div>
    
    
</md-card>