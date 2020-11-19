<?php
    ini_set('display_errors',1);
    require_once('../config.php');
    require_once('../functions.php');
    require_once('../inc/modal.php');
    require DBAPI;
    $search = filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM customers WHERE name LIKE '%$search%'";
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
			<h2>Clientes</h2>
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
		<th width="30%">Nome</th>
		<th>CPF/CNPJ</th>
		<th>Telefone</th>
		<th>Atualizado em</th>
		<th>Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($customers) : ?>
<?php foreach ($customers as $customer) : ?>
	<tr>
		<td><?php echo $customer['id']; ?></td>
		<td><?php echo $customer['name']; ?></td>
		<td><?php echo $customer['cpf_cnpj']; ?></td>
		<td><?php echo mask($customer['mobile'],'## #####-####'); ?></td>
		<td><?php echo $customer['modified']; ?></td>
		<td class="actions text-right">
			<a href="<?=BASEURL?>customers/view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
			<a href="<?=BASEURL?>customers/edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
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
