
<?php 

if ($_SESSION['cargo'] == 'coordenador') {
	echo '<nav class="main-nav">
	<ul>
	<li class="dropdown-item"><a href="professor_2.php">Inserir Questões</a></li>
	<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
	<li class="dropdown-item"><a href="admin.php">Admin</a></li>
	<li class="dropdown-item"><a href="coord.php">Gerar Prova</a></li>
	<li class="dropdown-item"><a href="logout.php">Logout</a></li>
	</ul>
	</nav>';
}else{
	echo '<nav class="main-nav">
	<ul>
	<li class="dropdown-item"><a href="professor_2.php">Inserir Questões</a></li>
	<li class="dropdown-item"><a href="consulta_questoes.php">Consultar Questões</a></li>
	<li class="dropdown-item"><a href="admin.php">Admin</a></li>
	<li class="dropdown-item"><a href="logout.php">Logout</a></li>
	</ul>
	</nav>';
}

?>