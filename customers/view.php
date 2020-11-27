<?php 
ini_set('display_errors',1);
	require_once('functions.php'); 
	view($_GET['id']);
	$db = open_database();
	$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
	$sql = "SELECT * FROM veiculos WHERE id_cliente = '$id'";
	$query = $db->query($sql);
	$veiculos = [];
	while($row = $query->fetch_assoc()) {
		$veiculos[]=$row;
	}
	$sql2 = "SELECT * FROM os LEFT JOIN veiculos ON os.id_veiculo=veiculos.id WHERE veiculos.id_cliente = '$id'";
	$query = $db->query($sql2);
	$oss = [];
	while($row = $query->fetch_assoc()) {
		$oss[]=$row;
	}
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Cliente <?php echo $customer['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Nome / Razão Social:</dt>
	<dd><?php echo $customer['name']; ?></dd>

	<dt>Responsável pela Empresa:</dt>
	<dd><?php echo $customer['resp_cnpj']; ?>

	<dt>CPF / CNPJ:</dt>
	<dd><?php echo $customer['cpf_cnpj']; ?></dd>

	<dt>Data de Nascimento:</dt>
	<dd><?php echo $customer['birthdate']; ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>Endereço:</dt>
	<dd><?php echo $customer['address']; ?></dd>

	<dt>Bairro:</dt>
	<dd><?php echo $customer['hood']; ?></dd>

	<dt>CEP:</dt>
	<dd><?php echo $customer['zip_code']; ?></dd>

	<dt>Data de Cadastro:</dt>
	<dd><?php echo $customer['created']; ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>Cidade:</dt>
	<dd><?php echo $customer['city']; ?></dd>

	<dt>Telefone:</dt>
	<dd><?php echo $customer['phone']; ?></dd>

	<dt>Celular:</dt>
	<dd><?php echo $customer['mobile']; ?></dd>

	<dt>UF:</dt>
	<dd><?php echo $customer['state']; ?></dd>

	<dt>Inscrição Estadual:</dt>
	<dd><?php echo $customer['ie']; ?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
	  <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">Editar</a>
	  <a href="index.php" class="btn btn-default">Voltar</a>
	</div>
</div>

<br>
<?php if(count($veiculos) > 0) { ?>
	<p style="padding-bottom: 1rem;border-bottom: 1px solid grey;" class="display h4"><a href="#" onclick="$('#table1').toggle();$(this).toggleClass('text-success');" class="btn btn-primary">&#128065;</a>&nbsp;Veículos</p>
	<table class="table table-hover" id="table1" style="display:none">
		<thead class="thead-light">
			<tr>
				<th scope="col">Marca</th>
				<th scope="col">Modelo</th>
				<th scope="col">Placa</th>
				<th scope="col" class="text-right">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($veiculos as $veiculo) { ?>
				<tr>
					<td><?=$veiculo['marca']?></td>
					<td><?=$veiculo['modelo']?></td>
					<td><?=$veiculo['placa']?></td>
					<td align="right"><a href="<?=BASEURL?>veiculos/view.php?id=<?=$veiculo['id']?>" class="btn btn-success">Visualizar</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>

<br>
<?php if(count($oss) > 0) { ?>
	<p style="padding-bottom: 1rem;border-bottom: 1px solid grey;" class="display h4"><a href="#" onclick="$('#table2').toggle();$(this).toggleClass('text-success');" class="btn btn-primary">&#128065;</a>&nbsp;Ordens de Serviços</p>
	<table class="table table-hover" id="table2" style="display:none">
		<thead class="thead-light">
			<tr>
				<th scope="col">Placa</th>
				<th scope="col">Dinheiro</th>
				<th scope="col">Data de Registro</th>
				<th scope="col" class="text-right">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($oss as $veiculo) { ?>
				<tr>
					<td><?=$veiculo['placa']?></td>
					<td>R$ <?=number_format($veiculo['dinheiro'],2,',','.')?></td>
					<td><?php $today = new DateTime($veiculo['dt_registro']); echo $today->format("d/m/Y"); ?></td>
					<td align="right"><a href="<?=BASEURL?>os/view.php?id=<?=$veiculo['id']?>" class="btn btn-success">Visualizar</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>

<?php include(FOOTER_TEMPLATE); ?>
