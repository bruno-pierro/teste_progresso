<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
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
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1>Alterar senha</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<p class="text-center">Use o formulário abaixo para alterar sua senha.</p>
						<form method="post" id="passwordForm">
							<input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="Nova senha" autocomplete="off">
							<div class="row">
								<div class="col-sm-6">
									<span id="8char" class="fas fa-times" style="color:#FF0004;"></span> 8 caracteres.<br>
									<span id="ucase" class="fas fa-times" style="color:#FF0004;"></span> Uma letra maiúscula.
								</div>
								<div class="col-sm-6">
									<span id="lcase" class="fas fa-times" style="color:#FF0004;"></span> Uma letra minúscula<br>
									<span id="num" class="fas fa-times" style="color:#FF0004;"></span> Um número.
								</div>
							</div>
							<input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repita a senha" autocomplete="off">
							<div class="row">
								<div class="col-sm-12">
									<span id="pwmatch" class="fas fa-times" style="color:#FF0004;"></span> Senhas são iguais.
								</div>
							</div><br><br>
							<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Alterando senha..." value="Alterar">
						</form>
					</div><!--/col-sm-6-->
				</div><!--/row-->
			</div>
		</article> 
		<footer class="main-footer"></footer>
	</div>
	<?php include("footer.php") ?>
	<script type="text/javascript" src=js/admin.js></script>
</body>
</html>