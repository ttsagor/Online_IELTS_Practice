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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
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
				<div class="col-md-10 col-md-offset-1 cus_bg">
					<div class="col-md-12 reject_box">
						<div class="col-md-6 col-sm-6 col-xs-6 float-left">Approval Moduel</div>
						<div class="col-md-6 col-sm-6 col-xs-6 text-right"><b>TOTAL: <?php echo $members_size; ?></b></div>
					</div>
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>SL</th>
								<th>Member ID</th>
								<th>Member Type</th>
								<th>Name</th>
								<th>Father Name</th>
								<th>Date of Birth</th>
								<th>NID</th>
								<th>Action</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							<!--<tr class="linking">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>Approval<span>*</span></td>
								<td>Details<span>*</span></td>
							</tr>-->
							<?php 
							$count=1;
							foreach ($members as $member)
                            {?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $member->member_id; ?></td>
								<td><?php echo $member->member_type; ?></td>
								<td><?php echo $member->applicant_name; ?></td>
								<td><?php echo $member->fathers_name; ?></td>
								<td><?php echo $member->applicant_dob; ?></td>
								<td><?php echo $member->applicant_nid; ?></td>
								<td>
								    <a style='text-decoration:underline;color:green;' href='<?php echo base_url()."index.php/approve_data?id=".$member->id."&member_id=".$member->member_id."&page=reject_list"?>'>Approve</a>
								</td>
								<td>
								    <a style='text-decoration:underline;color:blue;' href='<?php echo base_url()."index.php/approve?id=".$member->id."&member_id=".$member->member_id."&page=reject_list"?>'>View</a>
								</td>
							</tr>
							<?php $count++; } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Member ID</th>
								<th>Member Type</th>
								<th>Name</th>
								<th>Father Name</th>
								<th>Date of Birth</th>
								<th>NID</th>
								<th>Action</th>
								<th>View</th>
							</tr>
						</tfoot>
					</table>
				</div>
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
		<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/table_js/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/table_js/custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/table_js/data_table.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
		</script>
		<!-- Bootstrap dataTables -->
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    </body>
</html>