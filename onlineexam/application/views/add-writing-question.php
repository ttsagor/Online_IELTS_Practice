

      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Passage will be shown same designed here
                <small></small>
              </h3>
              <!-- tools box 
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
               tools -->
            </div>
            <!-- /.box-header -->
            <form method='post' action='<?php echo base_url(); ?>index.php/AdminPanel/writingquestionaddpassagesubmit'>
            <div class="box-body pad">
              
                    <textarea id="passage" name="passage" rows="10" cols="80"> 
                              <?php 
                                if(isset($passage))
                                {
                                    echo $passage;
                                }
                               ?>             
                    </textarea
                    
              
            </div>
            <input type='hidden' name='tid' value='<?php echo $tid; ?>'>
            <input type='hidden' name='sec' value='<?php echo $sec; ?>'>
            
            <button type="submit" class="btn btn-primary" style='float:right'>Next</button>
            </form>
          </div>
          <!-- /.box -->

          
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->

    <!-- /.content -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url(); ?>assets/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('passage')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
</body>
</html>
