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
          <th>Student Name</th>
          <th>Mock Test Name</th>
          <th>Created Date</th>
          <th>Check Result</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $count=1;
            foreach ($data as &$d) 
            {
                echo "<tr>
                      <td>$count</td>
                      <td>".$d->user_login."</td>";
                      
                echo "<td>".$d->mt_name."</td>";
                echo "<td>".$d->start_datetime."</td>
                      <td>
                        <a class='btn btn-danger' aria-label='Delete' href='".base_url()."index.php/AdminPanel/reviewspeakinganswerpreview?ex_id=".$d->ex_id."'>
                          Check
                        </a>
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