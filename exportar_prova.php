<?php 
include("config_questoes.php");

$json = json_decode($_POST['data']);

$prova = json_decode($json, true);

//print_r($prova);
$data = [];
$prova1 = $prova["prova"];
$content = file_get_contents('template_prova.html');
$questao_template = file_get_contents('template_questao.html');
echo $content;  
foreach ($prova1["questoes"] as $value) {
    $qtd=  $value["qtd"];
    $materia=  $value["materia"];
    $dificuldade=  $value["dificuldade"];
    $queryQuestoes = "select id, questao, alt1, alt2, alt3, alt4, alt5, alt_correta,materia, img from table_questoes where materia=".$materia." and dificuldade=".$dificuldade." order by RAND() limit ".$qtd.";";


    $questoes = mysqli_query($db, $queryQuestoes);
//TODO: insert template
    $questoes_content = "";
    if($questoes != null) {
        while ($row = mysqli_fetch_assoc($questoes)){
            array_push($data,$row);
        }
    }
    //$content = str_replace("[QUESTOES]", $questoes_content, $content);
}
for($i = 0;$i<sizeof($data);$i++){
    $questoes_content = $questoes_content.$questao_template;
    $questoes_content = str_replace("{num_questao}", $i+1, $questoes_content);
    $questoes_content = str_replace("{nome_materia}", $data[$i]['materia'], $questoes_content);
    $questoes_content = str_replace("{dificuldade}", "Fácil", $questoes_content);
    $questoes_content = str_replace("[IMG_QUESTAO]", "<img src='".$data[$i]['img']."' style='width:35%'border='0'/>", $questoes_content);
    $questoes_content = str_replace("{txt_questao}", $data[$i]['questao'], $questoes_content);

    $alternativas_content = '';

    if($data[$i]['alt1'] != '') { //or NULL
        $alternativas_content = '<p>a)' + $data[$i]['alt1'] + '</p>';
    }
    if($data[$i]['alt2'] != '') { //or NULL
        $alternativas_content = '<p>b)' + $data[$i]['alt2'] + '</p>';
    }
    if($data[$i]['alt3'] != '') { //or NULL
        $alternativas_content = '<p>c)' + $data[$i]['alt3'] + '</p>';
    }
    if($data[$i]['alt4'] != '') { //or NULL
        $alternativas_content = '<p>d)' + $data[$i]['alt4'] + '</p>';
    }
    if($data[$i]['alt5'] != '') { //or NULL
        $alternativas_content = '<p>e)' + $data[$i]['alt5'] + '</p>';
    }

    $questoes_content = str_replace("[ALTERNATIVAS]", $alternativas_content, $questoes_content);
}
//echo($questoes_content);
$content = str_replace("[QUESTOES]", $questoes_content, $content);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array("source" => $content, "landscape" => false, "use_print" => false, "sandbox" => true )),
    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
    CURLOPT_USERPWD => '291f581b35fb4d3f9e21039fc2d9858e'
));
$response = curl_exec($curl);
file_put_contents('prova-teste.pdf', $response);
file_put_contents('post2.json', $json);
?>