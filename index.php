<?php require 'views/header.php' ?>
<?php require 'views/body_start.php' ?>
<?php $page = (isset($_GET['page'])) ? $_GET['page'] : '';
if ($page == 1)
{
?> <div id="carregaTabFinalizado"></div> <?php
}
else
{ ?> <div id="carregaTabPendente"></div><?php
}
?>

<?php require 'views/body_end.php' ?>
<?php require 'views/footer_start.php' ?>
<?php require 'views/footer_end.php' ?>
