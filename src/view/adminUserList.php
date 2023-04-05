<aside>
    <h1>Liste des utilisateurs</h1>
    <p class="bar"><a href="/signup" class="btn btn-success"><span class="fas fa-user-plus"></span> Nouvel utilisateur</a></p>
    <input type="text" id="myInput" onkeyup="tableSearch(this, 'userlist')" placeholder="Rechercher dans le tableau" class="w100">
    <table class="w100" id="userlist">
        <tr>
            <th>Identité</th>
            <th>Status</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php

use class\validator;

 foreach ($userList as $user) : ?>
            <tr>
                <td><?=$user['identity']; ?></td>
                <td><?=($user["banned"]==1) ? "<span class='txt-red'>Banni</span>" : "<span class='txt-green'>Actif</span>"; ?>  <?=(!validator::isNullOrEmpty($user["tokenEmailVerified"])) ? "/ e-mail non validée)" : ""; ?></td>
                <td><?=$user['email']; ?></td>
                <td><?=$user['role']; ?></td>
                <td>
                    <a href="/userEdit/?username=<?=$user['username'];?>" class="btn btn-primary btn-sm"><span class="fas fa-pen" title="Modifier l'utilisateur"></span></a>
                    <a href="/adminDeleteAccount/<?=$user['id']; ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash" title="Supprimer le compte"></span></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</aside>