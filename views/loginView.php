<?php $title = 'Connexion';
ob_start(); ?>
<img src="public/img/admin.png" alt="user picture">
<form action="index.php?action=submitLogin" method="POST">
    <label for="pseudo">Pseudo :
        <input type="text" name="pseudo" id="pseudo">
    </label>
    <label for="password">Mot de passe :
        <input type="password" name="password" id="password">
    </label>
    <button>Valider</button>
    <p><a href="index.php?action=subscribe">Pas encore inscrit? <i class="fas fa-sign-in-alt"></i></a></p>
</form>
<?php
$content = ob_get_clean();
require('views/template.php');
?>