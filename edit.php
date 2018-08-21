<?php 

$edit_id = $_GET['teste'];

include("config_questoes.php");
$query='SELECT questao, alt1,alt2,alt3,alt4,alt5,alt_correta,id, img FROM table_questoes where id ='.$edit_id.'';
$results = mysqli_query($db,$query);
$row = mysqli_fetch_array($results);

if($_SERVER["REQUEST_METHOD"] == "POST") {
$questao = mysqli_real_escape_string($db,$_POST['pergunta']);
$alt1 = mysqli_real_escape_string($db,$_POST['alt1']); 
$alt2 = mysqli_real_escape_string($db,$_POST['alt2']); 
$alt3 = mysqli_real_escape_string($db,$_POST['alt3']); 
$alt4 = mysqli_real_escape_string($db,$_POST['alt4']); 
$alt5 = mysqli_real_escape_string($db,$_POST['alt5']); 
$alt_correta = mysqli_real_escape_string($db,$_POST['questao_correta']);
$imgConvertida = mysqli_real_escape_string($db,$_POST['imgConvertida']); 
// $edit_id = mysqli_real_escape_string($db,$_POST['id']); 
// $mypassword = mysqli_real_escape_string($db,$_POST['at5']); 
echo $edit_id;
 $sql = " UPDATE table_questoes SET questao='$questao',alt1='$alt1', alt2='$alt2', alt3 = '$alt3', alt4='$alt4',alt5='$alt5', alt_correta='$alt_correta', img='$imgConvertida' where id='$edit_id'";
// $sql = "INSERT INTO table_questoes (questao,alt1,alt2,alt3,alt4,alt5,alt_correta,img) VALUES ('$questao','$alt1','$alt2','$alt3','$alt4','$alt5','$alt_correta','$imgConvertida') where table_questoes.id = '$edit_id'";
echo $sql;

}
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
<body>
	<div class="wrapper">
		<header class="main-head">The header</header>
		<nav class="main-nav">
			<ul>
				<li class="dropdown-item"><a href="professor.php">Inserir Questões</a></li>
				<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
				<li class="dropdown-item"><a href="">Admin</a></li>
			</ul>
		</nav>
		<article class="content">
			<h1>Editar Questão</h1>
			<form action = "" method = "POST">
				<div class="form-group">
					<label for="pergunta">Digite a questão: </label>
					<textarea class="form-control" id="pergunta" name="pergunta" rows="3" style="resize: none;" ><?php echo htmlspecialchars($row['questao']); ?></textarea>
				</div>
				<div class="form-group">
					<label>Suba uma imagem que ilustre a questão (opcional):</label>
					<div class="input-group">
						<span class="input-group-btn btn-secondary">
							<span class="btn btn-default btn-file">
								Browse… <input type="file"  id="imgInp">
							</span>
						</span>
						<input type="text" class="form-control" readonly value="<?php echo htmlspecialchars($row['img']); ?>">
					</div>
					<img id='img-upload'/>
					<input  style="display: none" id="base64" name="imgConvertida"></input>
				</div>

				<div class="alert alert-primary alert-dismissible fade show" role="alert">
					Ao inserir todas as questões, cheque qual delas é a correta usando o círculo do lado direito do campo.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<label for="alt1">Alternativa 1: </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt1" name="alt1"  rows="1" max="100" value="<?php echo htmlspecialchars($row['alt1']); ?>"></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="1">
						</div>
					</div>
				</div>

				<label for="alt2">Alternativa 2: </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt2" name="alt2" rows="1" max="100"  value="<?php echo htmlspecialchars($row['alt2']); ?>"></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="2">
						</div>
					</div>
				</div>

				<label for="alt3">Alternativa 3: </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt3" name="alt3" rows="1" max="100"  value="<?php echo htmlspecialchars($row['alt3']); ?>"></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="3">
						</div>
					</div>
				</div>

				<label for="alt4">Alternativa 4: </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt4" name="alt4" rows="1" max="100"  value="<?php echo htmlspecialchars($row['alt4']); ?>"></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="4">
						</div>
					</div>
				</div>

				<label for="alt5">Alternativa 5: </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt5" name="alt5" rows="1" max="100"  value="<?php echo htmlspecialchars($row['alt5']); ?>"></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" value="5">
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-success">Editar</button><br />
				
			</form>
		</article> 
		<footer class="main-footer">The footer</footer>
	</div>
	<script type="text/javascript" src=js/scripts.js></script>
</body>
</html>