<?php 


include("config_questoes.php");
$id_exclusao = $_POST['del_id'];
$qry='DELETE FROM table_questoes where id ='.$id_exclusao.'';
$results = mysqli_query($db,$qry);
if(isset($results)) {
	print_r('Registro Excluido!');
} else {
	print_r('Registro Excluido!');
}

?>