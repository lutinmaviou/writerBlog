<?php $title = 'Le blog de Jean Forteroche';
ob_start(); ?>
<img src="public/img/user.png" alt="user picture">
<form action="index.php?action=addMember" method="POST">
    <label for="pseudo">Pseudo :
        <input type="text" name="pseudo" id="pseudo">
    </label>
    <label for="password">Mot de passe :
        <input type="password" name="password" id="password">
    </label>
    <button>Valider</button>
</form>
<?php
$content = ob_get_clean();
require('views/template.php');
?>