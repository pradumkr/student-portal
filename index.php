<?php
	session_start();
	if(isset($_SESSION['ss_e']))
	{
		if($_SESSION['ss_e']==1)
		{
			echo "<script>alert('Please Login First')</script>";
		}
		unset($_SESSION['ss_e']);
	}
	$con = mysqli_connect('localhost','root','','student-portal',3307) or die("Server can't connect try again");
	mysqli_select_db($con,'student-portal') or die("Database not found!!");
	
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Student Portal</title>
  
  <style>
      
          .background{
                background-image: url(images/bg2.jpg);
                height: 434px;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
                border-radius:8px;
          }

          .onbackground h1{
          		padding-top: 20px;
                color:red;
                text-align: center;
          }
          .p{
          	width:80%;
          	color: grey;
          	text-align: center;
          	padding-left: 190px;
          }

  </style>  

  <script type="text/javascript">
		function download(){
		    var a = document.body.appendChild(
		        document.createElement("a")
		    );
		    a.download = "export.html";
		    a.href = "data:text/html," + document.getElementById("content12").innerHTML;
		    a.click();
		}
  </script>

 <link rel="stylesheet" href="css/style.css">

 <link rel="stylesheet" href="css/admin.css">

</head>

<body style="background-color:#1c2b4b">


	<div class="sticky">
		
			<div class="nav">
				<div class="webtitle-screen">
					<div class="webtitle">

		                <h2>National Institute of Technology, Durgapur</h2>
					</div>
				</div>
				<div class="nav-menu">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#notice_table">Notice</a></li>
						<li><a href="#aboutus">About Us</a></li>
						<!--<li class="drop-down">
		                <a href="#">Download</a>
						</li>-->
						<?php if(!isset($_SESSION['ss_user'])){?>
						<li id="signupBtn" style="float:right"><a>Sign Up</a></li>
						<li id="myBtn" style="float:right"><a>Login</a></li>
						<?php } else {	?>
						<li id="profile" ><a<?php if($_SESSION['ss_type']==1){?> href="http://localhost:86/student-portal/admin.php"<?php } else {?> href="http://localhost:86/student-portal/student.php"<?php } ?>>Dashboard</a></li>
						<li style="float:right"><a href="logout.php" id="logoutbtn">logout</a></li>
						<li style="float:right;bottom-paading:10px;">welcome <?php echo $_SESSION['ss_user']; ?> / </li>
						<?php
						}
						?>
					</ul>
				</div>
				<a id="myBtn"></a><a id="signupBtn"></a>
			</div>
	</div>

													<!-- Login Modal -->
