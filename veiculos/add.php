<?php 
  require_once('functions.php'); 
  add();
  $clientes = clientes();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Veículo</h2>

<form action="add.php" method="post">
  <!-- area de campos do form -->
  <hr />
  <div class="row">
    <div class="form-group col-md-2">
      <label for="campo">Cliente</label>
      <select name="customer['id_cliente']" id="" class="form-control">
        <?php foreach($clientes as $cliente) {
          echo '<option value="'.$cliente['id'].'">'.$cliente['name'].' - ('.$cliente['cpf_cnpj'].')</option>';
        } ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="campo">Marca</label>
      <input type="text" name="customer['marca']" id="" class="form-control">
    </div>
    <div class="form-group col-md-2">
      <label for="campo">Ano de Fabricação</label>
      <input type="text" name="customer['ano_de_fabricacao']" id="" class="form-control">
    </div>
    <div class="form-group col-md-4">
      <label for="campo">Modelo</label>
      <input type="text" name="customer['modelo']" id="" class="form-control">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-2">
      <label for="campo">Placa</label>
      <input type="text" name="customer['placa']" id="" class="form-control">
    </div>
    <div class="form-group col-md-4">
      <label for="campo">KM rodada</label>
      <input type="text" name="customer['motor']" id="" class="form-control">
    </div>
    <div class="form-group col-md-2">
      <label for="campo">Número Eixos</label>
      <input type="text" name="customer['numero_eixos']" id="" class="form-control">
    </div>
    <div class="form-group col-md-2">
      <label for="campo">Potência (Cavalos)</label>
      <input type="text" name="customer['potencia_cc']" id="" class="form-control">
    </div>
    <div class="form-group col-md-2">
      <label for="campo">Quantidade de Portas</label>
      <input type="text" name="customer['quant_portas']" id="" class="form-control">
    </div>
  </div>
  <div class="row">
  </div>
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
