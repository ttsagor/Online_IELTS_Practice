<!DOCTYPE html>
<html lang="fa">
  
<!-- Mirrored from bside.smaroofi.com/bside/demo.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Dec 2018 14:44:17 GMT -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>IELTS Practice zone</title>

 	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/css/font-awesome.css" /> 

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/form-builder/js/Sortable.min.js"></script>  
	<script src="<?php echo base_url(); ?>assets/form-builder/js/tidy.html"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/SJL.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/textbox.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/textarea.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/checkbox.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/combobox.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/sectionbreaker.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/label.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/fieldset.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/header.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/button.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/blank.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/hyperlink.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/paragraph.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/form.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/message.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/elementattrib.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/editor.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/colorpicker.js"></script>	
	<script src="<?php echo base_url(); ?>assets/form-builder/js/rating.js"></script>	
	<script src="<?php echo base_url(); ?>assets/form-builder/js/slider.js"></script>	
	<script src="<?php echo base_url(); ?>assets/form-builder/js/hbox.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/config.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/iconpicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/container.js"></script>
	<script src="<?php echo base_url(); ?>assets/form-builder/js/custom_functions.js"></script>
    
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/css/SJL.css" />
	<!--
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/form-builder/bootstrap.rtl.css" />
	-->
	
	<style>
        @media screen and (max-width: 768px) {
            #main_panel_dom {
                width: 100%;
                background-color:red;
            }
        }
	</style>
	<script>
	    function calll()
	    {
	        if(!attrib.is_first_element_set)
	        {
	            alert('Please Create a Form');
	            return;
	        }
	        var d =$("#main_panel_dom" ).html();
	        $("#formdata" ).val(d);
            $("#form" ).submit();
	    }
	</script>
	</head>

  <body class=''  style="background:rgba(0, 0, 0, 0) url('image/16.jpg') no-repeat fixed 0 0 / 100% auto">
  <form method='post' action='<?php echo base_url(); ?>index.php/AdminPanel/readingquestionaddpassageformsubmit' id='form'>
	   <input type='hidden' name='tid' value='<?php echo $tid; ?>' />
	   <input type='hidden' name='sec' value='<?php echo $sec; ?>' />
	   <input type='hidden' name='form' id='formdata' value='' />
	</form>
  <button type="button" class="btn btn-primary" style='float:right' onclick='calll()'>Next</button>
  
		<div class="sjl_container-fluid" style="padding-left:0px;padding-right:0px;margin-top:20px;margin:0;">
			<div id='mysidebar' class="sjl_col-sm-2" style="min-width:350px;width:320px;">
				<div class="sjl_sidebar-nav">
					<div id='sourena' class='sjl_panel sjl_panel-default' style="border:4px inset lightgray;padding-left:0;padding-right:0;margin-top:18px;">
						<div class="sjl_panel-heading" style="border-bottom: 1px solid gray;">
							<h3 class="sjl_panel-title"><span style='cursor:pointer' onclick="attrib.get_author_detail();">Detail </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<!--
                                <i class='menu-icon fa fa-arrow-down' title="Download page code" onclick="attrib.download_page_code()" style='cursor:pointer;'></i>&nbsp;&nbsp;
								<i class='' title="Download JSON Code" onclick="attrib.download_json_code()" style='cursor:pointer;'><b>#</b></i>&nbsp;&nbsp;
								<i class='menu-icon fa fa-eye' title="Display element code" style='cursor:pointer;' onclick="attrib.view_code()"></i>&nbsp;&nbsp;
								<i class='menu-icon fa fa-pagelines' title="display page code" style='cursor:pointer;' onclick="attrib.view_page_code()"></i>
								-->
                                <div class="sjl_btn-group">
                                    <button style="line-height:1;border:solid gray 1px;background-color:#f5f5f5;" onclick="bside_close_drop_down();attrib.view_page_code();" class="sjl_btn sjl_btn-default">
                                        Export
                                    </button> 
                                    <button data-toggle="dropdown" class="sjl_btn sjl_btn-default sjl_dropdown-toggle" style="line-height:1;border:solid gray 1px;background-color:#f5f5f5;">
                                        <span class="sjl_caret"></span>
                                    </button>
                                    <ul class="sjl_dropdown-menu">
                                        <li>
                                            <a href="#" onclick="bside_close_drop_down();attrib.view_page_code();">Export HTML</a>
                                        </li>
                                        <li class="">
                                            <a href="#" onclick="bside_close_drop_down();attrib.download_json_code();">Export JSON</a>
                                        </li>
                                        <li class="">
                                            <a href="#" onclick="bside_close_drop_down();attrib.view_code()">Export Component HTML</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" onclick="bside_close_drop_down();attrib.download_page_code();">Download Zip package</a>
                                        </li>
                                    </ul>
                                </div>
                                <i  class="sjl_menu-icon sjl_fa fa-arrows dragg_menu_bar" title="drag menu bar" style="cursor: pointer; float: right;disabled:true;" ></i>	
								<i style="float:right;">&nbsp;&nbsp;</i>
								<i class="sjl_menu-icon sjl_fa fa-minus collapse_expand_menu" style="cursor: pointer; float: right;" title="Collapse - Expand"></i>
							</h3>
						</div>
						<div class="sjl_panel-body" style="padding-bottom:0;">
							<form class="sjl_form-horizontal">
								<ul class="sjl_nav sjl_nav-tabs">
									<li role="presentation" class="sjl_active"><a href="#" class="property-form-tab tools_menu_tab" onclick="bb('tools_menu');return false;" style="font-family:tahoma;">Tools</a></li>
									<li role="presentation"><a href="#" class="property-form-tab page_menu_tab" onclick="bb('page_menu');return false;">Page</a></li>
									<li role="presentation"><a href="#" class="property-form-tab element_menu_tab" onclick="bb('element_menu');return false;">Element</a></li>
									<li role="presentation"><a href="#" class="property-form-tab misc_menu_tab" onclick="bb('misc_menu');return false;">Misc</a></li>
								</ul>
							</form>
							<div class="sjl_navbar sjl_navbar-default" id="tools_menu" style="overflow-y:auto;">
								<ul class="sjl_nav sjl_navbar-nav">
									<li>
										<a href="#" class="sjl-form-class" onclick="on_form_clicked()">
											<i class="sjl_menu-icon sjl_fa fa-foursquare"></i>
											<span class="sjl_menu-text"> Form </span>
										</a>
										<script>function on_form_clicked(){if(cfes('form')==true){attrib.form_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-hbox-class" onclick="on_hbox_clicked()">
											<i class="sjl_menu-icon sjl_fa fa-columns"></i>
											<span class="sjl_menu-text">Row</span>
										</a>
										<script>function on_hbox_clicked(){if(cfes('hbox')==true){attrib.hbox_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-blank-class" onclick="on_blank_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-square-o"></i>
											<span class="sjl_menu-text">Blank</span>
										</a>
										<script>function on_blank_clicked(){if(cfes('blank')==true){attrib.blank_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-paragraph-class" onclick="on_paragraph_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-paragraph"></i>
											<span class="sjl_menu-text">Paragraph</span>
										</a>
										<script>function on_paragraph_clicked(){if(cfes('paragraph')==true){attrib.paragraph_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-hyperlink-class" onclick="on_hyperlink_clicked();">
											<i class="sjl_menu-icon sjl_fa  fa-link"></i>
											<span class="sjl_menu-text"> Link </span>
										</a>
										<script>function on_hyperlink_clicked(){if(cfes('hyperlink')==true){attrib.hyperlink_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-header-class" onclick="on_header_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-header"></i>
											<span class="sjl_menu-text">Header</span>
										</a>
										<script>function on_header_clicked(){if(cfes('header')==true){attrib.header_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-label-class" onclick="on_label_clicked();">
											<i class="sjl_menu-icon  sjl_fa fa-font"></i>
											<span class="sjl_menu-text"> Label </span>
										</a>
										<script>function on_label_clicked(){if(cfes('label')==true){attrib.label_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-textbox-class" onclick="on_textbox_clicked();">
											<i class="sjl_menu-icon  sjl_fa fa-pencil"></i>
											<span class="sjl_menu-text"> Textbox </span>
										</a>
										<script>function on_textbox_clicked(){if(cfes('textbox')==true){attrib.textbox_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-textarea-class" onclick="on_textarea_clicked();">
											<i class="sjl_menu-icon  sjl_fa fa-pencil-square-o"></i>
											<span class="sjl_menu-text"> Textarea </span>
										</a>
										<script>function on_textarea_clicked(){if(cfes('textarea')==true){attrib.textarea_attrib(true);return false;}}</script>
									</li>
									<!--
									<li>
										<a href="#"  onclick="on_datepicker_clicked();">
											<i class="menu-icon fa fa-calendar"></i>
											<span class="menu-text"> Date </span>
										</a>
										<script>function on_datepicker_clicked(){if(cfes('datepicker')==true){attrib.datepicker_attrib(true);return false;}}</script>
									</li>
									-->
									<li>
										<a href="#" class="sjl-password-class" onclick="on_password_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-asterisk"></i>
											<span class="sjl_menu-text"> Password </span>
										</a>
										<script>function on_password_clicked(){if(cfes('password')==true){attrib.password_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-number-class" onclick="on_number_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-slack"></i>
											<span class="sjl_menu-text"> Number </span>
										</a>
										<script>function on_number_clicked(){if(cfes('number')==true){attrib.number_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-email-class" onclick="on_email_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-envelope"></i>
											<span class="sjl_menu-text"> Email </span>
										</a>
										<script>function on_email_clicked(){if(cfes('email')==true){attrib.email_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-radiobox-class" onclick="on_radiobox_clicked()" >
											<i class="sjl_menu-icon sjl_fa  fa-list-ul"></i>
											<span class="sjl_menu-text"> Radiobox </span>
										</a>
										<script>function on_radiobox_clicked(){SJL.message.error("DEMO VERSION","NOT AVAILABLE IN DEMO VERSION")}</script>
									</li>
									<li>
										<a href="#" class="sjl-checkbox-class" onclick="on_checkbox_clicked();">
											<i class="sjl_menu-icon sjl_fa  fa-check-square-o"></i>
											<span class="sjl_menu-text"> Checkbox </span>
										</a>
										<script>function on_checkbox_clicked(){if(cfes('checkbox')==true){attrib.checkbox_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-combobox-class" onclick="on_combobox_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-bars"></i>
											<span class="sjl_menu-text"> Combobox </span>
										</a>
										<script>function on_combobox_clicked(){if(cfes('combobox')==true){attrib.combobox_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-fieldset-class" onclick="on_fieldset_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-square-o"></i>
											<span class="sjl_menu-text"> Fieldset </span>
										</a>
										<script>function on_fieldset_clicked(){if(cfes('fieldset')==true){attrib.fieldset_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-sectionbreaker-class" onclick="on_sectionbreaker_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-code"></i>
											<span class="sjl_menu-text"> Section breaker </span>
										</a>
										<script>function on_sectionbreaker_clicked(){if(cfes('sectionbreaker')==true){attrib.sectionbreaker_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-button-class" onclick="on_button_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-circle"></i>
											<span class="sjl_menu-text"> Button </span>
										</a>
										<script>function on_button_clicked(){if(cfes('button')==true){attrib.button_attrib(true);return false;}}</script>
									</li>
									<!--
										<li>
											<a href="#" class='disabled' onclick="return false;">
												<i class="menu-icon fa fa-toggle-on"></i>
												<span class="menu-text"> Switch </span>
											</a>
										</li>
									-->
									<li>
										<a href="#" class="sjl-slider-class" onclick="on_slider_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-sliders"></i>
											<span class="sjl_menu-text"> Slider (HTML5) </span>
										</a>
										<script>function on_slider_clicked(){if(cfes('slider')==true){attrib.slider_attrib(true);return false;}}</script>
									</li>
									
									<li>
										<a href="#" class="sjl-rating-class" onclick="on_rating_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-star"></i>
											<span class="sjl_menu-text"> Rating </span>
										</a>
										<script>function on_rating_clicked(){if(cfes('rating')==true){attrib.rating_attrib(true);return false;}}</script>
									</li>
									<li>
										<a href="#" class="sjl-uploadfile-class" onclick="on_uploadfile_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-upload"></i>
											<span class="sjl_menu-text"> File Upload </span>
										</a>
										<script>function on_uploadfile_clicked(){SJL.message.error("DEMO VERSION","NOT AVAILABLE IN DEMO VERSION")}</script>
									</li>
									<li>
										<a href="#" class="sjl-image-class" onclick="on_image_clicked();">
											<i class="sjl_menu-icon sjl_fa fa-image"></i>
											<span class="sjl_menu-text"> Image </span>
										</a>
										<script>function on_image_clicked(){SJL.message.error("DEMO VERSION","NOT AVAILABLE IN DEMO VERSION")}</script>
									</li>


								</ul>
							</div>
							<div id="page_menu" style="display:none;border:1px solid lightgray;margin-top:2px;">
								<ul class="" style="overflow-y:auto;"></ul>
							</div>
							<div id="element_menu" style="display:none;margin:10px 2px;border:1px solid lightgray;">
								<ul class="" style="overflow-y:auto;">
									<br />
									<b>No Element selected!!!</b>
									<!-- generate li tag here by javascript code -->
								</ul>
							</div>
							<div id="misc_menu" style="display:none;border:1px solid lightgray;margin-top:2px;">
								<ul class="" >
									
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id='main_panel_dom' class="sjl_container sjl_col-lg-8 sjl_col-md-7 sjl_col-sm-6 sjl_col-xs-5" style="background-image:url('image/grid.jpg');min-height:200px;border:10px ridge lightblue;padding:5px;margin-top:20px;margin-right:20px;">
					<?php 
					    if(isset($passage) && $passage!='')
					    {
					        echo html_entity_decode($passage);
					    }
					    else
					    {
					     ?>
					        <div id="main_design_span" class="" style='padding-top:82px;min-height:200px;text-align:center;font-family:tahoma;'>
            						<i style='font-size:1.5em'>This is the design area...add form or container here!!!</i>
            				</div>
					     <?php
					    }
					?>
			</div>
			
		</div>	
			

			<script>

			/*code for activate/deactivate the tab panel bar by click on it(using SJL library).*/
			SJL.dom('.property-form-tab').click(function(){
				SJL.dom(this).parent().siblings().remove_css_class('sjl_active');
				SJL.dom(this).parent().add_css_class('sjl_active');
				
			});
			function bb(tag_id){
				SJL.dom("#tools_menu").hide();
				SJL.dom("#element_menu").hide();
				SJL.dom("#misc_menu").hide();
				SJL.dom("#page_menu").hide();
				SJL.dom("#"+tag_id).show();
				if(tag_id=='page_menu'){
					attrib.page_view();
				}
				
			}

            function bside_close_drop_down(){
                SJL.dom("button.sjl_btn.sjl_btn-default.sjl_dropdown-toggle").parent().remove_css_class("sjl_open");return;
            }
			</script>
			
	<script>
		window.onload=function() {
                SJL.dom("button.sjl_btn.sjl_btn-default.sjl_dropdown-toggle").click(function(e){
                    SJL.dom(e.target).parent().toggle_css_class('sjl_open');
                });
                
        /*
				//Sortable.create(SJL.dom('div#tools_menu > ul.nav.navbar-nav')[0]);
				SJL.add_event(SJL.dom('.dragg_menu_bar')[0],'mousedown',function(){
						SJL.dom("#mysidebar").draggable();
						//remove col-xx-x css from main_panel_dom
						SJL.dom("#main_panel_dom").remove_css_class('col-lg-8').remove_css_class('col-md-7').remove_css_class('col-sm-6').remove_css_class('col-xs-5').remove_css_class('container').add_css_class('container-fluid');
						SJL.dom("#main_panel_dom").set_style('margin-left','20px');
						SJL.dom("#main_panel_dom").set_style('marigin-right','20px');
						
					},[]);
				SJL.add_event(SJL.dom('.dragg_menu_bar')[0],'mouseup',function(){
						SJL.dom("#mysidebar")[0].onmousedown=null;
						SJL.dom("#mysidebar")[0].onmouseup=null;
						document.onmousemove=null;
						SJL.dom("#mysidebar")[0].onmousemove=null;
						SJL.dom("#mysidebar").remove_css_class('user_select_text_none');
				},[]);

        */

				SJL.add_event(SJL.dom('.collapse_expand_menu')[0],'click',function(){
					if(SJL.trim(SJL.dom("#sourena").get_children(".sjl_panel-body").get_style('display')[0])=='none'){
						SJL.dom("#sourena").get_children(".sjl_panel-body").show();
						SJL.dom(this).remove_css_class('fa-plus');
						SJL.dom(this).add_css_class('fa-minus');
					}else{
						SJL.dom("#sourena").get_children(".sjl_panel-body").hide();	
						SJL.dom(this).remove_css_class('fa-minus');
						SJL.dom(this).add_css_class('fa-plus');
					}
						
				},[]);
		
			
			var height = window.innerHeight;
			var main_panel = document.getElementById('main_panel_dom');
			var main_design_panel = document.getElementById('main_design_span');
            var tools_menu = document.getElementById('tools_menu');
            var page_menu = document.getElementById('page_menu');
			var page_menu_ul = SJL.dom("#page_menu > ul")[0];
            var element_menu_ul = SJL.dom('#element_menu > ul')[0];
            var misc_menu = document.getElementById('misc_menu');
            
            
			main_panel.style.minHeight=height * 0.9 + 'px';
			main_panel.style.maxHeight=height * 0.9 + 'px';
            main_panel.style.overflow='auto';
            
            tools_menu.style.maxHeight = (height * 0.9)-130 + 'px';
            tools_menu.style.minHeight = (height * 0.9)-130 + 'px';
            tools_menu.style.overflow = 'auto';
            
            page_menu_ul.style.maxHeight = (height * 0.9)-165 + 'px';
            page_menu_ul.style.minHeight = (height * 0.9)-165 + 'px';
            page_menu_ul.style.overflow = 'auto';
            
            element_menu_ul.style.maxHeight = (height * 0.9)-170 + 'px';
            element_menu_ul.style.minHeight = (height * 0.9)-170 + 'px';
            element_menu_ul.style.overflow = 'auto';
            
            misc_menu.style.maxHeight = (height * 0.9)-130 + 'px';
            misc_menu.style.minHeight = (height * 0.9)-130 + 'px';
            misc_menu.style.overflow = 'auto';
            
            
            
            
			
            main_design_panel.style.minHeight = height * 0.85 + 'px';
			main_design_panel.style.maxHeight = height * 0.85 + 'px';
			SJL.dom(main_design_panel).set_style('min-height',height * 0.85 + 'px');
            SJL.dom(main_design_panel).set_style('max-height',height * 0.85 + 'px');
            SJL.dom(main_design_panel).set_style('overflow-y','auto');
			SJL.dom(main_design_panel).set_style('padding-top',height * 0.8 / 2 + 'px');
			attrib.misc();
			/* test  hbox */
			SJL.dom("ul.sjl_nav.sjl_navbar-nav li").set_attr('draggable',true);
			
			SJL.dom("ul.sjl_nav.sjl_navbar-nav li").dragstart(function(ev){
				var dname = ev.target.className;
				dname = dname.split(" ");
				for(var i=0;i<dname.length;++i){
					if(dname[i].search("(^sjl-)([a-z]+)(-class$)")!=-1){
					
						var t = dname[i].split('-');
						if(t.length==3){
							var data = t[1];
							var component;
							var ctype  ;
							if(data=="email" || data=="number" || data=="mellicode" || data=="password" || data=="money"){
								ctype= data;
								component = "textbox";
							}else if(data =="textbox"){component="textbox";ctype="text";}else{
								component = data;
								ctype = data;
							}
							ev.dataTransfer.setData("component",component);
							ev.dataTransfer.setData("type",ctype);
						}else{
							ev.dataTransfer.setData("component","blank");
							ev.dataTransfer.setData("type","blank");
						}
					}else{
						ev.dataTransfer.setData("component","blank");
						ev.dataTransfer.setData("type","blank");
					}
				}	
			});
			if(SJL.is_object(bside) && SJL.is_object(bside.config)){
				for (var panel in bside.config.tabPanel){
					if(bside.config.tabPanel[panel]['hidden'] == true){
						console.log(panel);
						SJL.dom(".property-form-tab." + bside.config.tabPanel[panel]['id']).hide();
					}
				}
				for (var tool in bside.config.Components){
					if(bside.config.Components[tool]['hidden'] == true){
						SJL.dom("." + "sjl-" + tool + "-class").set_style('display','none');
					}
				}
			}
		};
		<?php 
			if(isset($passage) && $passage!='')
			{
				echo "attrib.is_first_element_set=true;";
			}
		?>
	</script>
	</body>
	
<!-- Mirrored from bside.smaroofi.com/bside/demo.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Dec 2018 14:44:45 GMT -->
</html>
