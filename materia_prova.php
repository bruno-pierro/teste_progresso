<?php 
$id_materia = $_POST['change'];
$query2="SELECT * FROM table_materia";
$results2 = mysqli_query($db,$query2);
echo "<option disabled selected value> -- Selecione uma matéria -- </option>";
while($row2 = mysqli_fetch_array($results2))
{
	echo '<option value="'.$row2['index_materia'] .'">' 
	. $row2['nome_materia'] 
	. '</option>';
}

?>