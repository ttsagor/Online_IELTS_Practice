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
  <h1 class="display-4"><?php echo $exam_data->mt_name; ?></h1>
  <p>All the Module will be taken by the following order. Please get comfortable and then press 'Take Exam' to start your exam</p>
  <?php 
	$l = "Pending <i class='fa fa-times-circle' style='color:red'></i>";
	$r = "Pending <i class='fa fa-times-circle' style='color:red'></i>";
	$w = "Pending <i class='fa fa-times-circle' style='color:red'></i>";
	
	if(isset($log->listening_score) && $log->listening_score!='')
	{
		$l = "<a href='".base_url()."index.php/Exampanel/resultlistening?ex_id=".$log->ex_id."'>(".$log->listening_score."/9.0) <i class='fa fa-check-circle' style='color:green'></i></a>";
	}
	$r = "Pending <i class='fa fa-times-circle' style='color:red'></i>";
	if(isset($log->reading_score)  && $log->reading_score!='')
	{
		$r = "<a href='".base_url()."index.php/Exampanel/resultreading?ex_id=".$log->ex_id."'>(".$log->reading_score."/9.0) <i class='fa fa-check-circle' style='color:green'></i></a>";
	}
	$w = "Pending <i class='fa fa-times-circle' style='color:red'></i>";
	if(isset($log->writing_score) && $log->writing_score!='')
	{
		if($log->writing_score!='-1')
		{
			$w = "<a href='".base_url()."index.php/Exampanel/resultwriting?ex_id=".$log->ex_id."'>(".$log->writing_score."/9.0) <i class='fa fa-check-circle' style='color:green'></i></a>";
		}
		else
		{
			$w = "<a href='".base_url()."index.php/Exampanel/resultwriting?ex_id=".$log->ex_id."'>(Result Pending) <i class='fa fa-check-circle' style='color:green'></i></a>";
		}
	}
	$s = "Pending <i class='fa fa-times-circle' style='color:red'></i>";
	if(isset($log->speaking_score) && $log->speaking_score!='')
	{
		if($log->speaking_score!='-1')
		{
			$s = "<a href='".base_url()."index.php/Exampanel/resultspeaking?ex_id=".$log->ex_id."'>(".$log->speaking_score."/9.0) <i class='fa fa-check-circle' style='color:green'></i></a>";
		}
		else
		{
			$s = "<a href='".base_url()."index.php/Exampanel/resultspeaking?ex_id=".$log->ex_id."'>(Result Pending) <i class='fa fa-check-circle' style='color:green'></i></a>";
		}
	}
  ?>  
  <p>1. Listening module - 40 minutes - <?php echo $l; ?></p>
  <p>2. Reading module - 60 minutes - <?php echo $r; ?></p>
  <p>3. Writing module - 60 minutes - <?php echo $w; ?></p>
  <p>4. Speaking module - 30 minutes - <?php echo $s; ?></p>
  <?php 
	if(isset($log->is_completed) && $log->is_completed=='1')
	{
		
		echo "<h2>Overall Band Score: <span style='color:green;'>".$log->overall_brand."</span></h2>";
		if(isset($log->overall_score_c))
		{
			echo "<p style='color:green'>".$log->overall_score_c."</p>";
		}				
		
	}
	else
	{
		echo "<a class='btn btn-success' href='".base_url()."index.php/Exampanel/beginexam?tid=".$log->ex_id."'>Take Exam</a>";
	}
  
   echo "&nbsp;<a class='btn btn-info' href='".base_url()."index.php/Exampanel/dashboard'>Go Home</a>";
  
  ?>
</div>

</body>
</html>
