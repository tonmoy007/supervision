<div  flex layout="column" layout-gt-sm="row">
    <div flex="100" class="post__container" flex-gt-sm="70" >
        <md-content class="md-block ">
         
            <div class="padded  white cool-border"  flex layout="column">
                
               <h3 flex class="p-x-2"><%type%></h3>
                <md-list >
                <md-divider></md-divider>
                    <div ng-repeat="school in schools" ng-include data-src="'getView/home.template.single_school'">
                        
                    </div>
                    <md-list-item ng-if="!schools.length" ng-include data-src="'getView/template.not_found'" ng-init="not_found='School'"></md-list-item>
                </md-list> 
           
            </div>

               
                
        </md-content>


    </div>

    <div flex="100" flex-gt-sm="30">
        <sidebar></sidebar>
    </div>
</div>