<?=(isset($msg_mismatch)? "<div class='alert alert-danger bold txt-center'>$msg_mismatch</div>" : ""); ?>

<div class="login">
    <div class="modal">
        <p><img class="text-center" src="/assets/img/login.webp" /></p>
        <h1>Authentification</h1>
        <?=$formLogin->display(); ?>
        <p class="forgot"><a href='/forgot'>Mot de passe oublié ?</a></p>
    <div>
</div>