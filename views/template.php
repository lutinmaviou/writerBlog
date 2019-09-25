<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8" />
    <meta name="author" content="Bertrand Bourion" />
    <meta name="description" content="Le blog de Jean Forteroche. Son nouveau roman publié en ligne." />
    <meta name="keywords" content="Jean Forteroche, écrivain, acteur, nouveau roman, chapitres" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!--<script src="https://cdn.tiny.cloud/1/ z5cswllgf3io3usrwa5xosso9z5fo9ek0vfp6r7my9cmyx0u /tinymce/5/tinymce.min.js "></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#chapter_content',
            skin: 'dark',
            width: 600,
            height: 300,
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
        });
    </script><-->
    <script src="https://kit.fontawesome.com/be774ce90d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <header>
        <div id="header">
            <a href="index.php" id="logo">
                <img src="public/img/al_copyrighter.png" alt="plume" id="plume">
                <h1>Jean Forteroche</h1>
            </a>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href=""><i class="fas fa-book"></i> Chapitres</a></li>
                <li><a href=""><i class="fas fa-user"></i> Connexion</a></li>
                <li><a href=""><i class="fas fa-file-signature"></i> S'inscrire</a></li>
            </ul>
        </div>
    </header>
    <?= $content ?>
</body>


</html>