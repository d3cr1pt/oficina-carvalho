<?php 
  require_once('functions.php'); 
  $db = open_database();
  $id = (int) $_POST['id'];
  $data = filter_input(INPUT_POST,'data',FILTER_SANITIZE_NUMBER_INT);
  $mes = filter_input(INPUT_POST,'mes',FILTER_SANITIZE_STRING);
  $ano = filter_input(INPUT_POST,'ano',FILTER_SANITIZE_NUMBER_INT);
  $referente = filter_input(INPUT_POST,'referente',FILTER_SANITIZE_STRING);
  $entrada = filter_input(INPUT_POST,'entrada',FILTER_SANITIZE_NUMBER_FLOAT);
  $saida = filter_input(INPUT_POST,'saida',FILTER_SANITIZE_NUMBER_FLOAT);
  $pagamento = filter_input(INPUT_POST,'fpagamento',FILTER_SANITIZE_STRING);
  $sql = "UPDATE caixa SET data = '$data', mes = '$mes', ano = '$ano', referente = '$referente', entrada = '$entrada', saida = '$saida', pagamento = '$pagamento' WHERE id = '$id'";
  $db->query($sql);
  echo $db->error;
  header("Location: caixa.php?mes=$mes&ano=$ano");