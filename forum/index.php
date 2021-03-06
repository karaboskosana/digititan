<?php
session_start();
//cheking if a user is connected if yes taje him inside website
if(isset($_SESSION['UID'] )){
	header("Location: home/");
 }	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Digititan Forum</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style/indexStyle.css" />
	<link rel="stylesheet" type="text/css" href="style/sharedStyle.css" />
	<link rel="icon" type="image/png" href="images/favicon.png" />	
	<script type="text/javascript" src="script/jquery.js"></script>
	<script type="text/javascript" src="script/jquery-ui.js"></script>
	<script type="text/javascript">
		$(function() {
			//ANIMATIONS TO SHOW AND HIDE THE SIGN UP AND THE LOGIN DIVS
			$("#BIGBOSS").hide();
			$("#signup-div").hide();
			$("#login-div").hide();
				//showing the sign up div to create a new account
				$(".signup-nav").click(function(){
					showSignupDiv();
				});

				//showing the login div to enter the website as a member
				$(".login-nav").click(function(){
					showLoginDiv();					
				});

				//Hiding the sign up and the login div when you click escape
				$(document).keyup(function(e){
					if(e.keyCode==27)
						hideLoginSignupDivs();
				});
				$(".cancel-action").click(function(){
					hideLoginSignupDivs();
				});

				//SIGNUP (CREATE NEW ACCOUNT) TREATEMENT 
				//an ajax request to add a new user to database
				$(".sign-up-success").hide();
				$(".sign-up-loading").hide();
				$("#error-signup").hide();
				//action for the sign up buttom
				$("#signup-button").click(function(){
					$("#sign-up-loading").show();
					var FullName =	$("#user-name-signup").val();
					var Email =	$("#user-email-signup").val();
					var Password = $("#user-password-signup").val();
					var PasswordConfirm = $("#user-password-confirm-signup").val();
					if ($.trim(FullName) !="" && $.trim(Email) !="" && $.trim(Password) !="" && $.trim(PasswordConfirm) !="" && Password==PasswordConfirm ) {				
						$.ajax({
							type:"POST",
							url:"api/api.php",
							data:{FullName:FullName,Email:Email,Password:Password,action:"signup"},
							success:function(data){
								$(".sign-up-loading").fadeOut(10);
								//alert(data);
								if($.trim(data)=="success"){//everything went right and the user were added

									$(".sign-up-success").fadeIn(300);
									$(".sign-up-success").fadeOut(700,function(){
										hideLoginSignupDivs();	
										$("#user-name-signup").val("");
										$("#user-email-signup").val("");
										$("#user-password-signup").val("");
										$("#user-password-confirm-signup").val("");
										$(".sign-up-success").hide();
									});
								}else if(data=="exist")//check if the email is alrady in the database if yes the user will not be added
									$("#error-signup").fadeIn(100,function(){
										$("#error-signup").fadeOut(4000);
									});						
								
							}
						});
					}else	
						alert(" Some errors on the form");
				});

				
				//LOGIN USER
				//an ajax request to check for the email and it's password if it matches the user will be redirected to the connected home page
				$(".login-success").hide();
				$(".login-loading").hide();
				$("#error-login").hide();
				//action to login the user
				$("#login-button").click(function(){
					 UserLogin();
				});

				$("#user-password-login").keyup(function(e){
					if (e.keyCode==13) {
						UserLogin();
					};
				});
				
				//to erase
				/*$(".logo").click(function(){
					alert($(window).width());
				});*/

				//Showing and Hiding the responsive menu
				$(".responsive-nav").hide();
				$("#index-menu-show").click(function(){
					$(".responsive-nav").toggle();
				}); 

		});

		//FUNCTION FOR THE LOGIN USER
		function UserLogin(){
			$(".login-loading").show();
					var EmailCon = $("#user-email-login").val();
					var PasswordCon = $("#user-password-login").val();
					$.ajax({
						type:"POST",
						url:"api/api.php",
						data:{EmailCon:EmailCon,PasswordCon:PasswordCon,action:"login"},
						success:function(data){
							//alert(data);
							$(".login-loading").hide();
							if ($.trim(data)=="good") {
								$(".login-success").fadeIn(400,function(){
									window.location.href = "home/";	
								});
							}else
								$("#error-login").fadeIn(100,function(){
										$("#error-login").fadeOut(4000);
								});	
						}
					});
		}

		//function that will hide the divs of signup and login
		function hideLoginSignupDivs(){				
			$("#BIGBOSS").slideUp(300,function(){
				$("#signup-div").hide();	
				$("#login-div").hide();
			});
		}

		//function that will show the login div
		function showLoginDiv(){
			$("#signup-div").hide();
			$("#BIGBOSS").fadeIn(200,function(){
				$("#login-div").slideDown(400);
			});
		}

		//function that will show the sign up div
		function showSignupDiv(){
			$("#login-div").hide();
			$("#BIGBOSS").fadeIn(200,function(){
				$("#signup-div").slideDown(400);
			});
		}

	</script>
