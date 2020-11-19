<?php
    ini_set('display_errors',1);
    require_once('../config.php');
    require_once('../functions.php');
    require_once('../inc/modal.php');
    require DBAPI;
    $search = mb_strtoupper(filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING));
    $sql = "SELECT * FROM veiculos WHERE placa LIKE '%$search%'";
    $db = open_database();
    $query = $db->query($sql);
    echo $db->error;
    $response=[];
    while($row=$query->fetch_assoc()) {
        $response[]=$row;
    }
    $customers=$response;
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Veículos</h2>
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
		<th>ID</th>
		<th>Marca</th>
		<th>Modelo</th>
		<th>Placa</th>
		<th class="text-left">Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($customers) : ?>
<?php foreach ($customers as $customer) : ?>
	<tr>
		<td><?php echo $customer['id']; ?></td>
		<td><?php echo $customer['marca']; ?></td>
		<td><?php echo $customer['modelo']; ?></td>
		<td><?php echo $customer['placa']; ?></td>
		<td class="actions text-right">
			<a href="<?=BASEURL?>veiculos/view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
			<a href="<?=BASEURL?>veiculos/edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
			<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $customer['id']; ?>">
				<i class="fa fa-trash"></i> Excluir
			</a>
		</td>
	</tr>
<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>

<?php include(FOOTER_TEMPLATE); ?>
