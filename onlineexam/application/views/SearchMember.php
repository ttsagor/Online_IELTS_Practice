<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head><meta http-equiv="Content-Type" content="text/html; charset=ibm866">
		
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="krishibid">
		<meta name="keywords" content="kibidcard, bootstrap,template">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>KIB</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <!-- <link href="css/ihover.css" rel="stylesheet"> -->
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet">
		<!--======= Responsive Bootstrap Carousel StyleSheet =========-->
		<script>
		    var editClickedFalg = false;
		</script>
    </head>
    <body class="bgimg">
		<nav class="navbar affix-top" role="navigation" id="BB-nav">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<div class="logo">
						<a href="<?php echo base_url(); ?>index.php/dashboard"><img src="<?php echo base_url(); ?>assets/images/logo.png"><span>Kirishibid<span class="cus_or1"> I</span>nstitution Bangladesh</span></a>
					</div>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="BB-nav">
					<ul class="nav navbar-nav navbar-right">
						<li>
						    <a href="<?php echo base_url()."index.php/admin_search"; ?>" class="animate">Search</a>
						</li>
						<li class="devider"></li>
						<li>
						    <a href="<?php echo base_url()."index.php/approve"; ?>" class="animate">Approve</a>
						</li>
						<li class="devider"></li>
						<li>
						    <a href="<?php echo base_url()."index.php/reject_list"; ?>" class="animate">Reject List</a>
						</li>
						<li class="devider"></li>
						<li>
						    <a href="<?php echo base_url()."index.php/AdminPanel/sign_out"; ?>" class="animate">Sign Out</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<form method='post' action='<?php echo base_url().$target; ?>'>
    		<div class="container">
    			<div class="row">
    				<div class="col-md-4 col-md-offset-4 search_form">
    					<div class="input-group">
    						<input type="text" placeholder='Member ID' class="form-control" id='member_id' name='member_id' value='<?php if(isset($member_id)){echo $member_id;}?>'>
    						<div class="input-group-btn">
    							<button type="submit" class="btn btn-primary" id='submit_btn'>Search</button>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
		</form>
		<?php 
    		if(isset($member_id) && !isset($applicant_name))
    		{
        ?>
                <div class="section_search_one" style='text-align:center;'>
        		    <h3 style='color:red;' >Member not registered / No Member Found</h3>
        		</div>
        <?php
    		} 
		?>
		
		<div class="section_search_one" <?php if(!isset($applicant_name)){echo "style='display:none;'";} ?> >
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 search_page box_padding1">
						<div class="col-md-3 box_padding1">
							<div class="col-md-12 col-sm-12 user-image">
								<img class="img-responsive" src="<?php 
								                                       if(@getimagesize("http://kibidcard.com/".$applicant_photo_path))
								                                       {
                                                                          echo "http://kibidcard.com/".$applicant_photo_path;
                                                                       } 
                                                                       else
                                                                       {
                                                                          echo base_url()."assets/images/profile.jpg";
                                                                       }
                                                                  ?>"/>
							</div>
							<div class="col-md-12 col-sm-12 search_result_part">
								<label class="border_bottom">Member ID :</label>
								<label class="show_result"><?php if(isset($member_id)){echo $member_id;} ?></label>
								<label class="border_bottom">Member Type :</label>
								<label class="show_result"><?php if(isset($member_type)){echo $member_type;} ?></label>
								<label class="border_bottom">Chapter :</label>
								<label class="show_result"><?php if(isset($zone)){echo $zone;} ?></label>
							</div>
						</div>
						
						<div class="col-md-9">
							<div class="col-md-12 col-sm-12 col-xs-12 box_padding1 status_box">
								<div class="col-md-11 col-sm-11 col-xs-10 status">
									<h5>Registration Status: <?php echo $form_status; ?></h5>
									<h5>Approve Status: <?php echo $approve_status; ?></h5>
								</div>	
								<div class="col-md-1 col-sm-1 col-xs-2 box_padding1">
									<button class="btn_edit btn-default" onclick="editClickedFalg = true;window.open('<?php echo base_url()."index.php/edit?id=$member_id"?>', '_blank');">
									    <img src="<?php echo base_url(); ?>assets/images/editt.png" alt="edit" />
									</button>
								</div>	
							</div>
							<br />						
							<table class="table">
								<tbody class="col-md-12 box_padding1">
									<tr class="border_tr">
										<td class="td1">
											Name
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_name)){echo $applicant_name;} ?>
										</td>
									</tr>
									<tr class="border_tr">
										<td class="td1">
											Father Name
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($fathers_name)){echo $fathers_name;} ?>
										</td>
									</tr>
									<tr class="border_tr">
										<td class="td1">
											Mother Name
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($mothers_name)){echo $mothers_name;} ?>
										</td>
									</tr>
									<tr class="border_tr">
										<td class="td1">
											Date of Birth
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
										    <?php if(isset($applicant_dob)){echo $applicant_dob;} ?>
										</td>
									</tr>
									<tr class="border_tr">
										<td class="td1">
											NID
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_nid)){echo $applicant_nid;} ?>
										</td>
									</tr>
									<tr class="border_tr">
										<td class="td1">
											Permanent Address
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											Vill: <?php if(isset($permanent_village)){echo $permanent_village;}?>; P.O: <?php if(isset($permanent_post_office)){echo $permanent_post_office;}?>; P.S: <?php if(isset($permanent_upazilla)){echo $permanent_upazilla;}?>; <?php if(isset($permanent_district)){echo $permanent_district;}?>.
										</td>
									</tr>
									<tr class="border_tr">
										<td class="td1">
											Mobile Number
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($mobile)){echo $mobile;} ?>
										</td>
									</tr>
									<tr class="border_tr">
										<td class="td1">
											Email Address
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($email)){echo $email;} ?>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="col-md-12">
								<div class="more_info">
									<button href="##" class="btn btn-primary" onclick="window.open('<?php echo base_url()."index.php/details?id=$member_id"?>', '_blank');">More Details</button>
									<button type="#" name="button" class="btn btn-primary" id="">Print</button>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		
		<footer class="container-fluid">
    		<div class="row">
    			<div class="col-md-12 footer">
    			    <p style='font-size:16px;'>Powered by: <a href="https://rezanreza.com/" target='blank' style='text-color:#25527B;text-decoration:underline;'>Reza &amp; Reza Solutions</a></p>
    			</div>
    		</div>
    	</footer>
		<!-- script js -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		<script>
		    window.addEventListener('focus', function() {
		        if(editClickedFalg)
                {
                    editClickedFalg = false;
                    document.getElementById('submit_btn').click();
                }
            });
            
            window.addEventListener('blur', function() {
            });
		</script>
    </body>
</html>