<?php 


include("config_questoes.php");
$id_materia = $_POST['change'];
echo $id_materia;
$query2="SELECT * FROM table_materia where index_area=".$id_materia."";
echo $query2;
$results2 = mysqli_query($db,$query2);
if(isset($results2)) {
	print_r('Registro Excluido!');
} else {
	print_r('Registro Excluido!');
}

?>