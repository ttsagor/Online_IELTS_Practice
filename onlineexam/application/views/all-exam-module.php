<!--- Reading Part -->
<?php 
    if(($reading_sec_answer_1)){}
    $total_reading_question = sizeof($reading_sec_answer_1)+sizeof($reading_sec_answer_2)+sizeof($reading_sec_answer_3);
    $total_listening_question = sizeof($listening_sec_answer_1)+sizeof($listening_sec_answer_2)+sizeof($listening_sec_answer_3)+sizeof($listening_sec_answer_4);
?>
<script src="<?php echo base_url(); ?>/assets/audiojs/audio.min.js"></script>
<script>
      audiojs.events.ready(function() {
        audiojs.createAll();
      });
    </script>
<div style='width:50%;margin:auto'>
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#" <?php if($total_reading_question==40){echo "class='label label-success'"; }else{echo "class='label label-warning'";} ?> >
             <h4><i class="fa fa-book"></i> Reading Module [Questions: <?php echo $total_reading_question; ?>]</h4>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="<?php echo base_url(); ?>index.php/AdminPanel/readingquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=1"><i class="fa fa-book"></i>Reading Section 1
                [Questions: <?php echo sizeof($reading_sec_answer_1); ?>]
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/AdminPanel/readingquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=2"><i class="fa fa-book"></i>Reading Section 2
                [Questions: <?php echo sizeof($reading_sec_answer_2); ?>]
                </a></li>
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/readingquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=3"><i class="fa fa-book"></i>Reading Section 3
                [Questions: <?php echo sizeof($reading_sec_answer_3); ?>]
            </a></li>
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/readingquestionpreview?tid=<?php echo $data['test_no']; ?>"><i class="fa fa-book"></i>Preview
                [Questions: <?php echo $total_reading_question; ?>]
            </a></li>
          </ul>
        </li>
    </ul>
    
    <!--- Listening Part -->
    <ul class="sidebar-menu" data-widget="tree" style='margin-top:5px;'>
        <li class="treeview">
          <a href="#" <?php if($total_listening_question==40 && $listening->lt_file_path!=''){echo "class='label label-success'"; }else{echo "class='label label-warning'";} ?>>
            <h4><i class="fa fa-headphones"></i> Listeing Module [Questions: <?php echo $total_listening_question; ?>]</h4>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
                <?php 
                    if(isset($listening->lt_file_path) && $listening->lt_file_path!='')
                    {
                        echo "<div><audio src='".$listening->lt_file_path."' preload='auto'></audio>";
                        echo "<a class='btn btn-danger' aria-label='Delete' href='".base_url()."/index.php/AdminPanel/deletefilelistening?t_id=".$listening->lt_id."'>
                              <i class='fa fa-trash-o' aria-hidden='true'></i>
                            </a></div>";
                                    
                    }
                    else
                    {
                        echo "<a data-toggle='modal' data-target='#uploadModal' style='cursor:pointer;'><i class='fa fa-file-audio-o'></i>Upload Audio File</a>";
                    }
                ?>
                
            </li>  
            <li>
                <a href="<?php echo base_url(); ?>index.php/AdminPanel/listeningquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=1"><i class="fa fa-headphones"></i>Section one
                [Questions: <?php echo sizeof($listening_sec_answer_1); ?>]</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/AdminPanel/listeningquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=2"><i class="fa fa-headphones"></i>Section two
                [Questions: <?php echo sizeof($listening_sec_answer_2); ?>]</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/AdminPanel/listeningquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=3"><i class="fa fa-headphones"></i>Section three
                [Questions: <?php echo sizeof($listening_sec_answer_3); ?>]</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/AdminPanel/listeningquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=4"><i class="fa fa-headphones"></i>Section Four
                [Questions: <?php echo sizeof($listening_sec_answer_4); ?>]</a>
            </li>
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/listeningquestionpreview?tid=<?php echo $data['test_no']; ?>"><i class="fa fa-book"></i>Preview
                [Questions: <?php echo $total_listening_question; ?>]
            </a></li>
          </ul>
        </li>
    </ul>
    
    <!--- Writing Part -->
    <ul class="sidebar-menu" data-widget="tree" style='margin-top:5px;'>
        <li class="treeview">
          <a href="#" <?php if(isset($writing->sec_one_question) && isset($writing->sec_two_question) && $writing->sec_one_question!='' && $writing->sec_two_question!=''){echo "class='label label-success'"; }else{echo "class='label label-warning'";}  ?>>
            <h4><i class="fa fa-edit"></i> Writing Module</h4>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/writingquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=1"><i class="fa fa-book"></i>Section one</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/writingquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=2"><i class="fa fa-book"></i>Section two</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/writingquestionpreview?tid=<?php echo $data['test_no']; ?>"><i class="fa fa-book"></i>Preview
            </a></li>  
        </ul>
        </li>
    </ul>
    
    <!--- Speaking Part -->
    <ul class="sidebar-menu" data-widget="tree" style='margin-top:5px;'>
        <li class="treeview">
          <a href="#" <?php if(isset($speaking->sec_one_question) && isset($speaking->sec_two_question) && isset($speaking->sec_three_question) && $speaking->sec_one_question!='' && $speaking->sec_two_question!='' && $speaking->sec_three_question!=''){echo "class='label label-success'"; }else{echo "class='label label-warning'";}  ?>>
            <h4><i <i class="fa fa-comments"></i></i> Speaking Module</h4>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/speakingquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=1"><i class="fa fa-comments"></i>Section one</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/speakingquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=2"><i class="fa fa-comments"></i>Cue Card</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/speakingquestionaddpassage?tid=<?php echo $data['test_no']; ?>&&sec=3"><i class="fa fa-comments"></i>Section three</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/AdminPanel/speakingquestionpreview?tid=<?php echo $data['test_no']; ?>"><i class="fa fa-book"></i>Preview
            </a></li>
          </ul>
        </li>
    </ul>
	
</div>    


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
                        Select file : <input type='file' name='file' id='file' class='form-control' accept=".mp3" required /><br>
                        <input type='hidden' name='rurl' value='<?php echo base_url()."/index.php/AdminPanel/mocktestmodules?id=".$data['test_no']; ?>'>
                        <input type='hidden' name='tid' value='<?php echo $data['test_no']; ?>'>
                        <input type='submit' class='btn btn-info' value='Upload' id='upload'>
                    </form>

                    <!-- Preview-->
                    <div id='preview'></div>
                </div>
                
            </div>

          </div>
        </div>