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
    <form method='post' action='<?php echo base_url().'index.php/AdminPanel/reviewwritinganswerpreviewsubmit' ?>'>
    	<div>
    		<div>
    			<?php echo html_entity_decode($mt->sec_one_question); ?>
    		</div>		
    		<div style='border:1px solid #4d94ff;margin:10px;padding:10px;color:#4d94ff'>
    		    <h3>Student's Answer</h3>      			
    			<?php echo html_entity_decode($log->wrting_answer_1); ?> <br/>
    			<h3>Your Comment</h3>
    			<textarea name='com1' id='com1' rows='8' cols='50' required></textarea>
    		</div>
    	</div>
    	<div>
    		<div>
    			<?php echo html_entity_decode($mt->sec_two_question); ?>
    		</div>
    		<div style='border:1px solid #4d94ff;margin:10px;padding:10px;color:#4d94ff'>
    			<h3>Student's Answer</h3>      			
    			<?php echo html_entity_decode($log->wrting_answer_2); ?> <br/>
    			<h3>Your Comment</h3>
    			<textarea name='com2' id='com2' rows='8' cols='50' required></textarea> <br/>
    			
    			<h3>Brand Score</h3>
                <select id='brand' name='brand' required>
                        <option value='0.0'>0.0</option>    
                        <option value='1.0'>1.0</option>
                        <option value='1.5'>1.5</option>
                        <option value='2.0'>2.0</option>
                        <option value='2.5'>2.5</option>
                        <option value='3.0'>3.0</option>
                        <option value='3.5'>3.5</option>
                        <option value='4.0'>4.0</option>
                        <option value='4.5'>4.5</option>
                        <option value='5.0'>5.0</option>
                        <option value='5.5'>5.5</option>
                        <option value='6.0'>6.0</option>
                        <option value='6.5'>6.5</option>
                        <option value='7.0'>7.0</option>
                        <option value='7.5'>7.5</option>
                        <option value='8.0'>8.0</option>
                        <option value='8.5'>8.5</option>
                        <option value='9.0'>9.0</option>
              </select>
    		</div>
    	</div>
    	
          <br/><br/>
    <input type='hidden' name='ex_id' value='<?php echo $ex_id; ?>'>      
    <button class="btn btn-success">Submit</button>       
    <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/AdminPanel/pendingwritingexamreview">Go Back</a>
</form>
</body>
</html>