<?php 
ini_set('display_errors',1);
	require_once('functions.php'); 
	view($_GET['id']);
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

<?php include(FOOTER_TEMPLATE); ?>
