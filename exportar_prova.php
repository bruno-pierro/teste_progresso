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
            
            $queryQuestoes = "select id, questao, alt1, alt2, alt3, alt4, alt5, alt_correta, img from table_questoes;";//; where materia = ".$nome." and dificuldade = ".$dificuldade." limit ".$qtd.";";
            //echo($queryQuestoes);

            $questoes = mysqli_query($db, $queryQuestoes);

            if($questoes != null) {

                while ($row = mysqli_fetch_assoc($questoes)){
                    //var_dump($row);
                    array_push($data,$row);
                }
            }

        }
    }
}


$content = file_get_contents('template_prova.html');
$questao_template = file_get_contents('template_questao.html');

//TODO: insert template

$questoes_content = "";

echo var_dump($data[4]['questao']);

for ($n = 0; $n <= count($data); $n++) {
    
    $questoes_content = $questoes_content.$questao_template;
    $questoes_content = str_replace("{num_questao}", $n, $questoes_content]);
    $questoes_content = str_replace("{nome_materia}", $data[$n][''], $questoes_content);
    $questoes_content = str_replace("{dificuldade}", "Fácil", $questoes_content);
    $questoes_content = str_replace("[IMG_QUESTAO]", "<img src='' border='0'/>", $questoes_content);
    $questoes_content = str_replace("{txt_questao}", "Por que, questão coisa e tal?", $questoes_content);


    echo($questoes_content);
}

// $content = str_replace("[QUESTOES]", $questoes_content, $content);

// echo $content;

// $curl = curl_init();

// curl_setopt_array($curl, array(
//     CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_POST => true,
//     CURLOPT_POSTFIELDS => json_encode(array("source" => $content, "landscape" => false, "use_print" => false )),
//     CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
//     CURLOPT_USERPWD => 'a012fe5dc105499391232cd72b181159:'
// ));

// $response = curl_exec($curl);
// file_put_contents('prova-teste-1.pdf', $response);

?>