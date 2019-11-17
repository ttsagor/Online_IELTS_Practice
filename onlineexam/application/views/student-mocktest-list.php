
<div class="box">
    <div class="box-header">
      <h3 class="box-title">All Mock Test List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Serial</th>
          <th>Mocktest name</th>
          <th>Status</th>
          <th>Created Date</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $count=1;
            foreach ($data as &$d) 
            {
                echo "<tr>
                      <td>$count</td>
                      <td>".$d->mt_name."</td>
                      <td>".$d->category."</td>
                      <td>".$d->last_update_date."</td>
                      <td><a href='".base_url()."index.php/Exampanel/createExam?tid=".$d->mt_id."'>Take Test</a></td>
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
          

