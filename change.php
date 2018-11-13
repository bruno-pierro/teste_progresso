<?php 


include("config_questoes.php");
$id_materia = $_POST['change'];
$query2="SELECT * FROM table_materia where index_area=".$id_materia."";
$results2 = mysqli_query($db,$query2);
echo "<option value='' selected disabled>-- Selecione uma matéria --</option>";
while($row2 = mysqli_fetch_array($results2))
{
	echo '<option value="materia_' . $row2['index_materia'] . '" data-id="' . $row2['index_materia'] . '" class="materia_selecionada" id="materia_'.$row2['index_materia'].'">' 
	. $row2['nome_materia'] 
	. '</option>';
}

?>