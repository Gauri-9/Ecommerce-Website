
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
			
		<div class="row align-items-center px-4" style="height:80vh">
			<div class="col-md-4">
				<h4>Change Password</h4>
				<form method="post">
					<input type="password" placeholder="Old password" name="op" id="op" class="form-control" style="margin-bottom:15px">
					<input type="password" placeholder="New password" name="np" id="np" class="form-control" style="margin-bottom:15px">
					<div id="np-message" class="message"></div>

					<input type="password" placeholder="Re-enter password" name="rp" id="rp" class="form-control" style="margin-bottom:15px">
					 <div id="rp-message" class="message"></div>

					<button type="submit" class="btn btn-outline-primary" class="form-control" name="update_password_button">Update Password</button>
  				</form>
			</div>
		</div>
				
</body>
</html>