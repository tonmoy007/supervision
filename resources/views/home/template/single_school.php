<md-list-item class="md-2-line " >
    <div flex="30" class="md-meadia" preload layout-padding src-image="<%school.image%>">
        <img src="" class="img-fluid img-rounded" alt="">
        <loader class="progress-loader"></loader>
    </div>
    <div class=" m-a-0" flex="grow" layout-padding layout="column">
        <span class="md-title" flex><%school.user.name%></span>
        <span class="md-subhead"><%school.user.email%></span>
        <span class="md-caption"><%school.type%>|<%school.management%></span>
        <span class="md-caption"><%school.upozilla%>,<%school.zilla%></span>
    </div>
    <md-divider ng-if="!$last"></md-divider>
</md-list-item>