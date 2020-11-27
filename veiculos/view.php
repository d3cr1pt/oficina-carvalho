<?php 
ini_set('display_errors',1);
	require_once('functions.php'); 
	view($_GET['id']);
	$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
	$db = open_database();
	$sql2 = "SELECT * FROM os WHERE id_veiculo = '$id'";
	$query = $db->query($sql2);
	$oss = [];
	while($row = $query->fetch_assoc()) {
		$oss[]=$row;
	}
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Veículo <?php echo $customer['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">

	<dt>Marca:</dt>
	<dd><?=$customer['marca']?></dd>

	<dt>Ano de Fabricação:</dt>
	<dd><?=$customer['ano_de_fabricacao']?></dd>

	<dt>Modelo:</dt>
	<dd><?=$customer['modelo']?></dd>

	<dt>Placa:</dt>
	<dd><?=$customer['placa']?></dd>

</dl>

<dl class="dl-horizontal">

	<dt>Motor:</dt>
	<dd><?=$customer['motor']?></dd>

	<dt>Número Eixos:</dt>
	<dd><?=$customer['numero_eixos']?></dd>

	<dt>Potência (Cavalos):</dt>
	<dd><?=$customer['potencia_cc']?></dd>

	<dt>Quantidade de Portas:</dt>
	<dd><?=$customer['quant_portas']?></dd>

</dl>

<div id="actions" class="row">
	<div class="col-md-12">
	  <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">Editar</a>
	  <a href="index.php" class="btn btn-default">Voltar</a>
	</div>
</div>

<?php if(count($oss) > 0) { ?>
	<p style="padding-bottom: 1rem;border-bottom: 1px solid grey;" class="display h4"><a href="#" onclick="$('#table2').toggle();$(this).toggleClass('text-success');" class="btn btn-primary">&#128065;</a>&nbsp;Veículos</p>
	<table class="table table-hover" id="table2" style="display:none">
		<thead class="thead-light">
			<tr>
				<th scope="col">Serviços</th>
				<th scope="col">Valor Cobrado</th>
				<th scope="col">Data de Registro</th>
				<th scope="col" class="text-right">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($oss as $veiculo) { ?>
				<tr>
					<td><?php 
						$services_list = [];
						foreach(json_decode($veiculo['services'],true) as $servico) {
							$services_list[]=$servico['servico'];
						}
						echo join(", ",$services_list);
					?></td>
					<td>R$ <?=number_format($veiculo['dinheiro'],2,',','.')?></td>
					<td><?php $today = new DateTime($veiculo['dt_registro']); echo $today->format("d/m/Y"); ?></td>
					<td align="right"><a href="<?=BASEURL?>os/view.php?id=<?=$veiculo['id']?>" class="btn btn-success">Visualizar</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>

<?php include(FOOTER_TEMPLATE); ?>
