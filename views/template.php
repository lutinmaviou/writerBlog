<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bertrand Bourion" />
    <meta name="description" content="Le blog de Jean Forteroche. Son nouveau roman publié en ligne." />
    <meta name="keywords" content="Jean Forteroche, écrivain, acteur, nouveau roman, chapitres" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinyMCE.init({
            selector: ".editor",
            language: "fr_FR",
            browser_spellcheck: true,
            plugins: "emoticons",
            toolbar1: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            toolbar2: 'fontselect fontsizeselect | forecolor backcolor emoticons'
        });
    </script>
    <script src="https://kit.fontawesome.com/be774ce90d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <header style="
    <?php
    if ($_SESSION && $_SESSION['status'] === '1') {
        ?>
        background-color: #29D585;
        <?php
        }
        ?>
    ">
        <div id="header">
            <a href="index.php" id="logo">
                <img src="public/img/al_copyrighter.png" alt="plume" id="plume">
                <h1>Jean Forteroche</h1>
            </a>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
                <?php
                if ($_SESSION && $_SESSION['status'] === '1') {
                    echo '<li><a href="index.php?action=newPost"><i class="fas fa-pen-nib"></i> Créer</a></li>';
                } elseif (!$_SESSION) {
                    echo '<li><a href="index.php?action=login"><i class="fas fa-user"></i> Connexion</a></li>';
                    echo '<li><a href="index.php?action=subscribe"><i class="fas fa-file-signature"></i> S\'inscrire</a></li>';
                }
                if ($_SESSION) {
                    echo '<li><a href="index.php?action=logout"><i class="fas fa-sign-out-alt"></i> Quitter</a></li>';
                }
                ?>
            </ul>
        </div>
    </header>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?= $content ?>
</body>


</html>