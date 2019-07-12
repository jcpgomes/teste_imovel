<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" />
        <title><?php echo $titulo; ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" />
        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    </head>
    <body>
        <div class="header navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
            <div class="col-4">
                <h1 class="h1-painel">Imoveis</h1>
            </div>
            <div class="col-8">
                <nav>
                    <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
                        <li class="nav-item item-usuario"><?php echo $username;?></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('imoveis/logout');?>">Sair</a></li>
                    </ul>
                </nav>
            </div>
        </div>
