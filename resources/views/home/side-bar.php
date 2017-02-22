<div flex="auto">
    <div layout="column" class=" sidebar p-x-1">
    
    <div class="space1">
        
    </div>
    <!--/.Panel-->
    <md-card  class="cool-shadow" md-theme-watch>
        <div class="p-a-1">
        <md-card-title-media>
            <div class="md-media-sm card-media">
                <img ng-src="<%bani[0].featured_image%>" class="img-fluid" alt="">
            </div>
          </md-card-title-media>
          <md-card-title-text>
            <span class="md-headline"><%bani[0].title%></span>
            <span class="md-caption"><%bani[0].sub_title%></span>
            <p class="text-justify" ng-bind-html="bani[0].content"></p>
          </md-card-title-text>
          
        </div >
        <!-- <md-card-actions layout="row" layout-align="end center">
          <md-button>Action 1</md-button>
          <md-button>Action 2</md-button>
        </md-card-actions> -->
      </md-card>
     <div  class="space1">
                
      </div>  

<news-ticker news="khobor" ng-if="khobor.length"></news-ticker>

 <div  class="space1">
                
      </div>  
      <!--Panel-->
            
   <!--  <div class="card card-block " layout-padding>
        <h4 class="card-title " >Panel title</h4>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="card-link md-button">Card link</a>
        <a href="#" class="card-link md-button">Another link</a>
    </div> -->
    <!--/.Panel-->

<!-- <div class="space1">
    
</div> -->

  
    <!--Panel-->
    <div class="card m-b-1" ng-repeat="(key,links) in sidebar.links">
        <div class="card-header cool-shadow rgba-black-strong white-text" layout-padding>
            <%key%>
        </div>
        <div class="card-block" layout-padding>
            <ul class="data-list">
                <li ng-repeat="link in links track by $index"><a href="<%link.url%>"><%link.name%></a></li>
                
            </ul>
        </div>
    </div>
    <!--/.Panel-->


    <!--Panel-->


    










    </div>
</div>


