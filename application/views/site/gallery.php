
<section class="gallery">
    <div class="container">    
        <div class="row">
        </div>
        
        <ul class="row">
            <li class="col-md-4 col-sm-4 col-xs-4">
                <img class="img-responsive" src="<?php echo base_url();?>assets/img/g-1.png">
            </li>
            <li class="col-md-4 col-sm-4 col-xs-4">
                <img class="img-responsive" src="<?php echo base_url();?>assets/img/g-2.png">
            </li>
            <li class="col-md-4 col-sm-4 col-xs-4">
                <img class="img-responsive" src="<?php echo base_url();?>assets/img/g-3.png">
            </li>
            <li class="col-md-4 col-sm-4 col-xs-4">
                <img class="img-responsive" src="<?php echo base_url();?>assets/img/g-4.png">
            </li>
            <li class="col-md-4 col-sm-4 col-xs-4">
                <img class="img-responsive" src="<?php echo base_url();?>assets/img/g-5.png">
            </li>
            <li class="col-md-4 col-sm-4 col-xs-4">
                <img class="img-responsive" src="<?php echo base_url();?>assets/img/g-6.png">
            </li>
            
          </ul>             
    </div> <!-- /container -->
    </section>  
    
     
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="gallery-modal modal-dialog">
        <div class="g-content modal-content">         
          <div class="g-modal modal-body">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
 <!--gallery end-->
 <?php $this->widget->beginBlock('scripts');?>
<script src="<?php echo base_url(); ?>assets/js/photo-gallery.js"></script>
 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php $this->widget->endBlock(); ?>