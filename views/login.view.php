<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<title>Log Session</title>
</head>
<body>
	<div class="container">
		<h1 class="title">Log Session</h1>
		
		<hr class="border">
		
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="application-form" name="login">
			<div class="form-group">
				<i class="icon left fa fa-user"></i><input type="text" name="user" class="user" placeholder="User">
			</div>

			<div class="form-group">
				<i class="icon left fa fa-lock"></i><input type="password" name="password" class="password_btn" placeholder="Password"> 
				<i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
			</div>
			<?php if(!empty($errors)): ?>
				<div class="error">
					<ul>
						<?php echo $errors; ?>
					</ul>
				</div>
			<?php endif; ?>	
		</form>
			<p class="text-sign-in"> 
				Don't you have an account yet ?
				<a href="signin.php">Sign in</a>
			</p>
	</div>
</body>
</html>