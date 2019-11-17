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
  <div>
	  <h4>Speaking Module</h4>
	  <h4>Your Score is : 
	  <?php
			if($log->speaking_score!='-1')
			{
				echo $log->speaking_score."/9.0";
			}
			else
			{
				echo "(Result Pedning)";
			}
		?></h4>
  </div>
  <p><i>Comment From Reviewer</i></p>
  <p><b>Section one:</b> 
		<?php 
			if($log->speaking_answer_1_com=='')
			{
				echo "<i>(Not Reviewed Yet)</i>";
			}
			else{
				echo "$log->speaking_answer_1_com";
			}
		?>
  </p>
  
  <p><b>Section two:</b>
		<?php 
			if($log->speaking_answer_2_com=='')
			{
				echo "<i>(Not Reviewed Yet)</i>";
			}
			else{
				echo "$log->speaking_answer_2_com";
			}
		?>
  </p>
  
  <p><b>Section three:</b>
		<?php 
			if($log->speaking_answer_2_com=='')
			{
				echo "<i>(Not Reviewed Yet)</i>";
			}
			else{
				echo "$log->speaking_answer_2_com";
			}
		?>
  </p>
  
	
	
  <?php 
	
	
  ?>
  <br/>
  
  <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Exampanel/speakinganswerpreview?ex_id=<?php echo $log->ex_id; ?>">Preview</a>
  <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Exampanel/ieltsexam?tid=<?php echo $log->ex_id; ?>">Home</a>
  <?php 
	 if((isset($log->is_completed) && $log->is_completed=='1'))
	 {
		
	 }
	 else
	 {
		 echo "<a class='btn btn-danger' href='".base_url()."index.php/Exampanel/speakingmodule?ex_id=".$log->ex_id."'>Retake this Module</a>";
	 }
  ?>
 
  
</div>

</body>
</html>
