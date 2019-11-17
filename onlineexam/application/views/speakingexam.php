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
		<button class='btn btn-primary' onclick='setsection("3")'>Section 3</button>
    </div>
	<div style='float:right'>
		<button class='btn btn-success' onclick='setAnswer()'>Finish</button>
	</div>
</div>
<?php
	$aLlink = base_url()."/speakingexamrecord.php?ex_id=$ex_id&mt_id=$mt_id&part=";
	$aLlink2 = base_url()."/index.php/Exampanel/uploadrecordedaudio?ex_id=$ex_id&mt_id=$mt_id&part=";
	
?>
<form method='post' action='<?php echo base_url(); ?>index.php/Exampanel/submitspeaking' id='main_form' enctype="multipart/form-data">
	<div class="ui-layout-center">
		<div id='question_1' <?php if($part!='1'){ echo "style='display:none;'"; } ?> >
			<div>
				<?php echo html_entity_decode($data->sec_one_question); ?>
			</div>
			<h2>You can 'Record' your Speech</h2>
			<div>			
				<div style='border:1px #ccc solid;'>
					<div style='margin:auto'>
						<p>
							<!--<input type="radio" id="test1_1" name="test_1" value='record' checked>-->
							<label for="test1_1"> Use Recorded Speech
								<p>
									<a href="#" onClick="loadpopup('1'); return false;">Start Recording</a><br/>
									OR <br/>
									<a href="#" onClick="loadpopupUpload('1'); return false;">Upload Audio File</a><br/>
									<audio controls id='audio_1'>
										<?php 
											if(isset($exam_data->speaking_answer_1) && $exam_data->speaking_answer_1!='')
											{
												echo "<source src='".$exam_data->speaking_answer_1."' type='audio/wav'";
											}
										?>
									  Your browser does not support the audio tag.
									</audio>
								</p>
							</label>
						</p>						
					</div>	
				</div>
				<!--<div style='border:1px #ccc solid'>
					<p>
						<input type="radio" id="test1_2" name="test_1" value='file'>
							<label for="test1_2"> Use Recorded Speech
								<p>Upload '.mp3' file <input type='file' id='audio_1' name='audio_1'></p>
							</label>
					</p>
				</div>-->
			</div>
		</div>
		<div id='question_2' <?php if($part!='2'){ echo "style='display:none;'"; } ?>>
			<div>
				<?php echo html_entity_decode($data->sec_two_question); ?>
			</div>
			<h2>You can 'Record' your Speech</h2>
			<div>			
				<div style='border:1px #ccc solid;'>
					<div style='margin:auto'>
						<p>
							<!--<input type="radio" id="test2_1" name="test_2" value='record' checked>-->
							<label for="test2_1"> Use Recorded Speech
								<p>
									<a href="#" onClick="loadpopup('2'); return false;">Start Recording</a><br/>
									OR <br/>
									<a href="#" onClick="loadpopupUpload('2'); return false;">Upload Audio File</a><br/>
									<audio controls id='audio_2'>
										<?php 
											if(isset($exam_data->speaking_answer_2) && $exam_data->speaking_answer_2!='')
											{
												echo "<source src='".$exam_data->speaking_answer_2."' type='audio/wav'";
											}
										?>
									  Your browser does not support the audio tag.
									</audio>
								</p>
							</label>
						</p>						
					</div>	
				</div>
				<!--<div style='border:1px #ccc solid'>
					<p>
						<input type="radio" id="test2_2" name="test_2" value='file'>
							<label for="test2_2"> Use Recorded Speech
								<p>Upload '.mp3' file <input type='file' id='audio_2' name='audio_2'></p>
							</label>
					</p>
				</div>-->
			</div>
		</div>
		<div id='question_3' <?php if($part!='3'){ echo "style='display:none;'"; } ?>>
			<div>
				<?php echo html_entity_decode($data->sec_three_question); ?>
			</div>
			<h2>You can 'Record' your Speech</h2>
			<div>			
				<div style='border:1px #ccc solid;'>
					<div style='margin:auto'>
						<p>
							<!--<input type="radio" id="test3_1" name="test_3" value='record' checked>-->
							<label for="test3_1"> Use Recorded Speech
								<p>
									<a href="#" onClick="loadpopup('3'); return false;">Start Recording</a> <br/>
									OR <br/>
									<a href="#" onClick="loadpopupUpload('1'); return false;">Upload Audio File</a><br/>
									<audio controls id='audio_3'>
										<?php 
											if(isset($exam_data->speaking_answer_3) && $exam_data->speaking_answer_3!='')
											{
												echo "<source src='".$exam_data->speaking_answer_3."' type='audio/wav'";
											}
										?>	
									  Your browser does not support the audio tag.
									</audio>
								</p>
							</label>
						</p>						
					</div>	
				</div>
				<!--<div style='border:1px #ccc solid'>
					<p>
						<input type="radio" id="test3_2" name="test_3" value='file'>
							<label for="test3_2"> Use Recorded Speech
								<p>Upload '.mp3' file <input type='file' id='audio_3' name='audio_3'></p>
							</label>
					</p>
				</div>-->
			</div>
		</div>
	</div>
    <input type='hidden' name='ex_id' value='<?php echo $ex_id; ?>'/>
	<input type='hidden' name='mt_id' value='<?php echo $mt_id; ?>'/>
</form>
</body>

<script>    
	function setsection(sec)
	{
		document.getElementById('question_1').style.display='none';
		document.getElementById('question_2').style.display='none';
		document.getElementById('question_3').style.display='none';
		document.getElementById('question_'+sec).style.display='block';
	}
       
    function setAnswer()
    { 
		$("#main_form" ).submit();        
    }	
	function loadpopup(part)
	{
		var url = '<?php echo $aLlink?>'+part;
		var title = 'IELTS practice zone';
		
		// Fixes dual-screen position                         Most browsers      Firefox
		var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
		var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

		var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

		var w = width;
		var h = height;
		
		var systemZoom = width / window.screen.availWidth;
		var left = (width - w) / 2 / systemZoom + dualScreenLeft
		var top = (height - h) / 2 / systemZoom + dualScreenTop
		var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w / systemZoom + ', height=' + h / systemZoom + ', top=' + top + ', left=' + left);

		// Puts focus on the newWindow
		if (window.focus) {newWindow.focus();}

		newWindow.onbeforeunload = function(){				
			var url = '<?php echo base_url()."index.php/Exampanel/speakingmodule?ex_id=$ex_id&part="?>'+part;	
			document.getElementById('go_link').href=url;
			document.getElementById('go_link').click();			
		}
	}	
	
	function loadpopupUpload(part)
	{
		var url = '<?php echo $aLlink2?>'+part;
		var title = 'IELTS practice zone';
		
		// Fixes dual-screen position                         Most browsers      Firefox
		var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
		var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

		var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

		var w = width;
		var h = height;
		
		var systemZoom = width / window.screen.availWidth;
		var left = (width - w) / 2 / systemZoom + dualScreenLeft
		var top = (height - h) / 2 / systemZoom + dualScreenTop
		var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w / systemZoom + ', height=' + h / systemZoom + ', top=' + top + ', left=' + left);

		// Puts focus on the newWindow
		if (window.focus) {newWindow.focus();}

		newWindow.onbeforeunload = function(){				
			var url = '<?php echo base_url()."index.php/Exampanel/speakingmodule?ex_id=$ex_id&part="?>'+part;	
			document.getElementById('go_link').href=url;
			document.getElementById('go_link').click();			
		}
	}
	
</script>

<a href='' id='go_link'></a>
</html>