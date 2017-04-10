   <div class="p-x-1">
   <form name="submitForm" ng-submit="submitAnswer(submitForm,form.questions,'responsibility')" >
        <table class="table table-responsive table-bordered" >
            <thead>
                <tr>
                    <th ng-repeat="(key,item) in form.header" ><%item%></th>
                    <th></th>
                </tr>
                
            </thead>
            <tbody>
                <tr ng-repeat="item in form.questions " ng-if="item.is_delete!=1">
                    <td><span><%item.serial_no%></span></td>
                    
                    <td>
                        <div class="form-input" flex layout layout-align="center center" ng-show="item.edit==0">
                                <input type="text" class="grey lighten-5 p-a-1 " required name="responsible" ng-model="item.responsible">
                        </div>
                        <span ng-if="item.edit!=0"><%item.responsible%></span>   
                    </td> 
                    <td>
                        <div class="form-input" flex layout layout-align="center center" ng-show="item.edit==0">
                                <input type="text" class="grey lighten-5 p-a-1 " required name="total_school" ng-model="item.total_school">
                        </div>
                        <span ng-if="item.edit!=0"><%item.total_school%></span>   
                    </td>  
                    <td>
                        <div class="form-input" flex layout layout-align="center center" ng-show="item.edit==0">
                                <input type="text" class="grey lighten-5 p-a-1 " required name="present_school" ng-model="item.present_school">
                        </div>
                        <span ng-if="item.edit!=0"><%item.present_school%></span>   
                    </td>
                    <td>   
                    <div flex layout layout-align="row">
                        <md-button class="md-icon-button" ng-show="item.edit==0" ng-click="edit(item)" aria-label="edit"><md-icon md-svg-src="/img/accessories/done-tick.svg"></md-icon></md-button>
                        <md-button class="md-icon-button" ng-show="item.edit!=0"  ng-click="item.edit=0" aria-label="edit"><md-icon md-svg-src="/img/accessories/edit.svg"></md-icon></md-button>
                        <md-button class="md-icon-button" ng-click="delete_cluster(item)" aria-label="delete"><md-icon md-svg-src="/img/accessories/waste-bin.svg"></md-icon></md-button>
                    </div>
                    </td>
                </tr>

            
                <tr>
                
                    <td ng-init="in_data.serial_no=getNumber(form.questions.length+1)">
                        <%in_data.serial_no%>
                    </td>
                    <td class="p-a-0 ">
                        <div class="form-input" flex layout layout-align="center center">
                            <input type="text" class="grey lighten-5 p-a-1 "  name="responsible" ng-model="in_data.responsible">
                        </div>
                    </td>
                    
                    <td class="p-a-0 ">
                        <div class="form-input" flex layout layout-align="center center">
                            <input type="text" class="grey lighten-5 p-a-1 "  name="total_school" ng-model="in_data.total_school">
                        </div>
                    </td>
                    <td class="p-a-0 ">
                        <div class="form-input" flex layout layout-align="center center">
                            <input type="text" class="grey lighten-5 p-a-1 " name="present_school"  ng-model="in_data.present_school">
                        </div>
                    </td>
                    <td class="p-a-0 p-t-1 ">
                        <div  flex layout="row" layout-align="center center">
                            <md-button class="md-icon-button" aria-label="dissmiss" ng-click="clusterSubmit(in_data,form.questions)"><md-icon md-svg-src="/img/accessories/plus-black-symbol.svg"></md-icon></md-button>
                        </div>
                    </td>
                
                </tr>
                
            </tbody>
        </table>
        <md-input-container class="form_submit "  ng-show="changed==true">
         <md-button class="md-raised bottom-fix" type="submit"><md-icon  md-svg-src="img/accessories/save-file-button.svg"></md-icon> save</md-button>
       </md-input-container>
        </form>
  
</div>