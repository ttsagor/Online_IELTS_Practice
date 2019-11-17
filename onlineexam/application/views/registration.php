<!DOCTYPE html>
<html class="full" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="krisibid">
    <meta name="keywords" content="kib,krisibid,id card id">

    <title>Krishibid</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style-1.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        var upazillas = new Array ( );
        <?php
            $count=0;
            foreach ($upazillas as $upazilla)
            {
                $district_id = $upazilla->district_id;
                $upazilla_id = $upazilla->upazilla_id;
                $upazilla_en = $upazilla->upazilla_en;
                echo "upazillas[$count]= new Array ('".$district_id."','".$upazilla_id."',\"".$upazilla_en."\");";
                $count++;
            }
        ?>
    </script>
    <script>
	var num_of_child= <?php echo $number_of_children; ?>;
	function addChildren()
	{
	    var num = 0;
	    if(document.getElementById('number_of_children').value!='')
	    {
	        num = parseInt(document.getElementById('number_of_children').value);
	    }
		 
		if(num > num_of_child)
		{
			var i=0;
			for (i = num_of_child+1; i <= num; i++) 
			{ 
				if(document.getElementById('children_'+i))
				{
					document.getElementById('children_'+i).style.display = 'block';
				}
				else
				{
					var str = '<div id="children_'+i+'"><div class="form-group space"> <label for="Name" class="col-sm-5 control-label">Name</label> <div class="col-sm-7"> <input class="form-control" type="text" name="child_name[]" maxlength="38"> </div> </div> <div class="form-group space"> <label for="Gneder" class="col-sm-5 col-md-5 control-label">Gneder</label> <div class="col-sm-7 col-md-7"> <select name="child_gender[]" class="form-control"> <option value="">Select</option> <option value="male">Male</option> <option value="female">Female</option> </select> </div> </div></div>';
					$('#children_data_holder').append(str);	
				}				
			}
			num_of_child = num;
		}
		else if(num < num_of_child)
		{
			var i=0;
			for (i = num_of_child; i > num; i--) 
			{ 
				document.getElementById('children_'+i).style.display = 'none';
			}
			num_of_child = num;
		}
		
			
	}
	
        function changeUpazilla(source,target)
        {
            var district_id = document.getElementById(source).value;
            var upazilla_id = document.getElementById(target);
            upazilla_id.length = 0;

            var option1 = document.createElement("option");
            option1.value = '-1';
            option1.text = '-Select-';
            upazilla_id.appendChild(option1);
            for ( i=0; i<upazillas.length; i++ )
            {

                if(upazillas[i][0] == district_id)
                {
                    var option = document.createElement("option");
                    option.value = upazillas[i][1];
                    option.text = upazillas[i][2];
                    upazilla_id.appendChild(option);
                }
            }
        }
		
		function changeUpazillaSame(source,target,uValue)
        {
            var district_id = document.getElementById(source).value;
            var upazilla_id = document.getElementById(target);
            upazilla_id.length = 0;

            var option1 = document.createElement("option");
            option1.value = '-1';
            option1.text = '-Select-';
            upazilla_id.appendChild(option1);
            for ( i=0; i<upazillas.length; i++ )
            {
                if(upazillas[i][0] == district_id)
                {
                    var option = document.createElement("option");
                    option.value = upazillas[i][1];
                    option.text = upazillas[i][2];
                    upazilla_id.appendChild(option);
                }
            }
			upazilla_id.value = uValue;
        }

        function setDisability(flag)
        {
            var element = document.getElementById('applicant_disabilities');
            if(flag=='true')
            {
                element.disabled = false;
            }
            else
            {
                element.disabled = true;
            }
        }

        function setPresentPermanemtAddress()
        {
            if(!document.getElementById("present_permanent_same").checked )
            {	
                document.getElementById('permanent_district').disabled = false;
                document.getElementById('permanent_upazilla').disabled = false;
                document.getElementById('permanent_post_office').disabled = false;
                document.getElementById('permanent_post_code').disabled = false;
                document.getElementById('permanent_road').disabled = false;
                document.getElementById('permanent_village').disabled = false;
            }
            else
            {
				document.getElementById('permanent_post_office').value = document.getElementById('present_post_office').value;
                document.getElementById('permanent_post_code').value = document.getElementById('present_post_code').value;
                document.getElementById('permanent_road').value = document.getElementById('present_road').value;
                document.getElementById('permanent_village').value = document.getElementById('present_village').value;
				document.getElementById('permanent_district').value = document.getElementById('present_district').value;
				
				changeUpazillaSame('permanent_district','permanent_upazilla',document.getElementById('present_upazilla').value);
				
                document.getElementById('permanent_district').disabled = true;
                document.getElementById('permanent_upazilla').disabled = true;
                document.getElementById('permanent_post_office').disabled = true;
                document.getElementById('permanent_post_code').disabled = true;
                document.getElementById('permanent_road').disabled = true;
                document.getElementById('permanent_village').disabled = true;
            }

        }
        function setDisabilityEducation(col)
        {
            elements = document.getElementsByClassName("additional_education"+col);
            for (var i = 0; i < elements.length; i++)
            {
                elements[i].removeAttribute("style");
            }
        }
        
    </script>





