<div class="white cool-border"  layout-padding>
    <ul vertical-ticker class="tickers">
          <li ng-repeat="item in myTicker" class="bq-primary">
            <blockquote class="blockquote {{item.class}}">
                <p class="bq-title">{{item.title}}</p>
                <p ng-bind-html="item.content"></p>
            </blockquote>
          </li>
</ul>
</div>