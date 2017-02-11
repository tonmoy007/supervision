<div ng-controller="tickerCtrl" class="ticker-container cool-shadow">
<div class="ticker ">
  <div ng-class="{moving: moving}" class="viewport">
    <div ng-repeat="box in boxes" class="box cool-border grey">
        <a href="<%box.url%>">
            <img ng-src="<%box.img%>" alt="">
            <span><% box.title %></span>
        </a>
    </div>
  </div>
</div>
</div>