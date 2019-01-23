<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<script type="text/javascript">
		
	</script>

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

		if(mysqli_query($db,$sql))
		{
			echo '<script language="javascript" type="text/javascript"> 
			alert("Senha Alterada! '.$psw.'");
			</script>';
		}
		else
		{
			echo '<script language="javascript" type="text/javascript"> 
			alert("Ocorreu um erro!");
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
						</li><li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#materias" role="tab" aria-controls="profile" aria-selected="false">Materias Cadastradas</a>
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
									if ($_SESSION['cargo'] == 'coordenador') {
										echo "Usuário: ", $_SESSION['username'], "<br />";
										echo "Curso(s): o usuário tem acesso a todos os cursos<br />";
										echo "Cargo: ", ucwords($_SESSION['cargo']), "<br /><br>";
									}else{
										
										echo "Usuário: ", $_SESSION['username'], "<br />";
										echo "Curso(s): ", $_SESSION['curso'], "<br />";
										echo "Cargo: ", ucwords($_SESSION['cargo']), "<br />";
										echo "Materias: ", ucwords($_SESSION['curso']), "<br /><br>";
									}

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
											<input type="password" class="input-lg form-control" name="password1" id="password1" maxlength="8" placeholder="Nova senha" autocomplete="off" required>
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
											<input type="password" class="input-lg form-control" name="password2" id="password2" maxlength="8" placeholder="Repita a senha" autocomplete="off" required>
											<div class="row">
												<div class="col-sm-12">
													<span id="pwmatch" class="fas fa-times" style="color:#FF0004;"></span> Senhas são iguais.
												</div>
											</div><br><br>
											<input type="submit" style="display:none" class="col-xs-12 btn btn-primary btn-load btn-lg bt_altera" data-loading-text="Alterando senha..." value="Alterar">
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
					<div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab">
						<table class="monta table table-striped">
							<thead class="thead-light">
								<tr>
									<th scope="col">Nome da matéria</th>
									<th scope="col">Area de conhecimento</th>
								</tr>
							</thead><br>
							<tbody>
								<?php 
								// include("config_questoes.php");
								$query2="SELECT m.nome_materia, m.index_area, a.area, a.index_area FROM bd_questoes.table_materia m left join bd_questoes.table_areas a on m.index_area = a.index_area ";
								$results2 = mysqli_query($db,$query2);
								if (!$results2) {
									printf("Error: %s\n", mysqli_error($db));
									exit();
								}
								while ($row2 = mysqli_fetch_array($results2)) {
									echo "<tr><td>" . $row2['nome_materia'] . "</td><td>" . $row2['area'] ."</td></tr>";
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