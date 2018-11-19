<section class="gallery">
    <div class="container">    
        <div class="row"></div>
<!--***********Blog Start**********-->        
<section id="blog" class="blogs text-center">
    <div class="container">
        <div class="blog-head">
            <h2>Blog</h2>
        </div>
        <!--end ts-title-->
        <div class="row">
           <?php if(!empty($allblog)){
                    foreach ($allblog as $blog) {
            ?>
            <div class="col-md-4">
                <a href="https://medium.com/@revive.auto/<?php echo $blog['slug'] ?>" target="_blank"><img src="<?php echo CRM_BASE_URL; ?>uploads/site/<?php echo $blog['image']; ?>" width="300px" class="mb-5" alt="">
                    <h4 class="mb-3"><?php echo $blog['title']; ?></h4></a>
                    <!-- <p><a href="https://medium.com/@revive.auto/how-to-get-rid-of-the-stubborn-road-paint-from-your-car-3f7828dd3df5" target="_blank">read full article</a>
                    </p> -->
            </div>
        <?php } }?>
        
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--***********Blog end***********--> 
 </div>
</section>