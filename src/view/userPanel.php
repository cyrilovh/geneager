<aside>
    <h2>Gestion de contenu</h2>
    <div class="userPanel">
        <div class="persoBtn" data-href="/ancestorList">
            <div>
                <i class="far fa-id-card"></i>
            </div>
            <div>
                Fiches d'identités
            </div>
        </div>

        <div class="persoBtn" data-href="/albumList">
            <div>
                <i class="fas fa-images"></i>
            </div>
            <div>
                Album
            </div>
        </div>

        <div class="persoBtn" data-href="/userPictureList">
            <div>
                <i class="fas fa-camera"></i>
            </div>
            <div>
                Photos
            </div>
        </div>

        <div class="persoBtn" data-href="/userArchiveList">
            <div>
                <i class="fas fa-landmark"></i>
            </div>
            <div>
                Archives
            </div>
        </div>

        <div class="persoBtn" data-href="/userVideoList">
            <div>
                <i class="fas fa-film"></i>
            </div>
            <div>
                Vidéos
            </div>
        </div>
    </div><!-- End of div.userPanel -->
    <h2>Bases de connaissances:</h2>
    <div class="userPanel">
        <div class="persoBtn" data-href="/userJob">
            <div>
                <i class="fas fa-user-doctor"></i>
            </div>
            <div>
                Métiers
            </div>
        </div>
        <div class="persoBtn" data-href="/userLocation">
            <div>
                <i class="fas fa-location-dot"></i>
            </div>
            <div>
                Lieux
            </div>
        </div>
    </div>

    <h2>Paramètres</h2>
    <div class="userPanel">
        <div class="persoBtn" data-href="/userEdit">
            <div>
                <i class="far fa-user"></i>
            </div>
            <div>
                Mon profil
            </div>
        </div>
        <?php
            if(\class\userInfo::isAdmin()){
        ?>
            <div class="persoBtn" data-href="/adminUserList">
                <div>
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    Liste des utilisateurs
                </div>
            </div>

            <div class="persoBtn" data-href="/adminParams" title="Paramètres du site">
                <div>
                    <i class="fas fa-gear"></i>
                </div>
                <div>
                    Paramètres généraux
                </div>
            </div>

            <div class="persoBtn" data-href="/adminSecurity" title="Sécurité">
                <div>
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    Paramètres de sécurité
                </div>
            </div>

            <div class="persoBtn" data-href="/adminSpeed" title="Journal des actions">
                <div>
                    <i class="fas fa-gauge-simple"></i>
                </div>
                <div>
                    Performances
                </div>
            </div>

            <div class="persoBtn" data-href="/adminUpdate" title="Mise(s) à jour du site">
                <div>
                    <i class="fas fa-arrows-rotate"></i>
                </div>
                <div>
                    Mise(s) à jour
                </div>
            </div>

            <div class="persoBtn" data-href="/adminHealth" title="Sécurité et santé du site">
                <div>
                    <i class="fas fa-heart-pulse"></i>
                </div>
                <div>
                    Santé du site
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</aside>