<?php
    require 'functions.php';
    view($_GET['id']);
    $today = new DateTime($customer['dt_registro']);
    $dt_registro = $today->format("d/m/Y");
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
    $pagamento = pagamento($customer['id_pagtype']);
?>

<?php include(HEADER_TEMPLATE); ?>
<div class="container" style="padding-top: 20px">
    <div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <table style="width: 100%">
                <tr>
                    <td align="center">
                        <table style="border: 2px solid black; width: 100%">
                            <tr>
                                <td class="text-center font-weight-bold" align="center" style="font-weight: bolder;font-size:x-large;">MECÂNICA</td>
                            </tr>
                            <tr>
                                <td class="text-center" align="center" style="font-size: large;font-style: italic;">DERLI</td>
                            </tr>
                                <td class="text-center" align="center" style="font-size: large">Especializado em Diesel</td>
                            </tr>
                            <tr>
                                <td class="text-center" align="center" style="">"Deus seja Louvado"</td>
                            </tr>
                            <tr>
                                <td class="text-center" align="center" style="">(15) 99612-0053 Whats</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">
            <table style="border: 2px solid black;width: 100%">
                <tr>
                    <td style="border-bottom: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>DATA</b>: <?=$dt_registro?></td>
                </tr>
                <tr>
                    <td style="border-bottom: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>VEICULO</b>: <?=find("veiculos",$customer['id_veiculo'])['marca']?> - <?=find("veiculos",$customer['id_veiculo'])['modelo']?></td>
                </tr>
                <tr>
                    <td style="border-bottom: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>PLACA</b>: <?=$customer['placa']?></td>
                </tr>
                <tr>
                    <td style="border-bottom: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>KM</b>: <?=find("veiculos",$customer['id_veiculo'])['km']?>KM rodados</td>
                </tr>
                <tr>
                    <td style="border-bottom: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>MECÂNICO RESPONSÁVEL</b>: <?=find("mecanico",$customer['id_mecanico'])['name']?></td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="border: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>NOME</b>: <?=$customer['nome']?></td>
        </tr>
        <tr>
            <td style="border: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>ENDEREÇO</b>: <?=$customer['endereco']?></td>
        </tr>
        <tr>
            <td style="border: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>TELEFONE</b>: <?=$customer['telefone']?></td>
        </tr>
        <tr>
            <td style="border: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>CPF/CNPJ</b>: <?=$customer['cpf_cnpj']?></td>
        </tr>
        <tr>
            <td style="border: 2px solid black;text-indent:.5em;padding-top:2px;padding-bottom:2px"><b>CONDIÇÕES DE PAGTO</b>: <?=$pagamento?></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%;border: 2px solid black">
        <tr>
            <td align="center" colspan="2" style="font-size: large">Descrição de Serviços</td>
        </tr>
        <?php foreach(json_decode($customer['services'],true) as $cliente) { ?>
            <tr>
                <td style="border-top: 2px solid black; border-bottom: 2px solid black; text-indent:.5em;  margin-top:2px;margin-bottom:2px;"><?=$cliente['servico']?></td>
                <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-right: 7px; margin-top:2px;margin-bottom:2px;" align="right">R$ <?=number_format($cliente['valor'],2,',','.')?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2" style="text-indent: .5em;">MÃO DE OBRA: <span style="float:right;margin-right:.5em">R$ <?=number_format($customer['dinheiro'],2,',','.')?></span></td>
        </tr>
        <tr>
            <td style="border-top: 2px solid black; border-bottom: 2px solid black;text-indent:.5em;padding-right:7px;" rowspan="2" colspan="2" style="text-indent: .5em;">OBS.: <?=$customer['obs']?></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td align="center">(<?php if($customer['qt_parcelas'] == 1) { echo "X"; } else { echo "&nbsp;&nbsp;";}?>) 1 MÊS</td>
            <td align="center">(<?php if($customer['qt_parcelas'] == 2) { echo "X"; } else { echo "&nbsp;&nbsp;";}?>) 2 MESES</td>
            <td align="center">(<?php if($customer['qt_parcelas'] == 3) { echo "X"; } else { echo "&nbsp;&nbsp;";}?>) 3 MESES</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td align="center">GARANTIA SOMENTE DA MÃO DE OBRA</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td align="center" style="border: 2px solid black;">CONCORDO (AMOS) COM AS CONDIÇÕES E PREÇOS DESTE PEDIDO</td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <div class="row">
        <div style="width: calc(10% / 2);display:inline-block;"></div>
        <div style="width: calc(90% / 3);display:inline-block;border-bottom: 1px solid black" class="col-md-4 col-4 col-xl-4 col-sm-4 col-lg-4 text-center"></div>
        <div style="width: calc(90% / 3);display:inline-block;" class="col-md-4 col-4 col-xl-4 col-sm-4 col-lg-4"></div>
        <div style="width: calc(90% / 3);display:inline-block;border-bottom: 1px solid black" class="col-md-4 col-4 col-xl-4 col-sm-4 col-lg-4 text-center"></div>
        <div style="width: calc(10% / 2);display:inline-block;"></div>
    </div>
    <div class="row">
        <div style="width: calc(10% / 2);display:inline-block;"></div>
        <div style="width: calc(90% / 3);display:inline-block;" class="col-md-4 col-4 col-xl-4 col-sm-4 col-lg-4 text-center">MECÂNICO</div>
        <div style="width: calc(90% / 3);display:inline-block;" class="col-md-4 col-4 col-xl-4 col-sm-4 col-lg-4"></div>
        <div style="width: calc(90% / 3);display:inline-block;" class="col-md-4 col-4 col-xl-4 col-sm-4 col-lg-4 text-center">CLIENTE</div>
        <div style="width: calc(10% / 2);display:inline-block;"></div>
    </div>
    <div class="print">
        <a href="javascript:window.print()" class="btn btn-primary"><i class="fa fa-print"></i>&nbsp;Imprimir</a>
    </div>
</div>