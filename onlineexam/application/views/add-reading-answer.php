<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from layout.jquery-dev.com/demos/simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Dec 2018 12:56:45 GMT -->
<head>

	<title><?php echo $title; ?></title>

	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/split-view-lib/css/layout-default-latest.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/css/font-awesome.css" /> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/css/SJL.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- LAYOUT v 1.3.0 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/split-view-lib/js/jquery-latest.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/split-view-lib/js/jquery-ui-latest.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/split-view-lib/js/jquery.layout-1.3.0.rc30.80.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/split-view-lib/js/debug.js"></script>

	<script type="text/javascript">

	function toggleLiveResizing () {
		$.each( $.layout.config.borderPanes, function (i, pane) {
			var o = myLayout.options[ pane ];
			o.livePaneResizing = !o.livePaneResizing;
		});
	};
	
	function toggleStateManagement ( skipAlert, mode ) {
		if (!$.layout.plugins.stateManagement) return;

		var options	= myLayout.options.stateManagement
		,	enabled	= options.enabled // current setting
		;
		if ($.type( mode ) === "boolean") {
			if (enabled === mode) return; // already correct
			enabled	= options.enabled = mode
		}
		else
			enabled	= options.enabled = !enabled; // toggle option

		if (!enabled) { // if disabling state management...
			myLayout.deleteCookie(); // ...clear cookie so will NOT be found on next refresh
			if (!skipAlert)
				alert( 'This layout will reload as the options specify \nwhen the page is refreshed.' );
		}
		else if (!skipAlert)
			alert( 'This layout will save & restore its last state \nwhen the page is refreshed.' );

		// update text on button
		var $Btn = $('#btnToggleState'), text = $Btn.html();
		if (enabled)
			$Btn.html( text.replace(/Enable/i, "Disable") );
		else
			$Btn.html( text.replace(/Disable/i, "Enable") );
	};

	// set EVERY 'state' here so will undo ALL layout changes
	// used by the 'Reset State' button: myLayout.loadState( stateResetSettings )
	var stateResetSettings = {
		north__size:		"auto"
	,	north__initClosed:	false
	,	north__initHidden:	false
	,	south__size:		"auto"
	,	south__initClosed:	false
	,	south__initHidden:	false
	,	west__size:			200
	,	west__initClosed:	false
	,	west__initHidden:	false
	,	east__size:			300
	,	east__initClosed:	false
	,	east__initHidden:	false
	};

	var myLayout;

	$(document).ready(function () {

		// this layout could be created with NO OPTIONS - but showing some here just as a sample...
		// myLayout = $('body').layout(); -- syntax with No Options

		myLayout = $('body').layout({

		//	reference only - these options are NOT required because 'true' is the default
			closable:					true	// pane can open & close
		,	resizable:					true	// when open, pane can be resized 
		,	slidable:					true	// when closed, pane can 'slide' open over other panes - closes on mouse-out
		,	livePaneResizing:			true

		//	some resizing/toggling settings
		,	north__slidable:			false	// OVERRIDE the pane-default of 'slidable=true'
		,	north__togglerLength_closed: '100%'	// toggle-button is full-width of resizer-bar
		,	north__spacing_closed:		20		// big resizer-bar when open (zero height)
		,	south__resizable:			false	// OVERRIDE the pane-default of 'resizable=true'
		,	south__spacing_open:		0		// no resizer-bar when open (zero height)
		,	south__spacing_closed:		20		// big resizer-bar when open (zero height)

		//	some pane-size settings
		,	west__minSize:				100
		,	east__size:					300
		,	east__minSize:				200
		,	east__maxSize:				.5 // 50% of layout width
		,	center__minWidth:			100

		//	some pane animation settings
		,	west__animatePaneSizing:	false
		,	west__fxSpeed_size:			"fast"	// 'fast' animation when resizing west-pane
		,	west__fxSpeed_open:			1000	// 1-second animation when opening west-pane
		,	west__fxSettings_open:		{ easing: "easeOutBounce" } // 'bounce' effect when opening
		,	west__fxName_close:			"none"	// NO animation when closing west-pane

		//	enable showOverflow on west-pane so CSS popups will overlap north pane
		,	west__showOverflowOnHover:	true

		//	enable state management
		,	stateManagement__enabled:	true // automatic cookie load & save enabled by default

		,	showDebugMessages:			true // log and/or display messages from debugging & testing code
		});

		// if there is no state-cookie, then DISABLE state management initially
		var cookieExists = !$.isEmptyObject( myLayout.readCookie() );
		if (!cookieExists) toggleStateManagement( true, false );

		myLayout
			// add event to the 'Close' button in the East pane dynamically...
			.bindButton('#btnCloseEast', 'close', 'east')
	
			// add event to the 'Toggle South' buttons in Center AND South panes dynamically...
			.bindButton('.south-toggler', 'toggle', 'south')
			
			// add MULTIPLE events to the 'Open All Panes' button in the Center pane dynamically...
			.bindButton('#openAllPanes', 'open', 'north')
			.bindButton('#openAllPanes', 'open', 'south')
			.bindButton('#openAllPanes', 'open', 'west')
			.bindButton('#openAllPanes', 'open', 'east')

			// add MULTIPLE events to the 'Close All Panes' button in the Center pane dynamically...
			.bindButton('#closeAllPanes', 'close', 'north')
			.bindButton('#closeAllPanes', 'close', 'south')
			.bindButton('#closeAllPanes', 'close', 'west')
			.bindButton('#closeAllPanes', 'close', 'east')

			// add MULTIPLE events to the 'Toggle All Panes' button in the Center pane dynamically...
			.bindButton('#toggleAllPanes', 'toggle', 'north')
			.bindButton('#toggleAllPanes', 'toggle', 'south')
			.bindButton('#toggleAllPanes', 'toggle', 'west')
			.bindButton('#toggleAllPanes', 'toggle', 'east')
		;


		/*
		 *	DISABLE TEXT-SELECTION WHEN DRAGGING (or even _trying_ to drag!)
		 *	this functionality will be included in RC30.80
		 */
		$.layout.disableTextSelection = function(){
			var $d	= $(document)
			,	s	= 'textSelectionDisabled'
			,	x	= 'textSelectionInitialized'
			;
			if ($.fn.disableSelection) {
				if (!$d.data(x)) // document hasn't been initialized yet
					$d.on('mouseup', $.layout.enableTextSelection ).data(x, true);
				if (!$d.data(s))
					$d.disableSelection().data(s, true);
			}
			//console.log('$.layout.disableTextSelection');
		};
		$.layout.enableTextSelection = function(){
			var $d	= $(document)
			,	s	= 'textSelectionDisabled';
			if ($.fn.enableSelection && $d.data(s))
				$d.enableSelection().data(s, false);
			//console.log('$.layout.enableTextSelection');
		};
		$(".ui-layout-resizer")
			.disableSelection() // affects only the resizer element
			.on('mousedown', $.layout.disableTextSelection ); // affects entire document

 	});
	</script>


