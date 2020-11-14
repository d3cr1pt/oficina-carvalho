<?php

require_once('../config.php');
require_once(DBAPI);

$customers = null;
$customer = null;

/**
 *  Listagem de Clientes
 */
function index() {
	global $customers;
	$customers = find_all('os');
}

/**
 *  Pesquisa Todos os Registros de uma Tabela
 */
function find_all( $table ) {
  return find($table);
}

/**
 *  Cadastro de Clientes
 */
function add() {

  if (!empty($_POST['customer'])) {
    
    $today = 
      date_create('now', new DateTimeZone('America/Sao_Paulo'));

    $customer = $_POST['customer'];
    $customer['dt_registro'] = $today->format("Y-m-d H:i:s");
    $customer['services'] = json_encode($_POST['servicos'],JSON_UNESCAPED_UNICODE);
    $db = open_database();
    $placa = $customer["'placa'"];
    $sql = "SELECT id FROM veiculos WHERE placa = '$placa' LIMIT 1;";
    $query = $db->query($sql);
    $customer['id_veiculo'] = $query->fetch_assoc()['id'];
    unset($customer["'id_cliente'"]);
    save('os', $customer);
    header('location: index.php');
  }
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_POST['customer'])) {

      $customer = $_POST['customer'];
      $customer['modified'] = $now->format("Y-m-d H:i:s");

      update('os', $id, $customer);
      header('location: index.php');
    } else {

      global $customer;
      $customer = find('os', $id);
    } 
  } else {
    header('location: index.php');
  }
}

/**
 *  Visualização de um Cliente
 */
function view($id = null) {
  global $customer;
  $customer = find('os', $id);
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $customer;
  $customer = remove('os', $id);

  header('location: index.php');
}

function clientes() {
  return find('customers');
}

function mecanico() {
  return find('mecanico');
}