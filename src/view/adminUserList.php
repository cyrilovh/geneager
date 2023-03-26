<aside>
    <h1>Liste des utilisateurs</h1>
    <input type="text" id="myInput" onkeyup="tableSearch(this, 'userlist')" placeholder="Rechercher dans le tableau" class="w100">
    <table class="w100" id="userlist">
        <tr>
            <th>Identité</th>
            <th>Status</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($userList as $user) : ?>
            <tr>
                <td><?php echo $user['identity']; ?></td>
                <td><?=($user["banned"]==1) ? "<span class='txt-red'>Banni</span>" : "<span class='txt-green'>Actif</span>"; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <a href="/userEdit/?username=<?=$user['username'];?>" class="btn btn-primary btn-sm"><span class="fas fa-pen" title="Modifier l'utilisateur"></span></a>
                    <a href="/adminDeleteAccount/<?=$user['id']; ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash" title="Supprimer le compte"></span></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</aside>