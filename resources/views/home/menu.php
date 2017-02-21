<header>
<loader  ng-show="!coverLoaded" class="fix_loader" ></loader>
    <div class="cover cool-shadow" ng-class="{profile:nav.current_state=='profile'}" ng-show="coverLoaded&&nav.current_state!=profile">
   
        <div class="search-form" >
            <form  class="md-no-momentum" method="get" accept-charset="utf-8">
             <md-input-container md-no-float class="md-block cool-shadow cool-border">
              
              <input ng-model="search_query" type="text" placeholder="Search">
              <md-icon md-svg-src="/img/accessories/search-black.svg"></md-icon>
            </md-input-container>
            </form>
            <a ui-sref="login" class="login" ng-show="!globals.currentUser" layout="row"><i  class="fa fa-sign-in"></i> <span>login</span></a>
            <li class="dropdown right-top" ng-class="{open:drop[9]}" ng-show="globals.currentUser">
            <a href="" class="dropdown-toggle cool-shadow" ng-click="setVisible(9)"><%globals.currentUser.name%></a>
                    <ul class="dropdown-menu">
                        <li><a ui-sref="profile"><i class="fa fa-home"></i> dashboard</a></li>
                        <li><a href="" ng-click="logout()"><i class="fa fa-sign-out"></i> logout</a></li>
                    </ul>
             </li>
        </div>
        <div class="navbar-brand" ng-class="{profile:nav.current_state=='profile'}">
            <img src="/img/logo.png" alt="">
            <a ui-sref="home" class="site-title"><%site.title%></a>
        </div>

        <div class="cover-container" ng-show="nav.current_state!='profile'">
            <div  preload src-image="<%img.image%>" data-type="background" ng-repeat="(key, img) in cover" class="img-div" ng-show="img.active" ng-class="{'animate-in':img.active,'animate-out':!img.active}" alt="">
              <loader class="progress-loader" ></loader>
            </div>
        </div>
        <nav class="detail-nav no-shadow" ng-show="nav.current_state!='profile'">
            <div id="nav-icon" ng-class="{open:showMenu}" ng-click="showMenu=!showMenu">
              <span></span>
              <span></span>
              <span></span>
            </div>
        <div ng-cloak class="main-nav trans3" ng-class="{open:showMenu}" >
    
            <ul class="nav-bar navbar nav " >
                <li ng-class="{dropdown:tab.length,'open':drop[$index]}"  ng-repeat="(index, tab) in home_menu track by $index"><a ng-show="!tab.length"  href="<%tab.url%>"><%tab.parent%></a>
                <a href="" class="dropdown-toggle" ng-show="tab.length" ng-click="setVisible($index)"><%tab[0].parent%></a>
                <ul class="dropdown-menu" ng-if="tab.length">
                    <li ng-repeat="(key,item) in tab" ><a href="<%item.url%>"><%item.name%></a></li>
                        
                </ul>
                  
                </li>
            </ul>
        </div>
        </nav>
    </div>
    
</header>