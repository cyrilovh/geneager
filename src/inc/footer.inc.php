<footer>
	<div class="rows">
		<div class="row1">
			<p class="title">
				Mots-clés
			</p>
			<p>
				<?=$gng_paramList->get("defaultKeywordList"); ?>
			</p>
			<p>
				&nbsp;
			</p>
		</div>
		<div class="row2">
            <p class="title">
                Sur le site
            </p>
            <p>
                <a href="/?page=about">Contact</a>
            </p>
            <p>
                <a href="/?page=about">Mention légales</a>
            </p>
		</div>
        <div class="row3">
            <p class="title">
				A propos de
			</p>
            <p>
				<?=$gng_paramList->get("defaultDescription"); ?>
            </p>
            <p>
                <?=\model\socialLink::get();?>
            </p>
        </div>
	</div>
	<div class="mentions">
		Propulsé par <a href='https://geneager.cyril.ovh'>Geneager</a> &mdash; <a href='https://twitter.com/cyrilovh' rel='nofollow'><i class="fab fa-twitter" data-href='https://twitter.com/' rel='nofollow'></i>cyrilovh</a>
	</div>
</footer>
