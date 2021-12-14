<?=(isset($msg_mismatch)? "<div class='alert alert-danger bold txt-center'>$msg_mismatch</div>" : ""); ?>

<div class="login">
    <div class="modal">
        <i class="fas fa-arrow-left back"></i> <i class="fas fa-home home"></i>
        <p><img class="text-center" src="/assets/img/login.webp" /></p>
        <h1>Authentification</h1>
        <p class="websiteName"><?=\gng\db::getParameter("websiteName"); ?></p>
        <?=$formLogin->display(); ?>
        <p class="forgot"><a href='/forgot'>Mot de passe oublié ?</a></p>
    <div>
</div>