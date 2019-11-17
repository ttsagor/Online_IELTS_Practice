
<div class="box">
    <div class="box-header">
      <h3 class="box-title">
      <?php 
        echo $data['package']->post_title;
      ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form role="form" method='post' action='<?php echo base_url(); ?>index.php/AdminPanel/addmocktesttopackagesubmit'>
            <div class="box-body" style='width:50%;margin:auto;'>
        		<div class="form-group">
                  <label for="exampleInputEmail1">Select Mock Test</label>
                  <select class="form-control" name="mocktest_id" required>
                     <?php 
                        foreach ($data['mt'] as &$d) 
                        {
                            echo "<option value='".$d->mt_id."'>".$d->mt_name."</option>";
                        }
                     ?> 
        		  </select>		  
                </div>
        		<div class="form-group" >
        		    <input type='hidden' name='package_id' value='<?php echo $data['package']->ID; ?>'>
        		 <button type="submit" class="btn btn-primary">Add</button>			
        		</div>
            </div>
        </form>    
        
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Serial</th>
          <th>Mocktest name</th>
          <th>Status</th>
          <th>Created Date</th>
          <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $count=1;
            $mpt = $data['mpt'];
            foreach ($mpt as &$d) 
            {
                echo "<tr>
                      <td>$count</td>
                      <td>".$d->mt_name."</td>
                      <td>".$d->category."</td>
                      <td>".$d->update_date."</td>
                      <td ><a href='".base_url()."index.php/AdminPanel/addmocktesttopackageremove?mocktest_id=".$d->mt_id."&package_id=".$data['package']->ID."' class='btn btn-danger' aria-label='Delete'>Remove</a></td>
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
          