</head>
<body>
	<header id="index-header" class="WhiteHeader">
		<div id="inside-header">
			<a class="logo"><img src="images/logo.png" height="50px"/></a>
			<nav class="nav">
				<li><a href="">HOME</a></li>
				<li><a href="guest/">GUEST</a></li>
				<li><a href="guest/categories-list-guest.php">CATEGORIES</a></li>
				<li><a href="guest/rooms-guest.php">ROOMS</a></li>
				<!--<li><a href="guest/about.php">ABOUT</a></li>-->
				<li><a class="login-nav">LOGIN</a></li>
				<li><a class="signup-nav">SIGN UP</a></li>			
			</nav>
			<div id="index-menu-show" title="Show menu"></div>
			
			<nav class="responsive-nav WhiteHeader">
					<li><a href="">HOME</a></li>
					<li><a href="guest/">GUEST</a></li>
					<li><a href="guest/categories-list-guest.php">CATEGORIES</a></li>
					<li><a href="guest/rooms-guest.php">ROOMS</a></li>
					<!--<li><a href="guest/about.php">ABOUT</a></li>-->
					<li><a class="login-nav">LOGIN</a></li>
					<li><a class="signup-nav">SIGN UP</a></li>
			</nav>

		</div>
	</header>


	<div id="container">
		<div id="info">
			<div class="insider">
				<div class="info-insider-left">
					<span class="insider-left-strong" id="info-strong">Welcome to TVET IT & Computer Science Educators Forum</span>
					<!--<span class="insider-left-soft" id="info-soft">
						<span class="soft-0">dtForum  a Digititan Forum</span> 
						<span class="soft-1">Add more text here......</span> 
						<span class="soft-2">and again why people must join.</span><br/>
						<span class="soft-3">and yes yes.....</span>
					</span> -->
				</div>
				<div class="info-insider-right">
					<img src="images/forum.png" id="info-image"> 
					
				</div>
			</div>
		</div>

		<div id="about">
			<div class="insider">
				<span class="about-title">About The Forum</span>
				<div class="about-container-items">
					<div class="about-par">The Technical Vocational Education and Training (TVET) Information Technology & Computer Science 
						Educators Forum is an engagement forum for educators and other interested partners where all issues related to 
						Information Technology (IT) & Computer Science teaching and learning at TVET Colleges are discussed.</div>
				</div>
			</div>
		</div>
	</div>

	<div id="BIGBOSS">
		<!--THE LOGIN AND THE SIGN UP HIDDEN DIV-->
		<!--CREATE NEW ACOUNT DIV-->
		<div id="signup-div" class="user-action">
			<div class="user-action-header">
				Create new account
			</div>
			
			<div class="user-inputs">
				<input type="text" name="user-name-signup" id="user-name-signup"  placeholder="Full name">
				<input type="email" name="user-email-signup" id="user-email-signup"  placeholder="Email">
				<input type="password" name="user-password-signup" id="user-password-signup" placeholder="Password">
				<input type="password" name="user-password-confirm-signup" id="user-password-confirm-signup" placeholder="Confirm password">
				<span class="red-error" id="error-signup">The email exists already</span>
				<div class="user-action-button" id="signup-button">
					SIGN UP
					<div class="sign-up-success"></div>
					<div class="sign-up-loading loading"></div>
				</div>
			</div>
			<div class="user-action-footer">
				Already member ? <a class="login-nav">Log in</a><br/>
				<div class="cancel-action"  title="hide"></div>
			</div>			
		</div>	

		<!--LOG IN USING EXISTING ACCOUNT DIV-->
		<div id="login-div" class="user-action">
			<div class="user-action-header">
				Log in the forum
			</div>
			
			<div class="user-inputs">	
				<input type="email" name="user-email-login" id="user-email-login"  placeholder="Email">
				<input type="password" name="user-password-login" id="user-password-login" placeholder="Password">
				<span class="red-error" id="error-login">Error Login</span>
				<div class="user-action-button" id="login-button">
					LOG IN
					<div class="login-success"></div>
					<div class="login-loading loading"></div>
				</div>
			</div>
			<div class="user-action-footer">
				<a href="reset.php?ask">Forget password?</a> Not member yet ? <a class="signup-nav">Sign up </a><br/>
				<div class="cancel-action" title="hide"></div>
			</div>			
		</div>	

	</div>

</body>
</html>