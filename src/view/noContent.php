<div class="txt-center mt10">
    <?=isset($msgError) ? $msgError : "<h1>Pas de contenu pour cette requête.</h1>"; ?><!-- will be deprecated -->
    <?=isset($messageList) ? ((!$messageList->isEmptyError()) ? $messageList->getErrorHTML() : "<h1>Pas de contenu pour cette requête.</h1>") : "<h1>Pas de contenu pour cette requête.</h1>"; ?>

    <p><img src="/assets/img/empty.webp" class="e40x" alt="Pas de contenu" /></p>
</div>