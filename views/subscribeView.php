<?php $title = 'Le blog de Jean Forteroche';
ob_start(); ?>
<img src="public/img/user.png" alt="user picture">
<form action="index.php?action=addMember" method="POST">
    <label for="pseudo">Pseudo (obligatoire):
        <input type="text" name="pseudo" id="pseudo" required>
    </label>
    <label for="password">Mot de passe (obligatoire, 6 caractères min):
        <input type="password" name="password" id="password" minlength="6" required>
    </label>
    <button>Valider</button>
</form>
<?php
$content = ob_get_clean();
require('views/template.php');
?>