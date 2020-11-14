<?php 
ini_set('display_errors',1);
	require_once('functions.php'); 
	view($_GET['id']);
	function pagamento($id) {
		switch($id) {
			case 0:
			case "Dinheiro":
				return "Dinheiro";
			break;
			case "Boleto":
				return "Boleto";
			break;
			case "CartaoCredito":
				return "Cartão de Crédito";
			break;
			case "CartaoDebito":
				return "Cartão de Débito";
			break;
			case "FaturamentoNF":
				return "Faturamento";
			break;
		}
	}
	$veiculo = find('veiculos',$customer['id_veiculo']);
	$cliente = find('customers',$veiculo['id_cliente']);
	$mecanico = find('mecanico',$customer['id_mecanico']);
	$pagamento = pagamento($customer['id_pagtype']);
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Ordem de Serviço <?php echo $customer['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Data do Registro:</dt>
	<dd><?=$customer['dt_registro']?></dd>
	<dt>Veículo:</dt>
	<dd><?=$veiculo['marca']?> - <?=$veiculo['modelo']?></dd>
	<dt>Placa:</dt>
	<dd><?=$customer['placa']?></dd>
	<dt>Mecânico:</dt>
	<dd><?=$mecanico['name']?></dd>
	<dt>Nome do Cliente:</dt>
	<dd><?=$customer['nome']?></dd>
	<dt>Endereco do Cliente:</dt>
	<dd><?=$customer['endereco']?></dd>
	<dt>Telefone do Cliente:</dt>
	<dd><?=$customer['telefone']?></dd>
	<dt>CPF/CNPJ do Cliente:</dt>
	<dd><?=$customer['cpf_cnpj']?></dd>
	<dt>Pagamento:</dt>
	<dd><?=$pagamento?></dd>
	<dt>Serviços:</dt>
	<table class="table table-bordered">
		<tr>
			<th scope="col">Item</th>
			<th scope="col">Valor (R$)</th>
		</tr>
		<?php foreach(json_decode($customer['services'],true) as $servico) { ?>
			<tr>
				<td><?=$servico['servico']?></td>
				<td><?=number_format($servico['valor'],2,',','.')?></td>
			</tr>		
		<?php } ?>
	</table>
	<dt>Preço da Mão de Obra:</dt>
	<dd><?=$customer['work_price']?></dd>
	<dt>Qt. Parcelas:</dt>
	<dd><?=$customer['qt_parcelas']?></dd>
	<dt>Obs.:</dt>
	<dd><?=$customer['obs']?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
	  <a href="index.php" class="btn btn-default">Voltar</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
