<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from layout.jquery-dev.com/demos/simple.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Dec 2018 12:56:45 GMT -->
<head>

	<title><?php echo $mt_name; ?></title>

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
		,	east__size:					'50%'
		,	east__minSize:				200
		,	east__maxSize:				.9 // 50% of layout width
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
<div class="ui-layout-north" onmouseover="myLayout.allowOverflow('north')" onmouseout="myLayout.resetOverflow(this)">

	<div style='float:left'>
		<h4 class="display-4"><?php echo $mt_name; ?></h4>
    </div>
	<div style='float:right'>
		 <h3 id="timer_sec"></h3>
	</div>
</div>
<div class="ui-layout-south">
	<div id='sl_holder' style='float:left'>
		<button class='btn btn-primary' onclick='setsection("1")'>Section 1</button>
		<button class='btn btn-primary' onclick='setsection("2")'>Section 2</button>
    </div>
	<div style='float:right'>
		<button class='btn btn-success' onclick='setAnswer()'>Finish & Go to Next Module</button>
	</div>
</div>
<form method='post' action='<?php echo base_url(); ?>index.php/Exampanel/submitwriting' id='main_form'>
	<div class="ui-layout-center">
		<div id='question_1'>
			<div>
				<?php echo html_entity_decode($data->sec_one_question); ?>
			</div>
		</div>
		<div id='question_2' style='display:none;'>
			<div>
				<?php echo html_entity_decode($data->sec_two_question); ?>
			</div>
		</div>
	</div>
	
   <div class="ui-layout-east" id='answer_panel'>
    	<div id='answer_1_p'>
            <h2>Please Write your below (Task 1)</h2>
            <div>			
            	<textarea rows="20" style='border:1px solid #999999;width:100%; margin:5px 0; padding:3px;' name='answer_1' id='answer_1' spellcheck="false" ></textarea>
            </div>
            <di id='word_count_1'>
			    Words: 0
			</di>
    	</div>
    	<div id='answer_2_p' style='display:none;'>
            <h2>Please Write your below (Task 2)</h2>
			<div>			
				<textarea rows="20" style='border:1px solid #999999;width:100%; margin:5px 0; padding:3px;' name='answer_2' id='answer_2' spellcheck="false"></textarea>
			</div>
			<di id='word_count_2'>
			    Words: 0
			</di>
    	</div>
    </div>
    <input type='hidden' name='ex_id' value='<?php echo $ex_id; ?>'/>
	<input type='hidden' name='mt_id' value='<?php echo $mt_id; ?>'/>
</form>
</body>

<script>

    $("#answer_1").on('change keyup paste', function() {
        var wo = document.getElementById('answer_1').value.split(" ");
        document.getElementById('word_count_1').innerHTML = "Words: "+wo.length;
    });
    
    $("#answer_2").on('change keyup paste', function() {
        var wo = document.getElementById('answer_2').value.split(" ");
        document.getElementById('word_count_2').innerHTML = "Words: "+wo.length;
    });
    
    
	function setsection(sec)
	{
		document.getElementById('question_1').style.display='none';
		document.getElementById('answer_1_p').style.display='none';
		
		document.getElementById('question_2').style.display='none';
		document.getElementById('answer_2_p').style.display='none';
		
		document.getElementById('question_'+sec).style.display='block';
		document.getElementById('answer_'+sec+'_p').style.display='block';
	}
       
    function setAnswer()
    {   
		$("#main_form" ).submit();        
    }

	function startTimer()
	{
		if(document.getElementById("timer_sec").innerHTML =='')
		{
			// Set the date we're counting down to
			var countDownDate = new Date().getTime()+60*60000;
			
			// Update the count down every 1 second
			var x = setInterval(function() {

			  // Get todays date and time
			  var now = new Date().getTime();
				
			  // Find the distance between now and the count down date
			  var distance = countDownDate - now;
				
			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
				if(seconds<=0 && minutes<=0)
				{
					setAnswer();
					return;
				}
				if(minutes < 10)
				{
					document.getElementById("timer_sec").style.color='red';
				}
			  // Output the result in an element with id="demo"
			  document.getElementById("timer_sec").innerHTML = minutes + "m " + seconds + "s ";
				
			  // If the count down is over, write some text 
			  if (distance < 0) {
				clearInterval(x);
				document.getElementById("demo").innerHTML = "EXPIRED";
			  }
			}, 1000);
		}
	}
 startTimer();
</script>
</html>