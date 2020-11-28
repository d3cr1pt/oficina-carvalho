<?php   require 'functions.php';
        require HEADER_TEMPLATE;
        require '../inc/modal.php';
        if($_GET['mes'] == "") {
            header("Location: index.php");
        }
        if($_GET['ano'] == "") {
            header("Location: index.php");
        }
        $mes = (string) $_GET['mes'];
        $ano = (int) $_GET['ano'];
        $db = open_database();
        $sql = "SELECT * FROM caixa WHERE mes = '$mes' AND ano = '$ano'";
        $query = $db->query($sql);
        $customers = [];$t_entrada = 0; $t_saida = 0;
        while($row = $query->fetch_assoc()) {
            $customers[] = $row;
            if($row['pagamento'] != "Não recebido") {
                $t_entrada += $row['entrada'];
                $t_saida   += $row['saida'];
            }
        }
        $n = count($customers);
?>

<style>
    a:hover {
        text-decoration: none;
    }
</style>

<script>
$n = <?=$n?>;
function addCaixa() {
    $content = `
        <form action="add.php" method="get">
            <table style="border: 1px solid black;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Ação</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Data</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Referente</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Entrada</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Saída</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">F. Pagamento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="row_<?=$n?>">
                        <td class='excel' style="background: red; padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black; text-align: center;">
                            <a href="#" onclick="removeRow(<?=$n?>)" style="color:white">&#128473;</a>
                        </td>
                        <th class='excel'><input  id="input-1" name="data" type="number" class="excel" max="31" min="1" step="1"></th>
                        <td class='excel'><input  id="input-2" name="referente" type="text" class="excel"></td>
                        <td class='excel'><input  id="input-3" name="entrada" type="number" class="excel" max="999999" min="0" step="0.01"></td>
                        <td class='excel'><input  id="input-4" name="saida" type="number" class="excel" max="999999" min="0" step="0.01"></td>
                        <td class='excel'>
                            <select id="input-5" class="excel" name="fpagamento">
                                <option value="Crédito" selected>Crédito</option>
                                <option value="Débito">Débito</option>
                                <option value="Parcela">Parcelamento</option>
                                <option value="Dinheiro">Dinheiro</option>
                                <option value="Não recebido">Não recebido</option>
                                <option value="Outros">Outros...</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="mes" value="<?=$mes?>">
            <input type="hidden" name="ano" value="<?=$ano?>">
        </form>
    `;
    $(".modal-body").html($content);
    $(".modal").modal("show");
    $(".modal .btn-primary").html("Salvar").attr("onclick","sRegistro()").attr("href","#");
    $(".modal .btn-default").hide();
    $(".modal-title").html("Adicionar registro");
    $n++;
}

function edit(el) {
    id = $(el).data("id");
    data = $(el).data("date");
    referente = $(el).data("referente");
    entrada = $(el).data("entrada");
    saida = $(el).data("saida");
    pagamento = $(el).data("pagamento");
    if(pagamento == "Crédito") {      selected1 = "selected"; } else { selected1 = ""};
    if(pagamento == "Débito") {       selected2 = "selected"; } else { selected2 = ""};
    if(pagamento == "Parcela") {      selected3 = "selected"; } else { selected3 = ""};
    if(pagamento == "Dinheiro") {     selected4 = "selected"; } else { selected4 = ""};
    if(pagamento == "Não recebido") { selected5 = "selected"; } else { selected5 = ""};
    if(pagamento == "Outros") {       selected6 = "selected"; } else { selected6 = ""};

    $content = `
        <form action="edit.php" method="post">
            <table style="border: 1px solid black;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Ação</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Data</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Referente</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Entrada</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">Saída</th>
                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black;">F. Pagamento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class='excel' style="background: red; padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px; border: 1px solid black; text-align: center;">
                            <a href="delete.php?id=${id}" style="color:white">&#128473;</a>
                        </td>
                        <th class='excel'><input value="${data}" id="input-1" name="data" type="number" class="excel" max="31" min="1" step="1"></th>
                        <td class='excel'><input value="${referente}" id="input-2" name="referente" type="text" class="excel"></td>
                        <td class='excel'><input value="${entrada}" id="input-3" name="entrada" type="number" class="excel" max="999999" min="0" step="0.01"></td>
                        <td class='excel'><input value="${saida}" id="input-4" name="saida" type="number" class="excel" max="999999" min="0" step="0.01"></td>
                        <td class='excel'>
                            <select id="input-5" class="excel" name="fpagamento">
                                <option ${selected1} value="Crédito">Crédito</option>
                                <option ${selected2} value="Débito">Débito</option>
                                <option ${selected3} value="Parcela">Parcelamento</option>
                                <option ${selected4} value="Dinheiro">Dinheiro</option>
                                <option ${selected5} value="Não recebido">Não recebido</option>
                                <option ${selected6} value="Outros">Outros...</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="mes" value="<?=$mes?>">
            <input type="hidden" name="ano" value="<?=$ano?>">
            <input type="hidden" name="id" value="${id}">
        </form>
    `;
    $(".modal-body").html($content);
    $(".modal").modal("show");
    $(".modal .btn-primary").html("Salvar").attr("onclick","sRegistro()").attr("href","#");
    $(".modal .btn-default").hide();
    $(".modal-title").html("Adicionar registro");
    $n++;
}

function sRegistro() {
    $(".modal form")[0].submit();
}

function removeRow($n) {
    $(".modal").modal("hide");
}
</script>

<h2>Caixa: <?=$mes?>/<?=$ano?></h2>
<hr>
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col"><a href="#" onclick="addCaixa()" class="btn btn-success">+</a>&nbsp;Ação</th>
                    <th scope="col">Data</th>
                    <th scope="col">Referente</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Saída</th>
                    <th scope="col">Forma de Pagamento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($customers as $row) { ?> 
                    <tr>
                        <td>
                             <a href="#" onclick="edit(this)" data-id="<?=$row['id']?>" data-date="<?=$row['data']?>" data-referente="<?=$row['referente']?>" data-entrada="<?=$row['entrada']?>" data-saida="<?=$row['saida']?>" data-pagamento="<?=$row['pagamento']?>" class="btn btn-warning">&#9998;</a>
                            <a href="delete.php?id=<?=$row['id']?>&mes=<?=$mes?>&ano=<?=$ano?>" class="btn btn-danger">&#128473;</a>
                        </td>
                        <th scope="row"><?=$row['data']?>/<?=$mes?>/<?=$row['ano']?></th>
                        <td><?=$row['referente']?></td>
                        <td>R$ <?=number_format($row['entrada'],2,',','.')?></td>
                        <td>R$ <?=number_format($row['saida'],2,',','.')?></td>
                        <td><?php if($row['pagamento'] == "Parcela") { echo "Parcelamento"; } else { echo $row['pagamento']; }?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th scope="row" colspan="2" style="text-align: right"><?=$mes?>/<?=$ano?></th>
                    <td scope="row" style="font-weight: bold">Total</td>
                    <td>R$ <?=number_format($t_entrada,2,',','.')?></td>
                    <td>R$ <?=number_format($t_saida,2,',','.')?></td>
                    <td>Caixa</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php require FOOTER_TEMPLATE; ?>