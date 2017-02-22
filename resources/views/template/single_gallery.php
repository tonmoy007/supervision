<div class="gallery-image ">
    <div class="gallery-image-container ">

        <figure class="figure" preload src-image="<%image.file%>" type="<%image.type%>" ng-if="image.type=='image'">
        <md-icon  ng-click="delete(this,'content from gallery','gallery',image.id)" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/waste-bin.svg" aria-label="Close dialog"></md-icon>
           <img src="" alt="" class="img-responsive">
          <loader class="progress-loader" ></loader>
        </figure>
        
        <figure class="figure" preload src-image="<%image.file%>" type="<%image.type%>" ng-if="image.type=='video'">
            <md-icon  ng-click="delete(this,'content from gallery','gallery',image.id)" class=" md-raised file-remove-icon right cool-shadow" md-svg-src="../img/accessories/waste-bin.svg" aria-label="Close dialog"></md-icon>
           <video  type="video/mp4" controls  alt="" class="img-responsive video-gallery">
               <source ng-src="" type="" media="">
           </video>
            
        </figure>      
        
    </div>
</div>