<div id=modal-flow>	



	<div id="Mymodal" class="modal">
		<div class="modal-content">
			<span class="close1">&times;</span>
			<div class="login">
				<div class="login-screen">
					<div class="app-title">
						<h1>Login</h1>
					</div>
					<form method="post" action="login_process.php" id="myform0">
						<div class="login-form">
							<div class="control-group">
									<input type="text" class="login-field" onclick="errors3()" value="" placeholder="username" id="login_name" name="username">
									<label class="login-field-icon fui-user" for="login-name"></label>
									<span class="error_modal" style="display:none" id="error_login_name">Username is required</span>
							</div>

							<div class="control-group">
									<input type="password" class="login-field" onclick="forgot()" value="" placeholder="password" id="login-pass" name="pswd">
									<label class="login-field-icon fui-lock" for="login-pass"></label>
							</div>

							<input type="submit" class="btn btn-primary btn-large btn-block"  style="background-color:#1c2b4b" value="Login"/>


							<a class="login-link" id="lostPass" onclick="lostPass()"> Lost your password?</a>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>

		  										<!-- Forget Password -->

	<div id="passModal" class="modal">
		<div class="modal-content">
			<span class="close5">&times;</span>
			<div class="login">
				<div class="login-screen">
					<div class="app-title">
						<h1>Password Recovery</h1>
					</div>
					<form method="post" action="pass_change.php" id="myform5">
						<div class="login-form">
							<div class="control-group">
									<input type="text" class="login-field" onclick="errors4()" value="" placeholder="Username" id="ch_user" name="user">
									<label class="login-field-icon fui-lock" for="login-pass"></label>
									<span class="error_modal" style="display:none" id="error_select_user">Whats's your username?</span>
							</div>
							<div class="control-group" class=dropdown>
								<SELECT class="login-field" id="select_que" name="question">

								<OPTION  style="text-align: center;" Value="">Select your security question</OPTION>
								<OPTION Value="0" style="color:black;">What is your nick name?</OPTION>
								<OPTION Value="1" style="color:black;">Who is your fav actor?</OPTION>
								<OPTION Value="2" style="color:black;">Who is your fav acteress?</OPTION>
								<OPTION Value="3" style="color:black;">which team you will support in IPL?</OPTION>
								<OPTION Value="4" style="color:black;">Your fav place for vacation?</OPTION>
								
								</SELECT>
								<span class="error_modal" style="display:none" id="error_select_que">Select your security question</span>
							</div>

							<div class="control-group">
									<input type="text" class="login-field" value="" onclick="ans()" placeholder="Answer" id="answer" name="answer">
									<label class="login-field-icon fui-lock" for="login-pass"></label>
							</div>

							<div class="control-group">
									<input type="password" class="login-field" value=""   onclick="errors5()" placeholder="Password" id="ch_pass" name="password" style="display:none;">
									<label class="login-field-icon fui-user" for="login-name"></label>
									<span class="error_modal" style="display:none" id="error_ch_pass">Hey! Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character is required</span>
							</div>

							<div class="control-group">
									<input type="password" class="login-field" value="" onclick="con_security()" placeholder="Confirm Password" id="ch_conpass" style="display:none;">
									<label class="login-field-icon fui-user" for="login-name"></label>
									<span class="error_modal" style="display:none" id="error_ch_confirm">Password is not matched</span>
							</div>

							<input type="button" id="ch_btn" class="btn btn-primary btn-large btn-block" onclick="securityQue()" style="background-color:#1c2b4b;" value="Next"/>
							<input type="submit" id="ch_sub" class="btn btn-primary btn-large btn-block"  style="background-color:#1c2b4b;display:none" value="Submit"/>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
													<!-- Sign up Modal -->


	<div id="signup" class="modal">
		<div class="modal-content1">
			<span class="close2">&times;</span>

			<div class="details">
				<h4>Personal Details</h4>
			</div>
			<div class="login">
				<div class="login-screen">
					<div class="app-title">
						
						<h1>Registration</h1>
						<h5>(1/3)</h5>
					</div>
					<form method="post" action="reg_process.php" id="myform" enctype="multipart/form-data">
						<div class="login-form">

										<div class="control-group">
												<input type="text" class="login-field " onblur="fname()" value="" placeholder="Name" name="Name" id="reg_name">
												<span class="error_modal" style="display:none" id="error_reg_name">Name is required (only alphabets)</span>
												<label class="login-field-icon fui-user" for="login-name"></label>
										</div>
										

										<div class="control-group">
												<input type="text" class="login-field" value=""  onblur="mname()" placeholder="Father's name" name="f_name" id="f_name">
												<span class="error_modal" style="display:none" id="error_f_name"> father name is required(only alphabets)</span>
												<label class="login-field-icon fui-user" for="login-name"></label>
										</div>


										<div class="control-group">
												<input type="text" class="login-field" onblur="dateob()" value="" placeholder="Mother's name" id="m_name" name="m_name">
												<span class="error_modal" style="display:none" id="error_m_name">mother name is required (only alphabets)</span>
												<label class="login-field-icon fui-user" for="login-name"></label>
										</div>


										<div class="control-group">
												<div class="date">
													<input type="text" class="login-field"  disabled="disabled" value=""  placeholder="Date of birth" id="dobi" name="dob">
													
													<label class="login-field-icon fui-user" for="login-name"></label>
													<input type="date" class="login-field" onblur="ffemale()" value="" max="2005-12-31" min="1947-12-31" placeholder="Date of birth: dd/mm/yy" id="dob" name="dob">
													<span class="error_modal" style="display:none" id="error_dob">What's your DOB</span>
													
												</div>
										</div>

										<div class=table>
											<table style="padding-left: 10px;">
												<tr>
													<td style="padding-left: 56px;">GENDER</td>
													<td style="padding-left:38px;">
														  <label for="male">Male</label>
  														  <input type="radio" onclick="nation()" name="gender" id="male" value="0">
  													</td>
  													<td style="padding-left: 38px;">
													  	  <label for="female">Female</label>
  													  	  <input type="radio" onclick="nation()"  name="gender" id="female" value="1">
													</td>
												</tr>
												
											</table>

											<span class="error_modal" style="display:none" id="error_gender">What's your gender ?</span>

										</div>

										<div class="control-group">
												<input type="text" class="login-field" onblur="nextb1()" value="" placeholder="Nationality" id="nationality" name="nationality">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_nationality">What's your nationality ? (only alphabets)</span>
												
										</div>


						</div>
				</div>
			</div>

			<br>
			<br>

			<div class="btn btn-primary btn-large btn-block" id="reset" style="background-color:#1c2b4b ;float:right;text-align: center;padding:4px 0;width:90px">
				<a onclick="reset()">Reset</a>	
			</div>

			<div class="btn btn-primary btn-large btn-block" id="next1" style="background-color:#1c2b4b ;float:right;text-align: center;padding:4px 0;width:90px;margin-right: 8px;">
				<a onclick="nextb1()">Next</a>	
			</div>


		</div>
	</div> 




	<div id="signup2" class="modal" >
		<div class="modal-content1">

			<span class="close3">&times;</span>

			<div class="details">
				<h4>Education Details</h4>
			</div>
			<div class="login">
				<div class="login-screen">
					<div class="app-title">

			
						<h1>Registration</h1>
						<h5>(2/3)</h5>
					</div>
						<div class="login-form">

										<div class="control-group">
												<input type="text" class="login-field" value="" onblur="rollyno()" placeholder="Registration Number" name="Regino" id="regno">
												<span class="error_modal" style="display:none" id="error_reg">Whats your reg no. ? (format: year/U/regno.) </span>
												<label class="login-field-icon fui-user" for="login-name"></label>

										</div>
										
										<div class="control-group">
												<input type="text" class="login-field" value="" onblur="rolly()" placeholder="Roll Number" name="rollno" id="roll">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_roll">Whats your roll no. ? (Format: year/branch/rollno. )</span>
											
										</div>


										<div class="control-group" class=dropdown>
													<SELECT class="login-field" id="select" name="department">

													<OPTION  style="text-align: center;" Value="0">Department</OPTION>
													<OPTION Value="Information Technology" style="color:black;">Information Technology</OPTION>
													<OPTION Value="Electrical Engineering" style="color:black;">Electrical Engineering</OPTION>
													<OPTION Value="Computer science and Engineering" style="color:black;">Computer science and Engi.</OPTION>
													<OPTION Value="Metallurgical & Materials Engineering" style="color:black;">Metallurgical & Materials Engi.</OPTION>
													<OPTION Value="Bio-Technologyy" style="color:black;">Bio-Technology</OPTION>
													<OPTION Value="Mechanical Engineering" style="color:black;">Mechanical Engineering</OPTION>
													<OPTION Value="Chemical Engineering" style="color:black;">Chemical Engineering</OPTION>
													<OPTION Value="Civil Engineering" style="color:black;">Civil Engineering</OPTION>

													</SELECT>
													<span class="error_modal" style="display:none" id="error_select">Whats ypur dept.?</span>
										</div>


										<div class="control-group">
												<input type="number" class="login-field" value="" onblur="c_tenth()" placeholder="Whats your 10th %" id="tenth" name="tenth_mark">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_tenth">Hey ! Fill your 10th % (0 < % <= 100)</span>
										</div>


										<div class="control-group">
												<input type="number" class="login-field" value="" onblur="c_twelve()" placeholder="Whats your 12th %" id="twelve" name="twelve_mark">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_twelve">Hey ! Fill your 12th %(0 < % <= 100)</span>
										</div>



										<div class="control-group">
												<input type="number" class="login-field" value="" onblur="c_cgpa()" placeholder="Whats your CGPA(in %)" id="cgpa" name="cgpa_mark">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_cgpa">Hey ! Fill your cgpa(0 < % <= 100)</span>
										</div>

						</div>
					

				</div>
			</div>

			<br>
			<br>

			<div id=previous1  class="btn btn-primary btn-large btn-block" style="background-color:#1c2b4b ;float:left;text-align: center;padding:4px 0;width:90px">
				<a onclick="previous1()">Previous</a>	
			</div>

			<div id=reset1  class="btn btn-primary btn-large btn-block" style="background-color:#1c2b4b ;float:right;text-align: center;padding:4px 0;width:90px">
				<a onclick="reset1()">Reset</a>	
			</div>

			<div id=next2  class="btn btn-primary btn-large btn-block" style="background-color:#1c2b4b ;float:right;text-align: center;padding:4px 0;width:90px;margin-right: 8px;">
				<a onclick="nextb2()">Next</a>	
			</div>

		</div>
	</div>





	<div id="signup3" class="modal" >
		<div class="modal-content1">
			<span class="close4">&times;</span>

			<div class="details">
				<h4>Other Details</h4>
			</div>
			<div class="login">
				<div class="login-screen">
					<div class="app-title">
					
						<h1>Registration</h1>
						<h5>(3/3)</h5>
					</div>
						<div class="login-form">

										<div class="control-group">
												<input type="number" class="login-field" value="" onblur="con()" placeholder="Contact no." name="contact" id="contact">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_contact">Hey ! Fill your contact</span>
										</div>
										
										<div class="control-group">
												<input type="email" class="login-field" value="" onblur="eemail()" placeholder="Email" name="email" id="email" >
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_email">Hey ! Fill your email correctly</span>
										</div>


										<div class="control-group">
												<input type="address" class="login-field" value="" onblur="permanent()" placeholder="Permanent Address" id="peraddress" name="peraddress">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_perm">Hey ! Fill your perm. address</span>
										</div>


										<div class="control-group">
												<input type="text" class="login-field" value="" onblur="corres()" placeholder="Correspondence Address" id="corraddress" name="corraddress" >
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_corr">Hey ! Fill your corr. address</span>
										</div>


										<div class="control-group">
												<input type="password" class="login-field" value="" onblur="pash()" placeholder="Password" id="pass" name="password">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_pass">Hey! Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character is required</span>
										</div>



										<div class="control-group">
												<input type="password" class="login-field" value="" onblur="conpash()" placeholder="Confirm Password" id="conpass" name="confirm password">
												<label class="login-field-icon fui-user" for="login-name"></label>
												<span class="error_modal" style="display:none" id="error_confirm">Password is not matched</span>
										</div>

										<div class="control-group" class=dropdown>
											<SELECT class="login-field" id="select_reg_question" name="reg_question">

											<OPTION  style="text-align: center;" Value="">Select your security question</OPTION>
											<OPTION Value="0" style="color:black;">What is your nick name?</OPTION>
											<OPTION Value="1" style="color:black;">Who is your fav actor?</OPTION>
											<OPTION Value="2" style="color:black;">Who is your fav acteress?</OPTION>
											<OPTION Value="3" style="color:black;">which team you will support in IPL?</OPTION>
											<OPTION Value="4" style="color:black;">Your fav place for vacation?</OPTION>
											
											</SELECT>
											<span class="error_modal" style="display:none"  id="error_select">Select your security question</span>
										</div>

										<div class="control-group">
												<input type="text" class="login-field" value="" onblur="seque()" placeholder="Answer" id="reg_answer" name="reg_answer">
												<label class="login-field-icon fui-lock" for="login-pass"></label>
												<span class="error_modal" style="display:none" id="error_ans">Fill the Answer</span>
										</div>

										<div class="control-group">
												<input type="file" class="login-field"name="photo"  id="photo">
												<span class="error_modal" style="display:none" id="error_photo">Upload your Photo</span>
												<label class="login-field-icon fui-user" for="login-name"></label>
										</div>


							<input type="submit" name="sub" id="sub" class="btn btn-primary btn-large btn-block" style="background-color:#1c2b4b" value="Register"/>

						</div>
					</form>
				</div>
			</div>

			<div id=previous2  class="btn btn-primary btn-large btn-block" style="background-color:#1c2b4b ;float:left;text-align: center;padding:4px 0;width:90px">
				<a onclick="previous2()">Previous</a>	
			</div>

			<div id=reset2  class="btn btn-primary btn-large btn-block" style="background-color:#1c2b4b ;float:right;text-align: center;padding:4px 0;width:90px">
				<a onclick="reset2()">Reset</a>	
			</div>

		</div>
	</div>


