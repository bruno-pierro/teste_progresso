<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<title></title>
</head>
<body>

		<?php include ("header.php") ?>

		<div class="wrapper">
			<!-- <header class="main-head">The header</header> -->
			<nav class="main-nav">
				<ul>
					<li class="dropdown-item"><a href="professor.php">Inserir Questões</a></li>
					<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
					<li class="dropdown-item"><a href="admin.php">Admin</a></li>
				</ul>
			</nav>
			<article class="content">
				<h1>Consultar questões:</h1>
				<table class="monta table table-striped">
					<thead class="thead-light">
						<tr>
							<th scope="col">Questão</th>
							<th scope="col">Alternativa 1</th>
							<th scope="col">Alternativa 2</th>
							<th scope="col">Alternativa 3</th>
							<th scope="col">Alternativa 4</th>
							<th scope="col">Alternativa 5</th>
							<th scope="col">Alternativa Correta</th>
							<th scope="col">Imagem Inserida</th>
							<th scope="col">       </th>
						</tr>
					</thead>
					<tbody>
						<?php 
						include("config_questoes.php");
						$query="SELECT questao, alt1,alt2,alt3,alt4,alt5,alt_correta,id, img FROM table_questoes";
						$results = mysqli_query($db,$query);

						while ($row = mysqli_fetch_array($results)) {

							$certo = $row['alt_correta'];
							echo "<tr id='".$row['id']."'><td>" . $row['questao'] . "</td><td>" . $row['alt1'] ."</td><td>".$row['alt2']."</td><td>".$row['alt3']."</td><td>".$row['alt4']."</td><td>".$row['alt5']."</td><td>".$row['alt'.$certo.'']. "</td><td><img style='width:50px; height:50px;' onclick='img(this.id);' data-toggle='modal' data-target='#exampleModal' id='img".$row['id']."' class='imagemModal' src='".$row['img']."'></td><td><a id='".$row['id']."' href='' onclick='edit(this.id);'><i class='far fa-edit'></a></i><a href='' id='".$row['id']."' onclick='exclui(this.id);'><i class='fas fa-times'></i></a></td></tr>";

						}

					//echo $src[0].'<br><br>';
						?>
					</tbody>
				</table>
				<!-- Button trigger modal -->

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Visualização</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body modalzin">

								<!-- monta o modalzinho -->

							</div>
							<div class="modal-footer">
							</div>
						</div>
					</div>
				</div>
			</form>
		</article> 
	</div>

		<?php include ("footer.php") ?>
	
			<script type="text/javascript" src=js/scripts.js></script>
		</body>
		</html>

