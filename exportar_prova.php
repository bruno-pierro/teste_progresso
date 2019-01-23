<?php 
include("config_questoes.php");

$json = json_decode($_POST['data']);
$prova = json_decode($json, true);

$data = [];
$prova1 = $prova["prova"];
$content = file_get_contents('template_prova.html');
$questao_template = file_get_contents('template_questao.html');
$gabarito = file_get_contents('template_gabarito.html');
$itens_gabarito = file_get_contents('gabarito_itens.html');
echo $content;  
foreach ($prova1["questoes"] as $value) {
  $qtd=  $value["qtd"];
  $materia=  $value["materia"];
  $dificuldade=  $value["dificuldade"];
  $queryQuestoes = "select id, questao, alt1, alt2, alt3, alt4, alt5, alt_correta,materia, img from table_questoes where materia=".$materia." and dificuldade=".$dificuldade." order by RAND() limit ".$qtd.";";


  $questoes = mysqli_query($db, $queryQuestoes);
//TODO: insert template
  $questoes_content = "";
  $gabarito_content = "";
  if($questoes != null) {
    while ($row = mysqli_fetch_assoc($questoes)){
      array_push($data,$row);
    }
  }
    //$content = str_replace("[QUESTOES]", $questoes_content, $content);
}
for($i = 0;$i<sizeof($data);$i++){


  if ($data[$i]['img'] == null || $data[$i]['img'] == '') {

   $questoes_content = $questoes_content.$questao_template;
   $gabarito_content = $gabarito_content.$itens_gabarito;
   $questoes_content = str_replace("[IMG_QUESTAO]", "<span class='sem_imagem'></span>", $questoes_content);
   $questoes_content = str_replace("{num_questao}", $i+1, $questoes_content);
   $questoes_content = str_replace("{nome_materia}", $data[$i]['materia'], $questoes_content);
   $questoes_content = str_replace("{dificuldade}", "Fácil", $questoes_content);
   $questoes_content = str_replace("{txt_questao}", $data[$i]['questao'], $questoes_content);

   $gabarito_content = str_replace("{num_questao}", $i+1, $gabarito_content);
   if ($data[$i]['alt_correta'] == 1) {
    $gabarito_content = str_replace("{alt_correta}", 'A', $gabarito_content);
  }elseif ($data[$i]['alt_correta'] == 2) {
    $gabarito_content = str_replace("{alt_correta}", 'B', $gabarito_content);
  }elseif ($data[$i]['alt_correta'] == 3) {
    $gabarito_content = str_replace("{alt_correta}", 'C', $gabarito_content);
  }elseif ($data[$i]['alt_correta'] == 4) {
    $gabarito_content = str_replace("{alt_correta}", 'D', $gabarito_content);
  }elseif ($data[$i]['alt_correta'] == 5) {
    $gabarito_content = str_replace("{alt_correta}", 'E', $gabarito_content);
  }

}else{

 $questoes_content = $questoes_content.$questao_template;
 $gabarito_content = $gabarito_content.$itens_gabarito;
 $questoes_content = str_replace("[IMG_QUESTAO]", "<img src='".$data[$i]['img']."' style='width:20em'border='0'/>", $questoes_content);
 $questoes_content = str_replace("{num_questao}", $i+1, $questoes_content);
 $questoes_content = str_replace("{nome_materia}", $data[$i]['materia'], $questoes_content);
 $questoes_content = str_replace("{dificuldade}", "Fácil", $questoes_content);
 $questoes_content = str_replace("{txt_questao}", $data[$i]['questao'], $questoes_content);

 $gabarito_content = str_replace("{num_questao}", $i+1, $gabarito_content);
 if ($data[$i]['alt_correta' ] == 1) {
  $gabarito_content = str_replace("{alt_correta}", 'A', $gabarito_content);
}elseif ($data[$i]['alt_correta'] == 2) {
  $gabarito_content = str_replace("{alt_correta}", 'B', $gabarito_content);
}elseif ($data[$i]['alt_correta'] == 3) {
  $gabarito_content = str_replace("{alt_correta}", 'C', $gabarito_content);
}elseif ($data[$i]['alt_correta'] == 4) {
  $gabarito_content = str_replace("{alt_correta}", 'D', $gabarito_content);
}elseif ($data[$i]['alt_correta'] == 5) {
  $gabarito_content = str_replace("{alt_correta}", 'E', $gabarito_content);
}

}




    if($data[$i]['alt1'] != '-') { //or NULL
      $questoes_content = str_replace("{alt1}", $data[$i]['alt1'], $questoes_content);
    }
    if($data[$i]['alt2'] != '-') { //or NULL
      $questoes_content = str_replace("{alt2}", $data[$i]['alt2'], $questoes_content);
    }
    if($data[$i]['alt3'] != '-') { //or NULL
      $questoes_content = str_replace("{alt3}", $data[$i]['alt3'], $questoes_content);
    }
    if($data[$i]['alt4'] != '-') { //or NULL
      $questoes_content = str_replace("{alt4}", $data[$i]['alt4'], $questoes_content);
    }
    if($data[$i]['alt5'] != '-') { //or NULL
      $questoes_content = str_replace("{alt5}", $data[$i]['alt5'], $questoes_content);
    }

  }
  $content = str_replace("[QUESTOES]", $questoes_content, $content);
  $gabarito = str_replace("[QUESTAO_CORRETA]", $gabarito_content, $gabarito);

// $gabarito = str_replace("[QUESTAO_CORRETA]", $gabarito_content, $content);

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array("source" => $content, "landscape" => false, "use_print" => false,  "css" => "css/prova.css")),
    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
    CURLOPT_USERPWD => '291f581b35fb4d3f9e21039fc2d9858e'
  ));
  $response = curl_exec($curl);

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array("source" => $gabarito, "landscape" => false, "use_print" => false,  "css" => "css/prova.css")),
    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
    CURLOPT_USERPWD => '291f581b35fb4d3f9e21039fc2d9858e'
  ));
  $response2 = curl_exec($curl);
  file_put_contents('prova-teste.pdf', $response);
  file_put_contents('gabarito.pdf', $response2);
  file_put_contents('gabarito.php', $gabarito);
  file_put_contents('post2.json', $json);
  ?>