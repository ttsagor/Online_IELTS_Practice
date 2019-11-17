<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from layout.jquery-dev.com/demos/simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Dec 2018 12:56:45 GMT -->
<head>

	<title><?php echo $title; ?></title>

	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/split-view-lib/css/layout-default-latest.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/css/font-awesome.css" /> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/css/SJL.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body style='margin:20px;'>
	<div>
		<div>
			<?php echo html_entity_decode($mt->sec_one_question); ?>
		</div>		
		<div style='border:1px solid #4d94ff;margin:10px;padding:10px;color:#4d94ff'>			
			<audio controls id='audio_1'>
				<?php 
					if(isset($log->speaking_answer_1) && $log->speaking_answer_1!='')
					{
						echo "<source src='".$log->speaking_answer_1."' type='audio/wav'";
					}
				?>
			  Your browser does not support the audio tag.
			</audio>
		</div>
	</div>
	<div>
		<div>
			<?php echo html_entity_decode($mt->sec_two_question); ?>
		</div>
		<div style='border:1px solid #4d94ff;margin:10px;padding:10px;color:#4d94ff'>			
			<audio controls id='audio_1'>
				<?php 
					if(isset($log->speaking_answer_2) && $log->speaking_answer_2!='')
					{
						echo "<source src='".$log->speaking_answer_2."' type='audio/wav'";
					}
				?>
			  Your browser does not support the audio tag.
			</audio>
		</div>
	</div>
	<div>
		<div>
			<?php echo html_entity_decode($mt->sec_three_question); ?>
		</div>
		<div style='border:1px solid #4d94ff;margin:10px;padding:10px;color:#4d94ff'>			
			<audio controls id='audio_1'>
				<?php 
					if(isset($log->speaking_answer_3) && $log->speaking_answer_3!='')
					{
						echo "<source src='".$log->speaking_answer_3."' type='audio/wav'";
					}
				?>
			  Your browser does not support the audio tag.
			</audio>
		</div>
	</div>
	
<a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Exampanel/resultspeaking?ex_id=<?php echo $ex_id; ?>">Go Back</a>

</body>
</html>