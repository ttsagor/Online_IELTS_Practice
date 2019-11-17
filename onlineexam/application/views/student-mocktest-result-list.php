
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
          <th>Category</th>
          <th>Overall Band</th>
          <th>Date</th>
          <th>Details</th>
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
                      <td>".$d->overall_brand."</td>
                      <td>".$d->end_date_time."</td>
                      <td><a href='".base_url()."index.php/Exampanel/ieltsexam?tid=".$d->ex_id."'>Details</a></td>
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
          

