<h1 class="txt-center">Authentification</h1>
<?=(isset($msg_mismatch)? "<div class='alert alert-danger bold txt-center'>$msg_mismatch</div>" : ""); ?>
<!-- return :: -->
<?=$formLogin->display(); ?>