<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="kib theme">
		<meta name="keywords" content="kibidcard, bootstrap,template">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>KIB</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/kalpurush.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
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

		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<!-- search -->
					<div class="row">
						<div class="col-md-12 topnav box_padding">
							<div class="search-container">
								<form action="" method='post'>
									<input type="text" placeholder="Type here..." name="member_id" value='<?php if(isset($msg)){ echo $member_id; } ?>'>
									<button type="submit">SEARCH</button>
									<h4 style='color:red;'><?php if(isset($msg)){ echo $msg; } ?></h4>
								</form>
							</div>
						</div>
					</div>
					<!-- search -->
					<div class="row" <?php if(isset($msg)){ echo "style='display:none;'"; } ?>>
						<div class="col-md-12 aproval_box">
							<div class="col-md-6 col-sm-6 col-xs-6 float-left">Approval Moduel</div>
							<div class="col-md-6 col-sm-6 col-xs-6 text-right"><b>TOTAL: <?php echo $pending_data; ?></b></div>
						</div>
					</div>
					<div class="row bg_color" <?php if(isset($msg)){ echo "style='display:none;'"; } ?>>
						<div class="col-md-3 lib-panel">
							<img class="img-responsive" src="<?php echo "http://kibidcard.com/".$applicant_photo_path; ?>">
						</div>
						<div class="col-md-9 box_padding2" <?php if(isset($msg)){ echo "style='display:none;'"; } ?>>
							<table class="table">
								<tbody>
									<tr class="odds">
										<td class="td1">
											Member ID
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($member_id)){echo $member_id;} ?>
										</td>
									</tr>
									<tr class="evens">
										<td class="td1">
											Member Type
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($member_type)){echo $member_type;} ?>
										</td>
									</tr>
									<tr class="odds">
										<td class="td1">
											Chapter
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
                                            <?php if(isset($zone)){echo $zone;} ?>
										</td>
									</tr>
									<tr class="evens">
										<td class="td1">
											Registration Date
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($submission_date)){echo $submission_date;} ?>
										</td>
									</tr>
									<tr class="odds">
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
								</tbody>	
							</table>
						</div>
					</div>
					
					<div class="row bg_color1" <?php if(isset($msg)){ echo "style='display:none;'"; } ?>>
						<div class="col-md-12">
							<div class="col-md-6 box_padding">
								<div class="col-md-12 reg_box">
									<div class="col-md-9 col-sm-9 col-xs-9 text-left box_padding">Registration Data</div>
									<!--<div class="col-md-3 col-sm-3 col-xs-3 text-right box_padding"><button class="edit_btn">Edit</button></div>-->
								</div>
								
								<table class="table">
									<tbody class="col-md-12 box_padding1">
										<th class="title_hint evens" colspan="4" scope="colgroup">
											<label class="label_hint">PERSONAL INFORMATION</label>
										</th>
										<tr class="odds">
											<td class="td1">
												Member Name
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_mem_name)){echo $old_mem_name;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="evens">
											<td class="td1">
												Father Name
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_father_name)){echo $old_father_name;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="odds">
											<td class="td1">
												Mother Name
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_mother_name)){echo $old_mother_name;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="evens">
											<td class="td1">
												Spouse Name
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_hus_name)){echo $old_hus_name;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="odds">
											<td class="td1">
												Date of Birth
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_dob)){echo $old_dob;}else{echo "N/A";} ?>
											</td>
										</tr>
									</tbody>								
									
									<tbody class="col-md-12 box_padding1">
										<th class="title_hint evens" colspan="4" scope="colgroup">
											<label class="label_hint">ACADEMIC INFORMATION</label>
										</th>
										<tr class="odds">
											<td class="td1">
												Bachelor of
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_mem_graduate)){echo $old_mem_graduate;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="evens">
											<td class="td1">
												Institution Name
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_gr_unv)){echo $old_gr_unv;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="odds">
											<td class="td1">
												Passing Year
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_gr_year)){echo $old_gr_year;}else{echo "N/A";} ?>
											</td>
										</tr>
									</tbody>															
									<tbody class="col-md-12 box_padding1">
										<th class="title_hint evens" colspan="3" scope="colgroup">
											<label class="label_hint">Permanent ADDRESS</label>
										</th>
										<tr class="odds">
											<td class="td1">
												District
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_per_dist_id)){echo $old_per_dist_id;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="evens">
											<td class="td1">
												Police station
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_per_upz_id)){echo $old_per_upz_id;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="odds">
											<td class="td1">
												Village/House
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_per_addr)){echo $old_per_addr;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="evens">
											<td class="td1">
												Post office
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_per_post_off)){echo $old_per_post_off;}else{echo "N/A";} ?>
											</td>
										</tr>
										<tr class="odds">
											<td class="td1">
												Post Code
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($old_per_post_off)){ echo "N/A";}else{echo "N/A";} ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-6 box_padding">
								<div class="col-md-12 reg_box box_padding">
									<div class="col-md-9 col-sm-9 col-xs-9 text-left box_padding">ID Card Data</div>
									<div class="col-md-3 col-sm-3 col-xs-3 text-right box_padding">
									    <button class="edit_btn" onclick="editClickedFalg = true;window.open('<?php echo base_url()."index.php/edit?id=$member_id"?>', '_blank');">Edit</button>
									</div>
								</div>
								<table class="table">
									<tbody class="col-md-12 box_padding1">
										<th class="title_hint evens" colspan="4" scope="colgroup">
											<label class="label_hint">PERSONAL INFORMATION</label>
										</th>
										<tr class="odds">
											<td class="td1">
												Member Name
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($applicant_name)){echo $applicant_name;} ?>
											</td>
										</tr>
										<tr class="evens">
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
										<tr class="odds">
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
										<tr class="evens">
											<td class="td1">
												Spouse Name
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($spouse_name)){echo $spouse_name;} ?>
											</td>
										</tr>
										<tr class="odds">
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
									</tbody>								
									
									<tbody class="col-md-12 box_padding1">
										<th class="title_hint evens" colspan="4" scope="colgroup">
											<label class="label_hint">ACADEMIC INFORMATION</label>
										</th>
										<tr class="odds">
											<td class="td1">
												Bachelor of
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($degree_name) && $degree_name!=''){ echo $degree_name;}else {echo "N/A";} ?>
											</td>
										</tr>
										<tr class="evens">
											<td class="td1">
												Institution Name
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($degree_institute) && $degree_institute!=''){ echo $degree_institute;}else {echo "N/A";} ?>
											</td>
										</tr>
										<tr class="odds">
											<td class="td1">
												Passing Year
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($degree_passing_year) && $degree_passing_year!=''){ echo $degree_passing_year;}else {echo "N/A";} ?>
											</td>
										</tr>
									</tbody>															
									<tbody class="col-md-12 box_padding1">
										<th class="title_hint evens" colspan="3" scope="colgroup">
											<label class="label_hint">Permanent ADDRESS</label>
										</th>
										<tr class="odds">
											<td class="td1">
												District
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($permanent_district) && $permanent_district!=''){ echo $permanent_district;}else {echo "N/A";} ?>
											</td>
										</tr>
										<tr class="evens">
											<td class="td1">
												Police station
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($permanent_upazilla) && $permanent_upazilla!=''){ echo $permanent_upazilla;}else {echo "N/A";} ?>
											</td>
										</tr>
										<tr class="odds">
											<td class="td1">
												Village/House
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($permanent_village) && $permanent_village!=''){ echo $permanent_village;}else {echo "N/A";} ?>
											</td>
										</tr>
										<tr class="evens">
											<td class="td1">
												Post office
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($permanent_post_office) && $permanent_post_office!=''){ echo $permanent_post_office;}else {echo "N/A";} ?>
											</td>
										</tr>
										<tr class="odds">
											<td class="td1">
												Post Code
											</td>
											<td class="td2">
												:
											</td>
											<td class="td3">
												<?php if(isset($permanent_post_code) && $permanent_post_code!=''){ echo $permanent_post_code;}else {echo "N/A";} ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-12 text-right">
							<button class="approve_btn" onclick="window.location.replace('<?php echo base_url()."index.php/approve_data?id=$id&member_id=$member_id&page=$page"?>');">APPROVE</button>
							<button class="reject_btn" onclick="window.location.replace('<?php echo base_url()."index.php/reject_data?id=$id&member_id=$member_id&page=$page"?>');">REJECT</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12"></div>
			</div>
		</div>
		
		<footer class="container-fluid">
			<div class="row">
				<div class="col-md-12 footer">
					<p style="font-size:16px;">Powered by: <a href="https://rezanreza.com/" target="blank" style="text-color:#25527B;text-decoration:underline;">Reza &amp; Reza Solutions</a></p>
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
                    location.reload();
                }
            });
            
            window.addEventListener('blur', function() {
            });
		</script>
    </body>
</html>