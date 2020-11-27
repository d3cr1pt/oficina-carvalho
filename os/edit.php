<?php 
  require_once('functions.php'); 
  edit($_GET['id']);
  $id5 = find('veiculos',$customer['id_veiculo']);
  $criente = $id5['id_cliente'];
  $veiculo = $customer['id_veiculo'];
  $mecacriente = $customer['id_mecanico'];
  $sql = "SELECT * FROM veiculos WHERE id_cliente = '$criente'";
  $db = open_database();
  $query2 = $db->query($sql);
  $placas = [];
  echo $db->error;
  while($row=$query2->fetch_assoc()) {
    $placas[]=$row;
  }
  $clientes = clientes();
  $mecanicos = mecanico();
?>
<?php $services = json_decode($customer['services'],true) ?>
<?php include(HEADER_TEMPLATE); ?>
<script>
  $n = <?=count($services);?>;
  function aServico() {
    $td = `
    <tr>
      <td class="excel"><input class="excel" name="servicos[${$n}][servico]"></td>
      <td class="excel"><input class="excel" type="number" name="servicos[${$n}][valor]"></td>
    </tr>
    `;
    $("tbody").append($td);
    $("tbody")[0].focus();
    $n++;
  }
</script>

<h2>Nova Ordem de Serviço</h2>

<form action="add.php" method="post">
  <!-- area de campos do form -->
  <hr />
  <div class="row">
    <div class="form-group col-md-4">
      <label for="name">Cliente</label>
      <select name="customer['id_cliente']" id="cliente" class="form-control" onchange="loadPlacas();loadCliente();">
        <?php foreach($clientes as $cliente) { ?>
            <option <?php if($cliente['id'] == $criente) { echo "selected";}?> value="<?=$cliente['id']?>"><?=$cliente['name']?> - (<?=$cliente['cpf_cnpj']?>)</option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="placa">Placa</label>
      <select name="customer['placa']" id="placa" class="form-control">
        <?php foreach($placas as $cliente) { ?>
          <option <?php if($cliente['id'] == $veiculo) { echo "selected";}?> value="<?=$cliente['id']?>"><?=$cliente['marca']?> - (<?=$cliente['placa']?>)</option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="name">Mecânico</label>
      <select name="customer['id_mecanico']" id="cliente" class="form-control" onchange="loadPlacas()">
        <option value="" disabled selected>Selecione...</option>
        <?php foreach($mecanicos as $cliente ) { ?>
          <option <?php if($cliente['id'] == $mecacriente) { echo "selected";}?> value="<?=$cliente['id']?>"><?=$cliente['name']?> - (<?=$cliente['cpf_cnpj']?>)</option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="id_pagtype">Forma de Pagamento</label>
      <select name="customer['id_pagtype']" id="id_pagtype" class="form-control">
        <option <?php if($customer['id_pagtype'] == "Dinheiro") { echo "selected"; }?> value="Dinheiro">Dinheiro</option>
        <option <?php if($customer['id_pagtype'] == "Boleto") { echo "selected"; }?> value="Boleto">Boleto</option>
        <option <?php if($customer['id_pagtype'] == "CartaoCredito") { echo "selected"; }?> value="CartaoCredito">Cartão de Crédito</option>
        <option <?php if($customer['id_pagtype'] == "CartaoDebito") { echo "selected"; }?> value="CartaoDebito">Cartão de Débito</option>
        <option <?php if($customer['id_pagtype'] == "FaturamentoNF") { echo "selected"; }?> value="FaturamentoNF">Faturamento</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-2">
      <label for="name">Nome / Razão Social</label>
      <input type="text" class="form-control" name="customer['nome']" value="<?=$customer['nome']?>" id="cliente_name" readonly>
    </div>
    <div class="form-group col-md-5">
      <label for="cliente_address">Endereço</label>
      <input type="text" class="form-control" name="customer['endereco']" value="<?=$customer['endereco']?>" id="cliente_address" readonly>
    </div>
    <div class="form-group col-md-3">
      <label for="cliente_mobile">Telefone</label>
      <input type="text" class="form-control" name="customer['telefone']" value="<?=$customer['telefone']?>" id="cliente_mobile" readonly>
    </div>
    <div class="form-group col-md-2">
      <label for="cliente_cpf">CPF/CNPJ</label>
      <input type="text" class="form-control" name="customer['cpf_cnpj']" value="<?=$customer['cpf_cnpj']?>" id="cliente_cpf" readonly>
    </div>
  </div>
  <h4 style="margin-top: 0px !important;border-bottom: 1px solid grey;padding-bottom: 5px"><a href="#" class="btn btn-default" onclick="aServico()"><i class="fa fa-plus"></i></a>&nbsp;Serviços</h4>
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th scope="col">Item</th>
        <th scope="col">Valor (R$)</th>
      </tr>
    </thead>
    <tbody>
      
      <?php for($n=0;$n<count($services);$n++) { ?>
        <tr>
          <td class="excel"><input class="excel"               value="<?=$services[$n]['servico']?>"name="servicos[$n][servico]"></td>
          <td class="excel"><input class="excel" type="number" value="<?=$services[$n]['valor']?>"name="servicos[$n][valor]"></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="row">
    <div class="form-group col-md-3">
      <label for="id_pagtype">Quantidade de Garantia</label>
      <select name="customer['qt_parcelas']" id="qt_parcelas" class="form-control">
        <option <?php if($customer['qt_parcelas'] == 1) { echo "selected"; } ?> value="1">1 MÊS</option>
        <option <?php if($customer['qt_parcelas'] == 2) { echo "selected"; } ?> value="2">2 MESES</option>
        <option <?php if($customer['qt_parcelas'] == 3) { echo "selected"; } ?> value="3">3 MESES</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="work_price">Mão de Obra (R$)</label>
      <input type="number" name="customer['work_price1']" value="<?=$customer['work_price1']?>" id="work_price1" class="form-control">
    </div>
    <div class="form-group col-md-2">
      <label for="work_price">Peças (R$)</label>
      <input type="number" name="customer['work_price2']" value="<?=$customer['work_price2']?>" id="work_price2" class="form-control">
    </div>
    <div class="form-group col-md-5">
      <label for="obs">Observações</label>
      <textarea name="customer['obs']" id="obs" rows="1" class="form-control"><?=$customer['obs']?></textarea>
    </div>
  </div>
  
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
