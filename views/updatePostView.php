<?php $title = 'Modification de post';
ob_start();
?>
<form action='index.php?action=submitUpdatePost&amp;id=<?= $post['id'] ?>' method='POST'>
    <label for='title'>Titre :
        <input type="text" name='title' id='title' value="<?= $post['title'] ?>">
    </label>
    <label for="chapterContent">Contenu :
        <textarea name="chapterContent" id="chapterContent" cols="30" rows="10"><?= $post['chapterContent'] ?></textarea>
    </label>
    <button>Valider</button>
</form>
<?php
$content = ob_get_clean();
require('template.php');
?>