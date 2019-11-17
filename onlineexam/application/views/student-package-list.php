<div class="box">
    <div class="box-header">
      <h3 class="box-title">All Packages</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Serial</th>
          <th>Package name</th>
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
                      <td>".$d->post_title."</td>
                      <td>".$d->post_status."</td>
                      <td>".$d->post_date."</td>
                      <td><a href='".base_url()."index.php/Exampanel/studentmocklist?id=".$d->ID."'>Take Test</a></td>
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
          

