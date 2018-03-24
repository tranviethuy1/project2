<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
</head>
<body>
	<h3>Admin page</h3>
	<?php
		if(session()->has('name')){
			echo "Hello ".session('name')."<br>";
		}
	?>
	<a href="{{route('logout')}}">Logout</a>
</body>
</html>

