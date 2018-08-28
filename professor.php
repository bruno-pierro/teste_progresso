<?php 


include("config_questoes.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$questao = mysqli_real_escape_string($db,$_POST['pergunta']);
	$alt1 = mysqli_real_escape_string($db,$_POST['alt1']); 
	$alt2 = mysqli_real_escape_string($db,$_POST['alt2']); 
	$alt3 = mysqli_real_escape_string($db,$_POST['alt3']); 
	$alt4 = mysqli_real_escape_string($db,$_POST['alt4']); 
	$alt5 = mysqli_real_escape_string($db,$_POST['alt5']); 
	$alt_correta = mysqli_real_escape_string($db,$_POST['questao_correta']);
	$imgConvertida = mysqli_real_escape_string($db,$_POST['imgConvertida']); 

	$sql = "INSERT INTO table_questoes (questao,alt1,alt2,alt3,alt4,alt5,alt_correta,img) VALUES ('$questao','$alt1','$alt2','$alt3','$alt4','$alt5','$alt_correta','$imgConvertida')";


}

// $result = mysqli_query($db,$sql);
// $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
	<title></title>
</head>
<body >

		<?php include ("header.php") ?>

		<div class="wrapper">
			<header class="main-head">
			</header>
			<nav class="main-nav">
				<ul>
					<li class="dropdown-item"><a href="professor.php">Inserir Questões</a></li>
					<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
					<li class="dropdown-item"><a href="admin.php">Admin</a></li>
				</ul>
			</nav>
			<article class="content">
				<h1>Inserir Questão</h1>
				<form action = "professor.php" method = "POST">
					<div class="form-group">
						<label for="pergunta"><h5>Digite a questão:</h5> </label>
						<textarea class="form-control" id="pergunta" name="pergunta" rows="3" style="resize: none;"></textarea>
					</div>
					<div class="form-group">
						<label><h5>Suba uma imagem que ilustre a questão (opcional):</h5></label>
						<div class="input-group">
							<span class="input-group-btn btn-secondary" style="    border-radius: .25em;">
								<span class="btn btn-default btn-file">
									Browse… <input type="file"  id="imgInp">
								</span>
							</span>
							<input type="text" class="form-control" readonly>
						</div>
						<img id='img-upload'/>
						<input  style="display: none" id="base64" name="imgConvertida"></input>
					</div>

					<div class="alert alert-info alert-dismissible fade show" role="alert">
						Ao inserir todas as questões, cheque qual delas é a correta usando o círculo do lado direito do campo.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<label for="alt1"><h5>Alternativa 1:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt1" name="alt1"  rows="1" max="100"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="1">
							</div>
						</div>
					</div>

					<label for="alt2"><h5>Alternativa 2:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt2" name="alt2" rows="1" max="100"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="2">
							</div>
						</div>
					</div>

					<label for="alt3"><h5>Alternativa 3:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt3" name="alt3" rows="1" max="100"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="3">
							</div>
						</div>
					</div>

					<label for="alt4"><h5>Alternativa 4:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt4" name="alt4" rows="1" max="100"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="4">
							</div>
						</div>
					</div>

					<label for="alt5"><h5>Alternativa 5:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt5" name="alt5" rows="1" max="100"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="5">
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-success">Inserir</button><br />
					<?php 
					if($_SERVER["REQUEST_METHOD"] == "POST") {
						if ($db->query($sql) === TRUE) {
							echo "New record created successfully";
						} else {
							echo "Error: " . $sql . "<br>" . $conn->error;
						}
					}
					?>
				</form>
			</article> 
			<footer class="main-footer"></footer>
		</div>
		<?php include ("footer.php") ?>
				<script type="text/javascript" src=js/scripts.js></script>
			</body>
			</html>