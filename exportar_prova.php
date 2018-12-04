<?php 
include("config_questoes.php");
//$json = $_POST['json_parsed'];
var_dump($_POST);
//echo $json;
///
$json = '{ "prova": { "questoes": [ { "materia": "1", "qtd": "5", "dificuldade": "2" }, { "materia": "41", "qtd": "10", "dificuldade": "2" }, { "materia": "14", "qtd": "10", "dificuldade": "2" } ] } }';
$prova = json_decode($json, true);
$data = [];
$prova1 = $prova["prova"];
$content = file_get_contents('template_prova.html');
$questao_template = file_get_contents('template_questao.html');
echo $content;  
foreach ($prova1["questoes"] as $value) {
    $qtd=  $value["qtd"];
    $materia=  $value["materia"];
    $dificuldade=  $value["dificuldade"];
    $queryQuestoes = "select id, questao, alt1, alt2, alt3, alt4, alt5, alt_correta,materia, img from table_questoes where materia=".$materia." and dificuldade=".$dificuldade." limit ".$qtd.";";
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
for($i = 0;$i<=sizeof($data)-1;$i++){
  $questoes_content = $questoes_content.$questao_template;
  $questoes_content = str_replace("{num_questao}", $i+1, $questoes_content);
  $questoes_content = str_replace("{nome_materia}", $data[$i]['materia'], $questoes_content);
  $questoes_content = str_replace("{dificuldade}", "Fácil", $questoes_content);
  $questoes_content = str_replace("[IMG_QUESTAO]", "<img src='".$data[$i]['img']."' style='width:35%'border='0'/>", $questoes_content);
  $questoes_content = str_replace("{txt_questao}", $data[$i]['questao'], $questoes_content);
}
echo($questoes_content);
$content = str_replace("[QUESTOES]", $questoes_content, $content);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array("source" => $content, "landscape" => false, "use_print" => false )),
    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
    CURLOPT_USERPWD => 'a012fe5dc105499391232cd72b181159:'
));
$response = curl_exec($curl);
file_put_contents('prova-teste-3.pdf', $response);
?>