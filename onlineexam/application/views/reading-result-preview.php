<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from layout.jquery-dev.com/demos/simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Dec 2018 12:56:45 GMT -->
<head>

	<title><?php echo $title; ?></title>

	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/split-view-lib/css/layout-default-latest.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/css/font-awesome.css" /> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/css/SJL.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="<?php echo base_url(); ?>/assets/audiojs/audio.min.js"></script>

	


</head>
<body style='margin:20px;'>
    <div style='margin:20px;'>		
		<div style='float:right'>
			<h4>Correct Answer: <?php echo $canswer; ?>/40</h4>
		</div>
    </div>    
	
	<div id='answer_panel' style='padding-top:50px;'>
		<div class="">
			<?php echo html_entity_decode($mt->sec_one_question); ?>
		</div>
		<div id='answer_panel_1'>
			<?php 
				$answer = str_replace('<i class="sjl_fa fa-pencil" style="cursor: pointer;"></i>'," ",html_entity_decode($mt->sec_one_answer_paper));
				echo $answer; 
			?>
		</div>


		<div class="">
			<?php 
				echo html_entity_decode($mt->sec_two_question);
			?>
		</div>
		<div id='answer_panel_2'>
			<?php
				$answer = str_replace('<i class="sjl_fa fa-pencil" style="cursor: pointer;"></i>'," ",html_entity_decode($mt->sec_two_answer_paper));
				echo $answer; 
			?>
		</div>


		<div class="">
			<?php echo html_entity_decode($mt->sec_three_question); ?>
		</div>
		<div id='answer_panel_3'>
			<?php
				$answer = str_replace('<i class="sjl_fa fa-pencil" style="cursor: pointer;"></i>'," ",html_entity_decode($mt->sec_three_answer_paper));
				echo $answer; 
			?>
		</div>
	</div>
	<a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Exampanel/resultreading?ex_id=<?php echo $ex_id; ?>">Go Back</a>
    </body>

<script>       
   var cdata = document.getElementById('answer_panel').querySelectorAll('input,select');
<?php 
    if(isset($answers) && sizeof($answers)>0)
    {
        foreach ($answers as &$ans) 
        {
            $q=intval($ans->ert_question_no)-1;
           echo "if(cdata[$q]){findbytext(cdata[$q],'".$ans->ert_answer."');cdata[$q].disabled = true;}";
		   if($ans->ert_if_correct=='0')
		   {
			   echo "if(cdata[$q]){cdata[$q].style.borderColor = 'red';}";
		   }
		   else{
			    echo "if(cdata[$q]){cdata[$q].style.borderColor = 'green';}";
		   }
		   
        }   
    }
?>

 
 
 function findbytext(elem,txt){
	if(elem)
	{	
		if(elem.tagName === 'SELECT') 
		{				
			for (var i = 0; i < elem.options.length; i++) {
				if (elem.options[i].text === txt) {
					elem.selectedIndex = i;
					break;
				}
			}
		}
		else
		{
			elem.value=txt;
		}
		elem.disabled = true;
	}	
}
</script>
</html>