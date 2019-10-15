<?php $title = 'Nouveau post';
ob_start();
?>
<form action='index.php?action=addNewPost' method='POST'>
    <label for='title'>Titre :
        <input type="text" name='title' class="editor" id='title'>
    </label>
    <label for="chapterContent">Contenu :
        <textarea name="chapterContent" class="editor" id="chapterContent" cols="30" rows="10"></textarea>
    </label>
    <button>Valider</button>
</form>
<?php
$content = ob_get_clean();
require('template.php');
?>