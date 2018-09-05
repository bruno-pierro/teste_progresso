<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

</head>
<body>
	<?php include("header.php") ?>
	<?php 
	$login_edicao = $_SESSION['username'];
	include("config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST") {



		$login_edicao = $_SESSION['username'];
		$psw = mysqli_real_escape_string($db,$_POST['password1']);


		$sql = " UPDATE table_login SET senha='$psw' where id='$login_edicao'";
		$results = mysqli_query($db,$sql);

		if(mysqli_query($db,$sql))//query execution
		{
			echo '<script language="javascript" type="text/javascript"> 
			alert("Senha Alterada!");
			window.location = "admin.php";
			</script>';
		}
		else
		{
			echo '<script language="javascript" type="text/javascript"> 
			alert("Deu merda!");
			window.location = "admin.php";
			</script>';
		}
	}


	?>
	<div class="wrapper">
		<header class="main-head">
		</header>
		<?php include('nav.php') ?>
		<article class="content">
			<div class="container">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados do usuário</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Alterar Senha</a>
					</li>
					<?php 

					if ($_SESSION['cargo'] == 'coordenador') {
						echo '<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profs" role="tab" aria-controls="profile" aria-selected="false">Professores Cadastrados</a>
						</li>';
					}

					?>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
						<div class="card">
							<div class="card-header">
								Dados da Conta
							</div>
							<div class="card-body">
								<p class="card-text">
									<?php 
									echo "Usuário: ", $_SESSION['username'], "<br />";
									echo "Curso(s): ", $_SESSION['curso'], "<br />";
									echo "Cargo: ", ucwords($_SESSION['cargo']), "<br /><br>";

									?>
								</p>
							</div>
						</div>
						
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="container"><br>
							<!--  -->
							<div class="card">
								<div class="card-header">
									Alterar Senha
								</div>
								<div class="card-body">
									<h5 class="card-title">Use o formulário abaixo para alterar sua senha</h5>
									<p class="card-text">
										<form method="post" action="admin.php" id="passwordForm">
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
											</div><br>
											<input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repita a senha" autocomplete="off">
											<div class="row">
												<div class="col-sm-12">
													<span id="pwmatch" class="fas fa-times" style="color:#FF0004;"></span> Senhas são iguais.
												</div>
											</div><br><br>
											<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Alterando senha..." value="Alterar">
										</form>
									</p>
								</div>
							</div>
							<!--  -->
							
						</div>
					</div>
					<div class="tab-pane fade" id="profs" role="tabpanel" aria-labelledby="profs-tab">
						<table class="monta table table-striped">
							<thead class="thead-light">
								<tr>
									<th scope="col">Nome</th>
									<th scope="col">Login</th>
									<th scope="col">Curso</th>
									<th scope="col">Cargo</th>
								</tr>
							</thead><br>
							<tbody>
								<?php 
								// include("config.php");
								$query="SELECT * FROM table_login where cargo = 'professor'";
								$results = mysqli_query($db,$query);

								while ($row = mysqli_fetch_array($results)) {
										echo "<tr><td>" . $row['nome'] . "</td><td>" . $row['id'] ."</td><td>".$row['curso']."</td><td>".$row['cargo']."</td></tr>";
										continue;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</article> 
		<footer class="main-footer"></footer>
	</div>
	<?php include("footer.php") ?>
	<script type="text/javascript" src=js/admin.js></script>
</body>
</html>