<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style='margin:auto;width:100%'> 
  <h1 class="display-4"><?php echo $mt->mt_name; ?></h1>
  <?php 
    if(!isset($no_result))
    {
  ?>
  <div>
	  <h4>Reading Module</h4>
	  <h4>Your Score is : <?php echo $log->reading_score; ?>/9.0</h4>
	  <h4>Correct Answer : <?php echo $log->reading_c_answer; ?>/40</h4>
  </div>
  <p>Question's Answer</p>
  
  <?php 
	
	for ($x = 0; $x <= sizeof($sa)-1; $x=$x+2) 
	{
		$color = "red";
		$icon = "<i class='fa fa-times-circle' style='color:red'></i>";
		if($sa[$x]->ert_if_correct=='1')
		{
			$color = "green";
			$icon = "<i class='fa fa-check-circle' style='color:green'></i>";
		}
		echo "<div class='row'>
			<div class='col-sm-6'><span style='color:#268695'>".($x+1).") ".$sa[$x]->ert_question_answer_c."</span> : <span style='color:$color'>".$sa[$x]->ert_answer."</span> $icon</div>
			<div class='col-sm-6'><span style='color:#268695'>".($x+2).") ".$sa[$x+1]->ert_question_answer_c."</span> : <span style='color:$color'>".$sa[$x+1]->ert_answer."</span>  $icon</div>    
		</div>";
		;
	} 
  ?>
  <br/>
  
  <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Exampanel/readinganswerpreview?ex_id=<?php echo $log->ex_id; ?>">Preview</a>
  <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Exampanel/ieltsexam?tid=<?php echo $log->ex_id; ?>">Home</a> <?php } ?>
  <?php 
		if((isset($log->is_completed) && $log->is_completed=='1'))
		{

		}
		else
		{
		 echo "<a class='btn btn-danger' href='".base_url()."index.php/Exampanel/readingmodule?ex_id=".$log->ex_id."'>Retake this Module</a>";
		}
	?>  
  <a class="btn btn-success" href="<?php echo base_url(); ?>index.php/Exampanel/beginexam?tid=<?php echo $log->ex_id; ?>">Next Module</a>
</div>

</body>
</html>
