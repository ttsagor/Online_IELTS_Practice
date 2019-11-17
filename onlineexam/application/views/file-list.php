<style>
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">Upload file</button>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">All s</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Serial</th>
          <th>File Name</th>
          <th>Preview</th>
          <th>Size</th>
          <th>Created Date</th>
          <th>Copy/Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $count=1;
            foreach ($data as &$d) 
            {
                echo "<tr>
                      <td>$count</td>
                      <td>".$d->fl_name."</td><td>";
                      
                      if( $d->fl_type=="audio/mpeg" )
                      {
                          echo "<audio controls>
                                  <source src='".$d->fl_path."' type='audio/mpeg'>
                                   Your browser does not support the audio element.
                                </audio>";
                      }
                      else
                      {
                         echo "<img src='".$d->fl_path."' rel='popover' data-img='".$d->fl_path."' width='250'/>";
                      }
                      
                      echo "<td>".doubleval($d->fl_size/1000)." MB</td>
                      <td>".$d->last_update."</td>
                      <td>
                        <a class='btn btn-default' aria-label='Settings' onclick='return copytoclip(\"img_".$d->fl_id."\")'>
                            <i class='fa fa-files-o'></i> 
                        </a>
                        <a class='btn btn-danger' aria-label='Delete' href='".base_url()."/index.php/AdminPanel/deletefile?fl_id=".$d->fl_id."'>
                          <i class='fa fa-trash-o' aria-hidden='true'></i>
                        </a>
                        <input type='text' value='".$d->fl_path."' id='img_".$d->fl_id."' style='display:none;'>
                      </td>
                    </tr>";
                $count++;
            }
            
        ?>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  
  <!-- Modal -->
        <div id="uploadModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">File upload form</h4>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method='post' action='<?php echo base_url()."/index.php/AdminPanel/filesubmit" ?>' enctype="multipart/form-data" id='frm'>
                        File Name <input type='text' name='file_name' class="form-control" required /> <br/>
                        Select file : <input type='file' name='file' id='file' class='form-control' required /><br>
                        <input type='hidden' name='rurl' value='<?php echo base_url()."/index.php/AdminPanel/allfilelist" ?>'>
                        <input type='submit' class='btn btn-info' value='Upload' id='upload'>
                    </form>

                    <!-- Preview-->
                    <div id='preview'></div>
                </div>
                
            </div>

          </div>
        </div>
        <div id="snackbar">Path has been copied into clipboard</div>
        <script>
            function copytoclip(id)
            {
                var copyText = document.getElementById(id);
                copyText.style.display = 'block';
                copyText.select();
                document.execCommand("copy");
                copyText.style.display = 'none';
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                return false;
            }
        </script>