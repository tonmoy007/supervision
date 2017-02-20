<div flex layout-gt-sm="row" layout="column">
    <div flex="100" flex-gt-sm="70" class="p-x-1">
        
    <box-ticker></box-ticker>

    <md-content class="md-block " ng-if="globals.current_state.current.name=='home'">
        <div class="padded white cool-border"  flex layout="column">
            <h3 class="rgba-black-strong white-text" layout-padding>সাধারণ তথ্য</h3>
            <span class="space1"></span>
            <p class="text-justify" layout-padding>
                উপজেলা শিক্ষা অফিসারের কার্যালয়, প্রাথমিক শিক্ষা অধিদপ্তরের আওতাধীন একটি প্রতিষ্ঠান ‘‘ উপজেলা শিক্ষা অফিস’’। অত্র অফিসে ১ জন উপজেলা শিক্ষা অফিসার, ৭ জন সহকারী উপজেলা শিক্ষা অফিসার, ১ জন উচ্চমান সহকারী, ৩ জন অফিস সহকারী কাম কম্পিউটার অপারেটর, ১ জন হিসাব সহকারী, ১ জন এম.এল.এস.এস, এর পদ রয়েছে। তাছাড়া সরকারী প্রাথমিক বিদ্যালয়ে  ১৬৬টি প্রধান শিক্ষক ও ৮৩৫ টি সহকারী শিক্ষকের পদ রয়েছে। ১৬৬টি সরকারী, ৮৮টি কেজি প্রাথমিক বিদ্যালয় রয়েছে।        উপজেলা শিক্ষা অফিসার, ৩ জন সহকারী উপজেলা শিক্ষা অফিসার, ১ জন অফিস সহকারী, ১৬৬ জন প্রধান শিক্ষক, ৭১৫ জন সহকারী শিক্ষক কর্মরত আছেন।
            </p>
        </div>

        <span class="space1"></span>
        <div class="padded white cool-border"  flex layout="column">
            <h3 class="rgba-black-strong white-text" layout-padding>সাধারণ তথ্য</h3>
            <span class="space1"></span>
            <p class="text-justify" layout-padding>
                উপজেলা শিক্ষা অফিসারের কার্যালয়, প্রাথমিক শিক্ষা অধিদপ্তরের আওতাধীন একটি প্রতিষ্ঠান ‘‘ উপজেলা শিক্ষা অফিস’’। অত্র অফিসে ১ জন উপজেলা শিক্ষা অফিসার, ৭ জন সহকারী উপজেলা শিক্ষা অফিসার, ১ জন উচ্চমান সহকারী, ৩ জন অফিস সহকারী কাম কম্পিউটার অপারেটর, ১ জন হিসাব সহকারী, ১ জন এম.এল.এস.এস, এর পদ রয়েছে। তাছাড়া সরকারী প্রাথমিক বিদ্যালয়ে  ১৬৬টি প্রধান শিক্ষক ও ৮৩৫ টি সহকারী শিক্ষকের পদ রয়েছে। ১৬৬টি সরকারী, ৮৮টি কেজি প্রাথমিক বিদ্যালয় রয়েছে।        উপজেলা শিক্ষা অফিসার, ৩ জন সহকারী উপজেলা শিক্ষা অফিসার, ১ জন অফিস সহকারী, ১৬৬ জন প্রধান শিক্ষক, ৭১৫ জন সহকারী শিক্ষক কর্মরত আছেন।
            </p>
        </div>
        
    </md-content>
    <ui-view></ui-view>
    </div>
    <div flex="100" flex-gt-sm="30">
        <sidebar ng-if="globals.current_state.current.name=='home'"></sidebar>
    </div>

</div>