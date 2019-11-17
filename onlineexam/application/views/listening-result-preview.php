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
<body style='margin:10px;'>
    <div style='margin:20px;'>
		<div style='float:left'>
			<figure>			
				<audio 
					controls
					src="<?php echo $mt->lt_file_path ?>">
						Your browser does not support the
						<code>audio</code> element.
				</audio>
			</figure>			
		</div>
		<div style='float:right'>
			<h4>Correct Answer: <?php echo $canswer; ?>/40</h4>
		</div>
    </div>    
	
	<div id='answer_panel' style='padding-top:100px;'>
		<div id='answer_panel_1'>
			<?php echo html_entity_decode($mt->sec_one_answer_paper); ?>
		</div>    
		
		<div id='answer_panel_2'>
			<?php echo html_entity_decode($mt->sec_two_answer_paper); ?>
		</div>
		
		<div id='answer_panel_3'>
			<?php echo html_entity_decode($mt->sec_three_answer_paper); ?>
		</div>
		
		<div id='answer_panel_4'>
			<?php echo html_entity_decode($mt->sec_four_answer_paper); ?>
		</div>
	</div>
	<a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Exampanel/resultlistening?ex_id=<?php echo $ex_id; ?>">Go Back</a>
    </body>

<script>       
   var cdata = document.getElementById('answer_panel').querySelectorAll('input,select');
<?php 
    if(isset($answer) && sizeof($answer)>0)
    {
        echo "alreadyAnswer=true;";
        foreach ($answer as &$ans) 
        {
            $q=intval($ans->elt_question_no)-1;
           echo "if(cdata[$q]){findbytext(cdata[$q],'".$ans->elt_answer."');cdata[$q].disabled = true;}";
		   if($ans->elt_if_correct=='0')
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