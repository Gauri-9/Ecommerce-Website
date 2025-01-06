<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<table class="table">
	<tr>
	    <th>Photo</th>
		<td><img src="<?php echo $imagepath?>" class="img-fluid" width=150px></td>
	</tr>
	<tr>
		<th>Fullname</th>
		<td><?php echo $data["fullname"];?>	</td>
	</tr>
	<tr>
		<th>Email</th>
		<td><?php echo $data["email"];?></td>
	</tr>
	<tr>
		<th>Password</th>
		<td><?php echo $data["password"];?>	</td>			
	</tr>
	<tr>
		<th>Contact</th>
		<td><?php echo $data["contact"];?></td>					
	</tr>
	<tr>
		<th>Age</th>			

		<td><?php echo $data["age"];?>	</td>			
	</tr>	

</table>	
</body>
</html>		