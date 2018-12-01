<?php 
$json = '{ "prova": { "questoes": [ { "materia": "Gerenciamento e Administração de TI", "qtd": 10, "dificuldade": "Facil" }, { "materia": "Gestão de Projetos", "qtd": 10, "dificuldade": "Facil" }, { "materia": "null", "qtd": 10, "dificuldade": "Facil" } ] } }';

echo $json;

$query="select id, questao, alt1, alt2, alt3, alt4, alt5, alt_correta, img from table_questoes  where materia = 1 limit 10;";



?>