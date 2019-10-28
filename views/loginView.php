<?php $title = 'Connexion';
ob_start(); ?>
<section class="container pt-4">
    <div class="row">
        <img src="public/img/admin.png" alt="user picture" class="mx-auto cnx">
    </div>

    <div class="wrapper px-4">
        <!-- Default form register -->
        <div class="row">
            <form class="form col-md-6 text-center mx-auto bg-md bg-sm shadow border border-light rounded-lg p-5 mt-4" action="index.php?action=submitLogin" method="POST">
                <h4 class="mb-4">Connexion</h4>
                <div class="form-row mb-4">
                    <div class="col">
                        <!-- Pseudo -->
                        <label for="pseudo">
                            <input type="text" id="pseudo" name="pseudo" class="form-control mr-lg-5" placeholder="Pseudo" required>
                        </label>
                    </div>
                </div>
                <!-- Password -->
                <label for="password">
                    <input type="password" id="password" name="password" class="form-control mr-lg-5" placeholder="Mot de passe" required>
                </label>
                <small class="form-text text-muted mb-4">
                </small>
                <!-- Sign up button -->
                <button class="btn btn-info px-5" type="submit">Valider</button>
                <p class="mb-n3 pt-4"><a href="index.php?action=subscribe">Pas encore inscrit? <i class="fas fa-sign-in-alt"></i></a></p>
            </form>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require('views/template.php');
?>