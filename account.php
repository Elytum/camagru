<html>
	<head>
		<?php include('header.php');?>
	</head>
	<body>
	<?php 
		echo '<p>Account</p>';
	?>

<form id="identification" method="post" action="identification.php">
	<div class="box">
		<h1>Identification</h1>

		<script>
			function field_focus(field, email) {
				if (field.value == email) {
					field.value = '';
				}
			}

			function field_blur(field, email) {
				if (field.value == '') {
					field.value = email;
				}
			}

			function handleClick(type) {
				document.getElementById('formType').value = type;
				document.getElementById('identification').submit();
			}
		</script>

		<input type="email" name="email" value="email@email.com" onFocus="field_focus(this, 'email@email.com');" onblur="field_blur(this, 'email@email.com');" class="formular" />
		<input type="password" name="password" value="password" onFocus="field_focus(this, 'password');" onblur="field_blur(this, 'email');" class="formular" />
		<input hidden="true" name="formType" id="formType" />
		
		<a onclick="handleClick('login');" ><div class="btn">Sign In</div></a>
		<a onclick="handleClick('subscribe');" ><div id="btn2">Sign Up</div></a>
	  
	</div> <!-- End Box -->
  
</form>


	<?php include('footer.php');?>
	</body>
</html>