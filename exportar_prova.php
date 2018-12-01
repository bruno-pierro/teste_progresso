<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">

<?php 

include("config_questoes.php");

$json = '{ "prova": { "questoes": [ { "materia": "20", "qtd": "10", "dificuldade": "2" }, { "materia": "Gestão de Projetos", "qtd": "10", "dificuldade": "Facil" }, { "materia": "teste", "qtd": "10", "dificuldade": "Facil" } ] } }';
$prova = json_decode($json, true);
$data = []; 

foreach($prova as $pKey => $pValue) {
    foreach($pValue as $qKey => $qValue) {
        foreach($qValue as $mKey => $mValue) {
            $nome =  $mValue['materia'];
            $qtd = $mValue['qtd'];
            $dificuldade = $mValue['dificuldade'];
            
            $queryQuestoes = "select id, questao, alt1, alt2, alt3, alt4, alt5, alt_correta, img from table_questoes where materia = ".$nome." and dificuldade = ".$dificuldade." limit ".$qtd.";";
            //echo($queryQuestoes);

            $questoes = mysqli_query($db, $queryQuestoes);

            if($questoes != null) {

                while ($row = mysqli_fetch_assoc($questoes)){
                    var_dump($row);
                    array_push($data,$row);
                }
            }

        }
    }
}

?>


</head>
<body>
    <?php 
    
    for($i = 0; $i <= count($data); $i++) {
        
        if($data != null) {

        echo("<p>".VAR_DUMP($data[$i]['questao']."</p>");
    }

    //foreach($d as $data) { }
    ?>
</body>
</html>