<?php 


include("config_questoes.php");

if(!empty($_POST['insert_alternativa'])) {
	$questao = mysqli_real_escape_string($db,$_POST['pergunta']);
	$alt1 = mysqli_real_escape_string($db,$_POST['alt1']); 
	$alt2 = mysqli_real_escape_string($db,$_POST['alt2']); 
	$alt3 = mysqli_real_escape_string($db,$_POST['alt3']); 
	$alt4 = mysqli_real_escape_string($db,$_POST['alt4']); 
	$alt5 = mysqli_real_escape_string($db,$_POST['alt5']); 
	$alt_correta = mysqli_real_escape_string($db,$_POST['questao_correta']);
	$dificuldade_questao = mysqli_real_escape_string($db,$_POST['dificuldade']);
	$imgConvertida = mysqli_real_escape_string($db,$_POST['imgConvertida']);
	$area_conhecimento = mysqli_real_escape_string($db,$_POST['area_conhecimento']);
	$materia_escolhida = mysqli_real_escape_string($db,$_POST['materia_escolhida']);

	$sql = "INSERT INTO table_questoes (index_area,materia,questao,dificuldade,alt1,alt2,alt3,alt4,alt5,alt_correta,img) VALUES ('$area_conhecimento','$materia_escolhida','$questao','$dificuldade_questao','$alt1','$alt2','$alt3','$alt4','$alt5','$alt_correta','$imgConvertida')";


}else{
	echo "<script type='javascript'>alert('Email enviado com Sucesso!');";
	echo "javascript:window.location='index.php';</script>";
}
if (!empty($_POST['insert_dissertativa'])) {

	$questao = mysqli_real_escape_string($db,$_POST['pergunta']);
	$dificuldade_questao = mysqli_real_escape_string($db,$_POST['dificuldade']);
	$imgConvertida = mysqli_real_escape_string($db,$_POST['imgConvertida']);
	$area_conhecimento = mysqli_real_escape_string($db,$_POST['area_conhecimento']);
	$materia_escolhida = mysqli_real_escape_string($db,$_POST['materia_escolhida']);

	$sql = "INSERT INTO table_questoes (index_area,materia,questao,dificuldade,alt1,alt2,alt3,alt4,alt5,alt_correta,img) VALUES ('$area_conhecimento','$materia_escolhida','$questao','$dificuldade_questao','-','-','-','-','-','-','$imgConvertida')";
	

}
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($db->query($sql) === TRUE) {
		echo "<script type='javascript'>alert('Email enviado com Sucesso!');";
		echo "javascript:window.location='professor_2.php';</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}


?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/professor.css">
	<title></title>
	<script type="text/javascript">
		
		function areaAtuacao(){

			// coloca os id's selecionados fora do form dentro do form
			var area_conhecimento = $('.seletor_inicio').val();
			var materia_escolhida = $('.seletor_materia').val().substring(8,10);


			$('.form_questao').append('<input type="hidden" name="area_conhecimento" value="'+area_conhecimento+'" required>');
			$('.form_questao').append('<input type="hidden" name="materia_escolhida" value="'+materia_escolhida+'" required>');



			$('#seletor_area').css("display","none");
			$('#seletor_tipo').css("display","block");
			$('#seletor_materia').css("display","none");


			
		}
		function mudaTipo(){
			if ($('#q_alt').prop("checked")) {
				$('#seletor_tipo').css("display","none");
				$('#alternativa').css("display","block");
				$('#dissertativa').css("display","none");
			}else if ($('#q_dis').prop("checked")){
				$('#seletor_tipo').css("display","none");
				$('#alternativa').css("display","none");
				$('#dissertativa').css("display","block");
			}
		}

		$( document ).ready(function() {
			document.getElementById("imgInp").addEventListener("change", converte);
		});


	</script>
</head>
<body >

	<?php include ("header.php") ?>

	<div class="wrapper">
		<header class="main-head">
		</header>
		<?php include('nav.php') ?>

		<!-- SELETOR DE AREA ATUAÇÃO -->
		<article class="content" id="seletor_area">
			<div class="form-group">
				<fieldset style="border: 1px solid #00AD8E">
					<legend class="seletor_tipo legenda">Selecione a área de conhecimento:</legend>


					<?php 

					$query="SELECT * FROM table_areas";
					$results = mysqli_query($db,$query);
					echo '<select name="select" class="seletor_inicio seletores" onchange="'?>select_materia(this)<?php echo'">';
					echo "<option disabled selected value> -- Selecione uma área -- </option>";
					while($row = mysqli_fetch_array($results))
					{
						echo '<option value="' . $row['index_area'] . '" class="materias" id="'.$row['index_area'].'">' 
						. $row['area'] 
						. '</option>';
					}
					echo '</select>';

					?>
					<br><br>

				</fieldset>
			</div>
		</article>


		<!-- SELETOR DE MATERIA -->
		<article class="content" id="seletor_materia">
			<div class="form-group">
				<fieldset style="border: 1px solid #00AD8E">
					<legend class="seletor_tipo legenda">Selecione a matéria desejada:</legend>


					<select name="select" class="seletor_materia seletores" id="materias_select" onchange="checaID()" disabled>
						<option value="" selected disabled>-- Selecione uma matéria --</option>
						<!-- php vai popular o datalist -->

					</select>

					<br><br>

				</fieldset>
			</div>
			<button onclick="areaAtuacao()" id="btnTipo" disabled name="insert_alternativa" value="Inserir Alternativa" class="btn btn-success">Próximo</button>
		</article>

		<!--QUESTÃO ALTERNATIVA  -->

		<!-- SELETEOR DE TIPO DE QUESTÃO -->
		<article class="content" id="seletor_tipo" style="display: none;">
			<div class="form-group">
				<fieldset style="border: 1px solid #00AD8E">
					<legend class="seletor_tipo legenda">Selecione o tipo da questão:</legend>

					<div class="radio">
						<input type="radio" id="q_alt" name="tipo_questao" value="1" onchange="mudaTipo()" />
						<label for="q_alt">Alternativa</label>
					</div>

					<div class="radio">
						<input type="radio" id="q_dis" name="tipo_questao" value="2" onchange="mudaTipo()" />
						<label for="q_dis">Dissertativa</label>
					</div>

				</fieldset>
			</div>
		</article>

		<!--QUESTÃO ALTERNATIVA  -->

		<article class="content" id="alternativa" style="display: none;">
			<h1>Inserir Questão</h1>
			<form action = "professor_2.php" method = "POST" class="form_questao">
				<div class="form-group">
					<label for="pergunta"><h5>Digite a questão:</h5> </label>
					<textarea class="form-control" id="pergunta" name="pergunta" rows="3" style="resize: none;"></textarea>
				</div>
				<div class="form-group">
					<fieldset style="border: 1px solid #00AD8E">
						<legend class="legenda">Selecione a dificuldade da questão:</legend>

						<div class="radio">
							<input type="radio" id="facil" name="dificuldade" value="1" required/>
							<label for="facil">Facil</label>
						</div>

						<div class="radio">
							<input type="radio" id="medio" name="dificuldade" value="2" required/>
							<label for="medio">Médio</label>
						</div>

						<div class="radio">
							<input type="radio" id="dificil" name="dificuldade" value="3" required />
							<label for="dificil">Difícil</label>
						</div>
					</fieldset>
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
					<input class="form-control" id="alt1" name="alt1"  rows="1" max="100" required></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" required value="1">
						</div>
					</div>
				</div>

				<label for="alt2"><h5>Alternativa 2:</h5> </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt2" name="alt2" rows="1" max="100" required></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" required value="2">
						</div>
					</div>
				</div>

				<label for="alt3"><h5>Alternativa 3:</h5> </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt3" name="alt3" rows="1" max="100" required></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" required value="3">
						</div>
					</div>
				</div>

				<label for="alt4"><h5>Alternativa 4:</h5> </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt4" name="alt4" rows="1" max="100" required></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" required value="4">
						</div>
					</div>
				</div>

				<label for="alt5"><h5>Alternativa 5:</h5> </label>
				<div class="form-group input-group">
					<input class="form-control" id="alt5" name="alt5" rows="1" max="100" required></input>
					<div class="input-group-append">
						<div class="input-group-text">
							<input type="radio" aria-label="Radio button for following text input" name="questao_correta" required value="5">
						</div>
					</div>
				</div>

				<button type="submit" name="insert_alternativa" value="Inserir Alternativa" class="btn btn-success">Inserir</button><br />
				<?php 
				// if($_SERVER["REQUEST_METHOD"] == "POST") {
				// 	if ($db->query($sql) === TRUE) {
				// 		echo "<script type='javascript'>alert('Email enviado com Sucesso!');";
				// 		echo "javascript:window.location='professor_2.php';</script>";
				// 	} else {
				// 		echo "Error: " . $sql . "<br>" . $conn->error;
				// 	}
				// }
				?>
			</form>
		</article> 

		<!-- QUESTAO DISSERTATIVA -->


		<article class="content" id="dissertativa" style="display: none;">
			<h1>Inserir Questão</h1>
			<form action = "professor_2.php" method = "POST" class="form_questao">
				<div class="form-group">
					<label for="pergunta"><h5>Digite a questão:</h5> </label>
					<textarea class="form-control" id="pergunta" name="pergunta" rows="3" style="resize: none;" required></textarea>
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
				<div class="form-group">
					<fieldset style="border: 1px solid #00AD8E">
						<legend class="legenda">Selecione a dificuldade da questão:</legend>

						<div class="radio">
							<input type="radio" id="facil" name="dificuldade" value="1" required/>
							<label for="facil">Facil</label>
						</div>

						<div class="radio">
							<input type="radio" id="medio" name="dificuldade" value="2"/>
							<label for="medio">Médio</label>
						</div>

						<div class="radio">
							<input type="radio" id="dificil" name="dificuldade" value="3"/>
							<label for="dificil">Difícil</label>
						</div>
					</fieldset>
				</div>
				<button type="submit" name="insert_dissertativa" value="Inserir Dissertativa" class="btn btn-success">Inserir</button><br />
				<?php 
				// if($_SERVER["REQUEST_METHOD"] == "POST") {
				// 	if ($db->query($sql) === TRUE) {
				// 		echo "<script type='javascript'>alert('Email enviado com Sucesso!');";
				// 		echo "javascript:window.location='professor_2.php';</script>";
				// 	} else {
				// 		echo "Error: " . $sql . "<br>" . $conn->error;
				// 	}
				// }
				?>	
			</form>
		</article>
		<footer class="main-footer"></footer>
	</div>
	<?php include ("footer.php") ?>
	<script type="text/javascript" src=js/scripts.js></script>
</body>
</html>