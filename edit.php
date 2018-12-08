<?php 
include("config_questoes.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$id_edicao = mysqli_real_escape_string($db,$_POST['id_edicao']);
	$questao = mysqli_real_escape_string($db,$_POST['pergunta']);
	$alt1 = mysqli_real_escape_string($db,$_POST['alt1']); 
	$alt2 = mysqli_real_escape_string($db,$_POST['alt2']); 
	$alt3 = mysqli_real_escape_string($db,$_POST['alt3']); 
	$alt4 = mysqli_real_escape_string($db,$_POST['alt4']); 
	$alt5 = mysqli_real_escape_string($db,$_POST['alt5']); 
	$alt_correta = mysqli_real_escape_string($db,$_POST['questao_correta']);
	$imgConvertida = mysqli_real_escape_string($db,$_POST['imgConvertida']); 
	
	$sql = " UPDATE table_questoes SET questao='$questao',alt1='$alt1', alt2='$alt2', alt3 = '$alt3', alt4='$alt4',alt5='$alt5', alt_correta='$alt_correta', img='$imgConvertida' where id='$id_edicao'";
	$results = mysqli_query($db,$sql);
	header('Location: consulta_questoes.php');
	exit;
}
$edit_id = $_GET['id_edicao'];
$query="SELECT questao, alt1,alt2,alt3,alt4,alt5,alt_correta,id, img FROM table_questoes where id ='$edit_id'";
$results = mysqli_query($db,$query);
$row = mysqli_fetch_array($results);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
	<title></title>
</head>
<body>
	<?php include ("header.php") ?>
	<div class="wrapper">
		<!-- <header class="main-head">The header</header> -->
		<input type="" class="correto_edit" style="display:none" value="<?php echo htmlspecialchars($row['alt_correta']); ?>">
		<script type="text/javascript">
			$( document ).ready(function() {
				if ($('#alt1').val() == '-') {
					$('.edit_alternativa').css('display','none');
				}
				if ($('#alt1').val() != '-') {
					var correto = $('.correto_edit').val() -1;
					$('.correto').eq(correto).attr('checked',true);					
				}


			});
			$( document ).ready(function() {
				document.getElementById("imgInp").addEventListener("change", converte);
			});

		</script>
		<nav class="main-nav">
			<ul>
				<li class="dropdown-item"><a href="professor_2.php">Inserir Questões</a></li>
				<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
				<li class="dropdown-item"><a href="admin.php">Admin</a></li>
			</ul>
		</nav>
		<article class="content">
			<h1>Editar Questão</h1>
			<form action = "edit.php?teste=<?php echo htmlspecialchars($row['id']); ?>" method = "POST">
				<div class="form-group">
					<label for="pergunta"><h5>Digite a questão: </h5></label>
					<input type="" name="id_edicao" style="display: none" value="<?php echo htmlspecialchars($row['id']); ?>">
					<textarea class="form-control" id="pergunta" name="pergunta" rows="3" style="resize: none;" ><?php echo htmlspecialchars($row['questao']); ?></textarea>
				</div>
				<div class="form-group">
					<label><h5>Suba uma imagem que ilustre a questão (opcional):</h5></label>
					<div class="input-group">
						<span class="input-group-btn btn-secondary"  style="    border-radius: .25em;">
							<span class="btn btn-default btn-file">
								Browse… <input type="file"  id="imgInp">
							</span>
						</span>
						<input type="text" class="form-control" readonly value="<?php echo htmlspecialchars($row['img']); ?>">
					</div>
					<img id='img-upload' src="<?php echo htmlspecialchars($row['img']); ?>" />
					<input  style="display: none" id="base64" name="imgConvertida" value="<?php echo htmlspecialchars($row['img']); ?>"></input>
				</div>

				<div class="edit_alternativa">
					
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						Ao inserir todas as questões, cheque qual delas é a correta usando o círculo do lado direito do campo.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<label for="alt1"><h5>Alternativa 1:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt1" name="alt1"  rows="1" max="100" value="<?php echo htmlspecialchars($row['alt1']); ?>"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" class="correto" value="1">
							</div>
						</div>
					</div>

					<label for="alt2"><h5>Alternativa 2:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt2" name="alt2" rows="1" max="100"  value="<?php echo htmlspecialchars($row['alt2']); ?>"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" class="correto" value="2">
							</div>
						</div>
					</div>

					<label for="alt3"><h5>Alternativa 3:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt3" name="alt3" rows="1" max="100"  value="<?php echo htmlspecialchars($row['alt3']); ?>"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" class="correto" value="3">
							</div>
						</div>
					</div>

					<label for="alt4"><h5>Alternativa 4:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt4" name="alt4" rows="1" max="100"  value="<?php echo htmlspecialchars($row['alt4']); ?>"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" class="correto" value="4">
							</div>
						</div>
					</div>

					<label for="alt5"><h5>Alternativa 5:</h5> </label>
					<div class="form-group input-group">
						<input class="form-control" id="alt5" name="alt5" rows="1" max="100"  value="<?php echo htmlspecialchars($row['alt5']); ?>"></input>
						<div class="input-group-append">
							<div class="input-group-text">
								<input type="radio" aria-label="Radio button for following text input" name="questao_correta" class="correto" value="5">
							</div>
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-success">Editar</button><br />
				
			</form>
		</article>  
		<!-- <footer class="main-footer">The footer</footer> -->
	</div>
	<?php include("footer.php") ?>
	<script type="text/javascript" src=js/scripts.js></script>
</body>
</html>