</head>

<body>
<div class="bgimg">
    <nav class="navbar affix-top" role="navigation" id="BB-nav">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="text-center">
				<div class="logo">
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"><span>Kirishibid<span class="cus_or1"> I</span>nstitution Bangladesh</span></a>
				</div>
			</div>
		</div>
	</nav>

    <!-- Registration form -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 membership">
                <div class="heading">
                    <h2>MEMBER ID CARD PORTAL</h2>
                        Fields marked with <span>(*)</span>are mandatory.
                </div>
                <form role="form" action="<?php echo $target; ?>" method="post" id='reg_form'>
                    <div class="tab-content">
                        <div class="row tab-pane active" role="tabpanel" id="step1">
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <h4>Member Information :</h4>
                                        <div class="form-group space">
                                            <label for="MemberID" class="col-sm-5 control-label">Member ID</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="member_id" id="member_id" placeholder="Number" class="form-control"
                                                       value="<?php if(isset($member_id)){echo $member_id; } ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Member" class="col-sm-5 control-label">Member Type</label>
                                            <div class="col-sm-7">
                                                <select id="member_type" name="member_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="general" <?php if(isset($member_type) && $member_type=='general'){echo 'selected';} ?>>General</option>
                                                    <option value="life" <?php if(isset($member_type) && $member_type=='life'){echo 'selected';} ?>>Life</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--<div class="form-group space">
                                            <label for="birthDate" class="col-sm-5 control-label">Joining Date</label>
                                            <div class="col-sm-7">
                                                <div class='form-row'>
                                                    <div class='col6 form-group required'>
                                                        <select id="member_since_month" name="member_since_month" class="form-control">
                                                            <option value="" selected="" disabled="">Join&nbsp;Month</option>
                                                            <option value="01" <?php if(isset($member_since_month) && $member_since_month=='01'){echo 'selected';} ?>>January</option>
                                                            <option value="02" <?php if(isset($member_since_month) && $member_since_month=='02'){echo 'selected';} ?>>February</option>
                                                            <option value="03" <?php if(isset($member_since_month) && $member_since_month=='03'){echo 'selected';} ?>>March</option>
                                                            <option value="04" <?php if(isset($member_since_month) && $member_since_month=='04'){echo 'selected';} ?>>April</option>
                                                            <option value="05" <?php if(isset($member_since_month) && $member_since_month=='05'){echo 'selected';} ?>>May</option>
                                                            <option value="06" <?php if(isset($member_since_month) && $member_since_month=='06'){echo 'selected';} ?>>June</option>
                                                            <option value="07" <?php if(isset($member_since_month) && $member_since_month=='07'){echo 'selected';} ?>>July</option>
                                                            <option value="08" <?php if(isset($member_since_month) && $member_since_month=='08'){echo 'selected';} ?>>August</option>
                                                            <option value="09" <?php if(isset($member_since_month) && $member_since_month=='09'){echo 'selected';} ?>>September</option>
                                                            <option value="10" <?php if(isset($member_since_month) && $member_since_month=='10'){echo 'selected';} ?>>October</option>
                                                            <option value="11" <?php if(isset($member_since_month) && $member_since_month=='11'){echo 'selected';} ?>>November</option>
                                                            <option value="12" <?php if(isset($member_since_month) && $member_since_month=='12'){echo 'selected';} ?>>December</option>
                                                        </select>
                                                    </div>
                                                    <div class='col3 form-group required'>

                                                        <input class='form-control month' placeholder='Day' id="member_since_day" name="member_since_day" type='number' value="<?php if(isset($member_since_day)){echo $member_since_day; } ?>">
                                                    </div>
                                                    <div class='col3 form-group required'>

                                                        <input class='form-control year' placeholder='Year' type='number' id="member_since_year" name="member_since_year" value="<?php if(isset($member_since_year)){echo $member_since_year; } ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="form-group space">
                                            <label for="Chapter" class="col-sm-5 control-label"><span style='color:red;'>*</span>Chapter</label>
                                            <div class="col-sm-7">
                                                <select id="zone" name="zone" class="form-control" required="">
                                                	<option value="">Select</option>
                                                 <?php
                                                    foreach ($zones as $cZone)
                                                    {
                                                        if(isset($zone) && ($cZone->district_id == $zone))
                                                        {
                                                            echo "<option value='".$cZone->district_id."' selected>".$cZone->district_en."</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='".$cZone->district_id."'>".$cZone->district_en."</option>";
                                                        }
                                                    }
                                                 ?>
                                                </select>
                                            </div>
                                        </div> <!-- /.form-group -->
                                        <h4>Personal Information</h4>
                                        <div class="form-group space">
                                            <label for="Name" class="col-sm-5 control-label"><span style='color:red;'>*</span>Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="applicant_name" name="applicant_name" placeholder="Name" class="form-control"  value="<?php if(isset($applicant_name)){echo $applicant_name; } ?>" maxlength="38" required="">
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="birthDate" class="col-sm-5 control-label"><span style='color:red;'>*</span>Date of Birth</label>
                                            <div class="col-sm-7">
                                                <div class='form-row'>
                                                    <div class='col6 form-group required'>
                                                        <select id="applicant_dob_month" name="applicant_dob_month" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Month</option>
                                                            <option value="01" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='01'){echo 'selected';} ?>>January</option>
                                                            <option value="02" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='02'){echo 'selected';} ?>>February</option>
                                                            <option value="03" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='03'){echo 'selected';} ?>>March</option>
                                                            <option value="04" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='04'){echo 'selected';} ?>>April</option>
                                                            <option value="05" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='05'){echo 'selected';} ?>>May</option>
                                                            <option value="06" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='06'){echo 'selected';} ?>>June</option>
                                                            <option value="07" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='07'){echo 'selected';} ?>>July</option>
                                                            <option value="08" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='08'){echo 'selected';} ?>>August</option>
                                                            <option value="09" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='09'){echo 'selected';} ?>>September</option>
                                                            <option value="10" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='10'){echo 'selected';} ?>>October</option>
                                                            <option value="11" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='11'){echo 'selected';} ?>>November</option>
                                                            <option value="12" <?php if(isset($applicant_dob_month) && $applicant_dob_month=='12'){echo 'selected';} ?>>December</option>
                                                        </select>
                                                    </div>
                                                    <div class='col3 form-group required'>
                                        <select id="applicant_dob_day" name="applicant_dob_day" class="form-control" required="">
                                            <option value="" selected="" disabled="">Day</option>
                                        <?php 
                                            for($i=1;$i<=31;$i++)
                                            {
                if(isset($applicant_dob_day) && $i==$applicant_dob_day)
                {echo "<option value='$i' selected>$i</option>";}
                else
                {echo "<option value='$i'>$i</option>";}
                                            }
                                        ?>
                                        </select>
                                      </div>
                                                    <div class='col3 form-group required'>
 <select id="applicant_dob_year" name="applicant_dob_year" class="form-control" required="">
                                            <option value="" selected="" disabled="">Year</option>
                                        <?php 
                                            for($i=1900;$i<=2018;$i++)
                                            {
                if(isset($applicant_dob_year) && $i==$applicant_dob_year)
                {echo "<option value='$i' selected>$i</option>";}
                else
                {echo "<option value='$i'>$i</option>";}
                                            }
                                        ?>
                                        </select>                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="NationalID" class="col-sm-5 control-label"><span style='color:red;'>*</span>National ID Card No</label>
                                            <div class="col-sm-7">
                                                <input type="text" placeholder="Number" class="form-control" id="applicant_nid" name="applicant_nid"
                                        maxlength="17" value="<?php if(isset($applicant_nid)){echo $applicant_nid; } ?>" required="" onkeypress='validateNumber(event)'>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Gneder" class="col-sm-5 control-label"  id="applicant_gender" name="applicant_gender"><span style='color:red;'>*</span>Gneder</label>
                                            <div class="col-sm-7">
                                                <select name="applicant_gender" name='applicant_gender' class="form-control" required="">
                                                    <option value="">Select</option>
                                                    <option value="male"  <?php if(isset($applicant_gender) && $applicant_gender=='male'){echo 'selected';} ?>>Male</option>
                                                    <option value="female"  <?php if(isset($applicant_gender) && $applicant_gender=='female'){echo 'selected';} ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Religion" class="col-sm-5 control-label"><span style='color:red;'>*</span>Religion</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" id="applicant_religion" name="applicant_religion" required="">
                                                    <option value="">Select</option>
                                                    <option value="islam" <?php if(isset($applicant_religion) && $applicant_religion=='islam'){echo 'selected';} ?>>Islam</option>
                                                    <option value="hindu" <?php if(isset($applicant_religion) && $applicant_religion=='hindu'){echo 'selected';} ?>>Hindu</option>
                                                    <option value="christian" <?php if(isset($applicant_religion) && $applicant_religion=='christian'){echo 'selected';} ?>>Christian</option>
                                                    <option value="buddhism" <?php if(isset($applicant_religion) && $applicant_religion=='buddhism'){echo 'selected';} ?>>Buddhism</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Marital" class="col-sm-5 control-label"><span style='color:red;'>*</span>Marital Status</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" id="applicant_marital_status" name="applicant_marital_status" required="">
                                                    <option value="">Select</option>
                                                    <option value="married" <?php if(isset($applicant_marital_status) && $applicant_marital_status=='married'){echo 'selected';} ?>>Married</option>
                                                    <option value="single" <?php if(isset($applicant_marital_status) && $applicant_marital_status=='single'){echo 'selected';} ?>>Single</option>
                                                    <option value="divorced" <?php if(isset($applicant_marital_status) && $applicant_marital_status=='divorced'){echo 'selected';} ?>>Divorced</option>
                                                    <option value="widowed" <?php if(isset($applicant_marital_status) && $applicant_marital_status=='widowed'){echo 'selected';} ?>>Widowed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Blood" class="col-sm-5 control-label">Blood Group</label>
                                            <div class="col-sm-7">
                                                <select id="applicant_blood_group" name='applicant_blood_group' class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="A+" <?php if(isset($applicant_blood_group) && $applicant_blood_group=='A+'){echo 'selected';} ?>>A+</option>
                                                    <option value="A-" <?php if(isset($applicant_blood_group) && $applicant_blood_group=='A-'){echo 'selected';} ?>>A-</option>
                                                    <option value="B+" <?php if(isset($applicant_blood_group) && $applicant_blood_group=='B+'){echo 'selected';} ?>>B+</option>
                                                    <option value="B-" <?php if(isset($applicant_blood_group) && $applicant_blood_group=='B-'){echo 'selected';} ?>>B-</option>
                                                    <option value="AB+" <?php if(isset($applicant_blood_group) && $applicant_blood_group=='AB+'){echo 'selected';} ?>>AB+</option>
                                                    <option value="AB-" <?php if(isset($applicant_blood_group) && $applicant_blood_group=='AB-'){echo 'selected';} ?>>AB-</option>
                                                    <option value="O+" <?php if(isset($applicant_blood_group) && $applicant_blood_group=='O+'){echo 'selected';} ?>>O+</option>
                                                    <option value="O-" <?php if(isset($applicant_blood_group) && $applicant_blood_group=='O-'){echo 'selected';} ?>>O-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group space">
                                            <label class="control-label col-sm-5">Remarkable impairment</label>
                                            <div class="col-sm-7">
                                                <div class="row">
                                                    <div class="cusradio col-sm-6 text-center">
                                                        <div>
                                                            <input type="radio" name="applicant_impairment" value="yes" style="width:10%" onclick="setDisability('true');" <?php if(isset($applicant_impairment) && $applicant_impairment=='yes'){echo 'checked';} ?>> Yes



                                                            &nbsp;
                                                            <input type="radio" name="applicant_impairment" value="no" style="width:10%" onclick="setDisability('false');" <?php if(isset($applicant_impairment) && $applicant_impairment!='yes'){echo 'checked';} ?>>  No
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /.form-group -->

                                        <div class="form-group space">
                                            <label for="Name" class="col-sm-5 control-label">Physical Disabilities</label>
                                            <div class="col-sm-7">
                                            	 <select id="applicant_disabilities" name="applicant_disabilities" class="form-control" <?php if(isset($applicant_impairment) && $applicant_impairment=='yes'){}else{echo 'disabled';} ?>>
                                                    <option value="">-Select-</option>
                                                    
                                                    <?php
	                                                    foreach ($physical_disabilities as $physical_disability)
	                                                    {
	                                                        if(isset($applicant_disabilities) && ($physical_disability->id == $applicant_disabilities))
	                                                        {
	                                                            echo "<option value='".$physical_disability->id."' selected>".$physical_disability->disabilities_name."</option>";
	                                                        }
	                                                        else
	                                                        {
	                                                            echo "<option value='".$physical_disability->id."'>".$physical_disability->disabilities_name."</option>";
	                                                        }
	                                                    }
	                                                 ?>
                                                </select>
                                            </div>
                                        </div>
                                        <h4>Academic Information</h4>
                                        <div class="form-group space">
                                            <label for="bachelor" class="col-sm-5 control-label"><span style='color:red;'>*</span>Bachelor of</label>
                                            <div class="col-sm-7">
                                                <select id="degree_name" name="degree_name" class="form-control" required="">
                                                    <option value="">-Select-</option>                                                    
                                                    
	                                                 <?php
	                                                    foreach ($faculties as $faculty)
	                                                    {
	                                                        if(isset($degree_name) && ($faculty->fact_code == $degree_name))
	                                                        {
	                                                            echo "<option value='".$faculty->fact_code."' selected>".$faculty->fact_name."</option>";
	                                                        }
	                                                        else
	                                                        {
	                                                            echo "<option value='".$faculty->fact_code."'>".$faculty->fact_name."</option>";
	                                                        }
	                                                    }
	                                                 ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Institution" class="col-sm-5 control-label"><span style='color:red;'>*</span>Institution Name</label>
                                            <div class="col-sm-7">
                                                <select id="degree_institute" name="degree_institute" class="form-control" required="">
                                                    <option value="">-Select-</option>
                                                    
                                                    <?php
	                                                    foreach ($institutes as $institute)
	                                                    {
	                                                        if(isset($degree_institute) && ($institute->id == $degree_institute))
	                                                        {
	                                                            echo "<option value='".$institute->id."' selected>".$institute->institute_name."</option>";
	                                                        }
	                                                        else
	                                                        {
	                                                            echo "<option value='".$institute->id."'>".$institute->institute_name."</option>";
	                                                        }
	                                                    }
	                                                 ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Passing" class="col-sm-5 control-label"><span style='color:red;'>*</span>Passing year</label>
                                            <div class="col-sm-7"> 
                                                <select id="degree_passing_year" name="degree_passing_year" class="form-control" required="">
                                                    <option value="">-Select-</option>
                                                    <?php 
							for ($x = 1963; $x <= 2018; $x++)
							{								
								if(isset($degree_passing_year) && ($x == $degree_passing_year))
	                                                        {
	                                                           echo "<option value='".$x."' selected>".$x."</option>";
	                                                        }
	                                                        else
	                                                        {
	                                                           echo "<option value='".$x."'>".$x."</option>";
	                                                        }
							} 
							?>	
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                          	if(!(isset($education_level1) && $education_level1!=''))
                                          	{
                                          	   echo "<div class=\"form-group text-right\">
                                            <div class=\"col-md-12 col-sm-12\">
                                                <button id=\"add-more\" name=\"add-more\" class=\"btn btn-primary\" onclick=\"document.getElementById('education1').style.display='block';this.style.display='none';return false;\">Add More</button>
                                            </div>
                                        </div>";
                                          	}
                                          ?>
                                          
                                        
                                         
                                        <!-- academic extra Information -->
                                        <?php 
                                          	if(isset($education_level1) && $education_level1!='')
                                          	{
                                          	   echo "<div disabled id='education1' style='display:block'>";	
                                          	}
                                          	else
                                          	{
                                          	   echo "<div disabled id='education1' style='display:none'>";
                                          	}
                                          ?> 
                                            <!-- Text input-->
                                            <div class="form-group space">
                                                <label class="col-md-5 col-sm-5 control-label" for="action_id">Level of Education</label>
                                                <div class="col-md-7 col-sm-7">
                                                    <select id="education_level1" name="education_level1" class="form-control">
                                                        <option value="">-Select-</option>
                                                        <option value="masters" <?php if(isset($education_level1) && $education_level1=='masters'){echo 'selected';} ?>>Masters</option>
                                                        <option value="phd"  <?php if(isset($education_level1) && $education_level1=='phd'){echo 'selected';} ?>>PhD (Doctorate of Philosophy)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group space">
                                                <label class="col-md-5 col-sm-5 control-label" for="action_name">Exam/Degree Title:</label>
                                                <div class="col-md-7 col-sm-7">
                                                    <input class="form-control" type="text" id="additional_degree_name1" name="additional_degree_name1" value="<?php if(isset($additional_degree_name1)){echo $additional_degree_name1; } ?>">
                                                </div>
                                            </div>
                                            <div class="form-group space">
                                                <label class="col-md-5 col-sm-5 control-label" for="action_id">Institution Name</label>
                                                <div class="col-md-7 col-sm-7">
                                                    <input id="additional_intitute_name1" name="additional_intitute_name1" class="form-control" value="<?php if(isset($additional_intitute_name1)){echo $additional_intitute_name1; } ?>"/>                                                        
                                                </div>
                                            </div>
                                            <div class="form-group space">
                                                <label class="col-md-5 col-sm-5 control-label" for="action_id">Passing year</label>
                                                <div class="col-md-7 col-sm-7">
                                                    <select id="additional_paasing_year1" name="additional_paasing_year1" class="form-control">
                                                    		<option value="">-Select-</option>
	                                                    <?php 
								for ($x = 1963; $x <= 2018; $x++)
								{								
									if(isset($additional_paasing_year1) && ($x == $additional_paasing_year1))
		                                                        {
		                                                           echo "<option value='".$x."' selected>".$x."</option>";
		                                                        }
		                                                        else
		                                                        {
		                                                           echo "<option value='".$x."'>".$x."</option>";
		                                                        }
								} 
							    ?>                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <?php 
                                          	if(!(isset($education_level2) && $education_level2!=''))
                                          	{
                                          	   echo "<div class=\"form-group text-right\">
                                            <div class=\"col-md-12 col-sm-12\">
                                                <button id=\"add-more\" name=\"add-more\" class=\"btn btn-primary\" onclick=\"document.getElementById('education2').style.display='block';this.style.display='none';return false;\">Add More</button>
                                            </div>
                                        </div>";
                                          	}
                                          ?>
                                        </div>                                        
                                        
                                          <?php 
                                          	if(isset($education_level2) && $education_level2!='')
                                          	{
                                          	   echo "<div disabled id='education2' style='display:block'>";	
                                          	}
                                          	else
                                          	{
                                          	   echo "<div disabled id='education2' style='display:none'>";
                                          	}
                                          ?>                                     
                                        
                                            <div class="form-group space">
                                                <label class="col-md-5 col-sm-5 control-label" for="action_id">Level of Education</label>
                                                <div class="col-md-7 col-sm-7">
                                                    <select id="education_level2" name="education_level2" class="form-control">
                                                        <option value="">-Select-</option>
                                                        <option value="masters" <?php if(isset($education_level2) && $education_level2=='masters'){echo 'selected';} ?>>Masters</option>
                                                        <option value="phd"  <?php if(isset($education_level2) && $education_level2=='phd'){echo 'selected';} ?>>PhD (Doctorate of Philosophy)</option>
                                                    </select>
                                                </div>
                                            </div>	                                           
                                            <!-- Text input-->
                                            <div class="form-group space">
                                                <label class="col-md-5 col-sm-5 control-label" for="action_name">Exam/Degree Title:</label>
                                                <div class="col-md-7 col-sm-7">
                                                    <input class="form-control" type="text" id="additional_degree_name2" name="additional_degree_name2" value="<?php if(isset($additional_degree_name2)){echo $additional_degree_name2; } ?>">
                                                </div>
                                            </div>
                                            <div class="form-group space">
                                                <label class="col-md-5 col-sm-5 control-label" for="action_id">Institution Name</label>
                                                <div class="col-md-7 col-sm-7">
                                                    <input id="additional_intitute_name2" name="additional_intitute_name2" class="form-control" value="<?php if(isset($additional_intitute_name2)){echo $additional_intitute_name2; } ?>"/>                                                        
                                                </div>
                                            </div>
                                            <div class="form-group space">
                                                <label class="col-md-5 col-sm-5 control-label" for="action_id">Passing year</label>
                                                <div class="col-md-7 col-sm-7">
                                                    <select id="additional_paasing_year2" name="additional_paasing_year2" class="form-control">
                                                    		<option value="">-Select-</option>
	                                                    <?php 
								for ($x = 1963; $x <= 2018; $x++)
								{								
									if(isset($additional_paasing_year2) && ($x == $additional_paasing_year2))
		                                                        {
		                                                           echo "<option value='".$x."' selected>".$x."</option>";
		                                                        }
		                                                        else
		                                                        {
		                                                           echo "<option value='".$x."'>".$x."</option>";
		                                                        }
								} 
							    ?>                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <!-- academic extra Information -->
                                        <h4>Professional Information</h4>
                                        <div class="form-group space">
                                            <label for="Professional" class="col-sm-5 control-label"><span style='color:red;'>*</span>Professional</label>
                                            <div class="col-sm-7">
                                                <select name="applicant_profession" id="applicant_profession" class="form-control" required="">
                                                    <option value="">-SELECT-</option>
            					   <?php 
            					    foreach ($professions as $profession)
                                                    {
                                                        if(isset($applicant_profession) && ($profession->id == $applicant_profession))
                                                        {
                                                            echo "<option value='".$profession->id."' selected>".$profession->profession_name."</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='".$profession->id."'>".$profession->profession_name."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-success">
                                    <div class="box-body">
                                        <h4>Contact Information</h4>
                                        <h5>Present Address:</h5>
                                        <div class="form-group space">
                                            <label for="District" class="col-sm-5 control-label"><span style='color:red;'>*</span>District</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" id="present_district" name="present_district" onchange="changeUpazilla('present_district','present_upazilla')" required="">
                                               		 <option value="">Select</option>
                                                    <?php
                                                    foreach ($zones as $cZone)
                                                    {
                                                        if(isset($zone) && $cZone->visible=='0')
                                                        {
                                                           continue; 
                                                        }
                                                        if(isset($zone) && ($cZone->district_id == $present_district))
                                                        {
                                                            echo "<option value='".$cZone->district_id."' selected>".$cZone->district_en."</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='".$cZone->district_id."'>".$cZone->district_en."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="PoliceStation" class="col-sm-5 control-label"><span style='color:red;'>*</span>Police station</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" id="present_upazilla" name="present_upazilla" required="">
                                                    <option value="-1">-Select-</option>
                                                    <?php
                                                    if(isset($present_upazilla))
                                                    {
                                                        foreach ($upazillas as $upazilla)
                                                        {
                                                            if($upazilla->district_id==$present_district && $upazilla->upazilla_id==$present_upazilla)
                                                            {
                                                                echo "<option value='".$upazilla->upazilla_id."' selected>".$upazilla->upazilla_en."</option>";
                                                            }
                                                            else if($upazilla->district_id==$present_district)
                                                            {
                                                                echo "<option value='".$upazilla->upazilla_id."'>".$upazilla->upazilla_en."</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="VillageHouse" class="col-sm-5 control-label"><span style='color:red;'>*</span>Village/House</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="present_village" name="present_village" required="" value="<?php if(isset($present_village)){echo $present_village; } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="RoadBlockSector" class="col-sm-5 control-label"><span style='color:red;'>*</span>Road/Block/Sector</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="present_road" name="present_road" required=""  value="<?php if(isset($present_road)){echo $present_road; } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="PostOffice" class="col-sm-5 control-label"><span style='color:red;'>*</span>Post office</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="present_post_office" name="present_post_office" required=""  value="<?php if(isset($present_post_office)){echo $present_post_office; } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="PostCode" class="col-sm-5 control-label"><span style='color:red;'>*</span>Post Code</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="present_post_code" name="present_post_code" required="" value="<?php if(isset($present_post_code)){echo $present_post_code; } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <h5 class="control-label col-sm-5">Permanent address:</h5>
                                            <div class="col-sm-7">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <label class="radio">
                                                            <input type="checkbox" id="present_permanent_same" name="present_permanent_same" value="present_permanent_same" <?php if(isset($present_permanent_same) && $present_permanent_same=='1'){echo 'checked'; } ?> onclick="setPresentPermanemtAddress()">Same as Above
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /.form-group -->

                                        <div class="form-group space">
                                            <label for="District" class="col-sm-5 control-label"><span style='color:red;'>*</span>District</label>
                                            <div class="col-sm-7">
                                                <select id="permanent_district" name="permanent_district" class="form-control" required="" onchange="changeUpazilla('permanent_district','permanent_upazilla')" <?php if(isset($present_permanent_same) && $present_permanent_same=='1'){echo 'disabled'; } ?> >
                                                	<option value="">Select</option>
                                                    <?php
                                                    foreach ($zones as $cZone)
                                                    {
                                                        if(isset($zone) && $cZone->visible=='0')
                                                        {
                                                           continue; 
                                                        }
                                                        if(isset($zone) && ($cZone->district_id == $permanent_district))
                                                        {
                                                            echo "<option value='".$cZone->district_id."' selected>".$cZone->district_en."</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='".$cZone->district_id."'>".$cZone->district_en."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group space">
                                            <label for="PoliceStation" class="col-sm-5 control-label"><span style='color:red;'>*</span>Police station</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" id="permanent_upazilla" name="permanent_upazilla" <?php if(isset($present_permanent_same) && $present_permanent_same=='1'){echo 'disabled'; } ?> required="">
                                                    <option value="-1">-Select-</option>
                                                    <?php
                                                        if(isset($permanent_upazilla))
                                                        {
                                                            foreach ($upazillas as $upazilla)
                                                            {
                                                                if($upazilla->district_id==$permanent_district && $upazilla->upazilla_id==$permanent_upazilla)
                                                                {
                                                                    echo "<option value='".$upazilla->upazilla_id."' selected>".$upazilla->upazilla_en."</option>";
                                                                }
                                                                else if($upazilla->district_id==$permanent_district)
                                                                {
                                                                    echo "<option value='".$upazilla->upazilla_id."'>".$upazilla->upazilla_en."</option>";
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="VillageHouse" class="col-sm-5 control-label"><span style='color:red;'>*</span>Village/House</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="permanent_village" name="permanent_village" required="" value="<?php if(isset($permanent_village)){echo $permanent_village; } ?>" <?php if(isset($present_permanent_same) && $present_permanent_same=='1'){echo 'disabled'; } ?>>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="RoadBlockSector" class="col-sm-5 control-label"><span style='color:red;'>*</span>Road/Block/Sector</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="permanent_road" name="permanent_road" required=""  value="<?php if(isset($permanent_road)){echo $permanent_road; } ?>" <?php if(isset($present_permanent_same) && $present_permanent_same=='1'){echo 'disabled'; } ?>>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="PostOffice" class="col-sm-5 control-label"><span style='color:red;'>*</span>Post office</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="permanent_post_office" name="permanent_post_office" required=""  value="<?php if(isset($permanent_post_office)){echo $permanent_post_office; } ?>" <?php if(isset($present_permanent_same) && $present_permanent_same=='1'){echo 'disabled'; } ?>>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="PostCode" class="col-sm-5 control-label"><span style='color:red;'>*</span>Post Code</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="permanent_post_code" name="permanent_post_code" required="" value="<?php if(isset($permanent_post_code)){echo $permanent_post_code; } ?>" <?php if(isset($present_permanent_same) && $present_permanent_same=='1'){echo 'disabled'; } ?>>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Mobile No" class="col-sm-5 control-label"><span style='color:red;'>*</span>Mobile No:</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="mobile" name="mobile" required="" value="<?php if(isset($mobile)){echo $mobile; } ?>" maxlength="11" onkeypress='validateNumber(event)'>
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="Email Address" class="col-sm-5 control-label">Email Address</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="email" name="email" value="<?php if(isset($email)){echo $email; } ?>">
                                            </div>
                                        </div>
                                        <h4>Family Information</h4>
                                        <div class="form-group space">
                                            <label for="MotherName" class="col-sm-5 control-label"><span style='color:red;'>*</span>Mother’s Name</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="mothers_name" name="mothers_name" required=""  value="<?php if(isset($mothers_name)){echo $mothers_name; } ?>" maxlength="38">
                                            </div>
                                        </div>
                                        <div class="form-group space">
                                            <label for="FatherName" class="col-sm-5 control-label"><span style='color:red;'>*</span>Father’s Name</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="fathers_name" name="fathers_name" required=""  value="<?php if(isset($fathers_name)){echo $fathers_name; } ?>" maxlength="38">
                                            </div>
                                        </div>

                                        <div class="form-group space">
                                            <label for="spouseName" class="col-sm-5 control-label">Spouse Name</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="spouse_name" name="spouse_name" value="<?php if(isset($spouse_name)){echo $spouse_name; } ?>" maxlength="38">
                                            </div>
                                        </div>


                                        <div class="form-group space">
                                            <label for="NumberChild" class="col-sm-5 control-label">Number of Child</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" id="number_of_children" name="number_of_children" value="<?php if(isset($number_of_children)){echo $number_of_children; } ?>" onkeyup='addChildren()'>
                                            </div>
                                        </div>
                                        <h5>Children Details</h5>
										<div id='children_data_holder'>
											<?php 
											$count=1;
											foreach ($childrens as $children)
											{	                                        	
											?>  
												<div id='children_<?php echo $count; ?>'>
													<div class="form-group space">
														<label for="Name" class="col-sm-5 control-label">Name</label>
														<div class="col-sm-7">
															<input class="form-control" type="text" name="child_name[]" value='<?php echo $children->name; ?>' maxlength="38">
														</div>
													</div>

													<div class="form-group space">
														<label for="Gneder" class="col-sm-5 col-md-5 control-label">Gneder</label>
														<div class="col-sm-7 col-md-7">
															<select name="child_gender[]" class="form-control">
																<option value="">Select</option>	
																<option value="male" <?php if($children->gender=="male"){ echo "selected";} ?>>Male</option>
																<option value="female" <?php if($children->gender=="female"){ echo "selected";} ?>>Female</option>
															</select>
														</div>
													</div>	
												</div>	
											<?php 
											$count++;
											}
											?>
										</div>
                                        <div class="text-center">
                                            <button type="submit" class="cus_btn btn next-step" onclick="submitdata();">Save and Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
<!-- login form -->
<script>
    function submitdata()
    {
        
        if(!checkDropDownfield('zone')){return false;}
        if(!checkDropDownfield('applicant_dob_month')){return false;}
        if(!checkDropDownfield('applicant_gender')){return false;}
        if(!checkDropDownfield('applicant_religion')){return false;}
        if(!checkDropDownfield('applicant_marital_status')){return false;}
        if(!checkDropDownfield('degree_name')){return false;}
        if(!checkDropDownfield('degree_institute')){return false;}
        if(!checkDropDownfield('degree_passing_year')){return false;}
        if(!checkDropDownfield('applicant_profession')){return false;}
        if(!checkDropDownfield('present_district')){return false;}
        if(!checkDropDownfield('present_upazilla')){return false;}
        if(!checkDropDownfield('permanent_district')){return false;}
        if(!checkDropDownfield('permanent_upazilla')){return false;}
        if(!checkTextfield('applicant_name',-1)){return false;}
        if(!checkDropDownfield('applicant_dob_day')){return false;}
        if(!checkDropDownfield('applicant_dob_year')){return false;}
        
        if(!checkTextfield('present_village',-1)){return false;}
        if(!checkTextfield('present_road',-1)){return false;}
        if(!checkTextfield('present_post_office',-1)){return false;}
        if(!checkTextfield('present_post_code',-1)){return false;}
        if(!checkTextfield('present_permanent_same',-1)){return false;}
        if(!checkTextfield('permanent_village',-1)){return false;}
        if(!checkTextfield('permanent_road',-1)){return false;}
        if(!checkTextfield('permanent_post_office',-1)){return false;}
        if(!checkTextfield('permanent_post_code',-1)){return false;}
        
        if(!checkTextfield('mothers_name',-1)){return false;}
        if(!checkTextfield('fathers_name',-1)){return false;}
        
        if(!(checkTextfield('applicant_nid',10) || checkTextfield('applicant_nid',13) || checkTextfield('applicant_nid',17))){
            alert('National ID Must be 10/13/17 Digit');
            document.getElementById('applicant_nid').focus();
            return false;}
        if(!checkTextfield('mobile',11)){alert('Mobile Number Must be 11 Digit');
            document.getElementById('mobile').focus();
            return false;}
        if(!validateEmail('email'))
        {
            alert('Wrong Email Address');
            document.getElementById('email').focus();
            return false;
        }
        //alert('sdsd');
        document.getElementById('member_id').disabled = false;
        
        document.getElementById('reg_form').submit();
    }
    function checkTextfield(fieldName,Namelenght)
    {
        var value = document.getElementById(fieldName).value;
        if(value == '' || (value.length!=Namelenght && Namelenght!=-1))
        {
            return false;
        }
        return true;
    }
    function checkDropDownfield(fieldName)
    {
        var value = document.getElementById(fieldName).value;
        if(value == '' || value == '-1')
        {
            return false;
        }
        return true;
    }
    function validateEmail(emailAdd)
    {
        
        var email = document.getElementById(emailAdd).value;
        if(email=='')
        {
            return true;
        }
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    function validateNumber(evt) 
    {
      var theEvent = evt || window.event;
    
      // Handle paste
      if (theEvent.type === 'paste') {
          key = event.clipboardData.getData('text/plain');
      } else {
      // Handle key press
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode(key);
      }
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
</script>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
</body>
</html>