</head>
<body>
<div class="ui-layout-south">
	<div id='sl_holder' style='float:left'>
    </div>
	<div style='float:right'>
	    <button class='btn btn-primary' onclick='setAnswer()'>Save</button>
	</div>
</div>

<div class="ui-layout-east" id='answer_panel'>
	<?php 
		$answer = str_replace('<i class="sjl_fa fa-pencil" style="cursor: pointer;"></i>'," ",html_entity_decode($answer));
		echo $answer; 
	?>
</div>

<div class="ui-layout-center">
	<?php echo html_entity_decode($question); ?>
</div>
<form method='post' action='<?php echo base_url(); ?>index.php/AdminPanel/addanswersubmit' id='main_form'>
    <input type='hidden' name='tid' value='<?php echo $tid; ?>'/>
    <input type='hidden' name='sec' value='<?php echo $sec; ?>'/>
    <div id='final_answer_holder'>
    </div>
</form>
</body>

<script>
    var alreadyAnswer = false;
    function createNumSl(){
       $("#sl_holder" ).html("");  
      var data = document.getElementById('answer_panel').querySelectorAll('input,select');
      for(var i=0;i<data.length;i++)
      {
          var sl = i+1;
          data[i].setAttribute('onchange','createNumSl();');
          
          if(data[i].tagName === 'SELECT') 
          {
            var select = data[i];
            if(select[0].value!='')
            {
                var opt = new Option('Select Answer', '');
                select.insertBefore(opt, select.firstChild);
                if(!alreadyAnswer)
                {
                    select.value="";
                }
            }
          }
          
          if(data[i].value!='')
          {
              data[i].style.borderColor = "green";
              $("#sl_holder" ).append( "<button type='submit' class='btn btn-success' onclick='setFocus("+i+")'>"+sl+"</button> " );
          }
          else
          {
             data[i].style.borderColor = "red";
             $("#sl_holder" ).append( "<button type='submit' class='btn btn-danger' onclick='setFocus("+i+")'>"+sl+"</button> " );
          }
      }
      
    }
    
    function setFocus(elem)
    {
        var data = document.getElementById('answer_panel').querySelectorAll('input,select');
        data[elem].scrollIntoView();
        data[elem].focus();
    }
    function checkIfAnswer()
    {
        var data = document.getElementById('answer_panel').querySelectorAll('input,select');
        for(var i=0;i<data.length;i++)
        {
              if(data[i].value=='')
              {
                return false;    
              }
        }
        return true;
    }
    function setAnswer()
    {
        if(!checkIfAnswer())
        {
            alert("Please answer all the question");
            return;
        }
        $("#final_answer_holder" ).html("");
        var data = document.getElementById('answer_panel').querySelectorAll('input,select');
        for(var i=0;i<data.length;i++)
        {
			if(data[i].tagName === 'SELECT') 
			{				
				var nData = "<input type='hidden' name='final_answer[]' value='"+data[i].options[data[i].selectedIndex].text+"'>";
				$("#final_answer_holder" ).append(nData);
			}
			else
			{
				var nData = "<input type='hidden' name='final_answer[]' value='"+data[i].value+"'>";
				$("#final_answer_holder" ).append(nData);
			}
        }
        $("#main_form" ).submit();
        
    }
   
   var cdata = document.getElementById('answer_panel').querySelectorAll('input,select');
<?php 
    if(isset($canswer) && sizeof($canswer)>0)
    {
        echo "alreadyAnswer=true;";
        foreach ($canswer as &$ans) 
        {
            $q=intval($ans->rt_q_no)-1;            
			echo "if(cdata[$q]){findbytext(cdata[$q],'".$ans->rt_q_ans."');}";
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
	}	
}
 createNumSl();
</script>
</html>