<?php
	ini_set('display_errors',1);
    require_once('../functions.php');
    require_once('functions.php');
    require_once('../inc/modal.php');
    index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Caixa</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
	    </div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>
	<?php clear_messages(); ?>
<?php endif; ?>

<hr>

<table class="table table-hover">
<thead>
	<tr>
		<th>Mês</th>
		<th>Ano</th>
		<th></th>
	</tr>
</thead>
<tbody>
	<form action="caixa.php" method="get">
		<tr>
			<td>
				<select name="mes" id="input1" class="form-control" required>
					<option value="01">Janeiro</option>
					<option value="02">Fevereiro</option>
					<option value="03">Março</option>
					<option value="04">Abril</option>
					<option value="05">Maio</option>
					<option value="06">Junho</option>
					<option value="07">Julho</option>
					<option value="08">Agosto</option>
					<option value="09">Setembro</option>
					<option value="10">Outubro</option>
					<option value="11">Novembro</option>
					<option value="12">Dezembro</option>
				</select>
			</td>
			<td><input type="number" max="9999" min="1000" step="1" maxlength="4" name="ano" id="input2" class="form-control" required></td>
			<td>
				<input type="submit" value="Continuar" class="btn btn-primary">
				<button class="btn btn-success">&#128065;&nbsp;Visualizar</button>
			</td>
		</tr>
	</form>
</tbody>
</table>

<?php include(FOOTER_TEMPLATE); ?>
