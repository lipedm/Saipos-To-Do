<?php ?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Todo List</title>
        <meta name="description" content="Todo">
        <meta name="author" content="Felipe Fernandes">
        <meta name="robots" content="">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.min.css">
        <link rel="shortcut icon" href="assets/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="assets/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon-180x180.png">
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="assets/js/plugins/datatables/dataTables.bootstrap4.css">
        <link rel="stylesheet" type="text/css" href="assets/js/plugins/sweetalert2/sweetalert2.min.css">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <a class="navbar-brand" href="index.php">To-Do List</a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Lista Pendentes <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=1">Lista Finalizados</a>
                    </li>
                </ul>
            </div>
        </nav>
