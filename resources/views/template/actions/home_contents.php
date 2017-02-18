<div ng-show="nav.state.length>2">
    <div ng-show="nav.state[2]=='posts'">
        <actions data-title="'Post'" data-type="'posts'"></actions>
    </div>
    <div ng-show="nav.state[2]=='employees'">
        <actions data-title="'Employee'" data-type="'employees'"></actions>
    </div>
    <div ng-show="nav.state[2]=='links'">
        <actions data-title="'Link'" data-type="'links'"></actions>
    </div>
    <div ng-show="nav.state[2]=='gallery'">
        <actions data-title="'Add images/videos'" data-type="'gallery'"></actions>
    </div>
    <div ng-show="nav.state[2]=='slider'">
        <actions data-title="'Add images/videos'" data-type="'slider'"></actions>
    </div>
</div>