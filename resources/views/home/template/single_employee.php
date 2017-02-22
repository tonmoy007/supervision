<md-list-item class="md-2-line " >
    <div flex="30" class="md-meadia" preload layout-padding src-image="<%employee.image%>">
        <img src="" class="img-fluid img-rounded" alt="">
        <loader class="progress-loader"></loader>
    </div>
    <div class=" m-a-0" flex="grow" layout-padding layout="column">
        <span class="md-title" flex><%employee.name%></span>
        <span class="md-subhead"><%employee.rank%></span>
    </div>
    <md-divider ng-if="!$last"></md-divider>
</md-list-item>