
<?php 

if ($_SESSION['cargo'] == 'coordenador') {
	echo '<nav class="main-nav">
	<ul>
	<li class="dropdown-item"><a href="professor.php">Inserir Questões</a></li>
	<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
	<li class="dropdown-item"><a href="admin.php">Admin</a></li>
	<li class="dropdown-item"><a href="coord.php">Gerar Prova</a></li>
	</ul>
	</nav>';
}else{
	echo '<nav class="main-nav">
	<ul>
	<li class="dropdown-item"><a href="professor.php">Inserir Questões</a></li>
	<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
	<li class="dropdown-item"><a href="admin.php">Admin</a></li>
	</ul>
	</nav>';
}

?>