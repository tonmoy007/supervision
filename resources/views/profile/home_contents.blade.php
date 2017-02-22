
<div class="inner-page">
      <div class="inner-page-content" >
        <section flex class="grid " layout-align="center center" id="grid" ng-class="{'small':nav.state.length>2,'animate-in':nav.state.length==2}">
            <div class="grid-container inner"  ng-repeat="content in home_contents track by $index">
               <md-card class="grid__item grid-item-inner" ng-class="{'grid__item--animate':content.loading,'active':$index==nav.profile_index}" id="innerGrid<%$index%>"  ng-click="open(content,$index)" ui-sref-active="active" sref-opts="{reload:true, notify:true}">
                    
                        <span class=" "><md-icon md-svg-src="<%content.icon%>"></md-icon> <%content.title%></span>

                   
                </md-card> 
            </div>
            
        </section>
        <ui-view></ui-view>
    </div>
</div>
