<header>
<loader  ng-if="menuLoading" ></loader>
    <div class="cover cool-shadow" ng-class="{profile:nav.current_state=='profile'}" ng-show="!menuLoading&&nav.current_state!=profile">
    
        <div class="search-form" >
            <form  class="md-no-momentum" method="get" accept-charset="utf-8">
             <md-input-container md-no-float class="md-block cool-shadow cool-border">
              
              <input ng-model="search_query" type="text" placeholder="Search">
              <md-icon md-svg-src="/img/accessories/search-black.svg"></md-icon>
            </md-input-container>
            </form>
            <a ui-sref="login" class="login" ng-show="!globals.currentUser" layout="row"><i  class="fa fa-sign-in"></i> <span>login</span></a>
            <a href="" ng-click="logout()" ng-show="globals.currentUser" class="login" layout="row"><i class="fa fa-user"></i>&nbsp;<span><%globals.currentUser.name%></span></a>
        </div>
        <div class="navbar-brand" ng-class="{profile:nav.current_state=='profile'}">
            <img src="/img/logo.png" alt="">
            <a ui-sref="home" class="site-title">একাডেমিক সুপারভিশন</a>
        </div>

        <div class="cover-container" ng-show="nav.current_state!='profile'">
            <div  preload src-image="{{img.src}}" ng-repeat="(key, img) in cover" class="img-div" ng-show="img.active" ng-class="{'animate-in':img.active,'animate-out':!img.active}" alt="">
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
                <li><a href="#/">হোম</a></li><!--
             --><li class="dropdown" ng-class="{open:drop[0]}"><a href="" class="dropdown-toggle" ng-click="setVisible(0)">আমাদের সম্পর্কে</a>
                    <ul class="dropdown-menu">
                        <li><a href="">সাঙ্গঠনিক কাঠামো</a></li>
                        <li><a href="">কর্মকর্তাবৃন্দ</a></li>
                        <li><a href="">কর্মচারীবৃন্দ</a></li>
                        <li><a href="">সাবেক কর্মকর্তাবৃন্দ</a></li>
                        <li><a href="">লক্ষ্য ও উদ্দেশ্য</a></li>
                    </ul>
             </li><!--
             --><li class="dropdown" ng-class="{open:drop[1]}"><a href="" class="dropdown-toggle" ng-click="setVisible(1)" >শিক্ষা অফিসের কার্যক্রম</a>
                <ul class="dropdown-menu">
                    <li class="sub-heading ">আমাদের সেবা সমুহ</li>
                    <li><a href="">মাধ্যমিক পরযায়ে শিক্ষক নিয়োগ</a></li>
                    <li><a href="">শিক্ষা প্রতিষ্ঠান পরিদর্শন</a></li>
                    <li><a href="">উপবৃত্তি বিতরন</a></li>
                    <li><a href="">বিনামূল্যে পাঠ্যপুস্তক বিতরন</a></li>
                </ul>
             </li><!--
             --><li class="dropdown" ng-class="{open:drop[2]}"><a href="" class="dropdown-toggle" ng-click="setVisible(2)">ডিজিটাল সেবা সমুহ</a>
                <ul class="dropdown-menu">
                    <li><a href="">Mobile application based attendance management</a></li>
                    <li><a href="">Digital academic supervision</a></li>
                </ul>
             </li><!--
             --><li class="dropdown" ng-class="{open:drop[3]}"><a href="" class="dropdown-toggle" ng-click="setVisible(3)">মাধ্যমিক প্রতিষ্ঠান সমূহের তালিকা</a>
                <ul class="dropdown-menu">
                    <li><a href="">স্কুল</a></li>
                    <li><a href="">কলেজ</a></li>
                    <li><a href="">মাদ্রাসা</a></li>
                </ul>
             </li><!--
             --><li class="dropdown" ng-class="{open:drop[4]}"><a href="" class="dropdown-toggle" ng-click="setVisible(4)">গ্যালারী</a>
                <ul class="dropdown-menu" >
                    <li><a href="">ভিডিও গ্যালারী</a></li>
                    <li><a href="">ফটো গ্যলারী</a></li>
                </ul>
             </li><!--
             --><li><a  ui-sref="contact">যোগাযোগ</a></li>
            </ul>
        </div>
        </nav>
    </div>
    
</header>