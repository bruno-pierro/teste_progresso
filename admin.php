<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
</head>
<body>
	<?php include("header.php") ?>
	<div class="wrapper">
		<header class="main-head">
		</header>
		<nav class="main-nav">
			<ul>
				<li class="dropdown-item"><a href="professor.php">Inserir Questões</a></li>
				<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
				<li class="dropdown-item"><a href="">Admin</a></li>
			</ul>
		</nav>
		<article class="content">
			<h1>Admin</h1>
			<form action = "professor.php" method = "POST">

			</form>
		</article> 
		<footer class="main-footer"></footer>
	</div>
	<?php include("footer.php") ?>
</body>
</html>