<?php 
  require_once('functions.php'); 
  $db = open_database();
  $data = filter_input(INPUT_GET,'data',FILTER_SANITIZE_NUMBER_INT);
  $referente = filter_input(INPUT_GET,'referente',FILTER_SANITIZE_STRING);
  $mes = filter_input(INPUT_GET,'mes',FILTER_SANITIZE_NUMBER_INT);
  $ano = filter_input(INPUT_GET,'ano',FILTER_SANITIZE_NUMBER_INT);
  $fpagamento = filter_input(INPUT_GET,'fpagamento',FILTER_SANITIZE_STRING);
  $entrada = filter_input(INPUT_GET,'entrada',FILTER_SANITIZE_NUMBER_FLOAT);
  $saida = filter_input(INPUT_GET,'saida',FILTER_SANITIZE_NUMBER_FLOAT);
  $sql = "INSERT INTO caixa (data,referente,mes,ano,pagamento,entrada,saida) VALUES ('$data','$referente','$mes','$ano','$fpagamento','$entrada','$saida')";
  $db->query($sql);
  echo $db->error;
  header("Location: caixa.php?mes=$mes&ano=$ano");