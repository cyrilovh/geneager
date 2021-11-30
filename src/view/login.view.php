<h1 class="txt-center">Authentification</h1>
<?=(isset($msg_mismatch)? $msg_mismatch : ""); ?>
<form action="/login" method="post" class="login">
    <input type="text" placeholder="Nom d'utilisateur" name="username" minlength="<?=\gng\db::getParameter("usernameMinLength"); ?>" maxlength="<?=\gng\db::getParameter("usernameMaxLength"); ?>"/>
    <input type="password" placeholder="Mot de passe" name="password" minlength="<?=\gng\db::getParameter("passwordMinLength"); ?>" maxlength="<?=\gng\db::getParameter("passwordMaxLength"); ?>"/>
    <input type="submit" class="btn btn-primary" name="submit" value="Connexion" />
</form>