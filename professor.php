<?php 
	if(empty($_GET)) {
        header('Location: login.php');
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col">
				1 of 3
			</div>
			<div class="col-6">
				2 of 3 (wider)
			</div>
			<div class="col">
				3 of 3
			</div>
		</div>
		<div class="row">
			<div class="col">
				1 of 3
			</div>
			<div class="col-5">
				2 of 3 (wider)
			</div>
			<div class="col">
				3 of 3
			</div>
		</div>
	</div>
</body>
</html>