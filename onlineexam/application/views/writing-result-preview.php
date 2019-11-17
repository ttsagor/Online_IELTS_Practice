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
			<?php echo html_entity_decode($log->wrting_answer_1); ?>
		</div>
	</div>
	<div>
		<div>
			<?php echo html_entity_decode($mt->sec_two_question); ?>
		</div>
		<div style='border:1px solid #4d94ff;margin:10px;padding:10px;color:#4d94ff'>			
			<?php echo html_entity_decode($log->wrting_answer_2); ?>
		</div>
	</div>
	
<a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Exampanel/resultwriting?ex_id=<?php echo $ex_id; ?>">Go Back</a>

</body>
</html>