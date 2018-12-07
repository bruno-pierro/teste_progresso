<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
	<?php 
	include('header.php');
	include('config_questoes.php')
	?>
	<div class="wrapper">
		<header class="main-head"></header>
		<?php include('nav.php') ?>
		<article class="content">
			<div class="container">
				<form class="col-centered">
					<table class="monta table table-striped">
						<thead class="thead-light">
							<tr>
								<th scope="col">Materia</th>
								<th scope="col">Quantidade</th>
								<th scope="col">Dificuldade</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody id="grade_questoes">
							<tr class="monta1 ">
								<th>
									<!-- <input list="materias" style="width:100%" class="questao1" id="materia_selecionada"> -->
									<select id="materias" style="width:100%" class="questao1 ddlMaterias" onchange="select_materia_prova(this)">
										<?php 
										include("materia_prova.php")
									
										?>
									</select>
								</th>
								<th><input type="number" min="1" max="10" name="quantidade1" class="questao1 ddlQtd" style="width:100%"></th>
								<!-- <th><input type="number" min="1" max="3" name="dificuldade" class="questao1 ddlDificuldade" style="width:100%"></th> -->
								<th><select name="dificuldade" class="questao1 ddlDificuldade" style="width:100%">
									<option disabled selected value> -- Selecione a dificuldade -- </option>
									<option value="1">Fácil</option>
									<option value="2">Médio</option>
									<option value="2">Difícil</option>
								</select></th>
								<th><button type="button" class="btn btn-secondary questao1 bt1" onclick="checa()">Inserir</button></th>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th><button type="button" class="btn btn-secondary bt_gerasamba"  onclick="gera()">Gerar Prova</button></th>
								<th class="contador" colspan="3">Quantidade de questões: 0</th>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</article>

		<footer class="main-footer"></footer>
	</div>
</body>
<?php include('footer.php') ?>
<script type="text/javascript" src=js/scripts.js></script>
</html>