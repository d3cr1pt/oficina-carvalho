<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CRUD com Bootstrap</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <script>
      function changeSearch(type) {
        $("#form").attr("action",`<?=BASEURL?>search/${type}.php`);
        if(type == "cliente") {
          $("#search-form").attr("placeholder","Nome");
          $("#search-holder").html("Cliente");
        }
        if(type == "veiculo") {
          $("#search-form").attr("placeholder","Placa");
          $("#search-holder").html("Veículo");
        }
        $("#search-form").val("");
      }
    </script>
    <link rel="stylesheet" href="<?=BASEURL?>css/style.css">
    <link rel="stylesheet" href="<?=BASEURL?>vender/font/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?php echo BASEURL; ?>index.php" class="navbar-brand"><?=PROJECT_NAME?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">          
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Clientes <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>customers">Gerenciar Clientes</a></li>
                    <li><a href="<?php echo BASEURL; ?>customers/add.php">Novo Cliente</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Mecânicos <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>mecanico">Gerenciar Mecânicos</a></li>
                    <li><a href="<?php echo BASEURL; ?>mecanico/add.php">Novo Mecânico</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Veículos <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>veiculos">Gerenciar Veículos</a></li>
                    <li><a href="<?php echo BASEURL; ?>veiculos/add.php">Novo Veículo</a></li>
                </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Ordem de Serviço <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?=BASEURL?>os/add.php">Criar Ordem de Serviço</a></li>
                <li><a href="<?=BASEURL?>os">Imprimir Ordem de Serviço</a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-right" role="search" id="form" action="<?=BASEURL?>search/cliente.php" method="GET">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="search-holder">Cliente</span><span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#" onclick='changeSearch("cliente")'>Cliente</a></li>
                    <li><a href="#" onclick='changeSearch("veiculo")'>Veículo</a></li>
                  </ul>
                </div><!-- /btn-group -->
                <input type="text" class="form-control" name="search" placeholder="Nome" aria-describedby="basic-addon1" id="search-form" <?php if(isset($_GET['search'])) { echo 'value="'.$_GET['search'].'"'; }?>>
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit" onclick="$('#form').submit()"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </form> 
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <main class="container" style="padding-bottom: 40px">
