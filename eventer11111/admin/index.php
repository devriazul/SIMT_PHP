<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Eventer - Admin Panel</title>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>

<script type="text/javascript">
	
	$(document).ready(function() {
		$('input').placeholder();
		
		$('#submit-btn').click(function(e) {
			e.preventDefault();
			$('#login-form').submit();
        });
		
		$('#login-form').submit(function(e) {
			isValid = true;
			
			if ($("#username").val() == '' || $("#username").val() == 'username') {
				isValid = false;
				$("p.username-error").text('please enter a username');
				$("p.username-error").slideDown(500);
			}
			else {
				$("p.username-error").slideUp(500);
			}
			
			if ($("#password").val() == '' || $("#password").val() == 'username') {
				isValid = false;
				$("p.password-error").text('please enter a password');
				$("p.password-error").slideDown(500);
			}
			else {
				$("p.password-error").slideUp(500);
			}
			
			if (isValid) {
				$("p.msg").slideUp(500);
			}
			
			return isValid;
        });
		
	});
	
</script>

<style>
	
	body {
		background:url(images/bg-grain.jpg);
		border-top:5px solid #CF3B06;
		padding:0;
		margin:0;
	}
	
	div.header img {
		display:block;
		margin:50px auto;
	}
	
	#login-form-wrapper {
		border-radius:5px;
		width:400px;
		margin:0 auto;
		padding:20px;
		overflow:hidden;
	}
	
	h1 {
		font-size:36px;
		font-weight:bold;
		line-height:60px;
		text-align:center;
		color:#CF3B06;
		margin:15px 0 0 10px;
		text-shadow:1px 1px 1px #fff;
	}
	
	h2 {
		font-size:24px;
		line-height:60px;
		text-align:center;
		color:#636363;
		margin:15px 0 0 10px;
		text-shadow:1px 1px 1px #fff;
	}
	
	#login-form {
		
	}
	
	#login-form p {
		margin:20px 0 0 0;
	}
	
	p.msg {
		margin:35px 0;
		padding:0 0 0 10px;
		color:#CF3B06;
		text-align:center;
	}
	
	#login-form p.error {
		display:none;
		margin:5px 0 0 0;
		padding:0 0 0 10px;
		color:#CF3B06;
	}
	
	input.textfield {
		background:url(images/form_field_bg.png) no-repeat;
		font-size:14px;
		line-height:20px;
		color:#636363;
		width:380px;
		height:20px;
		border:none;
		padding:10px;
	}
	
	input.textfield:focus {
		box-shadow:0 0 8px #FFFFFF;
	}
	
	#submit-btn {
		background:url(images/login_btn.png) no-repeat;
		width:91px;
		height:37px;
		text-indent:-9999px;
		cursor:pointer;
		border:none;
		display:block;
		margin:0 auto;
	}
	
	#submit-btn:hover {
		background:url(images/login_btn_over.png) no-repeat;
	}
	
</style>
</head>

<body>
	<?php
		$error = '';
		
		if (isset($_GET['error'])) {
			if ($_GET['error'] == 'user') {
				if (isset($_GET['username'])) {
					$username = ' '.$_GET['username'];
				}
				
				$error = "User$username doesn't exist in the database.";
			}
			else if ($_GET['error'] == 'password') {
				$error = "Password didn't match. Please provide the correct password.";
			}
			else {
				
			}
		}
	?>
	<div id="login-form-wrapper">
        <div class="header"><img src="images/eventer_admin_login.png" width="239" height="41" alt=""/></div>
        <?php
			if ($error) {
		?>
        <p class="msg"><?php echo $error; ?></p>
        <?php	
			}
		?>
        <form id="login-form" action="login.php" method="post">
        	<p>
                <input name="name" id="username" value="" placeholder="username" class="textfield" />
                
            </p>
            <p class="error username-error"></p>
            <p>
                <input type="password" id="password" name="password" value="" placeholder="password" class="textfield" />
            </p>
            <p class="error password-error"></p>
            <p>
                <input type="submit" name="submit-btn" id="submit-btn" value="Login" class="button" />
            </p>
        </form>
	</div>

</body>
</html>