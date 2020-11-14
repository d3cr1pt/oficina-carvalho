<?php 
  require_once('functions.php'); 
  add();
  $clientes = clientes();
  $mecanicos = mecanico();
?>
<?php include(HEADER_TEMPLATE); ?>
<script>
  function loadPlacas() {
    if($("#cliente").val() != null) {
      e = {
        url: "ajax.php",
        id: $("#cliente").val()
      }
      $.get(e.url,e,function(result){
        $content = "";
        result.forEach(function(item){
          $content += `<option value="${item.placa}">${item.modelo} - ${item.placa}</option>`;
        })
        $("#placa").removeAttr("disabled").html($content);
      });
    }
  }
  function loadCliente() {
    if($("#cliente").val() != null) {
      e = {
        url: "ajax_clientes.php",
        id: $("#cliente").val()
      }
      $.get(e.url,e,function(result){
        console.log(result)
        $("#cliente_name").val(result.name);
        $("#cliente_address").val(result.address + ' - ' + result.city + ", " + result.state);
        $("#cliente_mobile").val(result.mobile);
        $("#cliente_cpf").val(result.cpf_cnpj);
        
      });
    }
  }
  $n = 1;
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
      <select name="customer['id_cliente']" id="cliente" class="form-control" onchange="loadPlacas();loadCliente()">
        <option value="" disabled selected>Selecione...</option>
        <?php foreach($clientes as $cliente) { ?>
          <option value="<?=$cliente['id']?>"><?=$cliente['name']?> - (<?=$cliente['cpf_cnpj']?>)</option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="placa">Placa</label>
      <select name="customer['placa']" id="placa" class="form-control" disabled></select>
    </div>
    <div class="form-group col-md-3">
      <label for="name">Mecânico</label>
      <select name="customer['id_mecanico']" id="cliente" class="form-control" onchange="loadPlacas()">
        <option value="" disabled selected>Selecione...</option>
        <?php foreach($mecanicos as $cliente) { ?>
          <option value="<?=$cliente['id']?>"><?=$cliente['name']?> - (<?=$cliente['cpf_cnpj']?>)</option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="id_pagtype">Forma de Pagamento</label>
      <select name="customer['id_pagtype']" id="id_pagtype" class="form-control">
        <option value disabled selected>Selecione...</option>
        <option value="Dinheiro">Dinheiro</option>
        <option value="Boleto">Boleto</option>
        <option value="CartaoCredito">Cartão de Crédito</option>
        <option value="CartaoDebito">Cartão de Débito</option>
        <option value="FaturamentoNF">Faturamento</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-2">
      <label for="name">Nome / Razão Social</label>
      <input type="text" class="form-control" name="customer['nome']" id="cliente_name" readonly>
    </div>
    <div class="form-group col-md-5">
      <label for="cliente_address">Endereço</label>
      <input type="text" class="form-control" name="customer['endereco']" id="cliente_address" readonly>
    </div>
    <div class="form-group col-md-3">
      <label for="cliente_mobile">Telefone</label>
      <input type="text" class="form-control" name="customer['telefone']" id="cliente_mobile" readonly>
    </div>
    <div class="form-group col-md-2">
      <label for="cliente_cpf">CPF/CNPJ</label>
      <input type="text" class="form-control" name="customer['cpf_cnpj']" id="cliente_cpf" readonly>
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
      <tr>
        <td class="excel"><input class="excel" name="servicos[0][servico]"></td>
        <td class="excel"><input class="excel" type="number" name="servicos[0][valor]"></td>
      </tr>
    </tbody>
  </table>
  <div class="row">
    <div class="form-group col-md-3">
      <label for="id_pagtype">Quantidade de Garantia</label>
      <select name="customer['qt_parcelas']" id="qt_parcelas" class="form-control">
        <option value disabled selected>Selecione...</option>
        <option value="1">1 MÊS</option>
        <option value="2">2 MESES</option>
        <option value="3">3 MESES</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="work_price">Mão de Obra (R$)</label>
      <input type="number" name="customer['work_price']" id="work_price" class="form-control">
    </div>
    <div class="form-group col-md-2">
      <label for="work_price">Peças (R$)</label>
      <input type="number" name="customer['work_price']" id="work_price" class="form-control">
    </div>
    <div class="form-group col-md-5">
      <label for="obs">Observações</label>
      <textarea name="customer['obs']" id="obs" rows="1" class="form-control"></textarea>
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