</div>

										<!--                                       carousel                   --->


<div id=main>
    <div class="slideshow-border"> 
            <div class="slidercontainer">  
                <div class="showSlide fade">  
                    <img src="images/img1.jpg" />  
                    <div class="content">NIT DGP</div>  
                </div>  
                <div class="showSlide fade">  
                    <img src="images/img2.jpeg" />  
                    <div class="content">NIT DGP</div>  
                </div>  
          
                <div class="showSlide fade">  
                    <img src="images/img3.jpg" />  
                    <div class="content">NIT DGP</div>  
                </div>  
                <div class="showSlide fade">  
                    <img src="images/img4.jpg" />  
                    <div class="content">NIT DGP</div>  
                </div>    
                <a class="left" onclick="nextSlide(-1)">❮</a>  
                <a class="right" onclick="nextSlide(1)">❯</a>  
            </div>
    </div>

    <div id="notice_table">
    	<br>
    	<br>
    	<br>
    	<br>
    	<br>
    	<br>
    	<br>
    	<br>
    	<br>
    	<br>
    	<br>


    <table class="table" style="width: 100%;" >
      <thead>
        <tr>
            <th style="width: 100%">Notice</th>
        </tr>
      </thead>
    </table >
    <table class="table" style="width: 100%;" >
      <tbody>
	    <?php 
	    	$s = "SELECT * FROM notice WHERE target='0'";
	    	$result = mysqli_query($con,$s) or die(mysqli_error($con));
			while($row = mysqli_fetch_assoc($result))
			{
	    ?>
        <tr>
            <th><?php echo $row["notice"]?></th>
        </tr>
    <?php } ?>
      </tbody>
    </table>
  
    <br>
    <br>
    <br>

	</div>



                                                        <!--               About us page -->



    <div id="aboutus">
        <div class="background">
            <div class="onbackground">
                <h1>AboutUs</h1>
            </div>
            <div class=p>
           			
                <p>We are the students of <b>NIT Durgapur</b> and with three members in a team.We design webpages just like here we have designed student login portal.Hope you liked our website  :) </p>

            </div>
            <div id="flex_container">

						<div class="member">
							<div class="flip-box">
			  					<div class="flip-box-inner">
			    					<div class="flip-box-front">
			   							<img src="images/Pradum.jpg"/>
									</div>
			    					<div class="flip-box-back">
										<br>
										<br>
			      						<h2>Pradum Kumar</h2>
			    					</div>
								</div>

			 		 		</div>
						</div>

						<div class="member" >
							<div class="flip-box">
			  					<div class="flip-box-inner">
			    					<div class="flip-box-front">
			   							<img src="images/SaiRam.jpg"/>
									</div>
			    					<div class="flip-box-back">
									<br>
									<br>
			      						<h2>Sai Ram</h2>
			    					</div>
								</div>

			 		 		</div>
						</div>


						<div class="member">
							<div class="flip-box">
			  					<div class="flip-box-inner">
			    					<div class="flip-box-front">
			   							<img src="images/Ankit.jpg"/>
									</div>
			    					<div class="flip-box-back">
										<br>
										<br>
			      						<h2>Ankit Kumar</h2>
			    					</div>
								</div>
			 		 		</div>			
						</div>
				</div>

        </div>
    </div>

</div>


	<script type="text/javascript" src="jquery.min.js"></script>
    <script src="js/javascript.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
