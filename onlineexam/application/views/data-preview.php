<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="krisbid">
		<meta name="keywords" content="krisbid">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>KIB</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style-3.css" rel="stylesheet">
        <!-- <link href="css/ihover.css" rel="stylesheet"> -->
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet">
		<!--======= Responsive Bootstrap Carousel StyleSheet =========-->
    </head>
    <body class="bgimg">
		<nav class="navbar affix-top" role="navigation" id="BB-nav">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="text-center">
					<div class="logo">
						<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"><span>Kirishibid<span class="cus_or1"> I</span>nstitution Bangladesh</span></a>
					</div>
				</div>
			</div>
		</nav>
		
		<div class="section_search">
			<div class="container">
				<div class="row">
					
					<div class="col-md-8 col-md-offset-2 search-details box_padding1">
						<div class="col-md-3 box_padding1">
							<div class="col-md-12 col-sm-12 user-image">
								<img class="img-responsive" src="<?php echo "http://kibidcard.com/".$applicant_photo_path; ?>"'/>
							</div>
							<div class="col-md-12 col-sm-12 search_result_details">
								<label class="border_bottom">Member ID :</label>
								<label class="show_result"><?php if(isset($member_id) && $member_id!=''){ echo $member_id; }else {echo "N/A";} ?></label>
								<label class="border_bottom">Member Type :</label>
								<label class="show_result"><?php if(isset($member_type) && $member_type!=''){ echo $member_type;}else {echo "N/A";} ?></label>
								<label class="border_bottom">Chapter :</label>
								<label class="show_result"><?php if(isset($zone) && $zone!=''){ echo $zone; }else {echo "N/A";}?></label>
								<label class="border_bottom">Mobile Number :</label>
								<label class="show_result"><?php if(isset($mobile) && $mobile!=''){ echo $mobile;}else {echo "N/A";} ?></label>
								<label class="border_bottom">E-mail :</label>
								<label><?php if(isset($email) && $email!=''){ echo $email;}else {echo "N/A";} ?></label>
							</div>
						</div>
						
						<div class="col-md-9 box_padding1">
							<table class="table">
								<tbody class="col-md-12 box_padding1">
									<th id="par" class="span" colspan="4" scope="colgroup">
										<label class="border_bottom_details"><span style='color:yellow;text-decoration:underline;font-weight:bold;'>Information Review </span> <br/> Personal INFORMATION</label>
									</th>
									
									<tr class="odd">
										<td class="td1">
											Name
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_name) && $applicant_name!=''){ echo $applicant_name;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="even">
										<td class="td1">
											Date of Birth
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_dob) && $applicant_dob!=''){ echo $applicant_dob;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="odd">
										<td class="td1">
											National ID Card No
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_nid) && $applicant_nid!=''){ echo $applicant_nid;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="even">
										<td class="td1">
											Gneder
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_gender) && $applicant_gender!=''){ echo $applicant_gender;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="odd">
										<td class="td1">
											Religion
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_religion) && $applicant_religion!=''){ echo $applicant_religion;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="even">
										<td class="td1">
											Blood Group
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_blood_group) && $applicant_blood_group!=''){ echo $applicant_blood_group;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="odd">
										<td class="td1">
											Remarkable impairment
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_impairment) && $applicant_impairment!=''){ echo $applicant_impairment;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="even">
										<td class="td1">
											Physical Disabilities
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_disabilities) && $applicant_disabilities!=''){ echo $applicant_disabilities;}else {echo "N/A";} ?>
										</td>
									</tr>
								</tbody>
								<tbody class="col-md-12 box_padding1">
									<th id="par" class="span" colspan="4" scope="colgroup">
										<label class="border_bottom_details">ACADEMIC INFORMATION</label>
									</th>
									
									<tr class="odd">
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
									<tr class="even">
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
									<tr class="odd">
										<td class="td1">
											Passing year
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
									<th id="par" class="span" colspan="4" scope="colgroup">
										<label class="border_bottom_details">Professional INFORMATION</label>
									</th>
									<tr class="odd">
										<td class="td1">
											Professional
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($applicant_profession) && $applicant_profession!=''){ echo $applicant_profession;}else {echo "N/A";} ?>
										</td>
									</tr>
								</tbody>
								<tbody class="col-md-6 box_padding1">
									<th id="par" class="span" colspan="4" scope="colgroup">
										<label class="border_bottom_details">Present ADDRESS</label>
									</th>
									<tr class="odd">
										<td class="td1">
											District
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($present_district) && $present_district!=''){ echo $present_district;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="even">
										<td class="td1">
											Village/House
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($present_village) && $present_village!=''){ echo $present_village;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="odd">
										<td class="td1">
											Road/Block/Sector
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($present_road) && $present_road!=''){ echo $present_road;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="even">
										<td class="td1">
											Post office
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($present_post_office) && $present_post_office!=''){ echo $present_post_office;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="odd">
										<td class="td1">
											Post Code
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($present_post_code) && $present_post_code!=''){ echo $present_post_code;}else {echo "N/A";} ?>
										</td>
									</tr>
								</tbody>								
								<tbody class="col-md-6 box_padding1">
									<th id="par" class="span" colspan="3" scope="colgroup">
										<label class="border_bottom_details">Permanent ADDRESS</label>
									</th>
									<tr class="odd">
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
									<tr class="even">
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
									<tr class="odd">
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
									<tr class="even">
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
									<tr class="odd">
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
								<tbody class="col-md-12 box_padding1">
									<th id="par" class="span" colspan="4" scope="colgroup">
										<label class="border_bottom_details">Family INFORMATION</label>
									</th>
									<tr class="odd">
										<td class="td1">
											Mother's Name
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($mothers_name) && $mothers_name!=''){ echo $mothers_name;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="even">
										<td class="td1">
											Father's Name
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($fathers_name) && $fathers_name!=''){ echo $fathers_name;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="odd">
										<td class="td1">
											Spouse Name
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($spouse_name) && $spouse_name!=''){ echo $spouse_name;}else {echo "N/A";} ?>
										</td>
									</tr>
									<tr class="even">
										<td class="td1">
											Number of Child
										</td>
										<td class="td2">
											:
										</td>
										<td class="td3">
											<?php if(isset($number_of_children) && $number_of_children!=''){ echo $number_of_children;}else {echo "N/A";} ?>
										</td>
									</tr>
								</tbody>
								<tbody class="col-md-12 box_padding1">
									<th id="par" class="span" colspan="4" scope="colgroup">
										<label class="border_bottom_details">Children DETAILS</label>
									</th>
									<?php 
										foreach ($childrens as $children)
                                        {
									?>
											<tr class="odd">
												<td class="td1">
													Name
												</td>
												<td class="td2">
													:
												</td>
												<td class="td3">
													<?php if(isset($children->name) && $children->name!=''){ echo $children->name;}else {echo "N/A";} ?>
												</td>
											</tr>
											<tr class="even">
												<td class="td1">
													Gneder
												</td>
												<td class="td2">
													:
												</td>
												<td class="td3">
													<?php if(isset($children->gender) && $children->gender!=''){ echo $children->gender;}else {echo "N/A";} ?>
												</td>
											</tr>
									<?php 
										}
									?>	
									<tr>
										<td colspan="4" scope="colgroup">
											<span class="btn_confirm">
												  <Button class="btn btn-primary" onclick='window.close();'>Close</Button>
											</span>
										</td>
									</tr>
								</tbody>
							</table>
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
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>