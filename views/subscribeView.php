<?php $title = 'Inscription';
ob_start(); ?>
<img src="public/img/user.png" alt="user picture">
<form action="index.php?action=addMember" method="POST">
    <label for="pseudo">Pseudo (obligatoire):
        <input type="text" name="pseudo" id="pseudo" required>
    </label>
    <label for="password">Mot de passe (obligatoire):
        <input type="password" name="password" id="password" minlength="6" placeholder=" 6 caractères minimum" required>
    </label>
    <button>Valider</button>
</form>
<?php
$content = ob_get_clean();
require('views/template.php');
?>