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
<script>
  audiojs.events.ready(function() {
    audiojs.createAll();
  });
</script>
	


</head>
<body>
    <div>
        <audio src='<?php echo $lt_file_path ?>' preload='auto'></audio>
    </div>
    <h4> Section one</h4>

    <div id='answer_panel_1'>
    	<?php echo html_entity_decode($answer_1); ?>
    </div>
    
    <h4> Section two</h4>
    <div id='answer_panel_2'>
    	<?php echo html_entity_decode($answer_2); ?>
    </div>
    
    <h4> Section three</h4>
    <div id='answer_panel_3'>
    	<?php echo html_entity_decode($answer_3); ?>
    </div>
	
	<h4> Section four</h4>
    <div id='answer_panel_4'>
    	<?php echo html_entity_decode($answer_4); ?>
    </div>
    </body>

<script>       
   var cdata = document.getElementById('answer_panel_1').querySelectorAll('input,select');
<?php 
    if(isset($canswer_1) && sizeof($canswer_1)>0)
    {
        echo "alreadyAnswer=true;";
        foreach ($canswer_1 as &$ans) 
        {
            $q=intval($ans->lt_q_no)-1;
           echo "if(cdata[$q]){findbytext(cdata[$q],'".$ans->lt_q_ans."');cdata[$q].disabled = true;}";
        }   
    }
    
    echo "cdata = document.getElementById('answer_panel_2').querySelectorAll('input,select');";
    if(isset($canswer_2) && sizeof($canswer_2)>0)
    {
        echo "alreadyAnswer=true;";
        foreach ($canswer_2 as &$ans) 
        {
            $q=intval($ans->lt_q_no)-1;
           echo "if(cdata[$q]){findbytext(cdata[$q],'".$ans->lt_q_ans."');cdata[$q].disabled = true;}";
        }   
    }
    
    echo "cdata = document.getElementById('answer_panel_3').querySelectorAll('input,select');";
    if(isset($canswer_3) && sizeof($canswer_3)>0)
    {
        echo "alreadyAnswer=true;";
        foreach ($canswer_3 as &$ans) 
        {
            $q=intval($ans->lt_q_no)-1;
            echo "if(cdata[$q]){findbytext(cdata[$q],'".$ans->lt_q_ans."');cdata[$q].disabled = true;}";
        }   
    }
    
    echo "cdata = document.getElementById('answer_panel_4').querySelectorAll('input,select');";
    if(isset($canswer_4) && sizeof($canswer_4)>0)
    {
        echo "alreadyAnswer=true;";
        foreach ($canswer_4 as &$ans) 
        {
            $q=intval($ans->lt_q_no)-1;
            //echo "if(cdata[$q]){cdata[$q].value='".$ans->lt_q_ans."';cdata[$q].disabled = true;}";
			echo "if(cdata[$q]){findbytext(cdata[$q],'".$ans->lt_q_ans."');cdata[$q].disabled = true;}";
        }   
    }
?>

 createNumSl();
 
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